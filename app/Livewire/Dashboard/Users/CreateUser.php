<?php
namespace App\Livewire\Dashboard\Users;

use App\Models\Job;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;
    public $successMessage;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'role' => 'nullable|exists:roles,id',
        'password' => 'required|min:6',
    ];

    public function store()
    {
        $validated = $this->validate();

        $validated['password'] = Hash::make($this->password);

        $user = User::create($validated);

        if (isset($validated['role'])) {
            $user->roles()->sync([$validated['role']]);
        }

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
