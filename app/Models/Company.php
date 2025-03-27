<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'name',
    ];

    public function funds(): HasMany
    {
        return $this->hasMany(Fund::class);
    }

    public function investiments(): HasMany
    {
        return $this->hasMany(FundInvestInCompany::class);
    }
}
