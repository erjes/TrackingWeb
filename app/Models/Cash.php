<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;

    protected $table = 'Cash';

    protected $primaryKey = 'id';

    protected $fillable = [
        'session',
        'current',
        'spend',
        'type',
    ];

}
