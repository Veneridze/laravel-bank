<?php

namespace Farsh4d\Bank\Traits;

use Farsh4d\Bank\Models\Payment;
use Illuminate\Database\Eloquent\Relations\MorphMany;
//use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasPayments
{
    /**
     * Summary of payments
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function payments(): MorphMany
    {
        return $this->morphMany(Payment::class, "model");
    }
}
