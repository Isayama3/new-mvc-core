<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum SupplierProductItemRequestStatus: string
{
    use EnumCustom;
    case INREVIEW = 'inreview';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case WAREHOUSEACCEPTED = 'warehouse_accepted';
}
