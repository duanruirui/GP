<style>
.merchant_popbox{position: fixed;left: 0;top: 0;width: 100%;height: 100%;z-index: 9999; display: none;}
.merchant_popbox .conbox{min-width: 300px;background: #fff;position: absolute;left: 50%;top: 50%;margin: -100px 0 0 -150px; border: 1px solid #c3c6c9; box-shadow: 0 0 10px #c3c6c9; }
.merchant_popbox .conbox .title {height: 35px; line-height: 35px; font-size:15px; font-weight: bold; padding-left:20px; background: #f8f9fa; border-bottom: 1px solid #edeef5; }
.merchant_popbox .conbox .cont { padding: 20px; }
.merchant_popbox .conbox .acon{text-align: center;}
.merchant_popbox .conbox .txt{font-size: 14px;color: #333; line-height: 24px;margin-top: -5px;}
.merchant_popbox .conbox .cap{text-align: center;line-height: 30px;}
.merchant_popbox .conbox .cap .txt1{vertical-align: middle;margin: -2px 0 0 10px;height: 28px;line-height: 28px;width: 150px;border: 1px solid #ddd;text-indent: 6px;}
.merchant_popbox .conbox .waitOk{padding: 15px 0 0 110px;min-height: 50px;background: url(../images/success_ico.png) no-repeat 40px center;}
.merchant_popbox .conbox .waitOk p{font-size: 12px;color: #666;line-height: 20px;}
.merchant_popbox .conbox .btn1{margin-top: 30px;overflow: hidden;text-align: right;}
.merchant_popbox .conbox a{display: inline-block;width: 90px;height: 30px;line-height: 30px;border-radius: 3px;text-align: center;font-size: 12px;}
.merchant_popbox .conbox .one{margin: 0 auto;}
.merchant_popbox .conbox .ok{background: #2492df;border: 1px solid #118ADE;color: #fff;}
.merchant_popbox .conbox .ok:hover{background: #118ADE;}
.merchant_popbox .conbox .cancel{background: #d4d4d4;border: 1px solid #cdcdcd;color: #000;}
.merchant_popbox .conbox .cancel:hover{background: #cdcdcd;}
.merchant_popbox .conbox .tit{text-align: center;font-size: 24px;color: #000;font-family: Microsoft Yahei;margin: -10px 0 20px 0;}
.merchant_popbox .conbox .inpbox{margin: 0 20px;position: relative;cursor: pointer;}
.merchant_popbox .mall_list li .r .txt1,
.merchant_popbox .conbox .inpbox .txt1{width: 100%;border: 1px solid #e5e5e5;height: 38px;line-height: 38px;text-align: center;color: #555;border-radius: 5px;}
.merchant_popbox .mall_list{margin: 0 25px;}
.merchant_popbox .mall_list li{padding: 10px 0;overflow: hidden;}
.merchant_popbox .mall_list li .l{width: 140px;float: left;line-height: 40px;font-size: 16px;}
.merchant_popbox .mall_list li .r{margin-left: 140px;}
.merchant_popbox .mall_list li .r .setExpress{width: 200px;height: 30px;line-height: 30px;margin-top: 5px;}
.merchant_popbox .mall_list li .r .txt1{width: 99%;text-align: left;text-indent: 10px;}
.order_popbox{z-index: 80;}
.alert_bg{height: 100%; width:100%;background: #999999; display: none;z-index: 999; top: 0px; left: 0px;position: fixed; filter:alpha(opacity=75); opacity: 0.75}
</style>
<div class="merchant_popbox" id="openBox">
	<div class="conbox">
		<div class='title'></div>
		<div class='cont'>
			<div class="txt" id="openBox_txt"></div>
			<div class="txt" id="openBox_auto"></div>
			<div class="btn1">
				<a href="javascript:;" class="ok" id="openBox_ok">确 认</a>
				<a href="javascript:;" class="ml30 cancel" id="openBox_cancel">取 消</a>
			</div>
		</div>
	</div>
</div>
<div class="alert_bg" id='bg' style='z-index:9998'></div>