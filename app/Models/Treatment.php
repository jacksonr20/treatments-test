<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int file_id
 * @property string group_phenotype
 * @property string action
 * @property string recommendation
**/

class Treatment extends Model
{
    use HasFactory;

    protected $table = 'treatments';

    protected $fillable = [
        'file_id',
        'group_phenotype',
        'action',
        'recommendation',
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(TreatmentFile::class, 'file_id');
    }

    public function drugs(): HasMany
    {
        return $this->hasMany(TreatmentDrug::class, 'treatment_id');
    }

    public function geneInfo(): HasMany
    {
        return $this->hasMany(TreatmentGeneInfo::class, 'treatment_id');
    }

    public function therapeuticArea(): HasMany
    {
        return $this->hasMany(TreatmentTherapeuticArea::class, 'treatment_id');
    }
}
