<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bill';
    protected $fillable = ['id', 'id_order', 'total_bill', 'payment', 'date_pay', 'created_at', 'updated_at'
    ];

    /**
     * Relationship: Order
     * @return Object Order
     */
    public function order(){
        return $this->hasOne('App\Order', 'id_order');
    }
}
