<?php

namespace App\Laravue\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'cpf',
        'address_id',
        'company_id',
    ];

    protected $searchableFields = ['*'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
