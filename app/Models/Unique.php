<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Unique extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'uniques';
    protected $primaryKey = "id";
    protected $fillable = [
        'code',
        'info',
        'lat',
        'long',
    ];

    /**
     * Generate a unique code with the format USER-WEB-0000001, ensuring uniqueness.
     *
     * @return string
     */
    private function generateCode()
    {
        $lastCode = Unique::latest('created_at')->value('code');
        
        if (!$lastCode) {
            return 'USER-WEB-0000001';
        }

        $lastNumber = (int) substr($lastCode, 9);
        $nextNumber = $lastNumber + 1;

        return 'USER-WEB-' . str_pad($nextNumber, 7, '0', STR_PAD_LEFT);
    }

    /**
     * Generate a new unique entry in the database.
     *
     * @param  array  $data
     * @return \App\Models\Unique
     */
    public static function createUnique(array $data)
    {
        $unique = new self();

        $unique->code = $unique->generateCode();
        $unique->info = $data['info'] ?? null;
        $unique->lat = $data['lat'];
        $unique->long = $data['long'];

        $unique->save();

        return $unique;
    }
}
