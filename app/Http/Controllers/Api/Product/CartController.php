<?php

namespace App\Http\Controllers\Api\Product;

// use App\Models\Product\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use Cart;
use Validator;

class CartController extends Controller
{
	public function index(){
		echo "test cart controller";
	}

	public function add(Request $res){
		// $data = $res->all(); 

		$data = $res['newCartitem'];

		$id = !empty($data['id'])?$data['id']:0;
		$img = !empty($data['img'])?$data['img']:'';
		$price = !empty($data['price'])?$data['price']:0;
		$product = !empty($data['product'])?$data['product']:'';
		$qty = !empty($data['qty'])?$data['qty']:'';

		Cart::add([
			'id' => $id,
			'name' => $product,
			'price' => $price,
			'quantity' => $qty,
			'attributes' => array(
			'image' => $img
			)	
			// 'image' => $img	
		]);

		// $items = Cart::getContent();

		// echo "<pre>";
		// print_r($items);
		// die();

		if($data){
			return response()->json(['status'=>'success','message'=>$data]);
		}else{
			return response()->json(['status'=>'error','message'=>'Data not found']);
		}
		
	}

	public function get(){
		$cart_items = Cart::getContent();

		$cartArray = array();

		if(!empty($cart_items)){
			foreach($cart_items as $cikey => $cival){
				$cartArray[] = array(
					'id' => $cival->id,
					'img'=>  $cival->attributes->image,
					'qty' => $cival->quantity,
					'price' => $cival->price,
					'product' => $cival->name,
					'added' => true
				);
			}
		}

		$cartData = array(
        	'cart_data' => $cartArray
		);
		
		// dd(session()->all());

		// return $cart_items;
		if($cart_items){
			return response()->json(['status'=>'success','cartitem'=>$cartData]);
		}else{
			return response()->json(['status'=>'error','message'=>'Empty Cart']);
		}
		
	}

	public function remove(Request $res){
		$product_id = $res['product_id'];

		$remove_cart = Cart::remove($product_id);

		if($remove_cart){
			return response()->json(['status'=>'success','message'=>'Item Removed From Cart.']);	
		}else{
			return response()->json(['status'=>'error','message'=>'Unable to remove item.']);
		}

	}

	public function update(Request $res){
		$product_id = $res['product_id'];
		$update_type = $res['type'];
		$update_qty = $res['qty'];

		// $cart_items = Cart::getContent($product_id);
		// $cart_qty = $cart_items[$product_id]->quantity;

		if($update_type == 'inc'){
			// $qty = $cart_qty+1;
			$qty = $update_qty+1;
			$action_type = 'Increased';
		}else{
			// $qty = $cart_qty-1;
			$qty = $update_qty-1;
			$action_type = 'Decreased';
		}
		
		if($qty < 1){
			$qty = 1;
		}else{
			$qty = $qty;
		}

		$update_cart = Cart::update($product_id, ['quantity' => 
											['relative' => false, 'value' => $qty]]);

		if($update_cart){
			return response()->json(['status'=>'success','message'=>"Item $action_type From Cart."]);	
		}else{
			return response()->json(['status'=>'error','message'=>'Unable to remove item.']);
		}
	}

