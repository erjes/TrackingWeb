<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentEvent extends Model
{
    use HasFactory;

    protected $table = 'Shipment_Events';

    protected $primaryKey = 'id';

    protected $fillable = [
        'shipment_number',
        'event_time',
        'location',
        'details',
    ];

    // Relationship with the Shipment model
    public function shipment()
    {
        return $this->belongsTo(Shipment::class); // Adjust model name if different
    }
}
