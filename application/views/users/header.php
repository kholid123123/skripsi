<?php
$cek    = $user->row();
$nama   = $cek->pegawai_nama;
$email  = $cek->pegawai_email;
$level  = $cek->pegawai_level;
$nip  	= $cek->pegawai_nip;
if ($level == "admin") {
	$level = "admin";
}
$menu 		= strtolower($this->uri->segment(1));
$sub_menu 	= strtolower($this->uri->segment(2));
$sub_menu3 	= strtolower($this->uri->segment(3));
?>
<!DOCTYPE html>
<html lang="en">
<style>
        .main-header .logo-header[data-background-color="blue"] {
            background: linear-gradient(to right, red, black);
        }

        .navbar-header.navbar-expand-lg[data-background-color="blue3"] {
            background: linear-gradient(to right, red, black);
        }
    </style>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php echo $judul_web; ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="description" content="SIAS | Sistem Informasi Administrasi Surat">
	<meta name="author" content="SIAS">
	<meta name="keyword" content="SIAS">
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>foto/logo.png">
	<script>
		var base_url_js = '<?php echo base_url(); ?>';
	</script>

	<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.js"></script>
	<!-- Fonts dan Icons -->
	<script src="<?php echo base_url(); ?>assets/js/plugin/webfont/webfont.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/plugin/webfont/font.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Muli:400,300" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/atlantis.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/rowReorder.dataTables.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/responsive.dataTables.min.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" style="background: red;">
				<a href="" class="logo">
					<b class="text-white"><i class="" aria-hidden="true"></i>E-surat</b>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->
			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue3">
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<span class="d-flex align-items-center">
							<span class="text-white fw-bold">Assalamualaikum, <?php echo ucwords($nama); ?>!</span>
						</span>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<span class="d-flex align-items-center">
									<div class="avatar-sm">
										<img src="<?php echo base_url(); ?>/foto/<?php echo $md->foto; ?>" class="avatar-img rounded-circle">
									</div>
									<span class="text-white fw-bold"><?php echo ucwords($nama); ?></span>
								</span>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg">
												<img src="<?php echo base_url(); ?>/foto/<?php echo $md->foto; ?>" class="avatar-img rounded">
											</div>
											<div class="u-text mt-2">
												<h4><?php echo $this->session->userdata('pegawai_level'); ?></h4>
												<p class="text-muted"><?php echo ucwords($nama); ?></p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="" data-toggle="modal" data-target="#editPegawai"><i class="fas fa-user-alt"></i>&nbsp; Profil</a>
										<a class="dropdown-item" href="" data-toggle="modal" data-target="#resetPassword"><i class=" fas fa-lock"></i>&nbsp; Ubah password</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?php echo base_url(); ?>web/logout" id="alert-logout-header"><i class="fas fa-sign-out-alt text-danger"></i>&nbsp; Keluar</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Main sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm avatar avatar-online float-left mr-2">
							<img src="<?php echo base_url(); ?>/foto/<?php echo $md->foto; ?>" class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<small class="fw-bold"><?php echo ucwords($nip); ?></small>
									<span class="user-level text-secondary">
										<?php echo ucwords($level); ?>
									</span>
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav nav-warning">
						<!-- Main -->
						<li class="nav-item active">
							<a href="<?php echo base_url() ?>" class="collapsed">
								<i class="fas fa-home text-info"></i>
								<p>Beranda</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Menu Utama</h4>
						</li>
						<?php if ($level == 'admin' or $level == 'petugas') { ?>
							<li class="nav-item">
								<a data-toggle="collapse" href="#lembaga">
									<i class="fa fa-building text-success"></i>
									<p class="fw-bold">Pengaturan</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?php if ($sub_menu == "pengguna" or $sub_menu == "bagian" or $sub_menu == "md") {
															echo 'show';
														} ?>" id="lembaga">
									<ul class="nav nav-collapse pt-0">
										<li><a href="<?php echo base_url(); ?>users/pengguna"><span class="sub-item">Pegawai</span></a></li>
										<li><a href="<?php echo base_url(); ?>users/bagian"><span class="sub-item">Jabatan</span></a></li>
										<li><a href="<?php echo base_url(); ?>users/md"><span class="sub-item">Sekolah</span></a></li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
								<a data-toggle="collapse" href="#siswa">
									<i class="fab fa-telegram text-warning"></i>
									<p class="fw-bold">Persuratan</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?php if ($sub_menu == "ska" or $sub_menu == "sm") {
															echo "show";
														}; ?>" id="siswa">
									<ul class="nav nav-collapse pt-0">
										<li><a href="<?php echo base_url(); ?>users/sm"><span class="sub-item">Surat Masuk</span></a></li>
										<li><a href="<?php echo base_url(); ?>users/ska"><span class="sub-item">Surat Keluar</span></a></li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
								<a data-toggle="collapse" href="#laporan">
									<i class="fas fa-file-signature text-primary"></i>
									<p class="fw-bold">Laporan</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?php if ($sub_menu == "lap_sk" or $sub_menu == "lap_sm") {
															echo "show";
														}; ?>" id="laporan">
									<ul class="nav nav-collapse pt-0">
										<li><a href="<?php echo base_url(); ?>users/lap_sm"><span class="sub-item">Data</span></a></li>
									</ul>
								</div>
							</li>
						<?php }
						if ($level == 'ktu') { ?>
							<li class="nav-item">
								<a data-toggle="collapse" href="#disposisi">
									<i class="fas fa-bookmark text-success"></i>
									<p class="fw-bold">Disposisi</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?php if ($sub_menu == "disposisi") {
															echo "show";
														}; ?>" id="disposisi">
									<ul class="nav nav-collapse pt-0">
										<li><a href="<?php echo base_url(); ?>users/disposisi"><span class="sub-item">Data</span></a></li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
								<a data-toggle="collapse" href="#ktu">
									<i class="fab fa-telegram text-primary"></i>
									<p class="fw-bold">Persuratan</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?php if (($sub_menu == "ktu" and $sub_menu3 == "") or $sub_menu == "ska" or $sub_menu == "control") {
															echo "show";
														}; ?>" id="ktu">
									<ul class="nav nav-collapse pt-0">
										<li><a href="<?php echo base_url(); ?>users/ktu"><span class="sub-item">Surat Masuk</span></a></li>
										<li><a href="<?php echo base_url(); ?>users/ska"><span class="sub-item">Surat Keluar</span></a></li>
									</ul>
								</div>
							</li>
						<?php }
						if ($level == 'kepala') { ?>
							<li class="nav-item">
								<a data-toggle="collapse" href="#kdis">
									<i class="fas fa-bookmark text-success"></i>
									<p class="fw-bold">Disposisi</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?php if ($sub_menu == "kdis") {
															echo "show";
														}; ?>" id="kdis">
									<ul class="nav nav-collapse pt-0">
										<li><a href="<?php echo base_url(); ?>users/kdis"><span class="sub-item">Data</span></a></li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
								<a data-toggle="collapse" href="#kepala">
									<i class="fab fa-telegram text-primary"></i>
									<p class="fw-bold">Persuratan</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?php if ($sub_menu == "kepala" or $sub_menu == "ska" or $sub_menu == "control") {
															echo "show";
														}; ?>" id="kepala">
									<ul class="nav nav-collapse pt-0">
										<li><a href="<?php echo base_url(); ?>users/kepala"><span class="sub-item">Surat Masuk</span></a></li>
										<li><a href="<?php echo base_url(); ?>users/ska"><span class="sub-item">Surat Keluar</span></a></li>
									</ul>
								</div>
							</li>
						<?php }
						if ($level == 'kasi') { ?>
							<li class="nav-item">
								<a data-toggle="collapse" href="#kasi">
									<i class="fab fa-telegram text-primary"></i>
									<p class="fw-bold">Persuratan</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?php if ($sub_menu == "kasi" or $sub_menu == "ska") {
															echo "show";
														}; ?>" id="kasi">
									<ul class="nav nav-collapse pt-0">
										<li><a href="<?php echo base_url(); ?>users/kasi"><span class="sub-item">Surat Masuk</span></a></li>
										<li><a href="<?php echo base_url(); ?>users/ska"><span class="sub-item">Surat Keluar</span></a></li>
									</ul>
								</div>
							</li>
						<?php }
						if ($level == 'staf') { ?>
							<li class="nav-item">
								<a data-toggle="collapse" href="#staf">
									<i class="fab fa-telegram text-primary"></i>
									<p class="fw-bold">Persuratan</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?php if ($sub_menu == "staf" or $sub_menu == "ska") {
															echo "show";
														}; ?>" id="staf">
									<ul class="nav nav-collapse pt-0">
										<li><a href="<?php echo base_url(); ?>users/staf"><span class="sub-item">Surat Masuk</span></a></li>
										<li><a href="<?php echo base_url(); ?>users/ska"><span class="sub-item">Surat Keluar</span></a></li>
									</ul>
								</div>
							</li>
						<?php }
						if ($level == 'jfu') { ?>
							<li class="nav-item">
								<a data-toggle="collapse" href="#jfu">
									<i class="fab fa-telegram text-primary"></i>
									<p class="fw-bold">Disposisi</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?php if ($sub_menu == "jfu") {
															echo "show";
														}; ?>" id="jfu">
									<ul class="nav nav-collapse pt-0">
										<li><a href="<?php echo base_url(); ?>users/jfu"><span class="sub-item">Data</span></a></li>
									</ul>
								</div>
							</li>
						<?php } ?>
						<!-- /main -->
						<!-- Logout -->
						<li class="nav-section"><span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
							<h4 class="text-section">User</h4>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url(); ?>web/logout" class="collapsed" id="alert-logout-sidebar"><i class="fas fa-power-off text-danger"></i>
								<p class="fw-bold">Keluar</p>
							</a>
						</li>
						<!-- /logout -->
					</ul>
				</div>
			</div>
		</div>
		<style>
    .sidebar-style-2 {
        background-color:#dcdcdc; /* Ganti dengan warna yang Anda inginkan */
    }
</style>

		<!-- /main sidebar -->
		<div class="main-panel">
			<div class="content">