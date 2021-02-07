<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengiriman extends Model
{
    use HasFactory, Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_pengiriman';

    public $incrementing = false;
    protected $keyType = 'string';

    public function barang()
    {
        return $this->hasOne(Barang::class, "id","id_barang");
    }
}
