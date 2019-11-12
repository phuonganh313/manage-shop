<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';
    protected $fillable=[
        'id', 'name_product', 'quantity_product', 'color_product', 'size_product',
        'classify', 'price', 'date_in', 'created_at', 'updated_at'
    ];

    /**
     * Relationship: product_order
     * @return Object productOrder
     */
    public function productOrder() {
        return $this->hasMany('App\ProductOrder','id_product');
    }
    public static function getProductByName($name_product) {
        $query = DB::table('product')
                    ->where('name_product', $name_product);
        return $query->first();
    }
}
