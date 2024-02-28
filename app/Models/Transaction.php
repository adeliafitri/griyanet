<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $fillable = ['package_id', 'sales_id', 'customer_id', 'house_photo'];

    public function sales(){
        return $this->belongsTo(User::class);
    }

    public function package(){
        return $this->belongsTo(SalesPackage::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
