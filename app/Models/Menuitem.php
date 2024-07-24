<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menuitem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'order', 'menu_id', 'page_id'];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
