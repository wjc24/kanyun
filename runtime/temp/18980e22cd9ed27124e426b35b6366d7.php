<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\work\kanyun\public/../application/index\view\index\index.html";i:1535713028;}*/ ?>
<!doctype html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>
<style>
	.sidebar .nav span{
		font-size: 10px;
	}
	.sidebar .nav > li > a{
		padding: 1.4rem;
	}
</style>
<body>
	<!-- WRAPPER -->
	<div id="wrapper" >
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top" style="height: 5%">
			<span style="font-size: 2rem;display:inline-block; margin: .5% 0 0 1%">电商小程序使用教程</span>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar" style="overflow:auto;width: 260px;height: 100%">
			<div class="sidebar-scroll">
				<div class="container-fluid" style="margin: -21% 0 0 -12%">
					<form class="navbar-form navbar-left">
						<div class="input-group">
							<input type="text" value="" id="select" class="form-control" placeholder="请输入搜索关键词...">
							<span class="input-group-btn" onclick="select()"><button type="button" class="btn btn-primary" >Go</button></span>
						</div>
					</form>
				</div>
				<div style="overflow:auto;width: 260px;height: 100%">
				<!--<nav>-->
					<ul class="nav">
						<?php if(is_array($data_one) || $data_one instanceof \think\Collection || $data_one instanceof \think\Paginator): $i = 0; $__LIST__ = $data_one;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data_one): $mod = ($i % 2 );++$i;?>
						<li>
							<a href="#<?php echo $data_one['id']; ?>" class="<?php echo $data_one['id']; ?>" data-toggle="collapse" class="collapsed" onclick="change('<?php echo $data_one['id']; ?>')"><span><?php echo $data_one['title']; ?></span> <?php if($data_one['icon'] == 1): ?><i class="icon-submenu lnr lnr-chevron-left"></i><?php else: endif; ?></a>
							<div id="<?php echo $data_one['id']; ?>" class="collapse ">
							<?php if(is_array($data_one['two']) || $data_one['two'] instanceof \think\Collection || $data_one['two'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data_one['two'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data_two): $mod = ($i % 2 );++$i;if($data_one['id'] == $data_two['pid']): ?>
									<ul class="nav">
										<li>
											<a href="#<?php echo $data_two['id']; ?>" class="<?php echo $data_two['id']; ?>" data-toggle="collapse" class="collapsed" onclick="change('<?php echo $data_two['id']; ?>')"><span><?php echo $data_two['title']; ?></span><?php if($data_two['icon'] == 1): ?><i class="icon-submenu lnr lnr-chevron-left"></i><?php else: endif; ?></a>
											<div id="<?php echo $data_two['id']; ?>" class="collapse ">
												<?php if(is_array($data_one['three']) || $data_one['three'] instanceof \think\Collection || $data_one['three'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data_one['three'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data_three): $mod = ($i % 2 );++$i;if($data_two['id'] == $data_three['pid']): ?>
												<ul class="nav">
													<li>
														<a href="javascript:void(0);" class="<?php echo $data_three['id']; ?>" class="collapsed" ><span style="margin-left:20%;" onclick="change('<?php echo $data_three['id']; ?>')"><?php echo $data_three['title']; ?></span></a>
													</li>
												</ul>
												<?php endif; endforeach; endif; else: echo "" ;endif; ?>
											</div>
										</li>
									</ul>
							<?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				<!--</nav>-->
				</div>
			</div>
		</div>
		<div class="main" style="margin-bottom:30px;">
			<input type="hidden" value="1" id="id">
			<span id="first"></span>
			<div  id="content">


			</div>
			<span style="margin-left: 10%;">上一篇：<a href="javascript:void(0);" id="previous" onclick="change_previous()"></a></span>
			<span style="margin-left: 50%;">下一篇：<a href="javascript:void(0);" id="next" onclick="change_next()"></a></span>
		</div>
	</div>

	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
<script>
	var tid = 0;
	var gid = 0;
	// 点击导航栏跳转
	function change(id) {
	    // alert(id);
		$.ajax({
			url: "<?php echo url('content'); ?>",
			type: "post",
			data: {'id':id},
			dataType: "json",
			success:function (res) {
				$('#content').html(res['content']);
                $('#id').val(res['id']);
                $('#previous').html(res['title_previous']);
                $('#next').html(res['title_next']);
                $('.'+gid).removeClass('active');
                $('.'+id).addClass('active');
                gid = id;
                if (id !== tid){
                    $('.'+tid).removeClass('active');
                }
            },
			error:function () {
				console.log('出错啦');
            }
		})
        $("html, body").animate({
            scrollTop: $("#first").offset().top }, {duration: 500,easing: "swing"});
        return false;

    }
    // 默认页面
    $(function(){
		var id = $('#id').val();
        $.ajax({
            url: "<?php echo url('content'); ?>",
            type: "post",
            data: {'id':id},
            dataType: "json",
            success:function (res) {
                // console.log(res);
                $('#content').html(res['content']);
                $('#previous').html(res['title_previous']);
                $('#next').html(res['title_next']);
            },
            error:function () {
                console.log('出错啦');
            }
        });

	});

	// 上一篇跳转
	function change_previous(){
        var id = $('#id').val();
        $.ajax({
            url: "<?php echo url('previous'); ?>",
            type: "post",
            data: {'id':id},
            dataType: "json",
            success:function (res) {
                $('#id').val(res['id']);
                $('#content').html(res['content']);
                $('#previous').html(res['title_previous']);
                $('#next').html(res['title_next']);
                var mid = parseInt(id) - 1;
                $('.'+id).removeClass('active');
                $('.'+mid).addClass('active');
                tid = mid;
            },
            error:function () {
                console.log('出错啦');
            }
        })
	}
    // 下一篇跳转
    function change_next(){
        var id = $('#id').val();
        // alert(id);
        $.ajax({
            url: "<?php echo url('next'); ?>",
            type: "post",
            data: {'id':id},
            dataType: "json",
            success:function (res) {
				// console.log(res);
                $('#id').val(res['id']);
                $('#content').html(res['content']);
                $('#previous').html(res['title_previous']);
                $('#next').html(res['title_next']);
                var mid = parseInt(id) + 1;
                $('.'+id).removeClass('active');
                $('.'+mid).addClass('active');
                tid = mid;
            },
            error:function () {
                console.log('出错啦');
            }
        })
    }
//搜索
    function select() {
        var key = $('#select').val();
        var title = '';
        var title1 = '<li><a href="#<?php echo $data_one['id']; ?>" data-toggle="collapse" class="collapsed" onclick="show(\'';
        var title2 = '\')"><span>';
        var title3 = '</span></a></li>';
        if (key == ''){
            window.location.reload();
            return false;
        }
        $.ajax({
            url: "<?php echo url('select'); ?>",
            type:"post",
            data:{'key':key},
            dataType:"json",
            success:function (res) {
                console.log(res[0].content);
                $('#content').html(res[0].content);
                $.each(res,function(index,v) {
                    title += title1 + v.id + title2 + v.title + title3;
                });
                $('.nav').html(title);
            },
            error: function () {
                console.log('出错啦');
            }
        })
    }
    function show(id){
        var key = $('#select').val();
        $.ajax({
            url: "<?php echo url('select1'); ?>",
            type:"post",
            data:{'key':key,'id':id},
            dataType:"json",
            success:function (res) {
                console.log(res.content);
                $('#content').html(res.content);
            },
            error: function () {
                console.log('出错啦');
            }
        })
    }

</script>

</html>
