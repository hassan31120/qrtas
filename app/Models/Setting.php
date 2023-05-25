<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'about',
        'about_en',
        'contact',
        'terms',
        'terms_en',
        'privacy',
        'privacy_en',
        'email',
        'mobile',
        'whatsapp',
    ];
}
