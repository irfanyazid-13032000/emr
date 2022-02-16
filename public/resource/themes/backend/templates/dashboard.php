<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Dashboard</h3>
    </div>

    <div class="box-body">
		<div class="text-center"><h4>SELAMAT DATANG DI ADMINISTRASI WEBSITE <?php echo strtoupper($config->site_title); ?></h4></div>
		<hr class="solid" />
		<div class="row">

			<div class="col-md-2">
				<a href="<?php echo site_url('content/admin/page'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-green">
							<i class="fa fa-clone fa-5x"></i><br>
							Halaman
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="<?php echo site_url('content/admin/blog'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-blue">
							<i class="fa fa-newspaper-o fa-5x"></i><br>
							Artikel
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="<?php echo site_url('content/admin/layanan'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-red">
							<i class="fa fa-book fa-5x"></i><br>
							Layanan
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="<?php echo site_url('dokter/admin/master_dokter'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-yellow">
							<i class="fa fa-users fa-5x"></i><br>
							Dokter
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="<?php echo site_url('dokter/admin/master_dokter/jadwal'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-aqua">
							<i class="fa fa-calendar fa-5x"></i><br>
							Jadwal Dokter
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="<?php echo site_url('settings/admin/menu'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-red">
							<i class="fa fa-list fa-5x"></i><br>
							Menu Manager
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="<?php echo site_url('media/admin/slideshow'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-muted">
							<i class="fa fa-image fa-5x"></i><br>
							Slideshow
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="<?php echo site_url('media/admin/banner'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-light-blue">
							<i class="fa fa-sticky-note fa-5x"></i><br>
							Banner
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="<?php echo site_url('media/admin/award'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-yellow">
							<i class="fa fa-star-o fa-5x"></i><br>
							Award
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="<?php echo site_url('media/admin/sertifikasi'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-green">
							<i class="fa fa-bookmark-o fa-5x"></i><br>
							Sertifikasi
						</div>
					</div>
				</a>
			</div>
		</div>

		<hr class="solid" />
		<div class="row">
			<!-- <div class="col-md-2">
				<a href="<?php echo site_url('content/admin/page'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-green">
							<i class="fa fa-user fa-5x"></i><br>
							User Manager
						</div>
					</div>
				</a>
			</div> -->
			<div class="col-md-2">
				<a href="<?php echo site_url('settings/admin/general_settings'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-muted">
							<i class="fa fa-cog fa-5x"></i><br>
							Konfigurasi
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-2">
				<a href="<?php echo site_url('settings/admin/general_settings/change_password'); ?>">
					<div class="thumbnail text-center">
						<div class="caption text-yellow">
							<i class="fa fa-lock fa-5x"></i><br>
							Ubah Password
						</div>
					</div>
				</a>
			</div>
		</div>
    </div>
</div>