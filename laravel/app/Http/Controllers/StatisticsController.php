<?php
/**
*@author duanruirui
*@license Licese
*@version 1.0
*@link git@github.com:duanruirui/GP.git
*@final
*
*/

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Statistics;
use App\Order;
use Auth;

class StatisticsController extends Controller
{
	// private $auth_id;
	// public function __construct(){
	// 	$this->auth_id = Auth::id();
	// }
	/**
	*	transaction day datas index
	*/
	public static function indexDay(){
		$start_date = date('Y-m-d');
    	$orders = Order::select(DB::raw('f_transaction_id,f_date,sum(f_payment) as f_total_fee'))
    		 ->where('f_transaction_id',Auth::id())
    		 ->where('f_date',$start_date)
    		 ->get();
    	return view('draw.index')
	    	->with(array(
	    		'orders'=>$orders,
	    		'json_orders'=>self::make_json($orders),
	    		'start_date'=>$start_date,
	    		'end_date'=>$start_date,
	    	));
	}
	/**
	*	transaction day datas seach
	*/	
    public static function transactionDay($request){
    	$this->validate($request,array(
    		'download' => 'required|integer',
    		'start_date' => 'required|date',
    		'end_date' => 'required|date',
    	));
    	$download = $request->download;
    	$start_date = $request->start_date;
    	$end_date = $request->end_date??date('Y-m-d');
    	$orders = Order::select(DB::raw('f_transaction_id,f_date,sum(f_payment) as f_total_fee'))
    		 ->where('f_transaction_id',Auth::id())
    		 ->whereBetween('f_date',[$start_date,$end_date])
    		 ->groupBy('f_date')
    		 ->orderBy('f_date','ASC')
    		 ->get();
    	if($download){
    		//export CSV
    	}
    	return view('draw.index')
	    	->with(array(
	    		'orders'=>$orders,
	    		'json_orders'=>self::make_json($orders),
	    		'start_date'=>$start_date,
	    		'end_date'=>$end_date,
	    	));
    }
    /**
    *return json type data for drawing
    */
    protected static function make_json($obj){
    	$json_string = '{';
    	foreach ($obj as $key => $value) {
    		$json_string .='"'.$value->f_date.'":'.$value->f_total_fee.',';
    	}
    	return rtrim($json_string,',').'}';
    }
}
