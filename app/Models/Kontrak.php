<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kontrak extends Model
{
    use HasFactory, Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kontrak';

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Get the phone associated with the perusahaan.
     */
    public function perusahaan()
    {
        return $this->hasOne(Perusahaan::class,'id', 'id_perusahaan');
    }

    /**
     * Get the phone associated with the Barang.
     */
    public function barang()
    {
        return $this->hasMany(Barang::class,'id_kontrak', 'id');
    }

    /**
     * Get all of the deployments for the project.
     */
    public function total_dikirim()
    {
        return $this->hasMany(Pengiriman::class,'id_kontrak','id');
    }


    /**
     * Get the phone associated with the Barang.
     */
    public function invoice()
    {
        return $this->hasOne(FileKontrakInvoice::class,'id_kontrak', 'id');
    }

    /**
     * Get the phone associated with the Barang.
     */
    public function perjanjian()
    {
        return $this->hasOne(FileKontrakPerjanjian::class,'id_kontrak', 'id');
    }


}
