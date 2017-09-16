<?php $this->load->view('admin/template/header')?>
	</head>

	<body class="no-skin">
		<?php $this->load->view('admin/template/topbar')?>
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
			
			<?php $this->load->view('admin/template/sidebar')?>
			
			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
						<?php $this->load->view('admin/template/setting')?>
						<div class="page-header">
							<h1>
								Admin
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('user/input')?>" enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?php echo $detail->id?>"/>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Nama</label>
										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-4" placeholder="Nama" required name="name" value="<?php echo $detail->name?>"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Username</label>
										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-4" placeholder="Usernmae" required name="username" value="<?php echo $detail->username?>"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Deskripsi</label>
										<div class="col-sm-9">
											<textarea class="col-xs-10 col-sm-4" placeholder="Deskripsi" name="desc"> <?php echo $detail->desc?> </textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Photo</label>
										<div class="col-sm-9">
											<input type="file" name="photo" class="col-xs-10 col-sm-4" value="<?php echo $detail->photo?>"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left"></label>
										<div class="col-sm-9">
											<img width="200" src="<?php echo base_url($detail->photo)?>"/>
										</div>
									</div>
									
									<div class="clearfix">
										<label class="col-sm-3 control-label no-padding-left"></label>
										<div class="col-sm-9">
											<button type="submit" class="btn btn-sm btn-primary">
												<i class="ace-icon fa fa-upload"></i>
												<span class="bigger-110">Submit</span>
											</button>
										</div>
										
									</div>
									
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php $this->load->view('admin/template/footer')?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<?php $this->load->view('admin/template/js')?>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				
			})
		</script>
	</body>
</html>
