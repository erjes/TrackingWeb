<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $table = 'Shipment';

    protected $primaryKey = 'shipment_number';

    protected $fillable = [
        'shipment_number',
        'date',
        'item_type',
        'quantity',
        'weight',
        'sender_id',
        'recipient_id',
        'cubic_meters',
        'shipping_cost',
        'origin_location',
        'destination_location',
        'other_costs',
        'total_cost',
        'status'
    ];

    // Relationships with other models
    public function sender()
    {
        return $this->belongsTo(Customer::class, 'sender_id'); // Adjust foreign key name if necessary
    }

    public function recipient()
    {
        return $this->belongsTo(Customer::class, 'recipient_id'); // Adjust foreign key name if necessary
    }

    // Optional: Relationship with Shipment Events model (if you have one)
    public function events()
    {
        return $this->hasMany(ShipmentEvent::class); // Adjust model name if different
    }
}
