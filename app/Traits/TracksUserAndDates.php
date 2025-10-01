<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait TracksUserAndDates
{
    protected static function bootTracksUserAndDates()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->added_by = Auth::id();
            }
            $model->added_date = now();
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
            $model->updated_date = now();
        });
    }

    public function initializeTracksUserAndDates()
    {
        $this->casts['added_date'] = 'datetime';
        $this->casts['updated_date'] = 'datetime';
    }
}
