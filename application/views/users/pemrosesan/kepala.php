<div class="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between mb-4">
                    <div>
                        <h3 class="card-title mb-0 font-weight-bold">Verval Surat Masuk</h3>
                        <div class="small text-muted"><?php echo $md->nm_lembaga; ?></div>
                        <span class="badge badge-success fw-bold"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $jabatan->bagian_nama; ?></span>
                    </div>
                    <div class="btn-toolbar">
                        <a href="<?php echo base_url(); ?>users/control/">
                            <button class="btn btn-xs btn-primary m-1 fw-bold"><i class="fas fa-clipboard-check"></i><span class="d-none d-md-block">Riwayat</span>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive pb-4" style="overflow-x:auto;">
                    <table id="basic-datatables" class="table table-striped table-bordered table-hover" cellspacing="0" style="width: 100%;">
                        <thead class="bg-success">
                            <tr class="text-white">
                                <th>No.</th>
                                <th>Status</th>
                                <th>Diterima Tgl.</th>
                                <th>Instansi</th>
                                <th>Perihal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kepala->result() as $baris) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $baris->sm_no_urut; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($baris->sm_dibaca == 3) { ?>
                                            <span class="badge badge-success fw-bold"><i class="fas fa-check-circle"></i>&nbsp; Diajukan</span>
                                        <?php } elseif ($baris->sm_dibaca == 2) { ?>
                                            <span class="badge badge-warning fw-bold"><i class="fas fa-bell"></i>&nbsp; Menunggu</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger fw-bold"><i class="fas fa-exclamation-triangle"></i>&nbsp; Menunggu</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo format_indo($baris->sm_tgl_diterima); ?></td>
                                    <td><?php echo $baris->sm_pengirim; ?></td>
                                    <td><?php echo $baris->sm_perihal; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>users/kepala/d/<?php echo $baris->id_sm; ?>" class="btn btn-info btn-sm mt-1 mb-1 fw-bold"><i class="fab fa-telegram-plane"></i> Periksa</a>
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
    $(document).ready(function() {
        $("#petunjuk1").select2({
            placeholder: "--pilih tindakan segera/kilat--",
        });

        $("#petunjuk2").select2({
            placeholder: "--Pilih tindakan biasa--"
        });
    });
</script>