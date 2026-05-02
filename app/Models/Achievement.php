<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'issuer',
        'issued_date',
        'image',
        'link',
        'category'
    ];

    protected $casts = [
        'issued_date' => 'date'
    ];

    // Accessor untuk format tanggal Indonesia
    public function getFormattedDateAttribute()
    {
        if (!$this->issued_date) return '-';
        return $this->issued_date->isoFormat('D MMMM YYYY');
    }

    // Accessor untuk mendapatkan tahun
    public function getYearAttribute()
    {
        return $this->issued_date ? $this->issued_date->format('Y') : null;
    }
}