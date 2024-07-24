<?php

namespace App\Enum;

enum ApplicationStatus:int
{
    case Prescreen = 1;
    case Shortlist = 2;
    case Interview = 3;
    case Offer = 4;
    case Accept = 5;
    case Decline = 6;
}