<?php
namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ActionController extends Controller 
{
    /**
    * get all rights
    * 
    */
	public function actionIndex()
	{
        $action_array = Action::orderBy('f_action', 'asc')->get();
        foreach ($action_array as $key => $val) {
            if ($val['f_action_parent_id'] == 0) {
                $parentList [$key]['f_action'] = $val['f_action'];
                $parentList [$key]['f_action_id'] = $val['f_action_id'];
                $parentList [$key]['f_action_parent_id'] = $val['f_action_parent_id'];
                $parentList [$key]['f_action_name'] = $val['f_action_name'];   
            } else {
                $subList [$key]['f_action'] = $val['f_action'];
                $subList [$key]['f_action_id'] = $val['f_action_id'];
                $subList [$key]['f_action_parent_id'] = $val['f_action_parent_id'];
                $subList [$key]['f_action_name'] = $val['f_action_name']; 
            }
        }
        if (! empty ( $parentList ) && ! empty ( $subList )) {
            foreach ( $parentList as $key => $list ) {  
                foreach ( $subList as $sk => $sl ) {
                    if ($sl ['f_action_parent_id'] == $list ['f_action']) {
                        $parentList [$key] ['sublist'] [] = $subList [$sk];
                    }
                }
            } 
        }
        return view('action.index')
        ->with('parentLists', $parentList) ; 
        
	}
    /**
    * 修改显示
    * 
    * @param mixed $id
    */
    public function actionEdit($id) {
        $action_row = Action::find($id);
        $action_parentList[0] = '默认顶级权限' ;
        $action_parentList_to = Action::where('f_action_parent_id',0)->orderBy('f_action', 'asc')->get();

        foreach ($action_parentList_to as $val) {
            $action_parentList[$val['f_action']] = $val['f_action_name'];     
        }
        return view('action.edit')
        ->with('action_parentList', $action_parentList)
        ->with('action_row', $action_row) ; 
    }
    /**
    * 修改post提交
    * 
    * @param mixed $id
    */
    public function PostEdit($id, Request $request)
    {
        $action = $request->input('action');
        $action_name = $request->input('action_name');
        $action_parent = $request->input('action_parent');
        $new_action = array(
                'f_action_name' => $action_name,
                'f_action' => $action
        );
        $this->validate($request, [
        		'action_name' => 'required|min:3|max:128'
        ]);
        $events = Action::find($id);
        $events->f_action_parent_id = $action_parent;
        $events->f_action_name = $action_name;
        $events->f_action = $action;
        $events->save();
        return redirect('/action');
    }
    
    /**
    * 添加权限
    * 
    */
    public function addGet()
    {
        $action_parentList[0] = '默认顶级权限' ;
        $action_parentList_to = Action::where('f_action_parent_id',0)->orderBy('f_action', 'asc')->get();

        foreach ($action_parentList_to as $val) {
            $action_parentList[$val['f_action']] = $val['f_action_name'];     
        }
        return view('action.add')
        ->with('action_parentList', $action_parentList)   ;
    }
    
    /**
    * 添加权限post
    * 
    */
    public function addPost(Request $request)
    {
        $action = $request->input('action');
        $action_name = $request->input('action_name');
        $action_parent = $request->input('action_parent');
        $this->validate($request, [
        		'action_name' => 'required|min:3|max:128'
        ]);
        $new_action = array(
            'f_action_name' => $action_name,
            'f_action' => $action,
            'f_action_parent_id' => $action_parent 
        );
        $action = new Action($new_action);
        $action->save();
        return redirect('/action'); 
    }
    
    
    /**
    * 删除权限
    * 
    * @param mixed $id
    */
    public function delete($id)
    {
        $action = Action::find($id);
        $action->delete();
        if ($action->f_action_parent_id  == 0) {
            Action::where('f_action_parent_id',$action->f_action)->delete();    
        }
        return redirect('action');     
    }
    
                                             
}
