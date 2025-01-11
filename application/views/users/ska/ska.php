<?php
$cek    = $user->row();
$id_user = $cek->id_user;
$nama    = $cek->pegawai_nama;
$level   = $cek->pegawai_level;
$username  = $cek->pegawai_nip;
?>
<div class="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between mb-4">
                    <div>
                        <h3 class="card-title mb-0 font-weight-bold">Data Surat Keluar</h3>
                        <div class="small text-muted"><?php echo $md->nm_lembaga; ?></div>
                        <?php if ($level == 'staf') { ?>
                            <span class="badge badge-success fw-bold"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $jabatan->bagian_nama; ?></span>
                        <?php } ?>
                    </div>
                    <div class="btn-toolbar">
                        <?php
                        if ($level == 'staf' or $level == 'petugas' or $level == 'admin') { ?>
                            <a href="<?php echo base_url(); ?>users/ska/t">
                                <button class="btn btn-xs btn-success m-1 fw-bold"><i class="fas fa-plus-circle"></i><span class="d-none d-md-block">Tambah</span>
                                </button>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-12">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
                <div class="table-responsive pb-4">
                    <table id="basic-datatables" class="table table-striped table-bordered table-hover" cellspacing="0" style="width: 100%;">
                        <thead class="bg-info">
                            <tr class="text-white">
                                <th>No.</th>
                                <th>Status</th>
                                <th>Tgl. Surat</th>
                                <?php if ($level != 'staf') { ?>
                                    <th>Jabatan</th>
                                <?php } ?>
                                <th>No. Surat</th>
                                <th>Perihal</th>
                                <th>Kepada</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($ska->result() as $baris) {
                            ?>
                                <tr>
                                    <td class="text-center fw-bold"></td>
                                    <td class="fw-bold">
                                        <?php
                                        if ($baris->ska_dibaca == 4) { ?>
                                            <span class="badge badge-success fw-bold"><i class="fas fa-check-circle"></i>&nbsp; Terbit</span>
                                        <?php } elseif ($baris->ska_dibaca == 3) { ?>
                                            <span class="badge badge-secondary fw-bold"><i class="fas fa-tag"></i>&nbsp; Kepala</span>
                                        <?php } elseif ($baris->ska_dibaca == 2) { ?>
                                            <span class="badge badge-primary fw-bold"><i class="fas fa-bell"></i>&nbsp; KTU</span>
                                        <?php } elseif ($baris->ska_dibaca == 1) { ?>
                                            <span class="badge badge-warning fw-bold"><i class="fas fa-spinner"></i>&nbsp; Kasi</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger fw-bold"><i class="fas fa-exclamation-triangle"></i>&nbsp; Revisi</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo date('d/m/Y', strtotime($baris->ska_tanggal)); ?></td>
                                    <?php if ($level != 'staf') { ?>
                                        <td><?php echo $baris->bagian_nama ?></td>
                                    <?php } ?>
                                    <td><?php
                                        if ($baris->ska_no_urut != null) {
                                            echo "<i class='fas fa-check-circle text-success'></i>&nbsp; Terbit";
                                        } else {
                                            echo "<i class='fas fa-times-circle text-danger'></i>&nbsp; Belum";
                                        } ?>
                                    </td>
                                    <td><?php echo $baris->ska_hal; ?></td>
                                    <td><?php echo implode(', ', explode(';', $baris->ska_kpd)); ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($level == 'petugas' or $level == 'admin' or $level == 'kepala' or $level == 'ktu' or $level == 'kasi') { ?>
                                            <a href="<?php echo base_url(); ?>users/ska/d/<?php echo $baris->id_ska; ?>" class="btn btn-info btn-xs mt-1 mb-1 fw-bold" title="Validasi Surat"><i class="fas fa-clipboard-list"></i></a>
                                            <?php if ($level == 'admin') { ?>
                                                <a href="<?php echo base_url(); ?>users/ska/e/<?php echo $baris->id_ska; ?>" class="btn btn-warning btn-xs mt-1 mb-1" title="Edit" href=""><i class="fas fa-edit"></i></a>
                                                <a href="<?php echo base_url(); ?>users/ska/h/<?php echo $baris->id_ska; ?>" class="btn btn-xs btn-danger mt-1 mb-1" onclick="return confirm('Apakah Anda yakin?')" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                                            <?php } elseif ($level == 'petugas') { ?>
                                                <a href="<?php echo base_url(); ?>users/ska/e/<?php echo $baris->id_ska; ?>" class="btn btn-warning btn-xs mt-1 mb-1" title="Edit" href=""><i class="fas fa-edit"></i></a>
                                            <?php } ?>
                                        <?php } elseif ($level == 'staf') { ?>
                                            <a href="<?php echo base_url(); ?>users/ska/d/<?php echo $baris->id_ska; ?>" class="btn btn-info btn-xs mt-1 mb-1" title="Periksa Ajuan"><i class="fas fa-clipboard-list"></i></a>
                                            <?php if ($baris->ska_dibaca == 4) { ?>
                                                <a href="<?php echo base_url(); ?>users/ska/cetak/<?php echo $baris->id_ska; ?>" class="btn btn-secondary btn-xs mt-2 mb-2 fw-bold" title="Cetak Surat" target="_blank"><i class="fas fa-print"></i></a>
                                            <?php } elseif ($baris->ska_dibaca == 0 or $baris->ska_dibaca == 1) { ?>
                                                <a href="<?php echo base_url(); ?>users/ska/e/<?php echo $baris->id_ska; ?>" class="btn btn-warning btn-xs mt-1 mb-1" title="Edit" href=""><i class="fas fa-edit"></i></a>
                                                <a href="<?php echo base_url(); ?>users/ska/h/<?php echo $baris->id_ska; ?>" class="btn btn-xs btn-danger mt-1 mb-1" onclick="return confirm('Apakah Anda yakin?')" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
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

<script>
    const isSuratKeluar = true
</script>