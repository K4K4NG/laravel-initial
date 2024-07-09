<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'cnt_testing_pendidikan'; // Sesuaikan dengan nama tabel pendidikan

    protected $fillable = [
        'name', 'description'
    ];

    // Define the relationship to Biodata
    public function biodatas()
    {
        return $this->belongsToMany(Biodata::class, 'cnt_testing_biodata_pendidikan', 'pendidikan_id', 'biodata_id');
    }
}
