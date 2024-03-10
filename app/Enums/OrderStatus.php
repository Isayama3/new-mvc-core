<?php

namespace App\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum OrderStatus: string
{
    use EnumCustom;

    case ORDERPLACED            = 'order-placed';
    case CONFIRMED              = 'confirmed';
    case DELIVERYINPROGRESS     = 'delivery-in-progress';
    case DELIVERED              = 'delivered';
    case CANCELED               = 'canceled';
}
