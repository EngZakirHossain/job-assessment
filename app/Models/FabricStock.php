<?php

namespace App\Models;

use App\Traits\TracksUserAndDates;
use Illuminate\Database\Eloquent\Model;

class FabricStock extends Model
{
    use TracksUserAndDates;

    protected $fillable = ['fabric_id', 'type', 'qty', 'remarks', 'created_by'];

    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }
}
