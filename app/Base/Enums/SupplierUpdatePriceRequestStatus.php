<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum SupplierUpdatePriceRequestStatus: string
{
    use EnumCustom;
    case INREVIEW = 'inreview';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
}
