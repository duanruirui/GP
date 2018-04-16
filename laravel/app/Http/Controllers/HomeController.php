<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Menu;
use App\Models\Group;
use App\Models\Action;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *??
     * @return void 
     */
    /* public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	   
        $menu_array  = Menu::where('f_menu_flag', 0)->orderBy('f_menu_order', 'desc')->get();
        $group_action_list = Group::find(Auth::user()->f_group_id, array('f_action_list'));
        foreach ($menu_array as $key => $val) {
            if ($val['f_menu_parent_id'] == 0) {
                $parentList [$key]['f_action'] = $val['f_action'];
                $parentList [$key]['f_menu_name'] = $val['f_menu_name']; 
                $parentList [$key]['f_menu_url'] = '#';
                $parentList [$key]['f_menu_id'] = $val['f_menu_id'];   
            } else {
                $action_count = Action::where('f_action',$val['f_action'])->count(); 
                if (!preg_match ( '/,' . $val['f_action'] . ',/', ",".$group_action_list['f_action_list']."," )) {
                    continue;                                                                                                       
                }
                if ($action_count == 0) { continue; }
                $subList [$key]['f_action'] = $val['f_action'];
                $subList [$key]['f_menu_name'] = $val['f_menu_name']; 
                $subList [$key]['f_menu_url'] = $val['f_menu_url'];
                $subList [$key]['f_menu_parent_id'] = $val['f_menu_parent_id'];
                
            }
        }
        
        if (! empty ( $parentList ) && ! empty ( $subList )) {
            foreach ( $parentList as $key => $list ) {  
                foreach ( $subList as $sk => $sl ) {
                    if ($sl ['f_menu_parent_id'] == $list ['f_menu_id']) {
                            $parentList [$key] ['sublist'] [] = $subList [$sk];   
                    } 
                }
                if (!isset($parentList [$key]['sublist']))
                {
                    unset($parentList [$key]); 
                }
            } 
        }
        $adminusername = Auth::user()->f_admin_user_name;
		return View('index')
        ->with('adminusername', $adminusername) 
        ->with('parentLists', $parentList) ;
	}  
}
