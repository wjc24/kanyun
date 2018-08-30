<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\work\kanyun\public/../application/index\view\index\index.html";i:1535622707;}*/ ?>
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
</style>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top" style="height: 5%">
			<span style="font-size: 2rem;display:inline-block; margin: .5% 0 0 1%">电商小程序使用教程</span>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<div class="container-fluid" style="margin: -20% 0 0 -12%">
					<form class="navbar-form navbar-left">
						<div class="input-group">
							<input type="text" value="" class="form-control" placeholder="请输入搜索关键词...">
							<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
						</div>
					</form>
				</div>
				<nav>
					<ul class="nav">
						<?php if(is_array($data_one) || $data_one instanceof \think\Collection || $data_one instanceof \think\Paginator): $i = 0; $__LIST__ = $data_one;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data_one): $mod = ($i % 2 );++$i;?>
						<li>
							<a href="#<?php echo $data_one['id']; ?>" data-toggle="collapse" class="collapsed" onclick="show('<?php echo $data_one['id']; ?>')"><span><?php echo $data_one['title']; ?></span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="<?php echo $data_one['id']; ?>" class="collapse ">
							<?php if(is_array($data_one['two']) || $data_one['two'] instanceof \think\Collection || $data_one['two'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data_one['two'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data_two): $mod = ($i % 2 );++$i;if($data_one['id'] == $data_two['pid']): ?>
									<ul class="nav">
										<li>
											<a href="#<?php echo $data_two['id']; ?>" data-toggle="collapse" class="collapsed" onclick="show('<?php echo $data_two['id']; ?>')"><span><?php echo $data_two['title']; ?></span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
											<div id="<?php echo $data_two['id']; ?>" class="collapse ">
												<?php if(is_array($data_one['three']) || $data_one['three'] instanceof \think\Collection || $data_one['three'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data_one['three'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data_three): $mod = ($i % 2 );++$i;if($data_two['id'] == $data_three['pid']): ?>
												<ul class="nav">
													<li>
														<a href="javascript:void(0);" class="collapsed" ><span style="margin-left:20%;" onclick="show('<?php echo $data_three['id']; ?>')"><?php echo $data_three['title']; ?></span></a>
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
				</nav>
			</div>
		</div>
		<div class="main">
			<div  id="content">
				<?php echo $data_one['content']; ?>
			</div>

		</div>
	</div>

	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
<script>
	function show(id) {
		$.ajax({
			url: "<?php echo url('content'); ?>",
			type: "post",
			data: {'id':id},
			dataType: "json",
			success:function (res) {
				$('#content').html(res);
            },
			error:function () {
				console.log('出错啦');
            }
		})
    }
</script>

</html>
