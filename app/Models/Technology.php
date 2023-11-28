<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Technology extends Model
{
    use HasFactory;

    public function project(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
    
    public function generateSlug($name)
    {
        return Str::slug($name, '-');
    } 
    protected $fillable = ['name', 'slug'];
}
