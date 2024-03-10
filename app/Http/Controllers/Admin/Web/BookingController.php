<?php

namespace App\Http\Controllers\Admin\Web;

use App\Base\Controllers\Web\Controller;
use App\Models\Booking as Model;
use App\Http\Requests\Admin\Web\BookingRequest as FormRequest;

class BookingController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path: 'admin.bookings.',
            hasCreate: false
        );
    }
}
