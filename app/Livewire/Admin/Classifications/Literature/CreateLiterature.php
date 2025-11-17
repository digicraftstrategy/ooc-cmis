<?php

namespace App\Livewire\Admin\Classifications\Literature;

use App\Models\Literature;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateLiterature extends Component
{
    use WithFileUploads;

    public $literature_title;
    public $slug;
    public $author;
    public $publisher;
    public $publication_year;
    public $pages;
    public $genre;
    public $summary;
    public $cover_art; // upload

    public bool $autoSlug = true;

    protected function rules()
    {
        $currentYear = now()->year + 1;

        return [
            'literature_title'  => ['required', 'string', 'max:255'],
            'slug'              => ['required', 'string', 'max:255', Rule::unique('literatures', 'slug')],
            'author'            => ['nullable', 'string', 'max:255'],
            'publisher'         => ['nullable', 'string', 'max:255'],
            'publication_year'  => ['nullable', 'integer', 'min:1800', 'max:' . $currentYear],
            'pages'             => ['nullable', 'integer', 'min:1', 'max:20000'],
            'genre'             => ['nullable', 'string', 'max:255'],
            'summary'           => ['nullable', 'string'],
            'cover_art'         => ['nullable', 'image', 'max:2048'], // 2MB
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

        $literature = new Literature($validated);

        if ($this->cover_art) {
            $path = $this->cover_art->store('literatures/covers', 'public');
            $literature->cover_art_path = $path;
        }

        $literature->save();

        session()->flash('success', 'Literature record created successfully.');

        return redirect()->route('admin.classifications.literatures');
    }

    public function render()
    {
        return view('livewire.admin.classifications.literature.create-literature');
    }
}
