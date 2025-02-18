<?php
namespace App\Livewire\Dashboard\Users;

use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;

class EditUser extends Component
{
    public $user;
    public $name;
    public $email;
    public $role;
    public $password;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'role' => 'nullable|exists:roles,id',
        'password' => 'nullable|min:6',
    ];

    public function mount(User $user)
    {
        $this->user  = $user;
        $this->name  = $user->name;
        $this->email = $user->email;
        $this->role  = $user->roles->first()?->id;
        $this->password  = null;
    }

    public function save()
    {
        $validated = $this->validate();

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
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
