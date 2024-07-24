<?php

namespace App\Enum;

enum UserRole:string
{
    case ADMIN     = 'admin';
    case USER      = 'user';
    case RECRUITER = 'recruiter';
    case JOBSEEKER = 'jobseeker';
    case GUEST     = 'guest';
}