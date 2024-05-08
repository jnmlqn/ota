<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    private const EMPLOYER = 'employer';
    private const SEEKER = 'seeker';
    private const MODERATOR = 'moderator';

    public function __construct(
        private User $user
    ) {
        $this->user = $user;
    }

    public function findByEmailAndPassword(string $email, string $password): string
    {
        $user = $this->user->where('email', $email)->firstOrFail();

        if (!Hash::check($password, $user->password)) {
            throw new Exception('Incorrect password');
        }

        switch ($user->roleId->name) {
            case self::EMPLOYER:
                $permissions = [
                    'ota:job_post'
                ];

                break;

            case self::SEEKER:
                $permissions = [
                    'ota:job_view'
                ];

                break;

            case self::MODERATOR:
                $permissions = [
                    'ota:job_status'
                ];

                break;
            
            default:
                break;
        }

        return $user->createToken(
            'basic', 
            $permissions
        )->plainTextToken;
    }
}
