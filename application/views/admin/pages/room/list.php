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
								Daftar Kamar Hunian
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
										<?php 
											isset($message)? print_r($message):null;											
										?>	
										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>No</th>
														<th>Kode Kamar</th>
														<th>Gedung</th>
														<th>Lantai</th>
														<th>Tipe</th>
														<th>Harga Lokal</th>
														<th>Harga Asing</th>
														<th>Status</th>
														<th>Photo</th>
														<th>Aksi</th>
													</tr>
												</thead>

												<tbody>
													<?php
														$no=1;
														foreach($list as $idx=>$val){
															echo '
																<tr>
																	<td>'. $no .'</td>
																	<td>'. $val->room_code .'</td>
																	<td>'. $val->room_building_text .'</td>
																	<td>'. $val->floor_name .'</td>
																	<td>'. $val->type_name .'</td>
																	<td>'. $val->floor_price .'</td>
																	<td>'. $val->floor_price_int .'</td>
																	<td>'. $val->room_availibility_text .'</td>
																	<td>
															';
															
															foreach($val->photo as $key=>$photo){
																echo '<img style="border:grey 2px solid" width="100px" src="' . base_url($photo->photo_name) . '"> &nbsp';		
															}															
															echo'
																	</td>
																	<td>
																		<div class="action-buttons">
																			<a class="green" href="'. site_url('room/form/'. $val->room_id).'">
																				<i class="ace-icon fa fa-pencil bigger-170"></i>
																			</a>

																			<a class="red" href="'. site_url('room/remove/'. $val->room_id).'">
																				<i class="ace-icon fa fa-trash-o bigger-170"></i>
																			</a>
																		</div>
																	</td>
																</tr>
															';
															$no++;
														}
													
													?>
												
												</tbody>
											</table>
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
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, 
					  null, 
					  null, 
					  null, 
					  null, 
					  null, 
					  null, 
					  { "bSortable": false },
					  { "bSortable": false }
					],
					"aaSorting": [],
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			    } );
				
			
			})
		</script>
	</body>
</html>
