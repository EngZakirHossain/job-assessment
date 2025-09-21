<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use NumberFormatter;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'sale_date', 'subtotal', 'discount_total', 'grand_total',
    ];

    protected $dates = ['sale_date'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    // Accessor
    public function getFormattedGrandTotalAttribute()
    {
        $fmt = new NumberFormatter('en_US', NumberFormatter::DECIMAL);
        $amount = $this->grand_total ?? 0;

        return $fmt->format($amount).' BDT';
    }

    // Mutator
    public function setNotesAttribute($value)
    {
        $this->attributes['notes'] = $value ? ucfirst(trim($value)) : null;
    }
}
