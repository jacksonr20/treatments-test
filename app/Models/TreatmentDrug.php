<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int treatment_id
 * @property string generic
 * @property string trade
 **/
class TreatmentDrug extends Model
{
    use HasFactory;

    protected $table = 'drugs';

    protected $fillable = [
        'treatment_id',
        'generic',
        'trade',
    ];
}
