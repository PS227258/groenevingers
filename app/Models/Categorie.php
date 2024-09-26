<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name"];

    /**
     * Defines the relation between products and categories
     */
    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get a categorie row from the database using its id
     * 
     * @param int $id id of the categorie to fetch
     * @return Categorie an instance of the categorie model
     */
    public static function getCategorie($id)
    {
        return Categorie::find($id);
    }
}
