<div class="page-inner">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h3 class="card-title mb-0 font-weight-bold">Data Sekolah</h3>
                        <div class="small text-muted"><?php echo $md->nm_lembaga; ?></div>
                    </div>
                    <div class="btn-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            <!-- NAMA LEMBAGA -->
                            <div class="col-sm-12 text-left">
                                <div class="form-group form-group-default bg-dop">
                                    <input type="hidden" name="id" value="<?php echo $md->id; ?>">
                                    <label class="text-primary fw-bold"><i class="fas fa-building"></i> NAMA SEKOLAH</label>
                                    <input name="lembaga" type="text" class="form-control fw-bold" value="<?php echo $md->nm_lembaga; ?>">
                                </div>
                            </div>
                            <!-- TELP -->
                            <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default bg-dop">
                                    <label class="text-primary fw-bold">TELP</label>
                                    <input name="telp" type="text" class="form-control fw-bold" value="<?php echo $md->telp; ?>">
                                </div>
                            </div>
                            <!-- WEB -->
                            <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default bg-dop">
                                    <label class="text-primary fw-bold">WEBSITE</label>
                                    <input name="website" type="text" class="form-control fw-bold" value="<?php echo $md->website; ?>">
                                </div>
                            </div>
                            <!-- EMAIL -->
                            <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default bg-dop">
                                    <label class="text-primary fw-bold">EMAIL</label>
                                    <input name="email" type="text" class="form-control fw-bold" value="<?php echo $md->email; ?>">
                                </div>
                            </div>
                            <!-- ALAMAT -->
                            <div class="col-sm-12 text-left">
                                <div class="form-group form-group-default bg-dop">
                                    <label class="text-primary fw-bold">ALAMAT</label>
                                    <textarea name="alamat" class="form-control fw-bold" placeholder="Masukkan Alamat Tempat Tinggal"><?php echo $md->alamat; ?></textarea>
                                </div>
                            </div>
                            <!-- TAHUN -->
                            <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">TAHUN</label>
                                    <input name="tahun" type="number" class="form-control fw-bold" value="<?php echo $md->tahun; ?>">
                                </div>
                            </div>
                            <!-- KABUPATEN -->
                            <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">KOTA</label>
                                    <input name="kabupaten" type="text" class="form-control fw-bold" value="<?php echo $md->kabupaten; ?>">
                                </div>
                            </div>
                            <!-- PROVINSI -->
                            <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">PROVINSI</label>
                                    <input name="provinsi" type="text" class="form-control fw-bold" value="<?php echo $md->provinsi; ?>">
                                </div>
                            </div>
                            <div class="col-sm-12 text-left mb-2">
                                <span class="fw-bold">Pengaturan Pimpinan Lembaga</span> <br> <small>
                                    Halaman ini digunakan untuk mengedit Nama dan NIP pimpinan yang sedang aktif.
                                </small>
                            </div>
                            <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-info fw-bold"><i class="fas fa-user-shield"></i> KEPALA KANTOR</label>
                                    <input required name="kepala" type="text" class="form-control fw-bold" value="<?php echo $md->nm_kepala; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-info fw-bold"><i class="fas fa-keyboard"></i> NIP</label>
                                    <input required name="nip" type="number" class="form-control fw-bold" value="<?php echo $md->nip; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-info fw-bold"><i class="fas fa-tag"></i> JABATAN</label>
                                    <input required name="jabatan" type="text" class="form-control fw-bold" value="<?php echo $md->jabatan; ?>">
                                </div>
                            </div>
                            <div class="col-sm-12 text-left mb-2">
                                <span class="fw-bold">Pengaturan KOP SURAT</span> <br> <small>
                                    Halaman ini digunakan untuk pengaturan KOP SURAT pada lembar disposisi dan Surat Keluar.
                                </small>
                            </div>
                            
                            <div class="col-sm-12 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-info fw-bold">KOP 1</label>
                                    <input required name="kop1" type="text" class="form-control fw-bold" value="<?php echo $md->kop_1; ?>">
                                    </div>   
                </div>
                <div class="col-sm-12 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-info fw-bold">KOP 2</label>
                                    <input required name="kop2" type="text" class="form-control fw-bold" value="<?php echo $md->kop_2; ?>">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="updateLembaga" class="btn btn-xs btn-primary"><i class="fa fa-check"></i>&nbsp;<b>SIMPAN</b></button>
                    <a href="<?php echo base_url(); ?>users/" class="btn btn-xs btn-danger"><i class="fa fa-close"></i>&nbsp;<b>KEMBALI</b></a>
                </div>
                </form>
            </div>
        </div>
       
        <div class="col-sm-4">
            <div class="card card-profile">
                <div class="card-header">
                    <div class="profile-picture">
                        <div class="avatar avatar-online avatar-xxl">
                            <img src="<?php echo base_url(); ?>/foto/<?php echo $md->foto; ?>" class="avatar-img rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name"><?php echo $md->nm_lembaga; ?></div>
                        <div class="job"><?php echo $md->kabupaten . ' - ' . $md->provinsi; ?></div>
                        <div class="desc">
                            <?php if ($md->nm_lembaga != 1) {
                                echo "<small class='badge badge-success'>Aktif</small>";
                            } else {
                                echo "<small class='badge badge-warning'>Off</small>";
                            } ?>
                        </div>
                        <div class="desc fw-bold"><?php echo $md->alamat; ?></div>
                        <div class="view-profile">
                            <a href="#" class="btn btn-sm btn-warning btn-block fw-bold" data-toggle="modal" data-target="#ubahFoto">EDIT FOTO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal foto profil -->
        <div class="modal fade" id="ubahFoto" tabindex="-1" role="dialog" aria-labelledby="ubahFoto">
            <div class="modal-dialog modal-md" role="document">
                <div class="col-sm-10">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="ubahFoto"><i class="fab fa-microsoft"></i>&nbsp; PROFIL</h3>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group text-center">
                                    <?php if ($md->foto != NULL) { ?>
                                        <img src="<?php echo base_url(); ?>/foto/<?php echo $md->foto; ?>" alt="Foto Profil Lembaga" class="img-thumbnail" width="70%">
                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>/foto/logo.png" alt="Foto Default" class="img-thumbnail" width="70%">
                                    <?php } ?>
                                    <div id="pratinjauFoto"></div>
                                </div>
                                <div class="form-group form-group-default bg-dop">
                                    <label class="text-primary text-small fw-bold"><i class="fab fa-microsoft"></i> UPLOAD FOTO</label>
                                    <input type="hidden" name="foto_nama" value="<?php echo $md->foto; ?>">
                                    <input type="file" class="form-control fw-bold" name="foto" id="foto" onchange="return validasiFoto()" required>
                                    <small class="small result_default">*Ukuran maksimal file foto 1 MegaByte </small>
                                    <small id="result_foto" class="text-danger fw-bold"></small>
                                </div>
                            </div>
                            <div class="modal-footer d-flex align-items-center">
                                <input type="hidden" name="id" value="<?php echo $md->id; ?>">
                                <button type="submit" name="updateFoto" class="btn btn-xs btn-primary fw-bold"><i class="fa fa-check"></i>&nbsp; SIMPAN</button>
                                <button type="button" class="btn btn-xs btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; BATAL</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>