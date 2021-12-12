<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangInout extends Model
{
    use HasFactory;

    protected $table = 'barang_in_out';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'sku',
        'tanggal',
        'qty',
        'is_flag',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
