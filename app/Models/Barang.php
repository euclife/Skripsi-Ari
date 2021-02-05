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

    /**
     * Get the phone associated with the pengiriman.
     */
    public function nota()
    {
        return $this->hasOne(FileNotaBarang::class,'id_barang', 'id');
    }

    /**
     * Get the phone associated with the pengiriman.
     */
    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class,'id_kontrak', 'id')->with("perusahaan");
    }

    /**
     * Get the phone associated with the pengiriman.
     */
    public function creator()
    {
        return $this->belongsTo(User::class,'created_by', 'id');
    }

    /**
     * Get the phone associated with the pengiriman.
     */
    public function updater()
    {
        return $this->belongsTo(User::class,'updated_by', 'id');
    }

}