	public function add_favorite(Request $res){
		// $data = $res->all();
		$customer_id = !empty(auth()->user()->id)?auth()->user()->id:'';

		if(empty($customer_id)){
			return response()->json(['status'=>'error','message'=>'Please login to add favorite list.']);
		}

		$data = $res['newwishListitem'];

		$id = !empty($data['id'])?$data['id']:0;
		$img = !empty($data['img'])?$data['img']:'';
		$price = !empty($data['price'])?$data['price']:0;
		$product = !empty($data['product'])?$data['product']:'';
		$qty = !empty($data['qty'])?$data['qty']:'';
		$added = !empty($data['added'])?$data['added']:'';
		
        $locationid=auth()->user()->locationid;
        $orgid=auth()->user()->orgid;
        $postdatead=CURDATE_EN;
        $postdatebs=EngToNepDateConv(CURDATE_EN);
        $postip=get_real_ipaddr();
        $postmac=get_Mac_Address();

        $input['product_id'] = $id;
        $input['customer_id'] = $customer_id ; // customer id from login
        $input['postby']=$customer_id;
        $input['postdatead']=$postdatead;
        $input['postdatebs']=$postdatebs;
        $input['posttime']=date('H:i:s');
        $input['postip']=$postip;
        $input['postmac']= $postmac;
        $input['is_remove']= 'N';
        // $insert = DB::table('favorite_list')->insert($input);
        $insert = DB::table('favorite_list')->updateOrInsert(
        	[
        		'product_id'=>$id,
        		'customer_id'=>$customer_id
        	],
        	$input
		);
		
		if($insert){
			$fav_items = DB::table('favorite_list as fv')
				->leftJoin('product as p','fv.product_id','=','p.id')
				->where('fv.customer_id','=',$customer_id)->where('fv.is_remove','=','N')
				->select('p.id','p.product_code','p.product_title','p.image','p.price','p.discount_pc','p.product_slug')
				->get();
				$favArray = array();
				if(!empty($fav_items)){
					foreach($fav_items as $fkey => $fval){
						$favArray[] = array(
							'id' => $fval->id,
							'product_title' => $fval->product_title,
							'product_code' => $fval->product_code,
							'image' => url("/uploads/product_image/thumbnail/$fval->image"),
							// 'image' => "http://cms.xelwel.com.np/public/images/frontend/product/$fval->image",
							'price' => $fval->price,
							'discount_pc' => $fval->discount_pc,
							'product_slug' => $fval->product_slug,
						);
					}
				}
            return response()->json(['status'=>'success','message'=>'Favorite Item Added Successfully','data'=>$favArray]);
        }
        return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
    }

	public function get_favorite(){

		try {
			if(Auth::check()){
				$customer_id = auth()->user()->id;
        
				$fav_items = DB::table('favorite_list as fv')
				->leftJoin('product as p','fv.product_id','=','p.id')
				->where('fv.customer_id','=',$customer_id)->where('fv.is_remove','=','N')
				->select('p.id','p.product_code','p.product_title','p.image','p.price','p.discount_pc','p.product_slug')
				->get();
				$favArray = array();
				if(!empty($fav_items)){
					foreach($fav_items as $fkey => $fval){
						$favArray[] = array(
							'id' => $fval->id,
							'product_title' => $fval->product_title,
							'product_code' => $fval->product_code,
							'image' => url("/uploads/product_image/thumbnail/$fval->image"),
							'price' => set_product_price($fval->price),
							'discount_pc' => $fval->discount_pc,
							'product_slug' => $fval->product_slug,
						);
					}
				}
				$favData = array(
					'fav_data' => $favArray
				);
				if($fav_items){
					return response()->json(['status'=>'success','favitem'=>$favData]);
				}else{
					return response()->json(['status'=>'error','message'=>'No Items In WishList']);
				}
			}
		} catch (\Throwable $th) {
			return response()->json(['status'=>'error','message'=>$th->getMessage()]);
		}
	}

	public function remove_favorite(Request $res){
		$customer_id = !empty(auth()->user()->id)?auth()->user()->id:0;
		
		$product_id = $res['product_id'];

        $postdatead=CURDATE_EN;
        $postdatebs=EngToNepDateConv(CURDATE_EN);
        $postip=get_real_ipaddr();
        $postmac=get_Mac_Address();

		$remove_fav = \DB::table('favorite_list')->where('customer_id','=',$customer_id)->where('product_id','=',$product_id)->update(['is_remove'=>'Y','removedatebs'=>$postdatead,'removedatead'=>$postdatebs,'removetime'=>date('H:i:s'),'removeip'=>$postip,'removemac'=>$postmac]);

		if($remove_fav){
			return response()->json(['status'=>'success','message'=>"Favorite item removed successfully."]);	
		}else{
			return response()->json(['status'=>'error','message'=>'Unable to remove item.']);
		}
			
	}

}