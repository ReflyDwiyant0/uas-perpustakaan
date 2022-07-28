<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    public $timestamps = false;
    protected $table = 'jenis_buku';
    protected $fillable = ['nama','deskripsi'];

}
