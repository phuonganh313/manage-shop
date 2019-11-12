<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Customer;
use App\Order;
use App\ProductOrder;
use DB;

class CustomerController extends Controller
{
    // public function show(Request $request){
    //     $get_product = Product::getProductByName($request->name_product);
    //     $data= array();
    //     if (!empty($get_product)) {
    //         $data = Customer::getCustomerByProduct($get_product->id);
    //     }

    //     return response()->json([
    //         'message'=> $data ? 'Success' : 'Non-success',
    //         'data' => $data
    //             ], 200);
    // }

    public function show(Request $request){
        $get_product = Product::getProductByName($request->name_product);
        $id_order = array();
        if($get_product){
            $get_order= ProductOrder::getOrderIdByProductId($get_product->id);
            if($get_order){
                foreach($get_order as $value){
                    array_push($id_order, $value->id_order);
                }
            }
        }
        $id_customer = array();
        if($id_order){
            // dd($id_order);
            $get_customer = Order::getOrderId($id_order);
            if($get_customer){
                foreach($get_customer as $value){
                    array_push($id_customer, $value->id_customer);
                }
            }
        }
        $data= array();
        if (!empty($id_customer)) {
            $data= Customer::getCustomerById($id_customer);

        }
        
        return response()->json([
            'message'=> $data ? 'Success' : 'Non-success',
            'data' => $data
                ], 200);

    }
}
