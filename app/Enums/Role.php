<?php

namespace App\Enums;

enum Role: string
{
    case EMPLOYER = 'employer';
    case SEEKER = 'seeker';
    case MODERATOR = 'moderator';
}
