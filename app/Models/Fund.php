<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'fund_manager_id',
        'name',
        'start_year',
        'aliases',
    ];

    protected $casts = [
        'aliases' => 'array',
    ];

    public function fundManager(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function investiments(): HasMany
    {
        return $this->hasMany(FundInvestInCompany::class);
    }
}
