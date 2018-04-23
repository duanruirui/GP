@extends('layouts.draw')
@section('content')
<div style="margin:0 auto;text-align: center;">
    <h1 style="text-align: center;">statistics</h1>
	<canvas id="cv" style="width:99%;height:300;border:0.05rem solid gray;"></canvas>
    <form>
        <tr>
            <td>start date</td>
            <td><input type="date" name="start_date" placeholder="{{$start_date}}"></td>
        </tr>
        <tr>
            <td>end date</td>
            <td><input type="date" name="end_date" placeholder="{{$end_date}}"></td>
        </tr>
        <tr>
            <button type="submit">search</button>
        </tr>
    </form>
</div>
<div id="datas" style="display:none">{{$json_orders}}</div>
<script type="text/javascript">
    var cv = document.getElementById("cv");
    var ctx = cv.getContext("2d");
    var json_orders = JSON.parse(document.getElementById('datas').innerText);
    console.log(json_orders);
    // var data2 = [.3, .1, .2, .4, .2, .7, .3, .9];
    // var data3 = [3, 12, 14, 17, 29, 33, 40, 52];

    // getBrokenLine(data2, "#f00");
    // getBrokenLine(data3, "#0f0");
    
    drawMap(json_orders, "#0f0");

    //封装一个折线图的函数
    function drawMap(obj_data,color){
        var data = key = new array();
        for(k in obj_data){
            key.push(k);
            data.push(obj_data[k]);
        }
        var maxNum = Math.max.apply(null, data);    //求数组中的最大值
        var padding = 20,  //边距
                x0 = padding,  //原点x轴坐标
                y0 = cv.height - padding,  //原点y轴坐标
                xArrow_x = padding, //x轴箭头处坐标x
                xArrow_y = padding, //x轴箭头处坐标y
                yArrow_x = cv.width - padding,  //y轴箭头处坐标x
                yArrow_y = cv.height - padding, //y轴箭头处坐标y
                arrowWidth = 10,    //箭头的宽度
                xLength = cv.width - 2*padding - arrowWidth,    //x轴的长度
                yLength = cv.height - 2*padding - arrowWidth,  //y轴的长度
                pointsWidth = xLength/(data.length + 1);    //折线上每个点之间的距离

        ctx.beginPath();//控制绘制的折线不受坐标轴样式属性的影响
        //绘制x轴
        ctx.moveTo(x0, y0);
        ctx.lineTo(xArrow_x, xArrow_y);
        ctx.moveTo(xArrow_x, xArrow_y);
        ctx.lineTo(xArrow_x - arrowWidth, xArrow_y + arrowWidth);
        ctx.moveTo(xArrow_x, xArrow_y);
        ctx.lineTo(xArrow_x + arrowWidth, xArrow_y + arrowWidth);

        //绘制y轴
        ctx.moveTo(x0, y0);
        ctx.lineTo(yArrow_x, yArrow_y);
        ctx.moveTo(yArrow_x, yArrow_y);
        ctx.lineTo(yArrow_x - arrowWidth, yArrow_y - arrowWidth);
        ctx.moveTo(yArrow_x, yArrow_y);
        ctx.lineTo(yArrow_x - arrowWidth, yArrow_y + arrowWidth);
        ctx.strokeStyle = "#000";
        

        //中断（坐标轴和折线的）连接
        ctx.stroke();
        ctx.beginPath();
        ctx.fillStyle = color;
        var x_axis_height = padding + arrowWidth + yLength + 10;
        //绘制折线
        for (var i = 0; i < data.length; i++) {
            var pointX = padding + (i + 1) * pointsWidth;
            var pointY = padding + arrowWidth + (1 - data[i]/maxNum) * yLength;
            ctx.lineTo(pointX, pointY);
            ctx.fillText(data[i],pointX,pointY);
            ctx.fillText(key[i],pointX,x_axis_height);
        }
        ctx.strokeStyle = color;
        ctx.stroke();        
        
    }

    //封装一个折线图的函数
    function getBrokenLine(data, color) {
        var maxNum = Math.max.apply(null, data);    //求数组中的最大值
        var padding = 20,  //边距
                x0 = padding,  //原点x轴坐标
                y0 = cv.height - padding,  //原点y轴坐标
                xArrow_x = padding, //x轴箭头处坐标x
                xArrow_y = padding, //x轴箭头处坐标y
                yArrow_x = cv.width - padding,  //y轴箭头处坐标x
                yArrow_y = cv.height - padding, //y轴箭头处坐标y
                arrowWidth = 10,    //箭头的宽度
                xLength = cv.width - 2*padding - arrowWidth,    //x轴的长度
                yLength = cv.height - 2*padding - arrowWidth,  //y轴的长度
                pointsWidth = xLength/(data.length + 1);    //折线上每个点之间的距离

        ctx.beginPath();//控制绘制的折线不受坐标轴样式属性的影响
        //绘制x轴
        ctx.moveTo(x0, y0);
        ctx.lineTo(xArrow_x, xArrow_y);
        ctx.moveTo(xArrow_x, xArrow_y);
        ctx.lineTo(xArrow_x - arrowWidth, xArrow_y + arrowWidth);
        ctx.moveTo(xArrow_x, xArrow_y);
        ctx.lineTo(xArrow_x + arrowWidth, xArrow_y + arrowWidth);

        //绘制y轴
        ctx.moveTo(x0, y0);
        ctx.lineTo(yArrow_x, yArrow_y);
        ctx.moveTo(yArrow_x, yArrow_y);
        ctx.lineTo(yArrow_x - arrowWidth, yArrow_y - arrowWidth);
        ctx.moveTo(yArrow_x, yArrow_y);
        ctx.lineTo(yArrow_x - arrowWidth, yArrow_y + arrowWidth);
        ctx.strokeStyle = "#000";
        

        //中断（坐标轴和折线的）连接
        ctx.stroke();
        ctx.beginPath();
        ctx.fillStyle = color;
        var x_axis_height = padding + arrowWidth + yLength + 10;
        //绘制折线
        for (var i = 0; i < data.length; i++) {
            var pointX = padding + (i + 1) * pointsWidth;
            var pointY = padding + arrowWidth + (1 - data[i]/maxNum) * yLength;
            ctx.lineTo(pointX, pointY);
            ctx.fillText(data[i],pointX,pointY);
            // ctx.fillText(i,pointX,x_axis_height);
        }
        ctx.strokeStyle = color;
        ctx.stroke();
    }
</script>
@endsection