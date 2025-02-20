<?php

namespace App\Livewire\Dashboard;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Url;
use Livewire\Component;

class Search extends Component
{
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

    public function getResultsProperty(): Collection
    {
        if (!class_exists($this->model) || empty($this->query)) {
            return collect();
        }

        return $this->model::query()
            ->where($this->field, 'like', "%{$this->query}%")
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.search');
    }
}

