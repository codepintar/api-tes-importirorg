<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'ref_kategori';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'is_deleted',
        'created_at',
        'updated_at'
    ];
}