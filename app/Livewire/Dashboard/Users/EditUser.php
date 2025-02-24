<?php
namespace App\Livewire\Dashboard\Users;

use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\User;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditUser extends Component
{
    public $user, $name, $email, $role, $password, $avatar_obj = '', $avatar;

    use WithFileUploads;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'role' => 'nullable|exists:roles,id',
        'password' => 'nullable|min:6',
        'avatar_obj' => 'nullable|image|max:1024|mimes:jpg,jpeg,png,gif,webp',
    ];

    public function mount(User $user)
    {
        $this->user  = $user;
        $this->name  = $user->name;
        $this->email = $user->email;
        $this->role  = $user->roles->first()?->id;
        $this->password  = null;
        $this->avatar = $user->avatar;
    }

    public function removeImage()
    {
        $this->avatar = null;
        $this->avatar_obj = null;
        $this->user->update(['avatar' => null]);
    }

    public function save()
    {
        $validated = $this->validate();

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($this->avatar_obj) {
            $originalName = pathinfo($this->avatar_obj->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $this->avatar_obj->getClientOriginalExtension();
            $filename = "{$originalName}.{$extension}";
            $counter = 1;

            while (Storage::disk('public')->exists("avatars/{$filename}")) {
                $filename = "{$originalName}-{$counter}.{$extension}";
                $counter++;
            }

            $this->avatar_obj->storeAs('avatars', $filename, 'public');
            $this->user->update(['avatar' => "avatars/{$filename}"]);
        }

        $this->user->update($validated);

        if (isset($validated['role'])) {
            $this->user->roles()->sync([$validated['role']]);
        }

        session()->flash('success', "User " . e($this->user->name) . " was successfully updated!");
        return $this->redirectRoute('dashboard.users', navigate: true);
    }


    public function render()
    {
        return view('livewire.dashboard.users.edit-user', [
            'roles' => Role::all(),
        ]);
    }
}
