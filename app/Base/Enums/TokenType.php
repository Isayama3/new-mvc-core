<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum TokenType: string
{
    use EnumCustom;
    case FIREBASE = 'firebase';
    case WEBPUSH = 'webpush';
}
