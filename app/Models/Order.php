<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The romenules that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menu(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'order_details', 'order_id')->withPivot('quantity', 'harga');
    }
}
