@extends('layouts.head')
@section('title', '角色列表_角色管理') 
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
     <button type="button" class="btn btn-success" id="addnew">新增角色</button>
</form>
<form class="form-inline definewidth m10">
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>角色ID</th>
        <th>角色名称</th>
        <th>角色说明</th>
        <th>操作</th>
    </tr>
    </thead>
    @foreach ($group_list as $group)
    <tr>
        <td>&nbsp;{{ $group['f_group_id'] }}</td>
        <td>&nbsp;{{ $group['f_group_name'] }}</td>
        <td>&nbsp;{{ $group['f_group_describe'] }}</td>   
        <td><a href="{{ url('group/edit/'.$group['f_group_id']) }}">编辑</a>&nbsp;/&nbsp;<a href="#" onclick="del({{ $group['f_group_id'] }})">删除</a> </td>
    </tr>   
    @endforeach
    </table>
</form>
<script>
    $(function () { 
        $('#addnew').click(function(){
                window.location.href="/group/add";
         });

    });

    function del(id)
    {
        if(confirm("确定要删除吗？"))
        {
            var url = "/group/delete/"+id;
            window.location.href=url;        
        }
    }
    
    function showSub(id) {
        $("#" + id).toggle();
        return false;
    }
    
</script>
@endsection