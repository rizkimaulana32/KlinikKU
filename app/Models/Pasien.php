<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'age',
        'gender',
        'address',
        'phone',
        'user_id',
    ];

    /**
     * Get the user that owns the Pasien
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the janjiTemu for the Pasien
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function janjiTemu(): HasMany
    {
        return $this->hasMany(JanjiTemu::class);
    }

    /**
     * Get all of the rekamMedis for the Pasien
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rekamMedis(): HasMany
    {
        return $this->hasMany(RekamMedis::class);
    }
}
