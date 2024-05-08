<?php

namespace App\Enums;

enum Seniority: string
{
    case ENTRY_LEVEL = 'entry_level';
    case JUNIOR = 'junior';
    case MID = 'mid';
    case SENIOR = 'senior';
    case EXPERIENCED = 'experienced';
}
