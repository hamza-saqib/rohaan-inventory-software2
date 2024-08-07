<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitMeasurement extends Model
{
    use HasFactory;

    protected  $table = "uomind";
    protected $primaryKey = 'code';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'code',
        'descrip',
        'factor',
    ];
}
