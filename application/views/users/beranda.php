<?php
$cek      = $user->row();
$id_user  = $cek->id_user;
$nama     = $cek->pegawai_nama;
$level    = $cek->pegawai_level;
$username = $cek->pegawai_nip;
$bagian = $cek->bagian_id;
$tgl = date('m-Y');
?>
<div class="page-inner">
  <div class="row">
    <?php if ($user->row()->pegawai_level == 'ktu') { ?>
      <div class="col-sm-12 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-bell"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category fw-bold">Konfirmasi Surat</p>
                  <h4 class="card-title fw-bold">
                    <?php echo number_format($this->db->query("SELECT * FROM tbl_sm where sm_dibaca='1'")->num_rows(), 0, ",", ".") + number_format($this->db->query("SELECT * FROM tbl_ska where ska_dibaca='1'")->num_rows(), 0, ",", "."); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-warning bubble-shadow-small">
                  <i class="fas fa-spinner"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category fw-bold">Menunggu</p>
                  <h4 class="card-title fw-bold"><?php echo number_format($this->db->query("SELECT * FROM tbl_sm where sm_bagian='$bagian'")->num_rows(), 0, ",", ".") + number_format($this->db->query("SELECT * FROM tbl_ska where ska_dibaca='2'")->num_rows(), 0, ",", "."); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-danger bubble-shadow-small">
                  <i class="fas fa-exclamation-triangle"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category fw-bold">Revisi</p>
                  <h4 class="card-title fw-bold"><?php echo number_format($this->db->query("SELECT * FROM tbl_sm where sm_dibaca='0'")->num_rows(), 0, ",", ".") + number_format($this->db->query("SELECT * FROM tbl_ska where ska_dibaca='0'")->num_rows(), 0, ",", "."); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-bookmark"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category fw-bold">Disposisi</p>
                  <h4 class="card-title fw-bold"><?php echo number_format($this->db->query("SELECT * FROM tbl_sm where sm_dibaca='3'")->num_rows(), 0, ",", "."); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } elseif ($user->row()->pegawai_level == 'kepala') { ?>
      <div class="col-sm-12 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-bell"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category fw-bold">Konfirmasi Surat</p>
                  <h4 class="card-title fw-bold"><?php echo number_format($this->db->query("SELECT * FROM tbl_sm where sm_dibaca='2'")->num_rows(), 0, ",", ".") + number_format($this->db->query("SELECT * FROM tbl_ska where ska_dibaca='2'")->num_rows(), 0, ",", "."); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fab fa-telegram"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category fw-bold">Terdisposisi</p>
                  <h4 class="card-title fw-bold"><?php echo number_format($this->db->query("SELECT * FROM tbl_sm where sm_dibaca='4'")->num_rows(), 0, ",", ".") + number_format($this->db->query("SELECT * FROM tbl_ska where ska_dibaca='3'")->num_rows(), 0, ",", "."); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-warning bubble-shadow-small">
                  <i class="fas fa-spinner"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category fw-bold">Menunggu</p>
                  <h4 class="card-title fw-bold"><?php echo number_format($this->db->query("SELECT * FROM tbl_sm where sm_dibaca='3'")->num_rows(), 0, ",", "."); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } elseif ($user->row()->pegawai_level == 'admin' or $user->row()->pegawai_level == 'petugas') { ?>
      <div class="col-sm-12 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-folder"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category fw-bold">Surat Masuk</p>
                  <h4 class="card-title fw-bold"><?php echo number_format($this->db->query("SELECT * FROM tbl_sm")->num_rows(), 0, ",", ".");
                                                  ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-danger bubble-shadow-small">
                  <i class="fa fa-archive"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category fw-bold">Surat Keluar</p>
                  <h4 class="card-title fw-bold"><?php echo number_format($this->db->query("SELECT * FROM tbl_ska")->num_rows(), 0, ",", ".");
                                                  ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-warning bubble-shadow-small">
                  <i class="fas fa-user-graduate"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category fw-bold">Pegawai</p>
                  <h4 class="card-title fw-bold"><?php echo number_format($this->db->query("SELECT pegawai_level FROM tbl_users WHERE pegawai_level !='admin'")->num_rows(), 0, ",", ".");
                                                  ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="alert alert-info mb-4">
    <span class="fw-bold h3">Dashboard</span><br>
    <?php if ($level != 'admin') { ?>
      <small> Selamat Datang <b class="text-warning"> <?php echo ucwords($nama); ?></b> di Sistem Informasi Administrasi Surat! Anda login sebagai <span class="badge badge-success fw-bold"><i class="fas fa-id-badge"></i>&nbsp; <?php echo ucwords($level) . ' ' . $jabatan->bagian_nama; ?></span></small>
    <?php } else { ?>
      <small> Selamat Datang <b class="text-warning"> <?php echo ucwords($nama); ?></b> di Sistem Informasi Administrasi Surat! Anda login sebagai <span class="badge badge-success fw-bold"><i class="fas fa-id-badge"></i>&nbsp; <?php echo ucwords($level); ?></span></small>
    <?php } ?>
  </div>
  <?php echo $this->session->flashdata('msg'); ?>
</div>