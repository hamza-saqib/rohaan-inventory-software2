<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueInventory extends Model
{
    use HasFactory;

    protected  $table = "oldissue";
    protected $primaryKey = 'isno';
    public $timestamps = false;
}
