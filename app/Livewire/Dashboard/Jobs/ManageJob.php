<?php

namespace App\Livewire\Dashboard\Jobs;

use App\Models\Job;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ManageJob extends Component
{
    use WithFileUploads;
    #[Url]
    public ?int $id = null;

    public $title, $description, $company_name, $company_logo;
    public $isEditing = false;
    public $logo_obj = '';

    protected $listeners = ['job-edit' => 'edit'];

    public function mount()
    {
        if ($this->id) {
            $this->edit($this->id);
        }
    }

    public function removeImage()
    {
        $this->company_logo = null;
        $this->logo_obj = null;
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        $this->id = $id;
        $this->title = $job->title;
        $this->description = $job->description;
        $this->company_name = $job->company_name;
        $this->company_logo = $job->company_logo;
        $this->isEditing = true;
    }

    public function create()
    {
        $this->resetInput();
        $this->id = null;
        $this->isEditing = false;
        $this->logo_obj = null;
        $this->redirect('/dashboard/jobs', navigate: true);
    }

    public function store()
    {
        $this->validate([
            'title'         => 'required|min:3',
            'description'   => 'required',
            'company_name'  => 'required',
            'logo_obj'      => $this->logo_obj ? 'image|max:1024|mimes:jpg,jpeg,png,gif,webp' : '',
        ]);

        if ($this->logo_obj) {
            $originalName = pathinfo($this->logo_obj->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $this->logo_obj->getClientOriginalExtension();
            $filename = "{$originalName}.{$extension}";
            $counter = 1;

            while (Storage::disk('public')->exists("company/{$filename}")) {
                $filename = "{$originalName}-{$counter}.{$extension}";
                $counter++;
            }

            $this->logo_obj->storeAs('company', $filename, 'public');
            $this->company_logo = $filename;
        }

        Job::updateOrCreate(['id' => $this->id], [
            'title' => $this->title,
            'description' => $this->description,
            'company_name' => $this->company_name,
            'user_id'       => auth()->id(),
            'company_logo'  => $this->company_logo
        ]);

        $message = $this->id ? 'Job updated!' : 'Job created!';
        $this->dispatch('showToast', message: $message);

        $this->resetInput();

        $this->redirect('/dashboard/jobs', navigate: true);
    }

    private function resetInput()
    {
        $this->title = '';
        $this->description = '';
        $this->company_name = '';
        $this->logo_obj = null;
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.dashboard.jobs.manage-job');
    }
}

