<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Regulation extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'regulations';
    protected $primaryKey = "id";
    protected $fillable = [
        'description',
        'rek_no',
        'rek_name',
        'bank',
    ];
}
