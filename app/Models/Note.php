<?php

namespace App\Models;

use App\Traits\TracksUserAndDates;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use TracksUserAndDates;

    protected $fillable = ['body', 'created_by'];

    public function notable()
    {
        return $this->morphTo();
    }
}
