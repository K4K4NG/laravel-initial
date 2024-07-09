<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;
    protected $table = 'cnt_testing_biodata';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'fullname',
        'tanggal_lahir',
        'umur',
        'anak',
        'foto',
        'jenis_kelamin',
        'skills_ids'
    ];
    protected $hidden = []; // You can add any fields you want to hide from JSON output here
    protected $casts = [
        'tanggal_lahir' => 'date', // Cast tanggal_lahir to a date
    ];
    public function skills()
    {
        return $this->hasMany(Skill::class, 'biodata_id', 'id');
    }
    public function pendidikan()
    {
        return $this->belongsToMany(Pendidikan::class, 'cnt_testing_biodata_pendidikan', 'biodata_id', 'pendidikan_id');
    }
}