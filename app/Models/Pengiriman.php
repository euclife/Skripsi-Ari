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
}
