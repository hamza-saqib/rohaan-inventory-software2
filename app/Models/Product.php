<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected  $table = "icitem";
    protected $primaryKey = 'code';
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'catcode', 'code');
    }
}
