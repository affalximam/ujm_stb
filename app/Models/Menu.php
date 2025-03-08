<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'menu_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'menu_text',
        'menu_type',
    ];
}
