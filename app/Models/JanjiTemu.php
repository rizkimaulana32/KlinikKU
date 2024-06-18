<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JanjiTemu extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokter_id',
        'pasien_id',
        'date',
        'start_time',
        'end_time',
        'status',
        'note',
    ];

    /**
     * Get the pasien that owns the JanjiTemu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    /**
     * Get the dokter that owns the JanjiTemu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }

    /**
     * Get the rekamMedis associated with the JanjiTemu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rekamMedis(): HasOne
    {
        return $this->hasOne(RekamMedis::class);
    }
}
