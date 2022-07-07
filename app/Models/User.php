<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $orderByDefault = ['name' => 'asc'];

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing  = true;

    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'cpf_cnpj',
        'email',
        'password',
        'type',
        'value'
    ];
    
}
