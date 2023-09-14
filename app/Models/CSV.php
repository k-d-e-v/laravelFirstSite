<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSV extends Model
{
    use HasFactory;

    protected $fillable = ['companyname', 'firstname', 'lastname', 'email', 'phonenumber'];
}
