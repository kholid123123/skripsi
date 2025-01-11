<?php
$cek    = $user->row();
$id_user = $cek->id_user;
$nama    = $cek->pegawai_nama;
$level   = $cek->pegawai_level;
$username   = $cek->pegawai_nip;
?>
<div class="page-inner">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between mb-4">
          <div>
            <h3 class="card-title mb-0 font-weight-bold">Laporan Surat Masuk</h3>
            <div class="small text-muted"><?php echo $md->nm_lembaga; ?></div>
          </div>
          <div class="btn-toolbar">
            <?php
            if ($level == 'admin' or $level == 'petugas') { ?>
              <form action="" method="post" target="_blank">
                <button type="submit" name="cetakSM" class="btn btn-xs btn-primary m-1 fw-bold"><i class="fas fa-print"></i><span class="d-none d-md-block">Print Data</span></button>
              </form>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-12">
          <?php echo $this->session->flashdata('msg'); ?>
        </div>
        <div class="table-responsive pb-4">
          <table id="basic-datatables" class="table table-striped table-bordered table-hover" cellspacing="0" style="width: 100%;">
            <thead class="bg-warning">
              <tr class="text-white">
                <th>No</th>
                <th width="10%">Tgl. Diterima</th>
                <th width="10%">Tgl. Surat</th>
                <th width="20%">Pengirim</th>
                <th>Perihal</th>
                <th>Penerima Disposisi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($sql->result() as $baris) {
              ?>
                <tr>
                  <td class="text-center fw-bold"></td>
                  <td><?php echo $baris->sm_tgl_diterima; ?></td>
                  <td><?php echo $baris->sm_tgl_surat; ?></td>
                  <td><?php echo $baris->sm_pengirim; ?></td>
                  <td><?php echo $baris->sm_perihal; ?></td>
                  <td><?php echo $baris->bagian_nama; ?></td>
                </tr>
              <?php
                $no++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>