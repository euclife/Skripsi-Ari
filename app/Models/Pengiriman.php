<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory,Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengiriman';

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Get the phone associated with the pengiriman.
     */
    public function kontrak()
    {
        return $this->hasOne(Kontrak::class,'id', 'id_kontrak');
    }

    /**
     * Get the phone associated with the pengiriman.
     */
    public function detail_pengiriman()
    {
        return $this->hasMany(DetailPengiriman::class,'id_pengiriman', 'id');
    }
}
