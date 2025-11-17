<?php

namespace App\Livewire\Admin\Classifications\VideoGame;

use App\Models\VideoGaming;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVideoGame extends Component
{
    use WithFileUploads;

    public $video_game_title;
    public $slug;
    public $main_characters;
    public $developer;
    public $publisher;
    public $release_year;
    public $release_date;
    public $genre;
    public $platform;
    public $average_playtime;
    public $game_mode;
    public $language;
    public $has_subtitle = false;
    public $cover_art_path = []; // multi-upload

    public bool $autoSlug = true;

    protected function rules()
    {
        return [
            'video_game_title' => 'required|string|max:255',
            'slug'             => ['required','string','max:255', Rule::unique('video_games','slug')],
            'main_characters'  => 'nullable|string|max:255',
            'developer'        => 'nullable|string|max:255',
            'publisher'        => 'nullable|string|max:255',
            'release_year'     => 'nullable|integer|min:1980|max:'.(date('Y') + 1),
            'release_date'     => 'nullable|date',
            'genre'            => 'nullable|string|max:255',
            'platform'         => 'nullable|string|max:255',
            'average_playtime' => 'nullable|integer|min:0|max:10000',
            'game_mode'        => 'nullable|in:Single-player,Multi-player,Both',
            'language'         => 'nullable|string|max:255',
            'has_subtitle'     => 'boolean',
            'cover_art_path.*' => 'file|mimes:jpg,jpeg,png,gif,webp,mp4,mov,m4v,avi,mkv,pdf,doc,docx|max:51200',
        ];
    }

    protected function messages()
    {
        return [
            'slug.unique' => 'This slug already exists. Please choose another.',
            'cover_art_path.*.mimes' => 'Allowed file types: images, video (mp4/mov/avi/mkv), pdf/doc/docx.',
        ];
    }

    public function updatedVideoGameTitle($value)
    {
        if ($this->autoSlug) {
            $this->slug = Str::slug($value);
        }
    }

    public function updatedAutoSlug($value)
    {
        if ($value && $this->video_game_title) {
            $this->slug = Str::slug($this->video_game_title);
        }
    }

    public function updatedSlug($value)
    {
        if ($this->autoSlug && $value !== Str::slug($this->video_game_title)) {
            $this->autoSlug = false;
        }
    }

    public function save()
    {
        $validated = $this->validate();

        $paths = [];
        if (!empty($this->cover_art_path)) {
            foreach ($this->cover_art_path as $file) {
                $paths[] = $file->store('video-games/attachments', 'public');
            }
        }

        $game = new VideoGaming();
        $game->fill([
            'video_game_title' => $this->video_game_title,
            'slug'             => $this->slug,
            'main_characters'  => $this->main_characters,
            'developer'        => $this->developer,
            'publisher'        => $this->publisher,
            'release_year'     => $this->release_year,
            'release_date'     => $this->release_date,
            'genre'            => $this->genre,
            'platform'         => $this->platform,
            'average_playtime' => $this->average_playtime,
            'game_mode'        => $this->game_mode,
            'language'         => $this->language,
            'has_subtitle'     => $this->has_subtitle,
            'cover_art_path'   => $paths ? json_encode($paths) : null,
        ]);

        // If you track creator:
        if (auth()->check()) {
            $game->user_id = auth()->id();
        }

        $game->save();

        session()->flash('success', 'Video game registered successfully.');
        return redirect()->route('admin.classifications.video-games');
    }

    public function render()
    {
        $gameModes = ['Single-player', 'Multi-player', 'Both'];

        return view('livewire.admin.classifications.video-game.create-video-game', [
            'gameModes' => $gameModes,
        ]);
    }
}
