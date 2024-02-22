<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum OrderStatus: string
{
    use EnumCustom;

    case INREVIEW               = 'inreview';
    case PENDING                = 'pending';
    case CONFIRMED              = 'confirmed';
    case WAREHOUSEPROGRESS      = 'warehouseprogress';
    case WAREHOUSEDONE          = 'warehousedone'; // READY FOR SHIPPING
    case DELIVERYINPROGRESS     = 'deliveryinprogress';
    case MONEYWITHSHIPPING      = 'moneywithshipping'; // DELIVERY DONE
    case WALLETSTEP             = 'walletstep'; // MONEY IN FROM SHIPPING COMPANY
    case MONEYINSAFE            = 'moneyinsafe';
    case CUSTOMERREFUSED        = 'customerrefused';
    case CANCELED               = 'canceled';
    case RECOVERING             = 'recovering';
    case RECOVERED              = 'recovered';
}
