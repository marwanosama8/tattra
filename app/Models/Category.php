<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];

    /**
     * Get all of the stories for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}
