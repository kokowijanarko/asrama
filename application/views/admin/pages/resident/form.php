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
								Penghuni
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('user/input')?>" enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?php echo $detail->resident_id?>"/>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Nama</label>
										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-4" placeholder="Nama Penghuni" required name="resident_name" value="<?php echo $detail->resident_name?>"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Tipe Identitas</label>
										<div class="col-sm-9">
											<?php
												foreach($identity_type as $idx=>$val){
													
													$cek = '';
													if($val == $detail->resident_identity_type){
														$cek = 'checked="checked"';
													}
													
													echo '
														<div class="radio">
															<label>
																<input name="resident_identity_type" type="radio" class="ace" value="'. $val .'"'. $cek .'/>
																<span class="lbl"> '. strtoupper($val) .'</span>
															</label>
														</div>
													
													';
													
												}
											?>
										
											
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Nomor Identitas</label>
										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-4" placeholder="Nomor Identitas" required name="resident_identity_number" value="<?php echo $detail->resident_identity_number?>"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Alamat Sesuai Identitas</label>
										<div class="col-sm-9">
											<textarea class="col-xs-10 col-sm-4" placeholder="Nama Penghuni" required name="resident_origin_address"><?php echo $detail->resident_origin_address?></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Email</label>
										<div class="col-sm-9">
											<input type="email" class="col-xs-10 col-sm-4" placeholder="Email" required name="resident_email" value="<?php echo $detail->resident_email?>"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Nomor Kontak (telp/HP)</label>
										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-4" placeholder="Nomor Telp atau HP" required name="resident_contact" value="<?php echo $detail->resident_contact?>"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Tipe Penghuni</label>
										<div class="col-sm-9">
											<select class="col-xs-10 col-sm-4" name="resident_type">
												<option value="" >---Pilih---</option>
												<?php
													foreach($type as $idx=>$val){
														$cek = '';
														if($val['id'] == $detail->resident_type){
															$cek = 'checked="checked"';
														}
														
														echo '
															<option value="'. $val['id'] .'" '. $cek .'>'. $val['name'] .'</option>
														';
													}
												?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Status</label>
										<div class="col-sm-9">
											<label>
												<?php
													$cek = '';
													if($detail->resident_status == 1){
														$cek = 'checked="checked"';
													}
												?>
												<input name="resident_status" class="ace ace-switch ace-switch-6" type="checkbox" <?php echo $cek?> />
												<span class="lbl"></span>
											</label>
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
