<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $this->authorizeAdmin();

        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $this->authorizeAdmin();

        $request->validate([
            'role' => ['required', 'in:admin,developer,client'],
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User role updated.');
    }
}