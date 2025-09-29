<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['body', 'created_by'];

    public function notable()
    {
        return $this->morphTo();
    }

    // protected static function booted()
    // {
    //     static::creating(function ($model) {
    //         if (auth()->check()) {
    //             $model->created_by = auth()->id();
    //         }
    //     });
    // }
}
