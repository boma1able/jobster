<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {

        $users = User::latest()->Paginate(5);
        $onlineUsers = User::where('last_active_at', '>=', now()->subMinutes(1))->get();

        return view('dashboard.users.index', compact('users', 'onlineUsers'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('dashboard.users.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'role' => ['nullable', 'exists:roles,id'],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = null;
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'avatar' => $avatarPath,
        ]);

        if (isset($validated['role'])) {
            $user->roles()->sync([$validated['role']]);
        }

        return redirect()->route('dashboard.users.index')->with('success', "User " . e($user->name) . " was successfully created!");
    }

    public function show(User $user)
    {
        $users = User::latest()->get();

        return view('dashboard.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        if (auth()->id() !== $user->id && !auth()->user()?->isAdmin()) {
            abort(403, 'You can edit only your profile!');
        }

        $roles = Role::all();

        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    public function update(User $user)
    {
        if (auth()->id() !== $user->id && !auth()->user()?->isAdmin()){
            abort(403, 'You can edit only your profile!');
        }

        $validated = request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'password' => ['nullable', 'min:6'],
            'role' => ['nullable', 'exists:roles,id'],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ]);

        $password = request('password') ? Hash::make(request('password')) : $user->password;

        if (request()->hasFile('avatar')) {
            $file = request()->file('avatar');

            $fileHash = md5_file($file->getRealPath());

            $existingFile = Storage::disk('public')->files('avatars');
            $avatarPath = null;

            foreach ($existingFile as $existingFilePath) {
                if (strpos($existingFilePath, $fileHash) !== false) {
                    $avatarPath = $existingFilePath;
                    break;
                }
            }

            if (!$avatarPath) {
                $avatarPath = $file->storeAs('avatars', $fileHash . '.' . $file->getClientOriginalExtension(), 'public');
            }

            $user->avatar = $avatarPath;
        } elseif (request()->has('avatar') && request('avatar') === '') {

            $user->avatar = null;
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $password,
        ]);

        if (isset($validated['role'])) {
            $user->roles()->sync([$validated['role']]);
        }

        return redirect()->route('dashboard.users.index', $user->id)->with('success', "User " . e($user->name) . " was successfully updated!");
    }

    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->route('dashboard.users.index')->with('success', "User " . e($user->name) . " was successfully was deleted!");
    }

}
