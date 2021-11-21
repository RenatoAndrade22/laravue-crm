<?php

namespace App\Laravue\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'cnpj',
        'active',
        'user_id',
        'phone',
        'email',
    ];

    protected $searchableFields = ['*'];

}
