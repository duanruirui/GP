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
    	return view('draw.day')
	    	->with(array(
	    		'orders'=>$orders,
	    		'json_orders'=>self::day_json($orders),
	    		'start_date'=>$start_date,
	    		'end_date'=>$start_date,
	    	));
	}
	/**
	*	transaction day datas seach
	*/	
    public function transactionDay(Request $request){
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
    		 ->get();
    	if($download){
    		//export CSV
    	}
    	return view('draw.day')
	    	->with(array(
	    		'orders'=>$orders,
	    		'json_orders'=>self::day_json($orders),
	    		'start_date'=>$start_date,
	    		'end_date'=>$end_date,
	    	));
    }

    /**
    *   transaction week datas index
    */
    public static function indexWeek(){
        $start_date = date('Y-m-d');
        $orders = Order::select(DB::raw('f_transaction_id,DATE_FORMAT(f_date,"%u") as f_week,sum(f_payment) as f_total_fee'))
             ->where('f_transaction_id',Auth::id())
             ->whereBetween('f_date',[self::monday_date($start_date),self::sunday_date($start_date)])
             ->get();
        return view('draw.week')
            ->with(array(
                'orders'=>$orders,
                'json_orders'=>self::week_json($orders),
                'start_date'=>$start_date,
                'end_date'=>$start_date,
            ));
    }
    /**
    *   transaction week datas seach
    */  
    public function transactionWeek(Request $request){
        $this->validate($request,array(
            'download' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ));
        $download = $request->download;
        $start_date = $request->start_date;
        $end_date = $request->end_date??date('Y-m-d');
        $orders = Order::select(DB::raw('f_transaction_id,DATE_FORMAT(f_date,"%u") as f_week,sum(f_payment) as f_total_fee'))
             ->where('f_transaction_id',Auth::id())
             ->whereBetween('f_date',[self::monday_date($start_date),self::sunday_date($end_date)])
             ->groupBy('f_week')
             ->get();
        if($download){
            //export CSV
        }
        return view('draw.week')
            ->with(array(
                'orders'=>$orders,
                'json_orders'=>self::week_json($orders),
                'start_date'=>$start_date,
                'end_date'=>$end_date,
            ));
    }

    /**
    *   transaction month datas index
    */
    public static function indexMonth(){
        $start_date = date('Y-m-d');
        $orders = Order::select(DB::raw('f_transaction_id,DATE_FORMAT(f_date,"%m") as f_week,sum(f_payment) as f_total_fee'))
             ->where('f_transaction_id',Auth::id())
             ->whereBetween('f_date',[date('Y-m-01'),date('Y-m-t')])
             ->get();
        return view('draw.week')
            ->with(array(
                'orders'=>$orders,
                'json_orders'=>self::week_json($orders),
                'start_date'=>$start_date,
                'end_date'=>$start_date,
            ));
    }
    /**
    *   transaction week datas seach
    */  
    public function transactionMonth(Request $request){
        $this->validate($request,array(
            'download' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ));
        $download = $request->download;
        $start_date = date('Y-m-01',strtotime($request->start_date));
        $end_date = $request->end_date?date('Y-m-t',strtotime($request->end_date)):date('Y-m-d');
        $orders = Order::select(DB::raw('f_transaction_id,DATE_FORMAT(f_date,"%m") as f_week,sum(f_payment) as f_total_fee'))
             ->where('f_transaction_id',Auth::id())
             ->whereBetween('f_date',[$start_date,$end_date])
             ->groupBy('f_week')
             ->get();
        if($download){
            //export CSV
        }
        return view('draw.week')
            ->with(array(
                'orders'=>$orders,
                'json_orders'=>self::week_json($orders),
                'start_date'=>$start_date,
                'end_date'=>$end_date,
            ));
    }


    /**
    *return json type data for drawing
    */
    protected static function day_json($obj){
    	$json_string = '{';
    	foreach ($obj as $key => $value) {
    		$json_string .='"'.$value->f_date.'":'.$value->f_total_fee.',';
    	}
    	return rtrim($json_string,',').'}';
    }
    protected static function week_json($obj){
        $json_string = '{';
        foreach ($obj as $key => $value) {
            $json_string .='"'.$value->f_week.'":'.$value->f_total_fee.',';
        }
        return rtrim($json_string,',').'}';
    }
    protected static function month_json($obj){
        $json_string = '{';
        foreach ($obj as $key => $value) {
            $json_string .='"'.$value->f_month.'":'.$value->f_total_fee.',';
        }
        return rtrim($json_string,',').'}';
    }    
    /**
    *get monday date by $date
    *$date '2018-04-24' kind of string
    *return monday date and sunday date
    */
    protected static function date_to_weeks($date){
        $week = date('Y-W',strtotime($date));
        $week_turnnel = preg_replace("/-/", "-W", $week);
        $monday_date = date('Y-m-d',strtotime($week_turnnel));
        $sunday_date = date('Y-m-d',strtotime($monday_date)+518400);//6*24*3600=518400
        return ['monday'=>$monday_date,'sunday'=>$sunday_date];
    }
    /**
    *for improving performance
    */
    protected static function monday_date($date){
        return date('Y-m-d',strtotime(preg_replace("/-/", "-W", date('Y-W',strtotime($date)))));
    }
    /**
    *for improving performance,get sunday
    */
    protected static function sunday_date($date){
        return date('Y-m-d',strtotime(preg_replace("/-/", "-W", date('Y-W',strtotime($date)+518400))));
    }   
}
