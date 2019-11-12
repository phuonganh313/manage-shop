<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';
    protected $fillable=['id', 'name', 'address', 'phone', 'created_at', 'updated_at'];
    
    /**
     * Relationship: Order
     * @return Object Order
     */
    public function order() {
        return $this->hasMany('App\Order','id', 'id_customer');
    }

    // public static function getCustomerByProduct($product_id){
    //     $query = DB::table('product_order as po')
    //     ->join('product as p', 'po.id_product', '=', 'p.id')
    //     ->join('order as o', 'po.id_order', '=', 'o.id')
    //     ->join('customer as c', 'o.id_customer', '=', 'c.id')
    //     ->select('c.*')
    //     ->where('id_product', $product_id);
    //     return $query->get();
    // }

    public static function getCustomerById($id_customer){
        return DB::table('customer')->whereIn('id', $id_customer)->get();
    }

}