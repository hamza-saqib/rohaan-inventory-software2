<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecieveInventory extends Model
{
    use HasFactory;

    protected  $table = "invrec";
    protected $primaryKey = 'id_col';
    public $timestamps = false;
}
