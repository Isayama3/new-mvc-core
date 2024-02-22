<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum UserType: string
{
    use EnumCustom;
    case MARKETER = 'marketer';
    case ADMIN = 'admin';
    case SUPPLIER = 'supplier';
}
