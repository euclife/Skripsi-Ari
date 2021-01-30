<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory, Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'barang';

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Get the phone associated with the pengiriman.
     */
    public function pengiriman()
    {
        return $this->hasMany(Perusahaan::class,'id_barang', 'id');
    }

}
