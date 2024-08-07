<?php

namespace App\Models\app;

use App\Models\app\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProCate extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = [
        'name',
        'code'
    ];

    public function product()
    {
        return $this->hashOne(Product::class);
    }
}
