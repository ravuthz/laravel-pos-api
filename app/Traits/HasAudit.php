<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

trait HasAudit
{
    public static function bootHasAudit(): void
    {
        static::creating(function (Model $model) {
            if (Auth::check()) {
                $model->created_by = $model->created_by ?? Auth::id();
                $model->updated_by = $model->created_by ?? Auth::id();
            }
        });

        static::updating(function (Model $model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });

        if (in_array(SoftDeletes::class, class_uses_recursive(static::class))) {
            static::deleting(function (Model $model) {
                // Only apply to soft deletes
                if (!$model->isForceDeleting() && Auth::check()) {
                    $model->deleted_by = Auth::id();

                    // Prevent recursion: do a raw DB update
                    $model->getConnection()->table($model->getTable())
                        ->where($model->getKeyName(), $model->getKey())
                        ->update(['deleted_by' => Auth::id()]);
                }
            });

            static::restoring(function (Model $model) {
                $model->deleted_by = null;
            });
        }
    }
}
