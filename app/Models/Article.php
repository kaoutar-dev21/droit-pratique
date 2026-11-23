<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'summary',
        'content',
        'is_published',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * Recherche simple (titre, résumé, contenu).
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        $term = trim((string) $term);

        if ($term === '') {
            return $query;
        }

        $like = '%'.str_replace(['\\', '%', ''], ['\\\\', '\\%', '\\'], $term).'%';

        return $query->where(function (Builder $w) use ($like) {
            $w->where('title', 'like', $like)
                ->orWhere('summary', 'like', $like)
                ->orWhere('content', 'like', $like);
        });
    }

    /**
     * Temps de lecture estimé en minutes (200 mots / minute).
     */
    public function getReadingTimeAttribute(): int
    {
        $words = count(preg_split('/\s+/u', trim((string) $this->content), -1, PREG_SPLIT_NO_EMPTY));

        return max(1, (int) ceil($words / 200));
    }

    /**
     * Convertit le contenu texte en HTML sécurisé.
     *  - "## Titre"  => <h2>
     *  - "- élément" => <li>
     *  - ligne simple => <p>
     */
    public function getFormattedContentAttribute(): string
    {
        $lines = preg_split('/\R/u', trim((string) $this->content));
        $html = '';
        $inList = false;

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '') {
                if ($inList) {
                    $html .= '</ul>';
                    $inList = false;
                }
                continue;
            }

            if (str_starts_with($line, '- ')) {
                if (! $inList) {
                    $html .= '<ul>';
                    $inList = true;
                }
                $html .= '<li>'.e(mb_substr($line, 2)).'</li>';
                continue;
            }

            if ($inList) {
                $html .= '</ul>';
                $inList = false;
            }

            if (str_starts_with($line, '## ')) {
                $html .= '<h2>'.e(mb_substr($line, 3)).'</h2>';
            } else {
                $html .= '<p>'.e($line).'</p>';
            }
        }

        if ($inList) {
            $html .= '</ul>';
        }

        return $html;
    }
}