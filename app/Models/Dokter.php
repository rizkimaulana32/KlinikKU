<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'age',
        'spesialis',
        'phone',
        'image',
    ];

    /**
     * Get the user that owns the Dokter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the jadwalDokter for the Dokter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwalDokter(): HasMany
    {
        return $this->hasMany(JadwalDokter::class);
    }

    /**
     * Get all of the janjiTemu for the Dokter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function janjiTemu(): HasMany
    {
        return $this->hasMany(JanjiTemu::class);
    }

    // /**
    //  * Get all of the rekamMedis for the Pasien
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function rekamMedis(): HasMany
    // {
    //     return $this->hasMany(RekamMedis::class);
    // }
}
