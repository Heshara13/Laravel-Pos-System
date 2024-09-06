<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primarykey = 'id';
    protected $fillable = [
        'catname',
        'status'

    ];

    public function product(){
        return $this->hasMany(Product::class, 'cat_id',);
    }
    
    
    
    use HasFactory;
}
