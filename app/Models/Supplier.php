<?php

namespace App\Models;

use App\Traits\TracksUserAndDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Prompts\Note;

class Supplier extends Model
{
    use HasFactory,SoftDeletes , TracksUserAndDates;

    protected $fillable = [
        'country', 'company_name', 'code', 'email', 'phone', 'address',
        'rep_name', 'rep_email', 'rep_phone',
        'added_by', 'added_date', 'updated_by', 'updated_date',
    ];

    protected $dates = ['added_date', 'updated_date'];

    // Relationships
    public function fabrics()
    {
        return $this->hasMany(Fabric::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable');
    }

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Scopes for filtering
    public function scopeFilter($query, $filters)
    {
        if (! empty($filters['country'])) {
            $query->where('country', $filters['country']);
        }
        if (! empty($filters['company_name'])) {
            $query->where('company_name', 'like', '%'.$filters['company_name'].'%');
        }
        if (! empty($filters['rep_name'])) {
            $query->where('rep_name', 'like', '%'.$filters['rep_name'].'%');
        }
        if (! empty($filters['from']) && ! empty($filters['to'])) {
            $query->whereBetween('added_date', [$filters['from'], $filters['to']]);
        }

        return $query;
    }
}
