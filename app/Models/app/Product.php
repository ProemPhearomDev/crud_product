<?php

namespace App\Models\app;

use App\Models\app\ProCate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory ; 
    // use SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'photo',
        'cate',
        'price',
        'status'
    ];

   
    public function category()
    {
        return $this->belongsTo(ProCate::class);
    }
}
