<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id_kategori',
    	'sku',
        'nama',
        'stok',
        'is_deleted',
        'created_at',
        'updated_at'
    ];
}
