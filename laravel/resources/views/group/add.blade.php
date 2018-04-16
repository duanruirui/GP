@extends('layouts.head')
@section('title', '角色增加_角色管理') 
@section('js')
    <script type="text/javascript">
    function checkAll(frm, checkbox)
    {
        for (i = 0; i < frm.elements.length; i++)
        {
            if (frm.elements[i].name == 'action_code[]' || frm.elements[i].name == 'chkGroup')
            {
                frm.elements[i].checked = checkbox.checked;
            }
        }
    }

    function check(list, obj)
    {
        var frm = obj.form;

        for (i = 0; i < frm.elements.length; i++)
        {
            if (frm.elements[i].name == "action_code[]")
            {
                var regx = new RegExp(frm.elements[i].value + "(?!_)", "i");

            if (list.search(regx) > -1) {frm.elements[i].checked = obj.checked;}
            }
        }
    }
    </script>
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
<form method='post' action="{{ url('group/add/') }}" class='efinewidth m20'>
{{ csrf_field() }} 
<table class="table table-bordered table-hover ">
    <tr>
        <td width="10%" class="tableleft">角色名称</td>
        <td><input type='text' name='group_name' value='{{ old('group_name') }}'>&nbsp;&nbsp;<span>@if ($errors->has('group_name')) {{ $errors->first('group_name') }} @endif</span></td>     
    </tr>
    <tr>
        <td class="tableleft">角色说明</td>
        <td><textarea type='text' name='group_describe'></textarea></td>
    </tr>  
 @foreach ($priv_arr as $priv)  
    <tr>
        <td class="tableleft"> <input name="chkGroup" type="checkbox" value="checkbox" onClick="check('{{ $priv['priv_list'] }}',this);" class="checkbox">{{ $priv['f_action_name'] }}</td>
        <td >
            @if ($priv['priv'] != "")
            @foreach ($priv['priv'] as $list)
            <div style="width:200px;float:left;">
            <label for="priv{{$list['f_action']}}"><input type="checkbox" name="action_code[]" value="{{$list['f_action']}}" id="priv{{$list['f_action']}}" class="checkbox" @if ($list['cando'] == 1) checked="true" @endif/>
            {{$list['f_action_name']}}</label>
            </div>
            @endforeach  
            @endif
        </td>
    </tr>
    @endforeach
    <tr>
        <td class="tableleft"></td>
        <td>
            <input type='submit' value='保存' class='btn btn-primary'> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>

<script>
    $(function () {       
        $('#backid').click(function(){
                window.location.href="/group";
         });

    });
</script>
@endsection
