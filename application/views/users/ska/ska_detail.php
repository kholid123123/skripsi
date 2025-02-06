<?php
$cek    = $user->row();
$id_user = $cek->id_user;
$nama    = $cek->pegawai_nama;
$level   = $cek->pegawai_level;
$username  = $cek->pegawai_nip;
?>
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-invoice">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h3 class="card-title mb-0 font-weight-bold">Validasi Surat Keluar</h3>
                        <div class="small text-muted"><?php echo $md->nm_lembaga; ?></div>
                        <?php if ($level != 'admin') { ?>
                            <span class="badge badge-success fw-bold"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $jabatan->bagian_nama; ?></span>
                        <?php } ?>
                    </div>
                </div>

                <div class="card-body">
                    <div class="invoice-item">
                        <div class="invoice-top">
                            <h6 class="text-uppercase fw-bold">
                                PENGAJUAN SURAT
                            </h6>
                        </div>
                        <div class="separator-solid"></div>
                        <div class="card-body">
    <div class="invoice-item">
        <div class="invoice-top">
            <h6 class="text-uppercase fw-bold text-danger">
                Error: Tidak dapat mengakses pengajuan surat.
            </h6>
        </div>
        <div class="separator-solid"></div>
        <div class="alert alert-danger mt-3" role="alert">
            Terjadi kesalahan. Silakan coba lagi nanti atau hubungi administrator.
        </div>
    </div>
</div>

                        <!-- <div class="row">
                            <div class="col-sm-6">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="bg-danger text-white">
                                                <td colspan="2"><strong><i class="fas fa-clipboard"></i> Informasi Surat</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nomor Surat</td>
                                                <td class="fw-bold"><?php echo $baris->ska_no_surat; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Sifat</td>
                                                <td class="text-left"><?php echo $baris->ska_sifat; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Lampiran</td>
                                                <td class="text-left"><?php echo $baris->ska_lampiran; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Perihal</td>
                                                <td class="text-left"><?php echo $baris->ska_hal; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td class="text-left"><?php echo format_indo($baris->ska_tanggal); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kepada</td>
                                                <td class="text-left fw-bold"><?php echo implode(', ', explode(';', $baris->ska_kpd)); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tembusan</td>
                                                <td class="text-left"><?php echo implode('<br>', explode(';', $baris->ska_tembusan)); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="bg-info text-white">
                                                <td><strong><i class="fas fa-user-edit"></i> Detail</strong></td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Pembuat</td>
                                                <td class="text-left"><?php echo $baris->pegawai_nama . ' - ' . ucwords($baris->pegawai_level); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Seksi</td>
                                                <td class="text-left">
                                                    <span class="badge badge-success fw-bold mt-2 mb-2"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $baris->bagian_nama; ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dibuat Tgl.</td>
                                                <td class="text-left"><?php echo format_indo($baris->ska_create); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td class="text-left fw-bold">
                                                    <?php
                                                    if ($baris->ska_dibaca == 4) { ?>
                                                        <span class="badge badge-success fw-bold mt-2 mb-2"><i class="fas fa-check-circle"></i>&nbsp; Terbit</span>
                                                    <?php } elseif ($baris->ska_dibaca == 3) { ?>
                                                        <span class="badge badge-secondary fw-bold mt-2 mb-2"><i class="fas fa-tag"></i>&nbsp; Verifikasi Kepala</span>
                                                    <?php } elseif ($baris->ska_dibaca == 2) { ?>
                                                        <span class="badge badge-primary fw-bold mt-2 mb-2"><i class="fas fa-bell"></i>&nbsp; Verifikasi KTU</span>
                                                    <?php } elseif ($baris->ska_dibaca == 1) { ?>
                                                        <span class="badge badge-warning fw-bold mt-2 mb-2"><i class="fas fa-spinner"></i>&nbsp; Verifikasi Kasi</span>
                                                        <!-- <span class="badge badge-warning fw-bold mt-2 mb-2"><i class="fas fa-spinner"></i>&nbsp; Verifikasi petugas</span> -->
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger fw-bold mt-2 mb-2"><i class="fas fa-exclamation-triangle"></i>&nbsp; Revisi</span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Penerbitan Nomor</td>
                                                <td class="text-left">
                                                    <?php
                                                    if ($baris->ska_no_urut != null) {
                                                        echo "<i class='fas fa-check-circle text-success'></i>&nbsp; Terbit";
                                                    } else {
                                                        echo "<i class='fas fa-times-circle text-danger'></i>&nbsp; Belum terbit";
                                                    } ?>
                                                </td>
                                            </tr>
                                            <?php if ($level == 'staf' and $baris->ska_dibaca != 4) { ?>
                                                <tr>
                                                    <td></td>
                                                    <!-- <td class="text-left"><a href="<?php echo base_url(); ?>users/ska/cetak/<?php echo $baris->id_ska; ?>" class="btn btn-info btn-sm mt-2 mb-2 fw-bold" title="Preview Draft Surat" target="_blank"><i class="fas fa-print"></i> Preview Surat</a></td> -->
                                                </tr>
                                            <?php } elseif ($level != 'staf') { ?>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-left"><a href="<?php echo base_url(); ?>users/ska/cetak/<?php echo $baris->id_ska; ?>" class="btn btn-info btn-sm mt-2 mb-2 fw-bold" title="Preview Draft Surat" target="_blank"><i class="fas fa-print"></i> Preview Surat</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php if ($baris->ska_dibaca != 1) { ?>
                                <div class="col-sm-12 text-left">
                                    <div class="alert alert-warning">
                                        <span class="fw-bold">#CATATAN</span> <br>
                                        <small>
                                            - <?php echo $baris->ska_kasi_ctt; ?> - <i class="text-info fw-bold">kasi</i><br>
                                            - <?php echo $baris->ska_ktu_ctt; ?> - <i class="text-warning fw-bold">ktu</i> <br>
                                            - <?php echo $baris->ska_kepala_ctt; ?> - <i class="text-secondary fw-bold">kepala</i><br>
                                        </small>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if ($level != 'staf') { ?>
                        <div class="separator-solid"></div>
                        <div class="invoice-top">
                            <!-- <h6 class="text-uppercase fw-bold">
                                TINDAKAN SELANJUTNYA
                            </h6> -->
                        </div>
                    <?php } ?> -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <?php if ($level == 'kasi') { ?>
                                <!-- TGL. AJUAN -->
                                <div class="col-sm-6 text-left mt-2">
                                    <div class="form-group form-group-default bg-dop">
                                        <label class="text-primary fw-bold"><i class="far fa-calendar-alt"></i> TANGGAL</label>
                                        <input readonly name="tgl_ajuan" type="text" value="<?php echo format_indo(date('Y-m-d')) ?>" class="form-control fw-bold">
                                        <input readonly name="id" type="hidden" value="<?php echo $baris->id_ska; ?>">
                                    </div>
                                </div>
                                <!-- AJUKAN KE -->
                                <div class="col-sm-6 text-left mt-2">
                                    <div class="form-group form-group-default bg-dop">
                                        <label class="text-primary fw-bold"><i class="fas fa-clipboard-check"></i> TINDAKAN SELANJUTNYA</label>
                                        <select required name="dibaca" class="custom-select form-control fw-bold" <?php echo ($baris->ska_dibaca >= 2) ? 'disabled' : '' ?>>
                                            <option value="">--Pilih Tindakan--</option>
                                            <option value="0">Koreksi Kembali</option>
                                            <option value="2" <?php echo ($baris->ska_dibaca == 2) ? 'selected' : '' ?>>Ajukan ke KTU</option>
                                            <?php if ($baris->ska_dibaca == 3) { ?>
                                                <option value="3" <?php echo ($baris->ska_dibaca == 3) ? 'selected' : '' ?>>Ajukan ke Kepala</option>
                                            <?php } elseif ($baris->ska_dibaca == 4) { ?>
                                                <option value="4" <?php echo ($baris->ska_dibaca == 4) ? 'selected' : '' ?>>Terbit</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php if ($baris->ska_dibaca == 1) { ?>
                                    <!-- CATATAN -->
                                    <div class="col-sm-12 text-left">
                                        <div class="form-group form-group-default bg-dop">
                                            <label class="text-primary fw-bold"><i class="fas fa-file-alt"></i> CATATAN</label>
                                            <input name="catatan" type="catatan" class="form-control fw-bold" placeholder="Berikan catatan untuk surat ini jika diperlukan.">
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } elseif ($level == 'ktu') { ?>
                                <?php
                                // $bulan = date('m', strtotime($baris->ska_tanggal));
                                // $tahun = date('Y', strtotime($baris->ska_tanggal));
                                $sql = $this->db->query("SELECT MAX(ska_no_urut) as noUrut FROM tbl_ska WHERE ska_tanggal = '$baris->ska_tanggal'")->row();
                                $no_max =  $sql->noUrut;
                                $urutan = (int) substr($no_max, 1, 3);
                                $urutan++;
                                $no = sprintf("%03s", $urutan);
                                ?>
                                <!-- TGL. AJUAN -->
                                <div class="col-sm-6 text-left mt-2">
                                    <div class="form-group form-group-default bg-dop">
                                        <label class="text-primary fw-bold"><i class="far fa-calendar-alt"></i> TANGGAL</label>
                                        <input readonly name="tgl_ajuan" type="text" value="<?php echo ($baris->ska_tgl_ktu == null) ? format_indo(date('Y-m-d')) : $baris->ska_tgl_ktu ?>" class="form-control fw-bold">
                                        <input readonly name="id" type="hidden" value="<?php echo $baris->id_ska; ?>">
                                    </div>
                                </div>
                                <!-- AJUKAN KE -->
                                <div class="col-sm-6 text-left mt-2">
                                    <div class="form-group form-group-default bg-dop">
                                        <label class="text-primary fw-bold"><i class="fas fa-clipboard-check"></i> TINDAKAN SELANJUTNYA</label>
                                        <select required name="dibaca" class="custom-select form-control fw-bold" <?php echo ($baris->ska_dibaca >= 3) ? 'disabled' : '' ?>>
                                            <option value="">--Pilih Tindakan--</option>
                                            <option value="0">Koreksi Kembali</option>
                                            <option value="3" <?php echo ($baris->ska_dibaca == 3) ? 'selected' : '' ?>>Ajukan ke Kepala</option>
                                            <?php if ($baris->ska_dibaca == 4) { ?>
                                                <option value="3" <?php echo ($baris->ska_dibaca == 4) ? 'selected' : '' ?>>Terbit</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- ska -->
                                <!-- <div class="col-sm-4 text-left mt-2">
                                    <div class="form-group form-group-default bg-dop">
                                        <label class="text-primary fw-bold"><i class="fas fa-sort-numeric-up"></i> TERBITKAN NOMOR SURAT</label>
                                        <input required name="no_urut" type="text" class="form-control fw-bold" value="<?php echo ($baris->ska_no_urut == null) ? $no : $baris->ska_no_urut ?>" <?php echo ($baris->ska_dibaca >= 3) ? 'readonly' : '' ?>>
                                    </div>
                                </div> -->
                                <?php if ($baris->ska_dibaca == 2 or $baris->ska_dibaca == 1) { ?>
                                    <!-- CATATAN -->
                                    <div class="col-sm-12 text-left">
                                        <div class="form-group form-group-default bg-dop">
                                            <label class="text-primary fw-bold"><i class="fas fa-file-alt"></i> CATATAN</label>
                                            <input name="catatan" type="catatan" class="form-control fw-bold" placeholder="Berikan catatan untuk surat ini jika diperlukan.">
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } elseif ($level == 'kepala') { ?>
                                <!-- TGL. AJUAN -->
                                <div class="col-sm-6 text-left mt-2">
                                    <div class="form-group form-group-default bg-dop">
                                        <label class="text-primary fw-bold"><i class="far fa-calendar-alt"></i> TANGGAL</label>
                                        <input readonly name="tgl_ajuan" type="text" value="<?php echo format_indo(date('Y-m-d')) ?>" class="form-control fw-bold">
                                        <input readonly name="id" type="hidden" value="<?php echo $baris->id_ska; ?>">
                                    </div>
                                </div>
                                <!-- AJUKAN KE -->
                                <div class="col-sm-6 text-left mt-2">
                                    <div class="form-group form-group-default bg-dop">
                                        <label class="text-primary fw-bold"><i class="fas fa-clipboard-check"></i> TINDAKAN SELANJUTNYA</label>
                                        <select required name="dibaca" class="custom-select form-control fw-bold" <?php echo ($baris->ska_dibaca >= 4) ? 'disabled' : '' ?>>
                                            <option value="">--Pilih Tindakan--</option>
                                            <option value="0">Koreksi Kembali</option>
                                            <option value="4" <?php echo ($baris->ska_dibaca == 4) ? 'selected' : '' ?>>Terbitkan</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if ($baris->ska_dibaca == 3) { ?>
                                    <!-- CATATAN -->
                                    <div class="col-sm-12 text-left">
                                        <div class="form-group form-group-default bg-dop">
                                            <label class="text-primary fw-bold"><i class="fas fa-file-alt"></i> CATATAN</label>
                                            <input name="catatan" type="catatan" class="form-control fw-bold" placeholder="Berikan catatan untuk surat ini jika diperlukan.">
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                </div>
                <div class="card-footer">
                    <?php if ($level == 'kasi') { //<?php if ($level == 'kasi') {
                        if ($baris->ska_dibaca == 1) { ?>
                            <button name="vervalKasiSKA" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
                            <!-- <button name="vervalpetugasSKA" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button> -->
                            <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                        <?php }
                    } elseif ($level == 'ktu') {
                        if ($baris->ska_dibaca == 2 or $baris->ska_dibaca == 1) { ?>
                            <button name="vervalKtuSKA" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
                            <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                        <?php }
                    } elseif ($level == 'kepala') {
                        if ($baris->ska_dibaca == 3) { ?>
                            <button name="vervalKepalaSKA" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
                            <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                    <?php }
                    } ?>
                </div>
                <input type="hidden" name="ska_no_surat" value="<?=$baris->ska_no_surat?>">
                </form>
            </div>
        </div>
    </div>
</div>