<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum WalletRequestedTransactionStatus: string
{
    use EnumCustom;
    case INREVIEW = 'inreview';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
}
