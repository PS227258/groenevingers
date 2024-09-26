<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "status_id",
        "customer_name",
        "city",
        "zipcode",
        "phone",
        "price"
    ];

    /**
     * Get the State associated with the Order.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * Get the Orderrows associated with the Order.
     */
    public function Orderrow(): HasMany
    {
        return $this->hasMany(Orderrow::class);
    }
}
