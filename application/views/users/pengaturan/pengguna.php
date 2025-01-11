<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between mb-4">
          <div>
            <h3 class="card-title mb-0 font-weight-bold">Data Pegawai</h3>
            <div class="small text-muted"><?php echo $md->nm_lembaga; ?></div>
          </div>
          <div class="btn-toolbar">
            <?php
            if ($user->row()->pegawai_level == 'admin') { ?>
              <a href="" data-toggle="modal" data-target="#addPegawai">
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
          <table id="calonsiswa-datatables" class="table table-striped table-bordered table-hover" cellspacing="0" style="width: 100%;">
            <table id="basic-datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead class="bg-info">
                <tr class="text-white">
                  <th>No.</th>
                  <th>NIP</th>
                  <th>Nama Lengkap</th>
                  <th>Jabatan</th>
                  <th>Level</th>
                  <th>Status</th>
                  <th>Login Terakhir</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($level_users->result() as $baris) {
                ?>
                  <tr>
                    <td class="text-center fw-bold"></td>
                    <td><?php echo $baris->pegawai_nip; ?></td>
                    <td><?php echo $baris->pegawai_nama; ?></td>
                    <td><?php echo $baris->bagian_nama; ?></td>
                    <td class="text-center">
                      <?php
                      if ($baris->pegawai_level == 'staf') { ?>
                        <span class="badge badge-success fw-bold mt-1 mb-1"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $baris->pegawai_level; ?></span>
                      <?php } elseif ($baris->pegawai_level == 'kasi') { ?>
                        <span class="badge badge-secondary fw-bold mt-1 mb-1"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $baris->pegawai_level; ?></span>
                      <?php } elseif ($baris->pegawai_level == 'ktu') { ?>
                        <span class="badge badge-primary fw-bold mt-1 mb-1"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $baris->pegawai_level; ?></span>
                      <?php } elseif ($baris->pegawai_level == 'kepala') { ?>
                        <span class="badge badge-info fw-bold mt-1 mb-1"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $baris->pegawai_level; ?></span>
                      <?php } elseif ($baris->pegawai_level == 'petugas') { ?>
                        <span class="badge badge-warning fw-bold mt-1 mb-1"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $baris->pegawai_level; ?></span>
                      <?php } else { ?>
                        <span class="badge badge-danger fw-bold mt-1 mb-1"><i class="fas fa-id-badge"></i>&nbsp; <?php echo $baris->pegawai_level; ?></span>
                      <?php } ?>

                    </td>
                    <td class="text-center"><?php if ($baris->pegawai_status == "1") {
                                              echo "<span class='badge badge-success fw-bold mt-1 mb-1'><i class='fas fa-check-circle'></i> Active</span>";
                                            } else {
                                              echo "<span class='badge badge-danger fw-bold mt-1 mb-1'><i class='fas fa-exclamation-circle'></i> Off</span>";
                                            } ?>
                    </td>
                    <td><?php echo $baris->pegawai_login; ?></td>
                    <td class="text-center">
                      <a class="btn btn-primary btn-xs mt-1 mb-1" data-toggle="modal" data-target="#editPegawai<?php echo $baris->id_user; ?>" title="Detail" href=""><i class="fas fa-user-edit"></i></a>
                      <a class="btn btn-warning btn-xs mt-1 mb-1" data-toggle="modal" data-target="#resetPassword<?php echo $baris->id_user; ?>" title=" Reset Password" href=""><i class="fas fa-lock"></i></a>
                      <?php if ($user->row()->pegawai_level == "admin") { ?>
                        <a href="" onclick="return deleteData(<?php echo $baris->id_user; ?>, 'users/pengguna/h/')" class="btn btn-danger btn-xs mt-1 mb-1" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                      <?php } ?>
                    </td>
                    <!-- Modal resetPassword-->
                    <div class="modal fade" id="resetPassword<?php echo $baris->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="resetPassword<?php echo $baris->id_user; ?>" area-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title fw-bold"><i class="fas fa-user-cog"></i>&nbsp; UBAH SANDI</h3>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
                          </div>
                          <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body text-left">
                              <span class="fw-bold">Ubah Sandi/Password</span> <br> <small>
                                Silahkan buat sandi dengan kombinasi Angka, Huruf Besar/Kecil dan Simbol.
                              </small>
                              <div class="row mt-4">
                                <div class="col-sm-12 text-left">
                                  <div class="form-group form-group-default">
                                    <input name="id" type="hidden" class="form-control fw-bold" value="<?php echo $baris->id_user; ?>">
                                    <label class="text-primary fw-bold"><i class="fas fa-user-lock"></i> PASSWORD BARU</label>
                                    <input required name="newpassword" type="text" class="form-control fw-bold" placeholder="Masukkan password baru">
                                  </div>
                                </div>
                                <div class="col-sm-12 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold"><i class="fas fa-user-lock"></i> KONFIRMASI PASSWORD</label>
                                    <input required name="confirmpassword" type="text" class="form-control fw-bold" placeholder="Konfirmasi password baru">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button name="updateSandi" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
                              <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->
                    <!-- Modal editPegawai -->
                    <div class="modal fade" id="editPegawai<?php echo $baris->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="editPegawai<?php echo $baris->id_user; ?>">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title fw-bold"><i class="fas fa-user-edit"></i>&nbsp; EDIT PEGAWAI</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
                          </div>
                          <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                              <div class="row">
                                <!-- JENIS PEGAWAI -->
                                <div class="col-sm-12 text-left mb-4">
                                  <h4 class="small fw-bold">JENIS PEGAWAI</h4>
                                  <label class="form-radio-label">
                                    <input class="form-radio-input form-control" type="radio" name="jenis" value="0" <?php if ($baris->pegawai_jenis == 0) {
                                                                                                                        echo "checked";
                                                                                                                      } ?>>
                                    <span class="form-radio-sign fw-bold">&nbsp; PNS</span>
                                  </label>
                                  <label class="form-radio-label">
                                    <input class="form-radio-input form-control" type="radio" name="jenis" value="1" <?php if ($baris->pegawai_jenis == 1) {
                                                                                                                        echo "checked";
                                                                                                                      } ?>>
                                    <span class="form-radio-sign fw-bold">&nbsp; PPPK/P3K</span>
                                  </label>
                                  <label class="form-radio-label">
                                    <input class="form-radio-input form-control" type="radio" name="jenis" value="2" <?php if ($baris->pegawai_jenis == 2) {
                                                                                                                        echo "checked";
                                                                                                                      } ?>>
                                    <span class="form-radio-sign fw-bold">&nbsp; NON PNS/PPPK</span>
                                  </label>
                                </div>
                                <!-- NAMA LENGKAP -->
                                <div class="col-sm-12 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold"><i class="fas fa-address-card"></i> NAMA LENGKAP PEGAWAI<small class="text-danger"> *</small></label>
                                    <input name="id" type="hidden" class="form-control fw-bold" value="<?php echo $baris->id_user; ?>">
                                    <input required name="nama" type="text" class="form-control fw-bold" placeholder="Masukkan Nama Lengkap" value="<?php echo $baris->pegawai_nama; ?>">
                                    <small class="text-muted">* Nama pegawai berdasarkan ijazah</small>
                                  </div>
                                </div>
                                <!-- NIP -->
                                <div class="col-sm-6 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">NIP</label>
                                    <input required name="nip" type="number" maxlength="18" class="form-control fw-bold" placeholder="Masukkan NIP" value="<?php echo $baris->pegawai_nip; ?>">
                                  </div>
                                </div>
                                <!-- PANGKAT -->
                                <div class="col-sm-6 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">PANGKAT GOLONGAN RUANGAN</label>
                                    <select required name="pangkat" class="custom-select form-control fw-bold">
                                      <option value="">--Pilih--</option>
                                      <?php
                                      $kodePangkat = array(
                                        1 => "Pembina (IV/a)",
                                        2 => "Penata TK.I (III/d)",
                                        3 => "Penata (III/c)",
                                        4 => "Penata Muda Tk. I (III/b)",
                                        5 => "Penata Muda (III/a)",
                                        6 => "IX",
                                        7 => "Pengatur Tk. I (II/d)",
                                        8 => "Pengatur Muda Tk. I (II/b)",
                                        9 => "-",
                                        // 1 => "Pembina (IV/a)",
                                        // 2 => "Penata Tk. I (III/d)",
                                        // 3 => "Penata (III/c)",
                                        // 4 => "Penata Muda Tk. I (III/b)",
                                        // 5 => "Penata Muda (III/a)",
                                        // 6 => "Pengatur Tk. I (II/d)",
                                        // 7 => "Pengatur Muda Tk. I (II/b)",
                                        // 8 => "Pengatur Tingkat I/IId",
                                        // 9 => "Penata Muda/IIIa",
                                        // 10 => "Penata Muda Tingkat I/IIIb",
                                        // 11 => "Penata/IIIc",
                                        // 12 => "Penata Tingkat I/IIId",
                                        // 13 => "Pembina/IVa",
                                        // 14 => "Pembina Tingkat I/IVb",
                                        // 15 => "Pembina Muda/IVc",
                                        // 16 => "Pembina Madya/IVd",
                                        // 17 => "Pembina Utama"
                                      );
                                      foreach ($kodePangkat as $id => $value) {
                                        if ($id == $baris->pegawai_pangkat) {
                                          $selected = "selected";
                                        } else {
                                          $selected = "";
                                        }
                                        echo "<option value='$id' $selected>$value</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <!-- JENIS KELAMIN -->
                                <div class="col-sm-12 text-left mb-4">
                                  <h4 class="fw-bold mb-1 small">JENIS KELAMIN</h4>
                                  <label class="form-radio-label">
                                    <input class="form-radio-input form-control" type="radio" name="jk" value="L" <?php if ($baris->pegawai_jk == "L") {
                                                                                                                    echo "checked";
                                                                                                                  } ?>>
                                    <span class="form-radio-sign fw-bold">&nbsp; Laki-laki</span>
                                  </label>
                                  <label class="form-radio-label">
                                    <input class="form-radio-input form-control" type="radio" name="jk" value="P" <?php if ($baris->pegawai_jk == "P") {
                                                                                                                    echo "checked";
                                                                                                                  } ?>>
                                    <span class="form-radio-sign fw-bold">&nbsp; Perempuan</span>
                                  </label>
                                </div>
                                <!-- TEMPAT LAHIR -->
                                <div class="col-sm-6 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">TEMPAT LAHIR</label>
                                    <input required name="tplahir" type="text" class="form-control fw-bold" placeholder="Masukkan Tempat Lahir" value="<?php echo $baris->pegawai_tempat_lahir; ?>">
                                  </div>
                                </div>
                                <!-- TANGGAL LAHIR -->
                                <div class="col-sm-6 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">TANGGAL LAHIR</label>
                                    <input required name="tgllahir" type="date" class="form-control fw-bold" value="<?php echo $baris->pegawai_tanggal_lahir; ?>">
                                  </div>
                                </div>
                                <!-- PENDIDIKAN TERAKHIR -->
                                <div class="col-sm-6 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">PENDIDIKAN TERAKHIR</label>
                                    <select required name="pdd" class="custom-select form-control fw-bold">
                                      <option value="">--Pilih--</option>
                                      <?php
                                      $kodePendidikan = array(
                                        1 => "Tidak Sekolah",
                                        2 => "Sekolah Dasar (SD/MI)",
                                        3 => "Sekolah Menengah Pertama (SMP/MTs)",
                                        4 => "Sekolah Menengah Atas (SMA/SMK/MA)",
                                        5 => "Diploma I (D1)",
                                        6 => "Diploma II (D2)",
                                        7 => "Diploma III (D3)",
                                        8 => "Sarjana (S1)",
                                        9 => "Magister (S2)",
                                        10 => "Doktor (S3)"
                                      );
                                      foreach ($kodePendidikan as $id => $value) {
                                        if ($id == $baris->pegawai_pdd) {
                                          $selected = "selected";
                                        } else {
                                          $selected = "";
                                        }
                                        echo "<option value='$id' $selected>$value</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <!-- TELP -->
                                <div class="col-sm-6 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">TELP</label>
                                    <input required name="telp" type="number" class="form-control fw-bold" placeholder="Masukkan Telp" value="<?php echo $baris->pegawai_telp; ?>">
                                  </div>
                                </div>
                                <!-- ALAMAT EMAIL -->
                                <div class="col-sm-12 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">ALAMAT EMAIL</label>
                                    <input name="email" type="email" class="form-control fw-bold" placeholder="Masukkan Alamat Email" value="<?php echo $baris->pegawai_email; ?>">
                                  </div>
                                </div>
                                <!-- TEMPAT TINGGAL -->
                                <div class="col-sm-12 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">ALAMAT TINGGAL</label>
                                    <input name="alamat" type="alamat" class="form-control fw-bold" placeholder="Masukkan Alamat Tempat Tinggal" value="<?php echo $baris->pegawai_alamat; ?>">
                                  </div>
                                </div>
                                <!-- STATUS AKUN -->
                                <div class="col-sm-12 text-left mb-4">
                                  <h4 class="fw-bold mb-1 small">STATUS AKUN</h4>
                                  <label class="form-radio-label">
                                    <input class="form-radio-input form-control" type="radio" name="status" value="1" <?php if ($baris->pegawai_status == 1) {
                                                                                                                        echo "checked";
                                                                                                                      } ?>>
                                    <span class="form-radio-sign fw-bold">&nbsp; Aktif</span>
                                  </label>
                                  <label class="form-radio-label">
                                    <input class="form-radio-input form-control" type="radio" name="status" value="0" <?php if ($baris->pegawai_status == 0) {
                                                                                                                        echo "checked";
                                                                                                                      } ?>>
                                    <span class="form-radio-sign fw-bold">&nbsp; Tidak Aktif</span>
                                  </label>
                                </div>
                                <!-- JABATAN -->
                                <div class="col-sm-6 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">JABATAN</label>
                                    <select required name="jabatan" class="custom-select form-control fw-bold">
                                      <option value="">--Pilih--</option>
                                      <?php
                                      foreach ($level_bagian->result() as $a) {
                                        if ($a->id_bagian == $baris->bagian_id) {
                                          $selected = "selected";
                                        } else {
                                          $selected = "";
                                        }
                                        echo "<option value='$a->id_bagian' $selected>$a->bagian_nama</option>";
                                      } ?>
                                    </select>
                                  </div>
                                </div>
                                <!-- AKSES -->
                                <div class="col-sm-6 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">LEVEL PEGEWAI</label>
                                    <select required name="level" class="custom-select form-control fw-bold">
                                      <option value="">--Pilih--</option>
                                      <?php
                                      $kodeLevel = array(
                                        "petugas" => "Petugas",
                                        "ktu" => "KTU",
                                        "kepala" => "Kepala Sekolah",
                                        "kasi" => "KASI",
                                        "staf" => "Staf",
                                        "jfu" => "JFU",
                                      );
                                      foreach ($kodeLevel as $id => $value) {
                                        if ($id == $baris->pegawai_level) {
                                          $selected = "selected";
                                        } else {
                                          $selected = "";
                                        }
                                        echo "<option value='$id' $selected>$value</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button name="updatePegawai" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
                              <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->
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
<!-- Modal addPegawai -->
<div class="modal fade" id="addPegawai" tabindex="-1" role="dialog" aria-labelledby="addPegawai">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold"><i class="fas fa-user-plus"></i>&nbsp; REGISTRASI PEGAWAI</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <!-- JENIS PEGAWAI -->
            <div class="col-sm-12 text-left mb-4">
              <h4 class="small fw-bold">JENIS PEGAWAI</h4>
              <label class="form-radio-label">
                <input class="form-radio-input form-control" type="radio" name="jenis" value="0">
                <span class="form-radio-sign fw-bold">&nbsp; PNS</span>
              </label>
              <label class="form-radio-label">
                <input class="form-radio-input form-control" type="radio" name="jenis" value="1">
                <span class="form-radio-sign fw-bold">&nbsp; PPPK/P3K</span>
              </label>
              <label class="form-radio-label">
                <input class="form-radio-input form-control" type="radio" name="jenis" value="2">
                <span class="form-radio-sign fw-bold">&nbsp; NON PNS/PPPK</span>
              </label>
            </div>
            <!-- NAMA LENGKAP -->
            <div class="col-sm-12 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="fas fa-address-card"></i> NAMA LENGKAP PEGAWAI<small class="text-danger"> *</small></label>
                <input required name="nama" type="text" class="form-control fw-bold" placeholder="Masukkan Nama Lengkap">
                <small class="text-muted">* Nama pegawai berdasarkan ijazah</small>
              </div>
            </div>
            <!-- NIP -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">NIP</label>
                <input required name="nip" type="number" maxlength="18" class="form-control fw-bold" placeholder="Masukkan NIP">
              </div>
            </div>
            <!-- PANGKAT -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">PANGKAT GOLONGAN RUANGAN</label>
                <select required name="pangkat" class="custom-select form-control fw-bold">
                  <option value="">--Pilih--</option>
                  <?php
                  $kodePangkat = array(
                    1 => "Pembina (IV/a)",
                    2 => "Penata TK. I (III/d)",
                    3 => "Penata (III/c)",
                    4 => "Penata Muda Tk. I (III/b)",
                    5 => "Penata Muda (III/a)",
                    6 => "IX",
                    7 => "Pengatur Tk. I (II/d)",
                    8 => "Pengatur Muda Tk. I (II/b)",
                    9 => "-",

                    // 1 => "Juru Muda/Ia",
                    // 2 => "Juru Muda Tingkat I/Ib",
                    // 3 => "Juru/Ic",
                    // 4 => "Juru Tingkat I/Id",
                    // 5 => "Pengatur Muda/IIa",
                    // 6 => "Pengatur Muda Tingkat I/IIb",
                    // 7 => "Pengatur/IIc",
                    // 8 => "Pengatur Tingkat I/IId",
                    // 9 => "Penata Muda/IIIa",
                    // 10 => "Penata Muda Tingkat I/IIIb",
                    // 11 => "Penata/IIIc",
                    // 12 => "Penata Tingkat I/IIId",
                    // 13 => "Pembina/IVa",
                    // 14 => "Pembina Tingkat I/IVb",
                    // 15 => "Pembina Muda/IVc",
                    // 16 => "Pembina Madya/IVd",
                    // 17 => "Pembina Utama"
                  );
                  foreach ($kodePangkat as $id => $value) {
                    echo "<option value='$id'>$value</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <!-- JENIS KELAMIN -->
            <div class="col-sm-12 text-left mb-4">
              <h4 class="fw-bold mb-1 small">JENIS KELAMIN</h4>
              <label class="form-radio-label">
                <input class="form-radio-input form-control" type="radio" name="jk" value="L">
                <span class="form-radio-sign fw-bold">&nbsp; Laki-laki</span>
              </label>
              <label class="form-radio-label">
                <input class="form-radio-input form-control" type="radio" name="jk" value="P">
                <span class="form-radio-sign fw-bold">&nbsp; Perempuan</span>
              </label>
            </div>
            <!-- TEMPAT LAHIR -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">TEMPAT LAHIR</label>
                <input required name="tplahir" type="text" class="form-control fw-bold" placeholder="Masukkan Tempat Lahir">
              </div>
            </div>
            <!-- TANGGAL LAHIR -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">TANGGAL LAHIR</label>
                <input required name="tgllahir" type="date" class="form-control fw-bold" placeholder="TTL">
              </div>
            </div>
            <!-- PENDIDIKAN TERAKHIR -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">PENDIDIKAN TERAKHIR</label>
                <select required name="pdd" class="custom-select form-control fw-bold">
                  <option value="">--Pilih--</option>
                  <?php
                  $kodePendidikan = array(
                    1 => "Tidak Sekolah",
                    2 => "Sekolah Dasar (SD/MI)",
                    3 => "Sekolah Menengah Pertama (SMP/MTs)",
                    4 => "Sekolah Menengah Atas (SMA/SMK/MA)",
                    5 => "Diploma I (D1)",
                    6 => "Diploma II (D2)",
                    7 => "Diploma III (D3)",
                    8 => "Sarjana (S1)",
                    9 => "Magister (S2)",
                    10 => "Doktor (S3)"
                  );
                  foreach ($kodePendidikan as $id => $value) {
                    echo "<option value='$id'>$value</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <!-- ALAMAT EMAIL -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">ALAMAT EMAIL</label>
                <input name="email" type="email" class="form-control fw-bold" placeholder="Masukkan Alamat Email">
              </div>
            </div>
            <!-- TELP -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">TELP</label>
                <input required name="telp" type="number" class="form-control fw-bold" placeholder="Masukkan Telp">
              </div>
            </div>
            <!-- STATUS AKTIF -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">STATUS</label>
                <select required name="status" class="custom-select form-control fw-bold">
                  <option value="">--Pilih--</option>
                  <option value="1">Aktif</option>
                  <option value="0">Tidak Aktif</option>
                </select>
              </div>
            </div>
            <!-- TEMPAT TINGGAL -->
            <div class="col-sm-12 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">ALAMAT TINGGAL</label>
                <input name="alamat" type="alamat" class="form-control fw-bold" placeholder="Masukkan Alamat Tempat Tinggal">
              </div>
            </div>
            <!-- JABATAN -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">JABATAN</label>
                <select required name="jabatan" class="custom-select form-control fw-bold">
                  <option value="">--Pilih--</option>
                  <?php
                  foreach ($level_bagian->result() as $baris) {
                    echo "<option value='$baris->id_bagian'>$baris->bagian_nama</option>";
                  } ?>
                </select>
              </div>
            </div>
            <!-- AKSES -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">LEVEL PEGEWAI</label>
                <select required name="level" class="custom-select form-control fw-bold">
                  <option value="">--Pilih--</option>
                  <?php
                  $kodeLevel = array(
                    "petugas" => "Petugas",
                    "ktu" => "KTU",
                    "kepala" => "Kepala Sekolah",
                    "kasi" => "KASI",
                    "staf" => "Staff",
                    "jfu" => "JFU",
                  );
                  foreach ($kodeLevel as $id => $value) {
                    echo "<option value='$id'>$value</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button name="savePegawai" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
          <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal -->