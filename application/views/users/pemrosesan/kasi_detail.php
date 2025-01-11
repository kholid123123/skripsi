<div class="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between mb-2">
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="table-responsive" style="overflow-x: auto;">
                                <table class="table table-striped table-hover" cellspacing="0" style="width: 100%;">
                                    <thead class="bg-default table-bordered">
                                        <tr class="text-black">
                                            <th colspan="2">NOMOR AGENDA (<?php echo $query->sm_no_urut; ?>)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-bordered">
                                        <tr class="fw-bold">
                                            <td width="30%">Kode</td>
                                            <td width="70%"><?php echo $query->sm_penerima; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Sifat</td>
                                            <td><span class="badge badge-success fw-bold mt-2 mb-2"><i class="fas fa-bell"></i>&nbsp;<?php echo $query->sm_sifat; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Diterima</td>
                                            <td><?php echo format_indo($query->sm_tgl_diterima); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="table-responsive" style="overflow-x: auto;">
                                <table class="table table-striped table-hover" cellspacing="0" style="width: 100%;">
                                    <thead class="bg-info table-bordered">
                                        <tr class="text-white">
                                            <th colspan="2"><i class="fas fa-ellipsis-h"></i> &nbsp;STATUS SURAT</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-bordered">
                                        <tr>
                                            <td>Berkas</td>
                                            <td><?php echo $query->sm_status; ?></td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td width="30%">Status</td>
                                            <td width="70%">
                                                <?php
                                                if ($query->sm_dibaca == 4) { ?>
                                                    <span class="badge badge-success fw-bold mt-2 mb-2"><i class="fas fa-check-circle"></i>&nbsp; Terdisposisi</span>
                                                <?php } elseif ($query->sm_dibaca == 3) { ?>
                                                    <span class="badge badge-secondary fw-bold mt-2 mb-2"><i class="fas fa-check-circle"></i>&nbsp; Verifikasi Kepala</span>
                                                <?php } elseif ($query->sm_dibaca == 2) { ?>
                                                    <span class="badge badge-primary fw-bold mt-2 mb-2"><i class="fas fa-bell"></i>&nbsp; Verifikasi KTU</span>
                                                <?php } elseif ($query->sm_dibaca == 1) { ?>
                                                    <span class="badge badge-warning fw-bold mt-2 mb-2"><i class="fas fa-spinner"></i>&nbsp; Menunggu KTU</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-danger fw-bold mt-2 mb-2"><i class="fas fa-exclamation-triangle"></i>&nbsp; Revisi</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                        if ($query->sm_dibaca == 4) { ?>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td><?php echo format_indo($query->sm_tgl_disposisi); ?></td>
                                            </tr>
                                        <?php } elseif ($query->sm_dibaca == 3) { ?>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td><?php echo format_indo($query->sm_tgl_kepala); ?></td>
                                            </tr>
                                        <?php } elseif ($query->sm_dibaca == 2) { ?>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td><?php echo format_indo($query->sm_tgl_ajuan); ?></td>
                                            </tr>
                                        <?php } elseif ($query->sm_dibaca == 1) { ?>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td><?php echo format_indo(substr($query->sm_create, 0, 8)); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive" style="overflow-x: auto;">
                                        <table class="table table-striped table-hover" cellspacing="0" style="width: 100%;">
                                            <thead class="bg-info table-bordered">
                                                <tr class="text-white">
                                                    <th colspan="2">Informasi Detail Surat</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-bordered">
                                                <tr class="fw-bold">
                                                    <td width="30%">No. Surat</td>
                                                    <td width="70%"><?php echo $query->sm_no_surat_asal; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Instansi</td>
                                                    <td><?php echo $query->sm_pengirim; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Perihal</td>
                                                    <td class="p-4"><br /><?php echo $query->sm_perihal; ?><br /><br /></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Surat</td>
                                                    <td><?php echo format_indo($query->sm_tgl_surat); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Lampiran</td>
                                                    <td><?php echo $query->sm_lampiran; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>File</td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>lampiran/surat_masuk/<?php echo $query->nama_berkas; ?>" target="_blank" class="btn btn-xs btn-primary mb-2 mt-2 fw-bold"><i class="fas fa-eye"></i>&nbsp; Preview</a>
                                                        <a href="<?php echo base_url(); ?>lampiran/surat_masuk/<?php echo $query->nama_berkas; ?>" target="_blank" class="btn btn-xs btn-primary mb-2 mt-2 fw-bold"><i class="fas fa-cloud-download-alt"></i>&nbsp; Download</a>
                                                    </td>
                                                </tr>
                                                <tr class="bg-warning">
                                                    <th colspan="2" class="text-white">Informasi Kepala</th>
                                                </tr>
                                                <tr>
                                                    <td>Tindakan Segera</td>
                                                    <td><?php echo implode(', ', explode(',', $query->sm_segera)); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tindakan Biasa</td>
                                                    <td><?php echo implode(', ', explode(',', $query->sm_biasa)); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Catatan Kepala</td>
                                                    <td><?php echo $query->sm_catatan; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Disposisi Jabatan</td>
                                                    <td>
                                                        <span class="badge badge-success fw-bold mb-2 mt-2"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $jabatan->bagian_nama; ?></span>
                                                    </td>
                                                </tr>
                                                <?php
                                                if ($query->sm_dibaca == 4) { ?>
                                                    <tr>
                                                        <td>Penerima</td>
                                                        <td>
                                                            <br>
                                                            <?php
                                                            $data = explode(';', $query->sm_disposisi);
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
                                                        <td><?php echo format_indo($query->sm_tgl_disposisi); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Catatan Seksi</td>
                                                        <td><?php echo $query->sm_kasi_ctt; ?></td>
                                                    </tr>
                                                <?php } elseif ($query->sm_dibaca == 3) { ?>
                                                    <tr>
                                                        <td>Tanggal</td>
                                                        <td><?php echo format_indo($query->sm_tgl_kepala); ?></td>
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($query->sm_dibaca == 4) {
                        } else { ?>
                            <div class="col-lg-12">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-4 text-left">
                                            <div class="select2-input">
                                                <label class="text-primary fw-bold mb-1"><i class="far fa-calendar-alt"></i> Disposisi Tgl.</label>
                                                <input type="text" name="tgl_disposisi" class="form-control form-control-sm" value="<?php echo format_indo(date('Y-m-d')) ?>" readonly>
                                            </div>
                                        </div>
                                        <div class=" col-sm-8 text-left">
                                            <div class="select2-input">
                                                <label class="text-primary fw-bold mb-1"><i class="fas fa-building"></i> Disposisi Pegawai</label>
                                                <select class="form-control selectSearch fw-bold" style="width: 100%;" required name="petunjuk1[]" id="petunjuk1" multiple>
                                                    <?php
                                                    foreach ($level_users->result() as $baris) {
                                                        echo "<option value='$baris->id_user'>$baris->pegawai_nama</option>";
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- CATATAN -->
                                        <div class="col-sm-12 text-left">
                                            <div class="form-group form-group-default bg-dop">
                                                <label class="text-primary fw-bold"><i class="fas fa-file-alt"></i> CATATAN</label>
                                                <input name="catatan" type="catatan" class="form-control fw-bold" placeholder="Berikan catatan untuk surat ini jika diperlukan.">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 text-left">
                                            <div class="alert alert-danger">
                                                <span class="fw-bold">#CATATAN</span> <br> <small>
                                                    Lakukan disposisi surat untuk diteruskan kepada pegawai. Pilihan disposisi bisa lebih dari satu pegawai.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
                <div class="card-footer mt--2">
                    <button type="submit" name="updateDisposisi" class="btn btn-xs btn-primary"><i class="fa fa-check"></i>&nbsp;<b>SIMPAN DATA</b></button>
                    <a href="<?php echo base_url(); ?>users/kepala" class="btn btn-xs btn-danger"><i class="fa fa-close"></i>&nbsp;<b>KEMBALI</b></a>
                </div>
                </form>
            <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $("#petunjuk1").select2({
            placeholder: " CARI NAMA PEGAWAI ",
        });

        $("#petunjuk2").select2({
            placeholder: "-- Pilih Tindakan Biasa --"
        });
    });
</script>