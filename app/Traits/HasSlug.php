<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public string $slugColumn = 'name';

    public function setAttribute($key, $value): void
    {
        if ($this->slugColumn === $key) {
            $this->attributes[$key] = $value;
            $this->attributes['slug'] = Str::slug($value); // Auto-generate slug
        } else {
            parent::setAttribute($key, $value);
        }
    }
}
