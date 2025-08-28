<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;


class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(3)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                ]),
            "filters" => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class),
            ],
        ]);
    }
    public function create()
    {
        return Inertia::render('Users/Create');
    }
    public function store()
    {
        $attributes = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required',
        ]);

        User::create($attributes);
        return redirect('/users');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        if (Gate::denies('edit', $user)) {
            abort(403, 'Unauthorized action.');
        }
        return Inertia::render('Users/Show', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }
    public function update($id)
    {
        $user = User::findOrFail($id);

        $validated = Request::validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password']
                ? bcrypt($validated['password'])
                : $user->password,
        ]);

        return redirect('/users');
    }
    public function destroy(User $id)
    {
        if (Gate::denies('delete')) {
            abort(403, 'Unauthorized action.');
        }
        $id->delete();
        return redirect('/users');
    }
}
