@extends('layouts.head')
@section('title', '权限编辑_权限管理') 
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
{{ Form::open(array('url'=>'action/add','method'=>'post','class'=>'definewidth m20')) }} 
<table class="table table-bordered table-hover ">
    <tr>
        <td width="10%" class="tableleft">权限名</td>
        <td>{{ Form::text('action_name') }}&nbsp;&nbsp;<span class='msg'>@if ($errors->has('action_name')) {{ $errors->first('action_name') }} @endif</span></td>
        
    </tr>
    <tr>
        <td class="tableleft">权限id</td>
        <td >{{ Form::text('action') }}</td>
    </tr>  
    <tr>
        <td class="tableleft">上级权限</td>
        <td >
        {{Form::select('action_parent', $action_parentList)}}
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
                window.location.href="/action";
         });
    });
</script>

@endsection