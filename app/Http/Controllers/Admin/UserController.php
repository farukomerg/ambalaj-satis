<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::where('role', 'user')->latest()->paginate(12),
        ]);
    }

    public function toggle(User $user)
    {
        abort_if($user->isAdmin(), 403);

        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', 'Kullanici durumu guncellendi.');
    }

    public function destroy(User $user)
    {
        abort_if($user->isAdmin(), 403);

        $user->delete();

        return back()->with('success', 'Kullanici basariyla silindi.');
    }
}
