<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $guard = "user";
    
    protected $fillable = [
        'client_f_name',
        'client_f_name',
        'client_address',
        'client_contact_number',
        'client_username',
        'client_email',
        'client_password',
    ];
}
