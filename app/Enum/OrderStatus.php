<?php

namespace App\Enum;

enum OrderStatus:int
{
    case Pending = 1;
    case Processing = 2;
    case Completed = 3; 
}