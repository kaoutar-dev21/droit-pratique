<?php

namespace App\Support;

use Illuminate\Support\Str;

class Slugger
{
    /**
     * Génère un slug unique pour le modèle donné.
     */
    public static function unique(string $model, string $text, ?int $ignoreId = null): string
    {
        $base = Str::slug($text) ?: Str::lower(Str::random(8));
        $slug = $base;
        $i = 2;

        while (
            $model::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}