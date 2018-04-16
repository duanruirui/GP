<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link href="{{ URL::asset('Css/style.css') }}" rel="stylesheet">  
    <link href="{{ URL::asset('Css/bootstrap-responsive.css') }}" rel="stylesheet">  
    <link href="{{ URL::asset('Css/bootstrap.css') }}" rel="stylesheet"> 
    <script type="text/javascript" src="{{ URL::asset('Js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('Js/bootstrap.js') }}"></script> 
    <script type="text/javascript" src="{{ URL::asset('Js/ckform.js') }}"></script> 
    <script type="text/javascript" src="{{ URL::asset('Js/common.js') }}"></script> 
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
</head>
<body>
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td>总支出：{{$totalprice}}</td>
        <td>本月支出：{{$monthprice}}</td>
    </tr>
</table>


</body>
</html>

