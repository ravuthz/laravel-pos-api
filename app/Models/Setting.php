<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

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
