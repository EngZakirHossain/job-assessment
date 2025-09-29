<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FabricStock extends Model
{
    protected $fillable = ['fabric_id', 'type', 'qty', 'remarks', 'created_by'];

    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->added_by = current_user_id(); // default user
            $model->added_date = now();
        });

        static::updating(function ($model) {
            $model->updated_by = current_user_id(); // default user
            $model->updated_date = now();
        });
    }
}
