<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RekamMedis extends Model
{
    use HasFactory;

    protected $fillable = [
        'janji_temu_id',
        'pasien_id',
        'diagnosis',
        'obat',
        'tindakan',
    ];

    /**
     * Get the pasien that owns the RekamMedis
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    /**
     * Get the janjiTemu that owns the RekamMedis
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function janjiTemu(): BelongsTo
    {
        return $this->belongsTo(JanjiTemu::class);
    }

    // /**
    //  * Get the dokter that owns the RekamMedis
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function dokter(): BelongsTo
    // {
    //     return $this->belongsTo(Dokter::class);
    // }
}
