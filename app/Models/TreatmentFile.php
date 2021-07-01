<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string sample_number
 * @property string pipeline_version
 * @property string sequencer
 * @property string knowledge_version
 * @property string date_generated
 **/

class TreatmentFile extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'sample_number',
        'pipeline_version',
        'sequencer',
        'knowledge_version',
        'date_generated',
    ];

    public function setDateGeneratedAttribute(string $value): void
    {
        $this->attributes['date_generated'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
