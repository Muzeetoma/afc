<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Company;

class Country extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'isoCode',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
