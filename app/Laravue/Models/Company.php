<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'cnpj', 'address_id'];

    protected $searchableFields = ['*'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function receiveds()
    {
        return $this->hasMany(payment::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
