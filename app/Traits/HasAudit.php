<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait HasAudit
{
    public static function bootAuditable(): void
    {
        static::creating(function (Model $model) {
            if (Auth::check()) {
                $model->created_by = $model->created_by ?? Auth::id();
            }
        });

        static::updating(function (Model $model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function (Model $model) {
            if (Auth::check()) {
                $model->deleted_by = Auth::id();
                $model->saveQuietly();
            }
        });

        static::restoring(function (Model $model) {
            $model->deleted_by = null;
        });
    }
}
