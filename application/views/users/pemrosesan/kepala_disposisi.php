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
                        <h3 class="card-title mb-0 font-weight-bold">Disposisi Surat Masuk</h3>
                        <div class="small text-muted">
                            <?php echo $md->nm_lembaga; ?>
                        </div>
                        <span class="badge badge-success fw-bold"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $jabatan->bagian_nama; ?></span>
                    </div>
                    <div class="btn-toolbar">

                    </div>
                </div>
                <div class="table-responsive pb-4" style="overflow-x:auto;">
                    <table id="basic-datatables" class="table table-striped table-bordered table-hover" cellspacing="0" style="width: 100%;">
                        <thead class="bg-warning">
                            <tr class="text-white">
                                <th>No.</th>
                                <th>Status</th>
                                <th>Diterima Tgl.</th>
                                <th>Instansi</th>
                                <th>Perihal</th>
                                <th>Penerima Tgs.</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kdis->result() as $baris) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no . '.'; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($baris->sm_dibaca == 4) { ?>
                                            <span class="badge badge-success fw-bold"><i class="fas fa-check-circle"></i>&nbsp; Terdisposisi</span>
                                        <?php } elseif ($baris->sm_dibaca == 3) { ?>
                                            <span class="badge badge-warning fw-bold"><i class="fas fa-bell"></i>&nbsp; Menunggu</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger fw-bold"><i class="fas fa-exclamation-triangle"></i>&nbsp; Proses</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo format_indo($baris->sm_tgl_diterima); ?></td>
                                    <td><?php echo $baris->sm_pengirim; ?></td>
                                    <td><?php echo $baris->sm_perihal; ?></td>
                                    <td>
                                        <?php
                                        $data = explode(';', $baris->sm_disposisi);
                                        foreach ($data as $b) {
                                            foreach ($level_users->result() as $a) {
                                                if ($b == $a->id_user) {
                                                    echo $a->pegawai_nama . "<br>";
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($baris->sm_dibaca == 4) { ?>
                                            <a href="<?php echo base_url(); ?>users/kdis/detail/<?php echo $baris->id_sm; ?>" class="btn btn-success btn-xs mt-1 mb-1 fw-bold" title="Detail"><i class="fas fa-eye"></i></a>
                                        <?php } elseif ($baris->sm_dibaca == 3) { ?>
                                            <a href="<?php echo base_url(); ?>users/kdis/detail/<?php echo $baris->id_sm; ?>" class="btn btn-info btn-sm mt-1 mb-1 fw-bold"><i class="fab fa-telegram-plane"></i> Periksa</a>
                                        <?php } else { ?>
                                            <span class="badge badge-danger fw-bold"><i class="fas fa-exclamation-triangle"></i>&nbsp; Proses</span>
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