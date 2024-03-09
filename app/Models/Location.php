<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected  $table = "issueloc";
    protected $primaryKey = 'code1';
    public $timestamps = false;
}
