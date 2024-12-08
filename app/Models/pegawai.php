<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    public $timestamps = false;
    
    protected $fillable = [
        'nama',
        'no_hp'
    ];
}