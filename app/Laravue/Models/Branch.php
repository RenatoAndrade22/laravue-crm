<?php

namespace App\Laravue\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class Branch extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    protected $table = 'branch';

    protected $fillable = [
        'name',
        'phone',
        'cnpj',
        'company_id',
        'status',
    ];

    protected $searchableFields = ['*'];

}
