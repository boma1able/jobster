<?php

namespace App\Livewire\Dashboard\Jobs;

use App\Models\Job;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class JobsTable extends Component
{
    use WithPagination;

    #[Url]
    public string $query = '';

    public string $model;
    public string $field;
    public ?string $route;

    public function mount(string $model, string $field = 'title', ?string $route = null)
    {
        $this->model = "App\\Models\\{$model}";
        $this->field = $field;
        $this->route = $route;
    }

    public function updatedQuery()
    {
        $this->dispatch('search-updated');
    }

    public function getResultsProperty(): LengthAwarePaginator
    {
        if (!class_exists($this->model)) {
            return new LengthAwarePaginator([], 0, 2);
        }

        $query = $this->model::query();

        if (!empty(trim($this->query))) {
            $query->where($this->field, 'like', "%{$this->query}%");
        }

        return $query->latest()->paginate(9);
    }

    public function resetQuery()
    {
        $this->query = '';
    }

    public function edit($id)
    {
        $this->dispatch('job-edit', ['id' => $id]);
    }

    public function redirectToEdit($id)
    {
        return $this->redirectRoute('dashboard.jobs.manage', ['id' => $id], navigate: true);
    }

    public function delete($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        $this->dispatch('showToast', message: 'Job deleted successfully!');
}

    public function render()
    {
        return view('livewire.dashboard.jobs.jobs-table', [
            'jobs' => $this->results,
        ]);
    }
}
