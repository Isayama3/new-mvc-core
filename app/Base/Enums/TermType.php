<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum TermType: string
{
    use EnumCustom;
    case SUPPLIER = 'supplier';
    case MARKETER = 'marketer';
}
