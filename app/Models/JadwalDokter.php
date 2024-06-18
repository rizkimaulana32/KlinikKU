<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokter_id',
        'date',
        'start_time',
        'end_time',
        'status',
    ];

    public $timestamps = false;

    /**
     * Get the dokter that owns the JadwalDokter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }
}
