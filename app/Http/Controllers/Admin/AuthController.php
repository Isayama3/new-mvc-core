<?php

namespace App\Http\Controllers\Admin;

use App\Base\Rules\PasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Web\AuthRequest;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public const VIEWPATH = 'admin.auth.';

    public function loginView()
    {
        return view(static::VIEWPATH  . __FUNCTION__);
    }

    public function loginPost(AuthRequest $request)
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

    public function updateProfileView()
    {
        return view('admin.profile.edit');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if ($request->input('old-password')) {
            $this->validate($request, [
                'old-password' => 'required',
                'password' => 'required|confirmed',
            ]);

            if (Hash::check($request->input('old-password'), $user->password)) {
                $user->password = $request->input('password');
                $user->save();
            } else {
                session()->flash('fail', 'كلمة المرور غير صحيحة');
                return view('manager.update-profile');
            }
        }

        return redirect()->back()->with('success', 'Record updated successfully!');
    }
}
