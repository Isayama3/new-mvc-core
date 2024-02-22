<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum WalletTransactionType: string
{
    use EnumCustom;
    case EXPECTED = 'expected';
    case CANCEL = 'cancel';
    case AVAILABLE = 'available';
    case REQUESTED = 'requested';
    case REJECTED = 'rejected';
    case DONE = 'done';
}
