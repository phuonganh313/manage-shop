<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_order';
    protected $fillable=['id_order', 'id_product', 'created_at', 'updated_at'];

    /**
     * Relationship: Order
     * @return Object Order
     */
    public function order() {
        return $this->belongsTo('App\Order', 'id_order');
    }

    /**
     * Relationship: product
     * @return Object product
     */
    public function product() {
        return $this->belongsTo('App\Product', 'id_product');
    }

    public static function getOrderIdByProductId($id_product){
        return DB::table('product_order')->where('id_product', $id_product)->get()->toArray();
    }
    public static function getProductIdByOrderId($id_order){
        return DB::table('product_order')->where('id_order', $id_order)->first();
    }
}
