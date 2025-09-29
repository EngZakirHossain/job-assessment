<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FabricStock extends Model
{
    protected $fillable = ['fabric_id','type','qty','remarks','created_by'];

    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
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
