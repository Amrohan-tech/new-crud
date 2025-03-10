<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes; // Use SoftDeletes

    protected $fillable = ['name', 'salary', 'job'];
    protected $dates = ['deleted_at']; // SoftDeletes column
}

