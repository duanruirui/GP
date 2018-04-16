@extends('layouts.head')
@section('title', '权限列表_权限管理') 
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
     <button type="button" class="btn btn-success" id="addnew">新增权限</button>
</form>
<form class="form-inline definewidth m10">
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>权限ID</th>
        <th>权限名</th>
        <th>操作</th>
    </tr>
    </thead>
    @foreach ($parentLists as $parentList)
    <tr>
        <td>&nbsp;{{ $parentList['f_action'] }}</td>
        <td><a href="javascript:void(0);" onClick="showSub('tr{{ $parentList['f_action_id'] }}');">{{ $parentList['f_action_name'] }}</td></a>
        <td><a href="{{ url('action/edit/'.$parentList['f_action_id']) }}">编辑</a>&nbsp;/&nbsp;<a href="#" onclick="del({{ $parentList['f_action_id'] }})">删除</a> </td>
    </tr>
    
    <thead class="subtr" id="tr{{ $parentList['f_action_id'] }}">
            @if (!empty($parentList['sublist']))
            @foreach ($parentList['sublist'] as $sublist)
            <tr>
                <td>{{ $sublist['f_action'] }}</td>
                <td>{{ $sublist['f_action_name'] }}</a>
                <td><a href="{{ url('action/edit/'.$sublist['f_action_id']) }}">编辑</a>&nbsp;/&nbsp;<a href="#" onclick="del({{ $sublist['f_action_id'] }})">删除</a> </td>
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
                window.location.href="/action/add";
         });

    });

    function del(id)
    {
        if(confirm("确定要删除吗？"))
        {
            var url = "/action/delete/"+id;
            window.location.href=url;        
        }
    }
    
    function showSub(id) {
        $("#" + id).toggle();
        return false;
    }
    
</script>
@endsection