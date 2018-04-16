@extends('layouts.head')
@section('title', '菜单编辑_菜单管理') 
@section('style')
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }


    </style>
@endsection
@section('content')
{{ Form::open(array('url'=>'menu/edit/'.$menu_row->f_menu_id,'method'=>'post','class'=>'definewidth m20')) }} 
<table class="table table-bordered table-hover ">
    <tr>
        <td width="10%" class="tableleft">排序值</td>
        <td>{{ Form::text('menu_order',$menu_row->f_menu_order) }}(值越大，排序越靠前) </td>
        
    </tr>
    <tr>
        <td class="tableleft">菜单名</td>
        <td >{{ Form::text('menu_name',$menu_row->f_menu_name) }}</td>
    </tr>
    <tr>
        <td class="tableleft">对应权限ID</td>
        <td >{{ Form::text('action',$menu_row->f_action) }}</td>
    </tr>
    <tr>
        <td class="tableleft">菜单链接</td>
        <td >{{ Form::text('menu_url',$menu_row->f_menu_url) }}</td>
    </tr>    
    <tr>
        <td class="tableleft">上级菜单</td>
        <td >
        {{Form::select('menu_parent', $menu_parentList, $menu_row->f_menu_parent_id) }}
        </td>
    </tr>
    <tr>
        <td class="tableleft">是否启用</td>
        <td >
        {{Form::select('menu_flag', $menu_flag, $menu_row->f_menu_flag) }}
        </td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            {{ Form::submit('保存',array('class'=>'btn btn-primary')) }} &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
{{ Form::close() }}

<script>
    $(function () {       
        $('#backid').click(function(){
                window.location.href="/menu";
         });

    });
</script>

@endsection