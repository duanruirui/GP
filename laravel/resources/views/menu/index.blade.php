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
        thead.subtr {
            display:none;
        }
        thead.subtr td{
            padding:0px 60px 0px 60px;
        }

    </style>
@endsection
@section('content')
<form class="form-inline definewidth m20" action="index.html" method="get">  
     <button type="button" class="btn btn-success" id="addnew">新增菜单</button>
</form>
<form class="form-inline definewidth m10">
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>排序</th>
        <th>一级菜单名</th>
        <th>权限ID=>对应权限</th>
        <th>是否停用</th>
        <th>操作</th>
    </tr>
    </thead>
    @foreach ($parentLists as $parentList)
    <tr>
        <td>&nbsp;{{ $parentList['f_menu_order'] }}</td>
        <td><a href="javascript:void(0);" onClick="showSub('tr{{ $parentList['f_menu_id'] }}');">{{ $parentList['f_menu_name'] }}</td></a>
        <td>&nbsp;{{ $parentList['f_action'] }} => {{$parentList['f_action_name'] }}</td>
        <td>&nbsp;@if($parentList['f_menu_flag'] == 0) 启用 @else  停用 @endif</td>
        <td><a href="{{ url('menu/edit/'.$parentList['f_menu_id']) }}">编辑</a>&nbsp;/&nbsp;<a href="#" onclick="del({{ $parentList['f_menu_id'] }})">删除</a> </td>
    </tr>
    
    <thead class="subtr" id="tr{{ $parentList['f_menu_id'] }}">
            @if (!empty($parentList['sublist']))
            @foreach ($parentList['sublist'] as $sublist)
            <tr>
                <td>&nbsp;{{ $sublist['f_menu_order'] }}</td>
                <td>{{ $sublist['f_menu_name'] }}</td>
                <td>&nbsp;{{ $sublist['f_action'] }} => {{$sublist['f_action_name'] }}</td>
                <td>&nbsp;@if($sublist['f_menu_flag'] == 0) 启用 @else  停用 @endif</td>
                <td><a href="{{ url('menu/edit/'.$sublist['f_menu_id']) }}">编辑</a>&nbsp;/&nbsp;<a href="#" onclick="del({{ $sublist['f_menu_id'] }})">删除</a> </td>
            </tr>
            @endforeach
            @endif 
    </thead>
    
    @endforeach
    </table>
</form>
<script>
    $(function () { 
        $('#addnew').click(function(){
                window.location.href="menu/add";
         });

    });

    function del(id)
    {
        if(confirm("确定要删除吗？"))
        {
            var url = "menu/delete/"+id;
            window.location.href=url;        
        }
    }
    
    function showSub(id) {
        $("#" + id).toggle();
        return false;
    }
    
</script>
@endsection