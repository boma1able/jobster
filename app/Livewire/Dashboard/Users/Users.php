<?php
namespace App\Livewire\Dashboard\Users;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public $users;
    public $showDeleteConfirmation = false;
    public $userToDelete = null;
    public $title = 'Delete!';
    public $sub = 'Are you sure you want to delete this user?';

    public function mount()
    {
        $this->users = User::all();
    }

    public function editUser()
    {
        return redirect()->route('dashboard.users.index', $this->user->id)->with('success', "User " . e($this->user->name) . " was successfully updated!");
    }

    public function confirmDelete($userId)
    {
        $this->showDeleteConfirmation = true;
        $this->userToDelete = $userId;
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);

        if (auth()->id() === $user->id) {
            session()->flash('error', 'You can\'t delete your account');
            return;
        }

        $userName = $user->name;
        $user->delete();

        $this->users = User::all();

        session()->flash('success', "User " . e($userName) . " was successfully deleted!");
        $this->showDeleteConfirmation = false;
    }

    public function cancelDelete()
    {
        $this->showDeleteConfirmation = false;
        $this->userToDelete = null;
    }

    public function render()
    {
        return view('livewire.dashboard.users.users', [
            'users' => User::with('jobs')->get()
        ]);
    }
}



