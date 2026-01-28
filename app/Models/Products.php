<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use App\Http\Controlle\ProductController;
class Products extends Model
{
    protected $fillable = ['name', 'description', 'price'];

  
}
