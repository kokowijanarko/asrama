<div id="sidebar" class="sidebar                  responsive">
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	</script>

	<ul class="nav nav-list">
		<li class="">
			<a href="<?php echo site_url('home')?>">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Dashboard </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-building"></i>
				<span class="menu-text">Kamar</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="">
					<a href="<?php echo site_url('user/show')?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Daftar Kamar
					</a>

					<b class="arrow"></b>

				</li>				
			</ul>
		</li>
		
		<li class="">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-users"></i>
				<span class="menu-text">Penghuni</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="">
					<a href="<?php echo site_url('resident/show')?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Daftar Penghuni
					</a>

					<b class="arrow"></b>

				</li>
				
				<li class="">
					<a href="<?php echo site_url('resident/form')?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Tambah Calon Penghuni
					</a>

					<b class="arrow"></b>

				</li>				
			</ul>
		</li>
		
		
		<li class="">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-user-circle"></i>
				<span class="menu-text">User</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

			<ul class="submenu">
				<li class="">
					<a href="<?php echo site_url('user/show')?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Daftar User
					</a>
					
					<b class="arrow"></b>

				</li>	
				
				<li class="">
					<a href="<?php echo site_url('user/form')?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Tambah User
					</a>
					
					<b class="arrow"></b>

				</li>				
			</ul>
		</li>
		

	</ul><!-- /.nav-show -->

	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>

	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	</script>
</div>
