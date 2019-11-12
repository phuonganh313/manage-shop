<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order';
    protected $fillable=['id', 'id_customer', 'ship_order', 'created_at', 'updated_at'
    ];

    /**
     * Relationship: customer
     * @return Object customer
     */
    public function customer() {
        return $this->belongsTo('App\Customer','id_customer');
    }

    /**
     * Relationship: bill
     * @return Object bill
     */
    public function bill() {
        return $this->hasOne('App\Bill','id_order');
    }

    /**
     * Relationship: ProductOrder
     * @return Object ProductOrder
     */
    public function ProductOrder() {
        return $this->hasMany('App\ProductOrder', 'id_order');
    }

    public static function getOrderId($id_order){
        return DB::table('order')->select('id_customer')->whereIn('id', $id_order)->get()->toArray();
    }
}