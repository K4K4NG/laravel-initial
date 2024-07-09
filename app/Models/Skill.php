<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'cnt_testing_skill'; // Sesuaikan dengan nama tabel skill

    protected $fillable = [
        'name', 'description', 'biodata_id'
    ];

    // Define the relationship to Biodata
    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'biodata_id', 'id');
    }
}
