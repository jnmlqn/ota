<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Models\Role as RoleModel;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function __construct(
        private User $user
    ) {
        $this->user = $user;
    }

    public function createLoginToken(
        string $email,
        string $password,
        string $role
    ): string {
        $role = RoleModel::where('name', $role)->first();
        $user = $this->user
            ->where('email', $email)
            ->where('role_id', $role->id ?? null)
            ->firstOrFail();

        if (!Hash::check($password, $user->password)) {
            throw new Exception('Incorrect password');
        }

        switch ($user->roleId->name) {
            case Role::EMPLOYER->value:
                $permissions = [
                    'ota:job_post'
                ];

                break;

            case Role::SEEKER->value:
                $permissions = [
                    'ota:job_view'
                ];

                break;

            case Role::MODERATOR->value:
                $permissions = [
                    'ota:job_status'
                ];

                break;
            
            default:
                break;
        }

        return $user->createToken(
            'basic', 
            $permissions,
            now()->addDay()
        )->plainTextToken;
    }
}
