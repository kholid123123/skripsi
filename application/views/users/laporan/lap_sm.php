<div class="page-inner">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between mb-4">
          <div>
            <h3 class="card-title mb-0 font-weight-bold">Filter Laporan Surat Masuk</h3>
            <div class="small text-muted"><?php echo $md->nm_lembaga; ?></div>
          </div>
          <div class="btn-toolbar">
            <?php
            if ($user->row()->pegawai_level == 'admin' or $user->row()->pegawai_level == 'petugas') { ?>
              <a href="<?php echo base_url(); ?>users/lap_ska">
                <button class="btn btn-sm btn-danger m-1 fw-bold"><i class="fab fa-telegram-plane"></i> Surat Keluar</button>
              </a>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-12">
          <?php echo $this->session->flashdata('msg'); ?>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="card-body mt--2">
            <div class="row">
              <!-- TANGGAL AWAL -->
              <div class="col-sm-6 text-left">
                <div class="form-group form-group-default">
                  <label class="text-info fw-bold"><i class="far fa-calendar-alt"></i> TANGGAL AWAL<small class="text-danger">*</small></label>
                  <input type="date" name="tgl1" class="form-control fw-bold" value="<?php echo date('Y-m-d'); ?>" maxlength="10" required>
                  <small class="text-muted text-danger fw-bold">*Masukkan tanggal awal filter data surat!</small>
                </div>
              </div>
              <!-- TANGGAL AKHIR -->
              <div class="col-sm-6 text-left">
                <div class="form-group form-group-default">
                  <label class="text-info fw-bold"><i class="far fa-calendar-check"></i> TANGGAL AKHIR<small class="text-danger">*</small></label>
                  <input type="date" name="tgl2" class="form-control fw-bold" value="<?php echo date('Y-m-d'); ?>" maxlength="10" required>
                  <small class="text-muted text-danger fw-bold">*Masukkan tanggal akhir filter data surat!</small>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button name="filterSM" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Filter</button>
            <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>