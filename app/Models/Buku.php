<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jenis;

class Buku extends Model
{
    public $timestamps = false;
    protected $table = 'buku';
    protected $fillable = ['judul','penulis','penerbit','jenis','tahun_terbit'];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis');
    }
}
