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
}
