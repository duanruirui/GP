<?php
namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class GroupController extends Controller 
{
    
    /**
    * group list列表
    * 
    */
	public function groupIndex()
	{
        $group_array = Group::orderBy('f_group_id', 'asc')->paginate(config('ssp.paginsize'));
        return view('group.index')
        ->with('group_list', $group_array) ; 
        
	}
    /**
    * 修改显示
    * 
    * @param mixed $id
    */
    public function groupEdit($id) {
        $group_action_list = Group::find($id);

        $action_list = $group_action_list['f_action_list'];
        $priv_arr = getPrivArr($action_list);
        return view('group.edit')
        ->with('row', $group_action_list)
        ->with('priv_arr', $priv_arr) ; 
    }
    /**
    * 修改post提交
    * 
    * @param mixed $id
    */
    public function PostEdit($id, Request $request)
    {
        $group_name = $request->input('group_name');
        $this->validate($request, [
        		'group_name' => 'required'
        ]);
        $group_describe = $request->input('group_describe');
        $action_code = $request->input('action_code');
        $action_code = implode(",", $action_code);
        
        $group = Group::find($id);
        $group->f_group_name = $group_name;
        $group->f_group_describe = $group_describe;
        $group->f_action_list = $action_code;
        $group->save();
        my_Admin_Log('角色修改操作，id= '.$id);
        return redirect('/group');
    }
    
    /**
    * 添加角色
    * 
    */
    public function addGet()
    { 
        $priv_arr = getPrivArr('');
        return view('group.add')
        ->with('priv_arr', $priv_arr) ; 
    }
    
    /**
    * 添加角色post
    * 
    */
    public function addPost(Request $request)
    {
        $group_name = $request->input('group_name');
        $this->validate($request, [
        		'group_name' => 'required'
        ]);
        $group_describe = $request->input('group_describe');
        $action_code = $request->input('action_code');
        $action_code = implode(",", $action_code);
        $new_action = array(
            'f_group_name' => $group_name,
            'f_group_describe' => $group_describe,
            'f_action_list' => $action_code 
        );
        $action = new Group($new_action);
        $action->save();
        my_Admin_Log('角色添加操作，group_name= '.$group_name);
        return redirect('/group'); 
    }
    
    
    /**
    * 删除角色
    * 
    * @param mixed $id
    */
    public function delete($id)
    { 
        $action = Group::find($id);
        $action->delete();
        my_Admin_Log('角色删除操作，id= '.$id);
        return redirect('group');     
    }
    
                                             
}
