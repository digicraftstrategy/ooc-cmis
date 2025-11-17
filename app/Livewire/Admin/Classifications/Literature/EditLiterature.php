<?php

namespace App\Livewire\Admin\Classifications\Literature;

use App\Models\Literature;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditLiterature extends Component
{
    use WithFileUploads;

    public Literature $literature;

    public $literature_title;
    public $slug;
    public $author;
    public $publisher;
    public $publication_year;
    public $pages;
    public $genre;
    public $summary;
    public $cover_art; // new upload

    public bool $autoSlug = false;

    public function mount(Literature $literature)
    {
        $this->literature = $literature;

        $this->literature_title   = $literature->literature_title;
        $this->slug               = $literature->slug;
        $this->author             = $literature->author;
        $this->publisher          = $literature->publisher;
        $this->publication_year   = $literature->publication_year;
        $this->pages              = $literature->pages;
        $this->genre              = $literature->genre;
        $this->summary            = $literature->summary;

        // You may decide whether to autoSlug initially.
    }

    protected function rules()
    {
        $currentYear = now()->year + 1;

        return [
            'literature_title'  => ['required', 'string', 'max:255'],
            'slug'              => [
                'required',
                'string',
                'max:255',
                Rule::unique('literatures', 'slug')->ignore($this->literature->id),
            ],
            'author'            => ['nullable', 'string', 'max:255'],
            'publisher'         => ['nullable', 'string', 'max:255'],
            'publication_year'  => ['nullable', 'integer', 'min:1800', 'max:' . $currentYear],
            'pages'             => ['nullable', 'integer', 'min:1', 'max:20000'],
            'genre'             => ['nullable', 'string', 'max:255'],
            'summary'           => ['nullable', 'string'],
            'cover_art'         => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function updatedLiteratureTitle($value)
    {
        if ($this->autoSlug) {
            $this->slug = Str::slug($value);
        }
    }

    public function updatedAutoSlug($value)
    {
        if ($value && $this->literature_title) {
            $this->slug = Str::slug($this->literature_title);
        }
    }

    public function updatedSlug($value)
    {
        if ($this->autoSlug && $value !== Str::slug($this->literature_title)) {
            $this->autoSlug = false;
        }
    }

    public function save()
    {
        $validated = $this->validate();

        $this->literature->fill($validated);

        if ($this->cover_art) {
            if ($this->literature->cover_art_path && Storage::disk('public')->exists($this->literature->cover_art_path)) {
                Storage::disk('public')->delete($this->literature->cover_art_path);
            }

            $path = $this->cover_art->store('literatures/covers', 'public');
            $this->literature->cover_art_path = $path;
        }

        $this->literature->save();

        session()->flash('success', 'Literature record updated successfully.');

        return redirect()->route('admin.classifications.literatures.view', $this->literature->slug);
    }

    public function render()
    {
        return view('livewire.admin.classifications.literature.edit-literature');
    }
}
