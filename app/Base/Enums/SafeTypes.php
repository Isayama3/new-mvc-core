<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum SafeTypes: string
{
    use EnumCustom;
    case SHIPPING   = 'shipping_safe';
    case DONATIONS  = 'donations_safe';
    case EXPENSES   = 'expenses_safe';
    case DAMAGED    = 'damaged_safe';
    case SALARIES   = 'salaries_safe';
    case EXPECTEDPROFITS = 'expected_profits_safe';
    case PROFITS    = 'profits_safe';
}
