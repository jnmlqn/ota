<?php

namespace App\Enums;

enum Status: string
{
    case UNPUBLISHED = 'unpublished';
    case PUBLISHED = 'published';
    case SPAM = 'spam';
}
