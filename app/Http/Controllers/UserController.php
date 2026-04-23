<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        /** @var User|null $currentUser */
        $currentUser = Auth::user();

        if (! $currentUser || ! $currentUser->isAdmin()) {
            abort(403);
        }

        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        /** @var User|null $currentUser */
        $currentUser = Auth::user();

        if (! $currentUser || ! $currentUser->isAdmin()) {
            abort(403);
        }

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