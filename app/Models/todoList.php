<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todoList extends Model
{
    use HasFactory;
    protected $fillable = ['titre','description','user_id'];
}
