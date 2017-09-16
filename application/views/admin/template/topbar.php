<div id="navbar" class="navbar navbar-default">
	<script type="text/javascript">
		try{ace.settings.check('navbar' , 'fixed')}catch(e){}
	</script>

	<div class="navbar-container" id="navbar-container">
		<div class="navbar-header pull-left">
			<a href="index.html" class="navbar-brand">
				<small>
					<i class="fa fa-leaf"></i>
					Ace Admin
				</small>
			</a>
		</div>

		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
				<li class="light-blue">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<?php
							if(empty($this->session->userdata('photo'))){
								$photo = base_url('assets/admin/images/user/default.jpg');
							}else{
								$photo = base_url($this->session->userdata('photo'));
							}
						?>
						<img class="nav-user-photo" src="<?php echo $photo ?>" alt="Jason's Photo" />
						<span class="user-info">
							<small>Welcome,</small>
							<?php echo $this->session->userdata('user_name')?>
						</span>

						<i class="ace-icon fa fa-caret-down"></i>
					</a>

					<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="<?php echo site_url('user/profile')?>">
								<i class="ace-icon fa fa-user"></i>
								Profile
							</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="<?php echo site_url('login/logout')?>">
								<i class="ace-icon fa fa-power-off"></i>
								Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div><!-- /.navbar-container -->
</div>