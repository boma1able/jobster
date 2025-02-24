<?php
namespace App\Livewire\Dashboard\Users;

use App\Models\Job;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;
    public $successMessage;
    public $avatar_obj = '', $avatar;

    use WithFileUploads;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'role' => 'nullable|exists:roles,id',
        'password' => 'required|min:6',
        'avatar_obj' => 'nullable|image|max:1024|mimes:jpg,jpeg,png,gif,webp',
    ];

    public function removeImage()
    {
        $this->avatar = null;
        $this->avatar_obj = null;
    }

    public function store()
    {
        $validated = $this->validate();

        $validated['password'] = Hash::make($this->password);

        $user = User::create($validated);

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

            $user->update(['avatar' => 'avatars/' .$filename]);
        }

        if (isset($validated['role'])) {
            $user->roles()->sync([$validated['role']]);
        }

        $this->avatar_obj = null;

        session()->flash('success', "User " . e($user->name) . " was successfully create!");
        return $this->redirectRoute('dashboard.users', navigate: true);
    }

    public function delete($id)
    {
        Job::findOrFail($id)->delete();
        $this->dispatch('showToast', message: 'Job deleted!');

        if ($this->categoryId == $id) {
            $this->resetInput();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.users.create-user', [
            'roles' => Role::all(),
        ]);
    }
}
