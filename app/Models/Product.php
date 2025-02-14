<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'products';
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'qty',
        'status',
        'description',
        'image',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }
}
