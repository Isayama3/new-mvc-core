<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum SupplierProductItemRequestType: string
{
    use EnumCustom;
    case ADDON = 'addon';
    case BUYBACK = 'buyback';
}
