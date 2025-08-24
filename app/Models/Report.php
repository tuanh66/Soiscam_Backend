<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table ='reports';
    protected $fillable = [
        'nameScammer',
        'phoneScammer',
        'bankNumber',
        'bankName',
        'contentReport',
        'imagesProof',
        'nameSender',
        'phoneSender',
        'option',
        'approve'

    ];
    protected $cats = [
        'imagesProof' => 'array',
    ];
}
