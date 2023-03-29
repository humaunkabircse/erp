<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = [
        'agent_fullname',
        'agent_address',
        'agent_contact',
        'agent_email',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
        'status'
    ];
}
