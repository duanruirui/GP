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

use Illuminate\Http\Request;
use app\Statistics;
use app\Order;
use Auth;

class StatisticsController extends Controller
{
	/**
	*	transaction day datas
	*/
    public static function TransactionDay($request){
    	$this->validate($request,array(
    		'download' => 'required|integer',
    		// 'trans_id' => 'required|integer',
    		'start_date' => 'required|date',
    		// 'end_date' => 'required|date',
    	));
    	$download = $request->download;
    	// $trans_id = $request->trans_id;
    	$trans_id = Auth::id();
    	$start_date = $request->start_date;
    	$end_date = $request->end_date??date('Y-m-d');
    	$orders = Order::select('f_transaction_id,f_date,sum(f_payment) as f_total_fee')
    		 ->where('f_transaction_id',$trans_id)
    		 ->whereBetween('f_date',[$start_date,$end_date])
    		 ->groupBy('f_date')
    		 ->orderBy('f_date','ASC')
    		 ->get();
    	if($download)){
    		//export CSV
    	}
    	return view('draw.index')
	    	->with(array(
	    		'orders'=>$orders,
	    		'start_date'=>$start_date,
	    		'end_date'=>$end_date,
	    	));
    }
}
