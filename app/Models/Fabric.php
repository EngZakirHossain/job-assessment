<?php

namespace App\Models;

use App\Traits\TracksUserAndDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fabric extends Model
{
    use HasFactory, SoftDeletes, TracksUserAndDates;

    protected $fillable = [
        'supplier_id', 'fabric_no', 'composition', 'gsm', 'qty', 'cuttable_width', 'production_type',
        'construction', 'color_pantone', 'weave_type', 'finish_type', 'dyeing_method', 'printing_method',
        'lead_time_days', 'moq', 'shrinkage', 'remarks', 'fabric_selected_by', 'image_path', 'barcode',
        'added_by', 'added_date', 'updated_by', 'updated_date',
    ];

    protected $casts = [
        'gsm' => 'decimal:2',
        'shrinkage' => 'decimal:2',
    ];

    // Relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stocks()
    {
        return $this->hasMany(FabricStock::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable');
    }

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    // Mutators & Accessors
    public function setFabricNoAttribute($value)
    {
        $this->attributes['fabric_no'] = strtoupper($value);
    }

    public function getAvailableBalanceAttribute()
    {
        // calculates total in - total out
        $in = $this->stocks()->where('type', 'in')->sum('qty');
        $out = $this->stocks()->where('type', 'out')->sum('qty');

        return $in - $out;
    }
}
