<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPackage extends Model
{
    use HasFactory;

    protected $table = 'sales_packages';
    protected $fillable = [
        'package_name',
        'description',
        'price',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
