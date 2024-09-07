<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetails extends Model
{
    protected $table = 'salesdetails';
    protected $primaryKey = 'id';
    protected $fillable = ['sales_id', 'product_id', 'price', 'qty', 'total_cost'];
    
    public function sales(){
        return $this->belongsTo(Sales::class, 'sales_id');
    }
    
    use HasFactory;
}
