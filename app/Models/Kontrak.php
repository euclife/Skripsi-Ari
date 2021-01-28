<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
