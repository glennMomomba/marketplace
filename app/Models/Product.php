<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'user_id',
        'shop_id',
    ];


    // Catégorie du produit
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Vendeur (user) qui a créé le produit
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Boutique à laquelle appartient le produit
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // Commandes liées via la table pivot order_product
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
                    ->withPivot('quantity','price')
                    ->withTimestamps();
    }

    // Avis des clients
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
