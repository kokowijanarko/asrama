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
								Kamar Hunian
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('room/input')?>" enctype="multipart/form-data">
									<input type="hidden" name="room_id" value="<?php echo $detail->room_id?>"/>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Nomor Kamar</label>
										<div class="col-sm-9">
											<input type="text" required class="col-xs-10 col-sm-4" placeholder="Nomor Kamar" required name="room_code" value="<?php echo $detail->room_code?>"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Tipe Kamar</label>
										<div class="col-sm-9">
											<select class="col-xs-10 col-sm-4" name="room_type_id">
												<option value="" >---Pilih---</option>
												<?php
													foreach($type as $idx=>$val){
														$cek = '';
														if($val->type_id == $detail->type_id){
															$cek = 'selected="selected"';
														}
														
														echo '
															<option value="'. $val->type_id .'" '. $cek .'>'. $val->type_name .'</option>
														';
													}
													
												?>
											</select>											
										
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Gedung</label>
										<div class="col-sm-9">
											<select class="col-xs-10 col-sm-4" name="room_building" id="room_building">
												<option value="" >---Pilih---</option>
												<?php
													foreach($building as $idx=>$val){
														$cek = '';
														if($val['id'] == $detail->room_building){
															$cek = 'selected="selected"';
														}
														
														echo '
															<option value="'. $val['id'] .'" '. $cek .'>'. $val['name'] .'</option>
														';
													}
													
												?>
											</select>
										</div>
									</div>								
									
									<div id = "room-floor-id" class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Lantai</label>
										<div class="col-sm-9">
											<select class="col-xs-10 col-sm-4" name="room_floor_id" id="room_floor_id">
												<option value="" >---Pilih---</option>
												<?php
													foreach($floor as $idx=>$val){
														$cek = '';
														if($val->floor_id == $detail->floor_id){
															$cek = 'selected="selected"';
														}
														
														echo '
															<option value="'. $val->floor_id .'" '. $cek .'>'. $val->floor_name .'</option>
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
													if($detail->room_availibility == 1){
														$cek = 'checked="checked"';
													}
												?>
												<input name="room_availibility" class="ace ace-switch ace-switch-6" type="checkbox" <?php echo $cek?> />
												<span class="lbl"></span>
											</label>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Deskripsi</label>
										<div class="col-sm-9">
											<textarea class="col-xs-10 col-sm-4" placeholder="Deskripsi" name="room_desc"> <?php echo $detail->room_desc?> </textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left">Photo</label>
										<div class="col-sm-9">
											<input type="file" multiple name="photo[]" class="col-xs-10 col-sm-4"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-left"></label>
										<div class="col-sm-9">
											<?php
												foreach($detail->photo as $idx=>$val){
													
													echo '<img style="border:2px solid white" width="150" src="' . base_url($val->photo_name) . '"/>';
													
												}											
											
											?>										
										
											
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
				
				/*$('#room_building_id').change(function(){
					$('#room-floor-id').removeClass('hide');
				})
				
				
				$('#room_floor_id').change(function(){
					var building = $('#room_building_id option:selected').val();
					var floor = $('#room_floor_id option:selected').val();
					
					var url='<?php echo site_url('room/codeGenerator/')?>'+floor+'/'+building;
					console.log(url);
					
					$.ajax({						
						url:'<?php echo site_url('room/codeGenerator/')?>'+floor+'/'+building
					}).success(function(result){
						$('input name:room_code').empty();
						result = JSON.parse(result);
						console.log(result);
						$('input name:room_code').val(result['code']);	
					})				
				})*/
					
			})
		</script>
	</body>
</html>
