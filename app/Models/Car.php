<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'cars';

    protected $fillable = ['car_name','brand','mileage','is_used'];
}
