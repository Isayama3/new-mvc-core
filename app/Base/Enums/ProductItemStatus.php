<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum ProductItemStatus: string
{
    use EnumCustom;
    case INWAREHOUSE = 'inwarehouse';
    case HELD = 'held';
    case PREPAREFORORDER = 'preparefororder';
    case INWAYTOCLIENT = 'inwaytoclient';
    case WITHCLIENT = 'withclient';
    case SOLD = 'sold';

    case INWAYTOWAREHOUSE = 'inwaytowarehouse';
    case BACKTOWAREHOUSE = 'backtowareHouse';
    case DAMAGED = 'damaged';
}
