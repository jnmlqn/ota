<?php

namespace App\Http\Controllers;

use App\DTO\JobPostDto;
use App\Enums\EmploymentType;
use App\Enums\Seniority;
use App\Enums\Schedule;
use App\Enums\Status;
use App\Repositories\JobPostsRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JobPostsController extends Controller
{
    public function __construct(
        private JobPostsRepository $jobPostsRepository
    ) {
        $this->jobPostsRepository = $jobPostsRepository;
    }

    public function index(): JsonResponse
    {
        $jobPosts = $this->jobPostsRepository->index();

        return response()->json([
            'success' => true,
            'message' => 'Job posts successflly fetched',
            'data' => $jobPosts,
        ], JsonResponse::HTTP_OK);
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'sub_company' => ['required'],
            'office' => ['required'],
            'department' => ['required'],
            'recruiting_category' => ['required'],
            'employment_type' => ['required', Rule::enum(EmploymentType::class)],
            'seniority' => ['required', Rule::enum(Seniority::class)],
            'schedule' => ['required', Rule::enum(Schedule::class)],
            'years_of_exp' => ['required'],
            'keywords' => ['required', 'array'],
            'occupation' => ['required'],
            'occupation_category' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create job posting',
                'data' => [
                    'errors' => json_decode($validator->errors()->toJson(), true)
                ],
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();
        $data['submitted_by'] = $request->user()->id;

        $dto = new JobPostDto;
        $dto->setAttributes($data);

        $jobPost = $this->jobPostsRepository->create($dto);

        return response()->json([
            'success' => true,
            'message' => 'Job post successflly created',
            'data' => $jobPost,
        ], JsonResponse::HTTP_CREATED);
    }

    public function updateStatus(string $id, string $status): JsonResponse
    {
        try {
            if (!in_array($status, array_column(Status::cases(), 'value'))) {
                $data = [
                    'success' => false,
                    'message' => 'Invalid status',
                ];

                $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;
            } else {
                $this->jobPostsRepository->updateStatus($id, $status);

                $data = [
                    'success' => true,
                    'message' => 'Job post status successflly updated',
                ];

                $code = JsonResponse::HTTP_OK;
            }
        } catch (ModelNotFoundException $e) {
            $data = [
                'success' => false,
                'message' => 'Invalid job posting',
            ];

            $code = JsonResponse::HTTP_NOT_FOUND;
        } catch (Exception $e) {
            $data = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            
            $code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($data, $code);
    }

    public function updateStatusViaEmail(
        Request $request,
        string $id,
        string $status
    ) {
        try {
            if (!in_array($status, array_column(Status::cases(), 'value'))) {
                $message = 'Invalid status';
            } else {
                $this->jobPostsRepository->updateStatus($id, $status);

                $message = 'Job post status successflly updated';
            }
        } catch (ModelNotFoundException $e) {
            $message = 'Invalid job posting';
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return view('status_update', compact('message'));
    }
}
