<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string treatmentId
 * @property string name
 **/
class TreatmentTherapeuticArea extends Model
{
    use HasFactory;

    protected $table = 'therapeutic_areas';

    protected $fillable = [
        'treatmentId',
        'name',
    ];
}
