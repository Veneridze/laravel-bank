<?php

namespace Farsh4d\Bank\Models;

use Farsh4d\Bank\Models\Bank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Payment extends Model
{
    protected $table = 'payment_requisites';

    protected $guarded = [];

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
}
