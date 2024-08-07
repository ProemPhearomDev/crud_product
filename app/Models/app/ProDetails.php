<?php

namespace App\Models\app;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProDetails extends Model
{
    use HasFactory;

    protected $table = 'pro_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pro_id',
        'add',
        'add_price',
        'sale',
        'sale_price',
    ];

 
    
}
