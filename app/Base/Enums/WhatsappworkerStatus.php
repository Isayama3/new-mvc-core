<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum WhatsappworkerStatus: string
{
    use EnumCustom;
    case PENDING = 'pending';
    case AVAILABLE = 'available';
}
