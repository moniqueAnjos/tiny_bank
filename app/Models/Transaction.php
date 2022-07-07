<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $orderByDefault = ['id' => 'desc'];

    protected $table = 'transactions';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing  = true;

    public $timestamps = true;

    protected $fillable = [
        'id',
        'payer',
        'payee',
        'status',
        'value'
    ];
}
