<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class MediaLibrary extends Component
{
    public $images = [];
    public $limit = 6;
    public $allImages = [];

    public function mount()
    {
        $files = Storage::disk('public')->files('media');

        $this->allImages = collect($files)
            ->sortByDesc(fn($file) => Storage::disk('public')->lastModified($file))
            ->map(fn($file) => Storage::url($file))
            ->toArray();

        $this->images = array_slice($this->allImages, 0, $this->limit);
    }

    public function loadMore()
    {
        $this->limit += 6;
        $this->images = array_slice($this->allImages, 0, $this->limit);
    }

    public function deleteImage($path)
    {
        $relativePath = preg_replace('/^\/?storage\//', '', $path);
        $imageName = pathinfo($relativePath, PATHINFO_FILENAME);

        Storage::disk('public')->delete($relativePath);

        $this->allImages = array_values(array_filter($this->allImages, fn($image) => $image !== $path));

        $this->images = array_slice($this->allImages, 0, $this->limit);

        $message = "Image {$imageName} was deleted!";
        $this->dispatch('showToast', message: $message);
    }

    public function render()
    {
        return view('livewire.dashboard.media-library', [
            'loadedCount' => count($this->images),
            'totalCount' => count($this->allImages)
        ]);
    }
}

