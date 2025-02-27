<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = ['product_name','category_id','user_id','quantity','unit','price'];

    public function user():BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function category():BelongsTo {
        return $this->belongsTo(Category::class,"category_id",'id');
    }
}
