<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request): JsonResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $token = $this->userRepository->findByEmailAndPassword($email, $password);

            $data = [
                'success' => true,
                'message' => 'Successfully logged in',
                'data' => [
                    'token' => $token,
                ],
            ];

            $code = JsonResponse::HTTP_OK;
        } catch (ModelNotFoundException $e) {
            $data = [
                'success' => false,
                'message' => 'Invalid email address',
            ];

            $code = JsonResponse::HTTP_UNAUTHORIZED;
        } catch (Exception $e) {
            $data = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            
            $code = JsonResponse::HTTP_UNAUTHORIZED;
        }

        return response()->json($data, $code);
    }
}
