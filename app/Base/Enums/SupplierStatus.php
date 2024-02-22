<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum SupplierStatus: string
{
    use EnumCustom;
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
}
