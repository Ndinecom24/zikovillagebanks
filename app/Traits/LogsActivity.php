<?php

namespace App\Traits;

use App\Models\ActivityLog;

/**
 * Automatically log created / updated / deleted events for any Eloquent model.
 *
 * Usage: Add `use LogsActivity;` to any model you want tracked.
 *
 * Customisation (optional overrides in the model):
 *   protected static string $activityLogName = 'User';          // friendly name
 *   protected static array  $logOnly          = ['name','email']; // limit tracked fields
 *   protected static array  $logExcept        = ['password'];     // exclude fields
 */
trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        /* ── CREATED ──────────────────────── */
        static::created(function ($model) {
            $label = static::activityLabel();
            $name  = static::activitySubjectName($model);

            ActivityLog::record([
                'log_type'     => 'model',
                'event'        => 'created',
                'description'  => "{$label} \"{$name}\" was created",
                'subject_type' => get_class($model),
                'subject_id'   => $model->getKey(),
                'properties'   => ['attributes' => static::filteredAttributes($model)],
            ]);
        });

        /* ── UPDATED ──────────────────────── */
        static::updated(function ($model) {
            $dirty = $model->getDirty();
            unset($dirty['updated_at']); // noise

            if (empty($dirty)) {
                return;
            }

            $label = static::activityLabel();
            $name  = static::activitySubjectName($model);

            $old = [];
            $new = [];
            foreach ($dirty as $key => $value) {
                if (static::shouldLogAttribute($key)) {
                    $old[$key] = $model->getOriginal($key);
                    $new[$key] = $value;
                }
            }

            if (empty($new)) {
                return;
            }

            ActivityLog::record([
                'log_type'     => 'model',
                'event'        => 'updated',
                'description'  => "{$label} \"{$name}\" was updated",
                'subject_type' => get_class($model),
                'subject_id'   => $model->getKey(),
                'properties'   => ['old' => $old, 'new' => $new],
            ]);
        });

        /* ── DELETED ──────────────────────── */
        static::deleted(function ($model) {
            $label = static::activityLabel();
            $name  = static::activitySubjectName($model);

            ActivityLog::record([
                'log_type'     => 'model',
                'event'        => 'deleted',
                'description'  => "{$label} \"{$name}\" was deleted",
                'subject_type' => get_class($model),
                'subject_id'   => $model->getKey(),
                'properties'   => ['attributes' => static::filteredAttributes($model)],
            ]);
        });
    }

    /* ── Internals ──────────────────────── */

    protected static function activityLabel(): string
    {
        return property_exists(static::class, 'activityLogName')
            ? static::$activityLogName
            : class_basename(static::class);
    }

    protected static function activitySubjectName($model): string
    {
        // Try common naming columns
        foreach (['name', 'title', 'slug', 'email', 'responsible_office'] as $col) {
            if (!empty($model->{$col})) {
                return (string) $model->{$col};
            }
        }
        return (string) $model->getKey();
    }

    protected static function shouldLogAttribute(string $key): bool
    {
        $except = property_exists(static::class, 'logExcept') ? static::$logExcept : ['password', 'remember_token', 'current_session_id'];
        if (in_array($key, $except, true)) {
            return false;
        }

        if (property_exists(static::class, 'logOnly') && !empty(static::$logOnly)) {
            return in_array($key, static::$logOnly, true);
        }

        return true;
    }

    protected static function filteredAttributes($model): array
    {
        $attrs = $model->attributesToArray();
        $except = property_exists(static::class, 'logExcept') ? static::$logExcept : ['password', 'remember_token', 'current_session_id'];

        foreach ($except as $key) {
            unset($attrs[$key]);
        }

        if (property_exists(static::class, 'logOnly') && !empty(static::$logOnly)) {
            $attrs = array_intersect_key($attrs, array_flip(static::$logOnly));
        }

        return $attrs;
    }
}
