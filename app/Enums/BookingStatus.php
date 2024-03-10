<?php

namespace App\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum BookingStatus: string
{
    use EnumCustom;

    case BOOKINGPLACED          = 'booking-placed';
    case CONFIRMED              = 'confirmed';
    case EXPERTONTHEWAY         = 'expert-on-the-way';
    case REACHEDATLOCATION      = 'reached-at-location';
    case EXPERTGOINGTOSTARTWORK = 'expert-going-to-start-work';
    case COMPLETED              = 'completed';
    case CANCELED               = 'canceled';
}
