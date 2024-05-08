<?php

namespace App\Enums;

enum EmploymentType: string
{
    case PERMANENT = 'permanent';
    case CONTRACTUAL = 'contractual';
    case PROJECT_BASED = 'project_based';
}
