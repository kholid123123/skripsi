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
                        <thead class="bg-info">
                            <tr class="text-white">
                                <th>No.</th>
                                <th>Status</th>
                                <th>Diterima Tgl.</th>
                                <th>Instansi</th>
                                <th>Perihal</th>
                                <th>Penerima Tgs.</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($sql->result() as $baris) {
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
                                            <span class="badge badge-danger fw-bold"><i class="fas fa-exclamation-triangle"></i>&nbsp; Terdisposisi</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo format_indo($baris->sm_tgl_diterima); ?></td>
                                    <td><?php echo $baris->sm_pengirim; ?></td>
                                    <td><?php echo $baris->sm_perihal; ?></td>
                                    <td>
                                        <br>
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
                                        <br>
                                    </td>
                                    <td>
                                        <?php
                                        if ($baris->sm_dibaca == 4) { ?>
                                            <a href="" class="btn btn-primary btn-xs mt-1 mb-1 fw-bold" data-toggle="modal" data-target="#detailSM<?php echo $baris->id_sm; ?>" title="Detail"><i class="fas fa-eye"></i></a>

                                            <a href="<?php echo base_url(); ?>users/jfu/cetak/<?php echo encrypt_url($baris->id_sm); ?>" class="btn btn-xs btn-warning mt-1 mb-1" target="_blank" title="Cetak"><i class="fas  fa-print"></i></a>
                                            <!-- modal detail surat -->
                                            <div class="modal fade" id="detailSM<?php echo $baris->id_sm; ?>" tabindex="-1" role="dialog" aria-labelledby="detailSM<?php echo $baris->id_sm; ?>">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-bold"><i class="fas fa-paste"></i>&nbsp; DETAIL SURAT MASUK</h5>
                                                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="table-responsive" style="overflow-x: auto;">
                                                                        <table class="table table-striped table-hover text-left" cellspacing="0" style="width: 100%;">
                                                                            <thead class="bg-info table-bordered">
                                                                                <tr class="text-white">
                                                                                    <th colspan="2">No. Agenda (<?php echo $baris->sm_no_urut; ?>)</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="table-bordered">
                                                                                <tr class="fw-bold">
                                                                                    <td width="30%">Kode</td>
                                                                                    <td width="70%"><?php echo $baris->sm_penerima; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Sifat</td>
                                                                                    <td><span class="badge badge-primary fw-bold mt-1 mb-1"><i class="fas fa-bell"></i>&nbsp;<?php echo $baris->sm_sifat; ?></span></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Diterima</td>
                                                                                    <td><?php echo format_indo($baris->sm_tgl_diterima); ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="table-responsive" style="overflow-x: auto;">
                                                                        <table class="table table-striped table-hover text-left" cellspacing="0" style="width: 100%;">
                                                                            <thead class="bg-info table-bordered">
                                                                                <tr class="text-white">
                                                                                    <th colspan="2">Status Surat</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="table-bordered">
                                                                                <tr>
                                                                                    <td>Berkas</td>
                                                                                    <td><?php echo $baris->sm_status; ?></td>
                                                                                </tr>
                                                                                <tr class="fw-bold">
                                                                                    <td width="30%">Status</td>
                                                                                    <td width="70%">
                                                                                        <?php
                                                                                        if ($baris->sm_dibaca == 4) { ?>
                                                                                            <span class="badge badge-success fw-bold"><i class="fas fa-check-circle"></i>&nbsp; Terdisposisi</span>
                                                                                        <?php } elseif ($baris->sm_dibaca == 3) { ?>
                                                                                            <span class="badge badge-secondary fw-bold"><i class="fas fa-bell"></i>&nbsp; Verifikasi Kepala</span>
                                                                                        <?php } elseif ($baris->sm_dibaca == 2) { ?>
                                                                                            <span class="badge badge-primary fw-bold"><i class="fas fa-bell"></i>&nbsp; Verifikasi KTU</span>
                                                                                        <?php } elseif ($baris->sm_dibaca == 1) { ?>
                                                                                            <span class="badge badge-warning fw-bold"><i class="fas fa-spinner"></i>&nbsp; Menunggu KTU</span>
                                                                                        <?php } else { ?>
                                                                                            <span class="badge badge-danger fw-bold"><i class="fas fa-exclamation-triangle"></i>&nbsp; Revisi</span>
                                                                                        <?php } ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php
                                                                                if ($baris->sm_dibaca == 4) { ?>
                                                                                    <tr>
                                                                                        <td>Tanggal</td>
                                                                                        <td><?php echo format_indo($baris->sm_tgl_disposisi); ?></td>
                                                                                    </tr>
                                                                                <?php } elseif ($baris->sm_dibaca == 3) { ?>
                                                                                    <tr>
                                                                                        <td>Tanggal</td>
                                                                                        <td><?php echo format_indo($baris->sm_tgl_kepala); ?></td>
                                                                                    </tr>
                                                                                <?php } elseif ($baris->sm_dibaca == 2) { ?>
                                                                                    <tr>
                                                                                        <td>Tanggal</td>
                                                                                        <td><?php echo format_indo($baris->sm_tgl_ajuan); ?></td>
                                                                                    </tr>
                                                                                <?php } elseif ($baris->sm_dibaca == 1) { ?>
                                                                                    <tr>
                                                                                        <td>Tanggal</td>
                                                                                        <td><?php echo format_indo($baris->sm_create); ?></td>
                                                                                    </tr>
                                                                                <?php } else { ?>
                                                                                    <tr>
                                                                                        <td>Tanggal</td>
                                                                                        <td><?php echo format_indo($baris->sm_create); ?></td>
                                                                                    </tr>
                                                                                <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="table-responsive" style="overflow-x: auto;">
                                                                        <table class="table table-striped table-hover text-left" cellspacing="0" style="width: 100%;">
                                                                            <thead class="bg-warning table-bordered">
                                                                                <tr class="text-white">
                                                                                    <th colspan="2"><i class="far fa-file-alt"></i>&nbsp; DETAIL SURAT</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="table-bordered">
                                                                                <tr class="fw-bold">
                                                                                    <td width="30%">No. Surat</td>
                                                                                    <td width="70%"><?php echo $baris->sm_no_surat_asal; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Instansi</td>
                                                                                    <td><?php echo $baris->sm_pengirim; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Perihal</td>
                                                                                    <td class="p-4"><br /><?php echo $baris->sm_perihal; ?><br /><br /></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Tanggal Surat</td>
                                                                                    <td><?php echo format_indo($baris->sm_tgl_surat); ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Lampiran</td>
                                                                                    <td><?php echo $baris->sm_lampiran; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>File</td>
                                                                                    <td>
                                                                                        <a href="<?php echo base_url(); ?>lampiran/surat_masuk/<?php echo $baris->nama_berkas; ?>" target="_blank" class="btn btn-xs btn-primary mb-2 mt-2 fw-bold"><i class="fas fa-eye"></i>&nbsp; Preview</a>
                                                                                        <a href="<?php echo base_url(); ?>lampiran/surat_masuk/<?php echo $baris->nama_berkas; ?>" target="_blank" class="btn btn-xs btn-primary mb-2 mt-2 fw-bold"><i class="fas fa-cloud-download-alt"></i>&nbsp; Download</a>
                                                                                    </td>
                                                                                </tr>

                                                                                <?php
                                                                                if ($baris->sm_dibaca == 4) { ?>
                                                                                    <tr class="bg-primary text-white">
                                                                                        <th colspan="2"><i class="fas fa-check-circle"></i>&nbsp; PETUNJUK PIMPINAN</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Tindakan Segera</td>
                                                                                        <td><?php echo implode(', ', explode(',', $baris->sm_segera)); ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Tindakan Biasa</td>
                                                                                        <td>
                                                                                            <?php echo implode(', ', explode(',', $baris->sm_biasa)); ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Catatan Kepala</td>
                                                                                        <td><?php echo $baris->sm_catatan; ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Disposisi Jabatan</td>
                                                                                        <td>
                                                                                            <span class="badge badge-success fw-bold mb-2 mt-2"><i class="fas fa-id-badge"></i>&nbsp;
                                                                                                <?php
                                                                                                $data['sql'] = $this->db->query("SELECT bagian_nama FROM tbl_bagian where id_bagian ='$baris->sm_bagian'")->row();
                                                                                                echo $data['sql']->bagian_nama;
                                                                                                ?>
                                                                                            </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Penerima</td>
                                                                                        <td>
                                                                                            <br>
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
                                                                                            <br>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Tanggal Penyelesaian</td>
                                                                                        <td><?php echo format_indo($baris->sm_tgl_disposisi); ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Catatan <?php
                                                                                                    $data['sql'] = $this->db->query("SELECT bagian_nama FROM tbl_bagian where id_bagian ='$baris->sm_bagian'")->row();
                                                                                                    echo $data['sql']->bagian_nama;
                                                                                                    ?></td>
                                                                                        <td><?php echo $baris->sm_catatan; ?></td>
                                                                                    </tr>
                                                                                <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } elseif ($baris->sm_dibaca == 3) { ?>
                                            <span class="badge badge-warning fw-bold"><i class="fas fa-bell"></i></span>
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