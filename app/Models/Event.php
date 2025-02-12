<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'available_tickets',
        'price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
        'price' => 'decimal:2', // Although defined as decimal in schema, explicit casting is good for model consistency if needed for specific formatting or behavior.
        // 'available_tickets' could be cast to integer if you intend to use it as a number in your application logic,
        // but the schema defines it as string, so casting to integer might depend on your use case.
        // If you want to ensure it's always treated as an integer in the model, uncomment the line below:
        // 'available_tickets' => 'integer',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'available_tickets' => 0,
        'price' => 0.00,
    ];
}
