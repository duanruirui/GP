<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MenuController extends Controller 
{
    /**
    * 列表
    * 
    */
	public function menuIndex()
	{
        $menu_array = Menu::orderBy('f_menu_order', 'desc')->get();
        foreach ($menu_array as $key => $val) {
            $action_row = Action::where('f_action',$val['f_action'])->first(array('f_action_name'));
            if ($val['f_menu_parent_id'] == 0) {
                $parentList [$key]['f_action'] = $val['f_action'];
                $parentList [$key]['f_menu_name'] = $val['f_menu_name'];
                $parentList [$key]['f_menu_id'] = $val['f_menu_id']; 
                $parentList [$key]['f_action_name'] = $action_row['f_action_name'];
                $parentList [$key]['f_menu_url'] = $val['f_menu_url'];
                $parentList [$key]['f_menu_order'] = $val['f_menu_order']; 
                $parentList [$key]['f_menu_flag'] = $val['f_menu_flag'];
                $parentList [$key]['f_menu_parent_id'] = $val['f_menu_parent_id'];   
            } else {
                $subList [$key]['f_action'] = $val['f_action'];
                $subList [$key]['f_menu_id'] = $val['f_menu_id']; 
                $subList [$key]['f_menu_name'] = $val['f_menu_name'];
                $subList [$key]['f_menu_url'] = $val['f_menu_url'];
                $subList [$key]['f_action_name'] = $action_row['f_action_name']; 
                $subList [$key]['f_menu_order'] = $val['f_menu_order']; 
                $subList [$key]['f_menu_flag'] = $val['f_menu_flag']; 
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
            } 
        }
        return view('menu.index')
        ->with('parentLists', $parentList) ; 
        
	}
    /**
    * 修改显示
    * 
    * @param mixed $id
    */
    public function menuEdit($id) {
        $menu_row = Menu::find($id);
        $menu_parentList[0] = '默认顶级菜单' ;
        $menu_parentList_to = Menu::where('f_menu_parent_id',0)->orderBy('f_menu_id', 'asc')->get();

        foreach ($menu_parentList_to as $val) {
            $menu_parentList[$val['f_menu_id']] = $val['f_menu_name'];     
        }
        $menu_flag = array(0=>'启用', 1=>'停用');
        return view('menu.edit')
        ->with('menu_parentList', $menu_parentList)
        ->with('menu_flag', $menu_flag)
        ->with('menu_row', $menu_row) ; 
    }
    /**
    * 修改post提交
    * 
    * @param mixed $id
    */
    public function PostEdit($id, Request $request)
    {
        $menu_order = $request->input('menu_order');
        $menu_name = $request->input('menu_name');
        $action = $request->input('action');
        $menu_url = $request->input('menu_url');
        $menu_parent = $request->input('menu_parent');
        $menu_flag = $request->input('menu_flag');
        $this->validate($request, [
        		'menu_order' => 'required',
        		'menu_name' => 'required',
        		'action' => 'required',
        ]);
        $events = Menu::find($id);

        $events->f_menu_order = $menu_order;
        $events->f_menu_name = $menu_name;
        $events->f_action = $action;
        $events->f_menu_parent_id = $menu_parent;
        $events->f_menu_flag = $menu_flag;
        $events->f_menu_url = $menu_url;
        $events->save();
        return redirect('/menu');
    }
    
    /**
    * 添加权限
    * 
    */
    public function addGet()
    {
        $menu_parentList[0] = '默认顶级菜单' ;
        $menu_parentList_to = Menu::where('f_menu_parent_id',0)->orderBy('f_menu_id', 'asc')->get();

        foreach ($menu_parentList_to as $val) {
            $menu_parentList[$val['f_menu_id']] = $val['f_menu_name'];     
        }
        $menu_flag = array(0=>'启用', 1=>'停用');
        return view('menu.add')
        ->with('menu_parentList', $menu_parentList)
        ->with('menu_flag', $menu_flag);
    }
    
    /**
    * 添加权限post
    * 
    */
    public function addPost(Request $request)
    {
        $menu_order = $request->input('menu_order');
        $menu_name = $request->input('menu_name');
        $action = $request->input('action');
        $menu_url = $request->input('menu_url');
        $menu_parent = $request->input('menu_parent');
        $menu_flag = $request->input('menu_flag');
        $this->validate($request, [
        		'menu_order' => 'required',
        		'menu_name' => 'required',
        		'action' => 'required',
        ]);
        $new_menu = array(
            'f_menu_order' => $menu_order,
            'f_menu_name' => $menu_name,
            'f_action' => $action,
            'f_menu_parent_id' => $menu_parent,
            'f_menu_flag' => $menu_flag,
            'f_menu_url' => $menu_url
        );
        $menu = new Menu($new_menu);
        $menu->save();
        return redirect('/menu'); 
    }
    
    
    /**
    * 删除权限 
    * 
    * @param mixed $id
    */
    public function delete($id)
    {
        $action = Menu::find($id);
        $action->delete();
        if ($action->f_menu_parent_id  == 0) {
            Menu::where('f_menu_parent_id',$action->f_menu_id)->delete();    
        }
        return redirect('menu');     
    }
    
                                             
}
