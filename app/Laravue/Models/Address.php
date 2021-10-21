<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'street',
        'number',
        'neighborhood',
        'complement',
        'zipcode',
        'city',
        'state_uf',
        'country',
    ];

    protected $searchableFields = ['*'];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }
}
