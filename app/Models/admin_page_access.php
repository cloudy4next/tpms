<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_page_access extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'page_id', 'page_name', 'page_url'];
}
