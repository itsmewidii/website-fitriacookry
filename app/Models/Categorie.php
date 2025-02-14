<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Categorie extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'categories';
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
