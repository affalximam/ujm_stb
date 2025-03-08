<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submenu extends Model
{
    use HasFactory;
    
    protected $table = 'submenu';
    protected $primaryKey = 'submenu_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'submenu_text',
        'submenu_type',
        'submenu_parent',
        'submenu_level',
    ];

    public function parentMenu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'submenu_parent', 'menu_id');
    }
}
