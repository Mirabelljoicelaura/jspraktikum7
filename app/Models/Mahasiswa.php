<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table="mahasiswa";
    public $timestamps = false;
    protected $primaryKey = 'Nim';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nim',
        'Nama',
        'Tanggal_Lahir',
        'Kelas',
        'Jurusan',
        'No_Handphone',
        'Email',
        ];
    };


