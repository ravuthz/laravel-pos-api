<?php

namespace App\Models;

use App\Traits\HasAudit;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, HasSlug, SoftDeletes, HasAudit;

    protected $guarded = ['id'];

    protected $casts = [
        'options' => 'array'
    ];

    public static function set($item)
    {
        if (empty($item['value'])) {
            $item['value'] = $item['code'];
        }
        if (empty($item['description'])) {
            $item['description'] = $item['name'];
        }
        return static::updateOrCreate([
            'code' => $item['code'],
        ], $item);
    }

    public function setItems($items)
    {
        $result = collect();

        foreach ($items as $item) {
            $item['parent_code'] = $this->code;
            $result[] = static::set($item);
        }

        return $result;
    }
}
