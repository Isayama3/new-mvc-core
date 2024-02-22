<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\Web\Controller;
use App\Base\Rules\PasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Admin as Model;
use App\Http\Requests\Admin\Web\AuthRequest as FormRequest;

class AuthController extends Controller
{
    public const VIEWPATH = 'admin.auth.';

    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
        );
    }

    public function loginView()
    {
        return view(static::VIEWPATH  . __FUNCTION__);
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => ["required", new PasswordRule]
        ]);

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect(route('admin.home'));
        }

        return back()->withInput()->withErrors(['email' => 'خطأ في البريد الإلكتروني أو كلمة المرور']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return redirect(route('admin.login.form'));
    }
}
