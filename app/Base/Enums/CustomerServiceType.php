<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum CustomerServiceType: string
{
    use EnumCustom;
    case COMPLAINT = 'complaint';
    case UNAVAILABLE = 'unavailable';
}
