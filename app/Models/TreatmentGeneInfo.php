<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string treatmentId
 * @property string gene
 * @property string genotype
 * @property string phenotype
 **/
class TreatmentGeneInfo extends Model
{
    use HasFactory;

    protected $table = 'gene_info';

    protected $fillable = [
        'treatmentId',
        'gene',
        'genotype',
        'phenotype',
    ];
}
