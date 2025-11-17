<?php

namespace App\Livewire\Admin\Classifications\VideoGame;

use App\Models\VideoGaming;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditVideoGame extends Component
{
    use WithFileUploads;

    public VideoGaming $game;

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

    public $cover_art_path = [];      // new uploads
    public $existing_attachments = []; // existing paths

    public bool $autoSlug = false;

    public function mount(VideoGaming $game)
    {
        $this->game = $game;

        $this->video_game_title = $game->video_game_title;
        $this->slug             = $game->slug;
        $this->main_characters  = $game->main_characters;
        $this->developer        = $game->developer;
        $this->publisher        = $game->publisher;
        $this->release_year     = $game->release_year;
        $this->release_date     = optional($game->release_date)->format('Y-m-d');
        $this->genre            = $game->genre;
        $this->platform         = $game->platform;
        $this->average_playtime = $game->average_playtime;
        $this->game_mode        = $game->game_mode;
        $this->language         = $game->language;
        $this->has_subtitle     = $game->has_subtitle;

        $raw = $game->cover_art_path;
        if (is_string($raw) && trim($raw) !== '') {
            $decoded = json_decode($raw, true);
            $this->existing_attachments = json_last_error() === JSON_ERROR_NONE && is_array($decoded)
                ? $decoded
                : [$raw];
        } elseif (is_array($raw)) {
            $this->existing_attachments = $raw;
        }
    }

    protected function rules()
    {
        return [
            'video_game_title' => 'required|string|max:255',
            'slug'             => ['required','string','max:255', Rule::unique('video_games','slug')->ignore($this->game->id)],
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

    public function updatedVideoGameTitle($value)
    {
        if ($this->autoSlug) {
            $this->slug = Str::slug($value);
        }
    }

    public function update()
    {
        $this->validate();

        $paths = $this->existing_attachments;

        if (!empty($this->cover_art_path)) {
            foreach ($this->cover_art_path as $file) {
                $paths[] = $file->store('video-games/attachments', 'public');
            }
        }

        $this->game->fill([
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

        $this->game->save();

        session()->flash('success', 'Video game updated successfully.');
        return redirect()->route('admin.classifications.video-games.view', $this->game->slug);
    }

    public function render()
    {
        $gameModes = ['Single-player', 'Multi-player', 'Both'];

        return view('livewire.admin.classifications.video-game.edit-video-game', [
            'gameModes' => $gameModes,
        ]);
    }
}
