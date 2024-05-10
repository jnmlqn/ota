<?php

namespace App\Repositories;

use App\Enums\Role;
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

    public function createLoginToken(string $email, string $password): string
    {
        $user = $this->user->where('email', $email)->firstOrFail();

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
