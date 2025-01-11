<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between mb-4">
          <div>
            <h3 class="card-title mb-0 font-weight-bold">Data Surat Masuk</h3>
            <div class="small text-muted"><?php echo $md->nm_lembaga; ?></div>
          </div>
          <div class="btn-toolbar">
            <?php
            if ($user->row()->pegawai_level == 'admin' or $user->row()->pegawai_level == 'petugas') { ?>
              <a href="" data-toggle="modal" data-target="#addSurat">
                <button class="btn btn-xs btn-success m-1 fw-bold"><i class="fas fa-plus-circle"></i><span class="d-none d-md-block">Tambah</span>
                </button>
              </a>
              <a href="<?php echo base_url(); ?>users/control/">
                <button class="btn btn-xs btn-primary m-1 fw-bold"><i class="fas fa-clipboard-check"></i><span class="d-none d-md-block">Riwayat</span>
                </button>
              </a>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-12">
          <?php echo $this->session->flashdata('msg'); ?>
        </div>
        <div class="table-responsive pb-4" style="overflow-x:auto;">
          <table id="basic-datatables" class="table table-striped table-bordered table-hover" cellspacing="0" style="width: 100%;">
            <thead class="bg-info">
              <tr class="text-white">
                <th>No.</th>
                <th>Agenda</th>
                <th>Tgl. Diterima</th>
                <th>Disposisi Jabatan</th>
                <th>Instansi</th>
                <th>Perihal</th>
                <th class="text-center" width="18%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($sm->result() as $baris) {
              ?>
                <tr>
                  <td class="text-center fw-bold"></td>
                  <td class="text-center">
                    <?php
                    if ($baris->sm_dibaca == 4) { ?>
                      <span class="badge badge-success fw-bold"><i class="fas fa-check-circle"></i>&nbsp; <?php echo $baris->sm_penerima; ?></span>
                    <?php } elseif ($baris->sm_dibaca == 3) { ?>
                      <span class="badge badge-secondary fw-bold"><i class="fas fa-tag"></i>&nbsp; <?php echo $baris->sm_penerima; ?></span>
                    <?php } elseif ($baris->sm_dibaca == 2) { ?>
                      <span class="badge badge-primary fw-bold"><i class="fas fa-bell"></i>&nbsp; <?php echo $baris->sm_penerima; ?></span>
                    <?php } elseif ($baris->sm_dibaca == 1) { ?>
                      <span class="badge badge-warning fw-bold"><i class="fas fa-spinner"></i>&nbsp; <?php echo $baris->sm_penerima; ?></span>
                    <?php } else { ?>
                      <span class="badge badge-danger fw-bold"><i class="fas fa-exclamation-triangle"></i>&nbsp; <?php echo $baris->sm_penerima; ?></span>
                    <?php } ?>
                  </td>
                  <td><?php echo date('m/d/Y', strtotime($baris->sm_tgl_diterima)); ?></td>
                  <td>
                    <?php if ($baris->sm_dibaca >= 3) {
                      $data['sql'] = $this->db->query("SELECT bagian_nama FROM tbl_bagian where id_bagian ='$baris->sm_bagian'")->row();
                      // echo'<pre>';
                      echo json_decode(json_encode($data['sql']),true)['bagian_nama']?:"tidak disposisi";
                      // die;
                      // echo $data['sql']->bagian_nama;
                    } else {
                      echo '-';
                    } ?>
                  </td>
                  </td>
                  <td><?php echo $baris->sm_pengirim; ?></td>
                  <td><?php echo $baris->sm_perihal; ?></td>
                  <td class="text-center">
                    <a href="" class="btn btn-success btn-xs mt-1 mb-1" data-toggle="modal" data-target="#detailSM<?php echo $baris->id_sm; ?>" title="Detail"><i class="fas fa-eye"></i></a>
                    <?php if ($baris->sm_dibaca == 4) { ?>
                      <a href="sm/c/<?php echo $baris->id_sm; ?>" class="btn btn-xs btn-warning mt-1 mb-1" target="_blank" title="Cetak"><i class="fas  fa-print"></i></a>
                    <?php } ?>
                    <?php if ($user->row()->pegawai_level == 'admin' or $user->row()->pegawai_level == 'petugas') { ?>
                      <?php if ($baris->sm_dibaca == 0) { ?>
                        <a href="" class="btn btn-xs btn-primary mt-1 mb-1" data-toggle="modal" data-target="#editSM<?php echo $baris->id_sm; ?>" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="" class="btn btn-xs btn-warning mt-1 mb-1" data-toggle="modal" data-target="#uploadSM<?php echo $baris->id_sm; ?>" title="Upload File"><i class="fas fa-cloud-upload-alt"></i></a>
                        <a href="<?php echo base_url(); ?>users/sm/h/<?php echo $baris->id_sm; ?>" class="btn btn-xs btn-danger mt-1 mb-1" onclick="return confirm('Apakah Anda yakin?')" title="Hapus"><i class="fas fa-trash"></i></a>
                      <?php } ?>
                    <?php } ?>
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
                                <div class="table-responsive">
                                  <table class="table table-striped table-hover text-left" cellspacing="0" style="width: 100%;">
                                    <thead class="bg-info table-bordered">
                                      <tr class="text-white">
                                        <!-- <th colspan="2">No. Agenda (<?php echo $baris->sm_no_urut; ?>)</th> -->
                                        <!-- <th colspan="2">No. Agenda (<?php echo $baris->sm_penerima . $baris->sm_no_urut . $baris->sm_no_surat_asal ; ?>)</th> -->
                                        <th colspan="2">No. Agenda (<?php echo $baris->sm_no_urut ; ?>)</th>
                                        <!-- <td class="fw-bold"><?php echo $baris->ska_no_awal . '.' . $baris->ska_no_urut . $baris->ska_no_surat; ?></td> -->
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
                                <div class="table-responsive">
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
                                <div class="table-responsive">
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
                                        <!-- liat surat masuk -->
                                        <td>
                                          <!-- asli -->
                                          <a href="<?php echo base_url(); ?>lampiran/surat_masuk/<?php echo $baris->nama_berkas; ?>" target="_blank" class="btn btn-xs btn-primary mb-2 mt-2 fw-bold"><i class="fas fa-eye"></i>&nbsp; Preview</a>
                                          <!-- asli  -->
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
                                          <td>Catatan</td>
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
                                          <td><?php echo $baris->sm_kasi_ctt; ?></td>
                                        </tr>
                                      <?php } elseif ($baris->sm_dibaca == 3) { ?>
                                        <tr class="bg-primary text-white">
                                          <th colspan="2"><i class="fas fa-check-circle"></i>&nbsp; PETUNJUK PIMPINAN</th>
                                        </tr>
                                        <tr>
                                          <td>Tindakan Segera</td>
                                          <td><?php echo $baris->sm_segera; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Tindakan Biasa</td>
                                          <td><?php echo $baris->sm_biasa; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Catatan</td>
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
                                      <?php } elseif ($baris->sm_dibaca == 0) { ?>
                                        <tr>
                                          <td>Koreksi</td>
                                          <td><?php echo $baris->sm_ktu_ctt; ?></td>
                                        </tr>
                                      <?php } ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer mt--2">
                            <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end modal -->
                  </td>
                  <!-- modal edit surat -->
                  <div class="modal fade" id="editSM<?php echo $baris->id_sm; ?>" tabindex="-1" role="dialog" aria-labelledby="editSM<?php echo $baris->id_sm; ?>">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title fw-bold"><i class="fas fa-paste"></i>&nbsp; EDIT SURAT MASUK</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-sm-12 text-left mb-2">
                                <span class="fw-bold">INFORMASI UMUM</span> <br> <small>
                                  Lengkapi informasi pada surat masuk.
                                </small>
                              </div>
                              <!-- NOMOR SURAT -->
                              <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default">
                                  <label class="text-primary fw-bold"><i class="fas fa-bullseye"></i> NO. SURAT</label>
                                  <input required name="id" type="hidden" value="<?php echo $baris->id_sm; ?>">
                                  <input required name="user" type="hidden" value="<?php echo $user->row()->id_user; ?>">
                                  <input required name="no_surat" type="text" class="form-control fw-bold" value="<?php echo $baris->sm_no_surat_asal; ?>">
                                </div>
                              </div>
                              <!-- TGL. SURAT -->
                              <div class="col-sm-3 text-left">
                                <div class="form-group form-group-default">
                                  <label class="text-primary fw-bold"><i class="far fa-calendar-alt"></i> TGL. SURAT</label>
                                  <input required name="tgl_surat" type="date" class="form-control fw-bold" value="<?php echo $baris->sm_tgl_surat; ?>">
                                </div>
                              </div>
                              <!-- DITERIMA TGL. -->
                              <div class="col-sm-3 text-left">
                                <div class="form-group form-group-default">
                                  <label class="text-primary fw-bold"><i class="far fa-calendar-check"></i> DITERIMA TGL.</label>
                                  <input required name="diterima_tgl" type="date" class="form-control fw-bold" value="<?php echo $baris->sm_tgl_diterima; ?>">
                                </div>
                              </div>
                              <!-- INSTANSI -->
                              <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default">
                                  <label class="text-primary fw-bold"><i class="fas fa-building"></i> INSTANSI PENGIRIM</label>
                                  <input required name="pengirim" type="text" class="form-control fw-bold" value="<?php echo $baris->sm_pengirim; ?>">
                                </div>
                              </div>
                              <!-- NOMOR AGENDA -->
                              <div class="col-sm-3 text-left">
                                <div class="form-group form-group-default">
                                  <label class="text-primary fw-bold"><i class="fas fa-clipboard-list"></i> NO AGENDA</label>
                                  <input required name="agenda" type="text" class="form-control fw-bold" value="<?php echo $baris->sm_no_urut; ?>" disabled>
                                </div>
                              </div>
                              <!-- KLASIFIKASI -->
                              <div class="col-sm-3 text-left">
                                <div class="form-group form-group-default">
                                  <label class="text-primary fw-bold"><i class="fas fa-bookmark"></i> KLASIFIKASI</label>
                                  <input required name="klasifikasi" type="text" class="form-control fw-bold" value="<?php echo $baris->sm_penerima; ?>" onkeyup="changeNoAgenda(this)">
                                </div>
                              </div>
                              <!-- PERIHAL SURAT -->
                              <div class="col-sm-12 text-left">
                                <div class="form-group form-group-default">
                                  <label class="text-primary fw-bold"><i class="fas fa-file-contract"></i> PERIHAL SURAT</label>
                                  <input required name="perihal" type="text" class="form-control fw-bold" value="<?php echo $baris->sm_perihal; ?>">
                                </div>
                              </div>
                              <div class="col-sm-12 text-left mb-2 mt-2">
                                <span class="fw-bold">INFORMASI TAMBAHAN</span> <br> <small>
                                  Silahkan lengkapi jumlah lampiran, status, dan sifat tindakan surat!
                                </small>
                              </div>
                              <!-- LAMPIRAN -->
                              <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default">
                                  <label class="text-primary fw-bold">LAMPIRAN</label>
                                  <select required name="lampiran" class="custom-select form-control fw-bold">
                                    <option value="">--Lampiran--</option>
                                    <option <?php if ($baris->sm_lampiran == "-") {
                                              echo "selected";
                                            } ?> value="-">0 Lampiran</option>
                                    <option <?php if ($baris->sm_lampiran == "1 lampiran") {
                                              echo "selected";
                                            } ?> value="1 lampiran">1 Lampiran</option>
                                    <option <?php if ($baris->sm_lampiran == "2 lampiran") {
                                              echo "selected";
                                            } ?> value="2 lampiran">2 Lampiran</option>
                                    <option <?php if ($baris->sm_lampiran == "3 lampiran") {
                                              echo "selected";
                                            } ?> value="3 lampiran">3 Lampiran</option>
                                    <option <?php if ($baris->sm_lampiran == "4 lampiran") {
                                              echo "selected";
                                            } ?> value="4 lampiran">4 Lampiran</option>
                                    <option <?php if ($baris->sm_lampiran == "5 lampiran") {
                                              echo "selected";
                                            } ?> value="5 lampiran">5 Lampiran</option>
                                    <option <?php if ($baris->sm_lampiran == "6 lampiran") {
                                              echo "selected";
                                            } ?> value="6 lampiran">6 Lampiran</option>
                                  </select>
                                </div>
                              </div>
                              <!-- STATUS -->
                              <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default">
                                  <label class="text-primary fw-bold">STATUS</label>
                                  <select required name="status" class="custom-select form-control fw-bold">
                                    <option value="">--Status--</option>
                                    <option <?php if ($baris->sm_status == "Asli") {
                                              echo "selected";
                                            } ?> value="Asli">Asli</option>
                                    <option <?php if ($baris->sm_status == "Tembusan") {
                                              echo "selected";
                                            } ?> value="Tembusan">Tembusan</option>
                                  </select>
                                </div>
                              </div>
                              <!-- SIFAT -->
                              <div class="col-sm-4 text-left">
                                <div class="form-group form-group-default">
                                  <label class="text-primary fw-bold">SIFAT</label>
                                  <select required name="sifat" class="custom-select form-control fw-bold">
                                    <option value="">--Sifat--</option>
                                    <option <?php if ($baris->sm_sifat == "Segera") {
                                              echo "selected";
                                            } ?> value="Segera">Biasa</option>
                                    <option <?php if ($baris->sm_sifat == "Sangat Segera") {
                                              echo "selected";
                                            } ?> value="Sangat Segera">Penting</option>
                                    <option <?php if ($baris->sm_sifat == "Kilat") {
                                              echo "selected";
                                            } ?> value="Kilat">Sangat Penting</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button name="updateSM" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
                            <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- end modal -->
                  <!-- modal upload -->
                  <div class="modal fade" id="uploadSM<?php echo $baris->id_sm; ?>" tabindex="-1" role="dialog" aria-labelledby="uploadSM<?php echo $baris->id_sm; ?>">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title fw-bold"><i class="fas fa-cloud-upload-alt"></i>&nbsp; UPLOAD FILE BARU</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-sm-12 text-left mb-2 mt-2">
                                <span class="fw-bold">UNGGAH FILE SURAT</span> <br> <small>
                                  Silahkan unggah file surat dalam satu file.
                                </small>
                              </div>
                              <div class="col-sm-12 text-left">
                                <div class="form-group form-group-default bg-dop">
                                  <label class="text-primary text-small fw-bold">UPLOAD FILE</label>
                                  <input type="file" class="form-control fw-bold" name="userfile">
                                  <small class="small result_default text-danger">* semua file type diizinkan!</small>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <input required name="id" type="hidden" class="form-control fw-bold" value="<?php echo $baris->id_sm; ?>">
                            <input required name="token_lampiran" type="hidden" class="form-control fw-bold" value="<?php echo $baris->token_lampiran; ?>">
                            <button name="uploadSM" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
                            <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- end modal -->
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
<!-- Modal addSurat -->
<div class="modal fade" id="addSurat" tabindex="-1" role="dialog" aria-labelledby="addSurat">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold"><i class="fas fa-paste"></i>&nbsp; TAMBAH SURAT MASUK</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12 text-left mb-2">
              <span class="fw-bold">INFORMASI UMUM</span> <br> <small>
                Lengkapi informasi pada surat masuk.
              </small>
            </div>
            <!-- NOMOR SURAT -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="fas fa-bullseye"></i> NO. SURAT</label>
                <input required name="user" type="hidden" value="<?php echo $user->row()->id_user; ?>">
                <input required name="t_no_surat" type="text" class="form-control fw-bold" placeholder="Masukkan Nomor Surat">
                <!-- <input required name="t_no_urut" type="text" class="form-control fw-bold" value="<?php echo $no; ?>" readonly> -->
              </div>
            </div>

            <!-- NOMOR URUT -SURAT MASUK -->

            <!-- <div class="col-sm-6 text-left">
              <div class="form-group form-group-default bg-dop">
                <label class="text-primary fw-bold">NO URUT</label>
                <input required name="no_urut" type="text" class="form-control fw-bold" value="<?php echo $no; ?>" readonly>
              </div>
            </div> -->

            <!-- TGL. SURAT -->
            <div class="col-sm-3 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="far fa-calendar-alt"></i> TGL. SURAT</label>
                <input required name="tgl_surat" type="date" class="form-control fw-bold">
              </div>
            </div>
            <!-- DITERIMA TGL. -->
            <div class="col-sm-3 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="far fa-calendar-check"></i> DITERIMA TGL.</label>
                <input required name="diterima_tgl" type="date" class="form-control fw-bold">
              </div>
            </div>
            <!-- INSTANSI -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="fas fa-building"></i> INSTANSI PENGIRIM</label>
                <input required name="pengirim" type="text" class="form-control fw-bold" placeholder="Masukkan Instansi Asal">
              </div>
            </div>
            <!-- NOMOR AGENDA -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="fas fa-clipboard-list"></i> NO AGENDA</label>
                <input required name="agenda" type="text" class="form-control fw-bold" placeholder="No. Urut/Agenda" readonly value="<?="_/101.6.21.770?"?>">
              </div>
            </div>
            <!-- NOMOR SEKOLAH -->
            <div class="col-sm-3 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="fas fa-school"></i> NOMOR SEKOLAH</label>
                <input required name="nomor_sekolah" type="text" class="form-control fw-bold" value="101.6.21.770" placeholder="Masukkan Nomor Sekolah" readonly>
              </div>
            </div>
            <!-- nomer urut -->
            <!-- <div class="col-sm-3 text-left">
              <div class="form-group form-group-default bg-dop">
                <label class="text-primary fw-bold">NO URUT</label>
                <input required name="no_urut" type="text" class="form-control fw-bold" value="<?php echo $no; ?>" readonly>
              </div>
            </div> -->
            <!-- TAHUN -->
            <div class="col-sm-3 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="fas fa-calendar-alt"></i> TAHUN</label>
                <select onchange="changeNoAgenda(this)" required name="tahun" class="form-control fw-bold">
                <option value="">Pilih Tahun</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
              </select>
              </div>
            </div>

            <!-- KLASIFIKASI -->
            <!-- <div class="col-sm-3 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="fas fa-bookmark"></i> KLASIFIKASI</label>
                <input onkeyup="changeNoAgenda(this)" required name="klasifikasi" type="text" class="form-control fw-bold" placeholder="Input Kode">
              </div>
            </div> -->

            <!-- KLASIFIKASI -->
            <div class="col-sm-3 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="fas fa-bookmark"></i> KLASIFIKASI KODE</label>
                <select onchange="changeNoAgenda(this)" required name="klasifikasi"class="form-control fw-bold select2">
                <option value="">Pilih Kode Surat</option>
                <?php
                // Array yang berisi daftar kode surat
                $kodeSurat = array(
                  '000' => "000 : UMUM",
                  '001' => "001 : LAMBANG",
                  '001.1' => " 001.1 : GARUDA",
                  '001.2' => " 001.2 : BENDERA KEBANGSAAN",
                  '001.3' => " 001.3 : LAGU KEBANGSAAN",
                  '001.4' => " 001.4 : LAMBANG DAERAH",
                  '002' => "002 : TANDA PENGHARGAAN",
                  '002.6' => " 002.6 : SERTIFIKAT/ PIAGAM",
                  '003' => "003 : HARI BESAR/HARI RAYA",
                  '004' => "004 : UCAPAN TERIMAKASIH ",
                  '005' => "005 : UNDANGAN",
                  '007' => "007 : -",
                  '012' => "012 : RUMAH DINAS",
                  '013' => "013 : MES DINAS",
                  '015' => "015 : PENERANGAN LISTRIK",
                  '016' => "016 : TELEPON",
                  '017' => "017 : KEAMANAN KANTOR",
                  '018'=> "018 : KEBERSIHAN KANTOR",
                  '019' => "019 : PROTOKOL",
                  '019.1' => "019.1 : UPACARA BENDERA",
                  '019.3' => "019.3 : AUDIEN",
                  '019.4' => "019.4 : ALAMAT KANTOR/PEJ",
                  '020' => "020 : PERALATAN",
                  '020.01' => "020.01 : PENAWARAN/PESANAN",
                  '020.02' => "020.02 : PRAKWALIFIKASI",
                  '020.03' => "020.03 : PENGAMBILAN PRKW",
                  '020.04' => "020.04 : PENGEMBALIAN PRKW",
                  '020.05' => "020.05 : USUL PENETAPAN PR",
                  '020.07' => "020.07 : PENGUMUMAN PRKW",
                  '020.08' => "020.08 : PENUNJANGAN",
                  '020.09' => "020.09 : B.ACARA EVALUASI",
                  '021' => "021 : ALAT TULIS",
                  '023' => "023 : PERABOT KANTOR",
                  '024' => "024 : ALAT ANGKUTAN",
                  '025' => "025 : PAKAIAN DINAS",
                  '027' => "027 : PENGADAAN",
                  '027.01' => "027.01 : JAMINAN",
                  '027.02' => "027.02 : SPMK",
                  '027.05' => "027.05 : TIM/PENGADAAN",
                  '027.08' => "027.08 : SPK/KONTRAK",
                  '028' => "028 : INVENTARIS",
                  '028.01' => "028.01 : B.A PENYERAHAN",
                  '028.02' => "028.02 : B.A PEMERIKSAAN",
                  '028.03' => "028.03 : B.A PEMASUKAN",
                  '028.04' => "028.04 : B.A PENERIMAAN",
                  '028.06' => "028.06 : B.A KEMAJUAN PEK",
                  '028.07' => "028.07 : B.A KLARIFIKASI",
                  '030' => "030 : KEKAYAAN DAERAH",
                  '041' => "041 : PERPUSTAKAAN",
                  '042' => "042 : DOKUMENTASI",
                  // PERBARUI
                  '045' => "045 : KEARSIPAN",
                  '045.2' => "045.2 : SURAT PENGANTAR",
                  // BLM KETEMU NOMER SURAT PENGANTAR
                  '046' => "046 : SANDI",

                  // BLM ADA KODE SURATNYA
                  '050' => "050 : PERENCANAAN",
                  '061' => "061 : INST PEMERINTAH",
                  '062' => "062 : ORG NON PEM",// nomernya blm jelas
                  '072' => "072 : SURVEY",
                  '079' => "079 : KECAMATAN /KELURAHAN",
                  '090' => "090 : PERJALANAN DINAS",
                  // '' => " : SPT(SPPD)",// -----
                  '100' => "100 : PEMERINTAHAN",
                  '111' => "111 : PRESIDEN",
                  '116' => "116 : LEMBAGA TINGGI NEGARA",//DIPERARUI LEMBAGA TINGGI
                  // '' => " : PEMERINTAH PUSAT",
                  '429' => "429 : DEPDAGRI",
                  // '' => " : DEP LAINNYA",// CARI DL 
                  // '' => " : LEMBAGA NON DEP",
                  '118' => "118 : OTONOMI/DESENT",
                  // '' => " : PEMDA TK I",
                  // '' => " : INSTANSI TK PROP",
                  '135' => "135 : PEMBENTUKAN/MEKAR",
                  // '' => " : PEMDA TK II",
                  // '' => " : INSTANSI KAB/KOTA",
                  // '' => " : PEMERINTAH DESA",
                  // '' => " : RT - RW - RK",
                 

                  // ADA DATANYA 
                  '181' => "181 : PERDATA",
                  '182' => "182 : PIDANA",
                  '183' => "183 : PERDILAN",
                  '185' => "185 : IMIGRASI/VISA/PASPOR",
                  '187' => "187 : KEJAKSAAN",
                  '188' => "188 : PERATURAN/ PER UU",
                  '189' => "189 : HUKUM ADAT",
                  '188.4' => "188.4 : KEPUTUSAN",
                  '188.5' => "188.5 : PANITIA KEGIATAN",
                  '195' => "195 : PERJALANAN TAMU ASING KE DAERAH",
                  '200' => "200 : POLITIK",
                  '210' => "210 : PARTAI POLITIK",
                  '220' => "220 : ORG MASYARAKAT",
                  '230' => "230 : ORG PROFESI",
                  '236' => "236 : KORPRI",
                  '240' => "240 : 0RGANISASI PEMUDA",
                  '250' => "250 : BURUH/TANI/NELAYAN",
                  '260' => "260 : ORGANISASI WANITA",
                  '261' => "261 : DHARMA WANITA",
                  '270' => "270 : PEMILIHAN UMUM",
                  '310' => "310 : PERTANIAN/MILITER",
                  '331' => "331 : KEPOLISIAN",
                  '331.1' => "331.1 : SATPOL PP",
                  '336' => "336 : SURAT KALENG",
                  '340' => "340 : HANSIP",
                  '350' => "350 : KEJAHATAN",
                  '356' => "356 : KORUPSI",
                  '360' => "360 : BENCANA",
                  '361' => "361 : GEMPA / GUNUNG",
                  '370' => "370 : KECELAKAAN / SAR",
                  '400' => "400 : KESRA",
                  '410' => "410 : PEMBANGUNAN DESA",
                  '411.1' => "411.1 : SWADAYA GOTONG ROYONG",
                  '420' => "420 : PENDIDIKAN",
                  '421' => "421 : SEKOLAH",
                  '421.1' => "421.1 : PRA SEK / TK/ PAUD",
                  '421.2' => "421.2 : SD",
                  '421.3' => "421.3 : SEKOLAH MENENGAH",
                  '421.4' => "421.4 : SEKOLAH TINGGI / PT",
                  '421.5' => "421.5 : SEKOLAH KEJURUAN",
                  '421.6' => "421.6 : KEGIATAN SEK /PT",
                  '421.7' => "421.7 : IDEM PELAJAR / MHS",
                  '421.8' => "421.8 : SEKOLAH PLB",
                  '421.9' => "421.2 : PLS/BERANTAS BUTA H",
                  '422' => "422 : ADMINISTRASI SEK",
                  '422.1' => "422.1 : SYARAT/MASUK SEK",
                  '422.3' => "422.3 : HARI LIBUR",
                  '422.4' => "422.4 : UANG SEKOLAH (SPP)",
                  '422.5' => "422.5 : BEA SISWA",
                  '423' => "423 : METHODE BELAJAR",
                  '423.4' => "423.4 : KKN",
                  '423.5' => "423.5 : KURIKULUM",
                  '423.6' => "423.6 : KARYA TULIS",
                  '423.7' => "423.7 : UJIAN / IJAZAH",
                  '424' => "424 : TENAGA PENGAJAR",
                  '425' => "425 : SARANA PENDIDIKAN",
                  '425.1' => "425.1 : GEDUNG SEK/KAMPUS",
                  '425.2' => "425.2 : BUKU",
                  '425.3' => "425.3 : PERLENGKAPAN SEK",
                  '426' => "426 : KEOLAHRAGAAN",
                  '426.2' => "426.2 : SARANA OLAH RAGA",
                  '426.3' => "426.3 : PON / OLIMPYADE",
                  '426.4' => "426.4 : HOBBY",
                  '427' => "427 : KEPEMUDAAN",
                  '428' => "428 : PRAMUKA",
                  '430' => "430 : KEBUDAYAAN",
                  '431' => "431 : KESENIAN",
                  '431.2' => "431.2 : SARANA KESENIAN",
                  '432' => "432 : KEPURBAKALAAN",
                  '432.1' => "432.1 : MUSEUM",
                  '433' => "433 : SEJARAH",
                  '434' => "434 : BAHASA",
                  '435' => "435 : HIBURAN",
                  // '' => " : ", // BLM DIKETAHUI MASU DIISI APA
                  '442' => "442 : OBAT-OBATAN",
                  '444' => "444 : GIZI",
                  '450' => "450 : AGAMA",
                  '451' => "451 : ISLAM",
                  '460' => "460 : SOSIAL",
                  '465' => "465 : KESRA",
                  '468' => "468 : PMI",
                  '470' => "470 : KEPENDUDUKAN",
                  '474.2' => "474.2 : KAWIN/ CERAI/ RUJUK",
                  '476' => "476 : KB",
                  '480' => "480 : MEDIA MASA",
                  '481.1' => "481.1 : SURAT KABAR",
                  '482' => "482 : RADIO",
                  '483' => "483 : TELEVISI",
                  '484' => "484 : FILM",
                  '489' => "489 : HUMAS",
                  '500' => "500 : PEREKONOMIAN",
                  '510' => "510 : PERDAGANGAN",
                  '510.2' => "510.2 : PELELANGAN",
                  '516' => "516 : PERDIGANGAN",
                  '518' => "518 : KOPERASI",
                  '520' => "520 : PERTANIAN",
                  '530' => "330 : PERINDUSTRIAN",
                  '540' => "540 : PERTAMBANGAN",
                  '550' => "550 : PERHUBUNGAN",
                  '560' => "560 : TENAGA KERJA",
                  '570' => "570 : PERMODALAN",
                  '580' => "580 : PERBANKAN/MONETER",
                  '590' => "590 : AGRARIA",
                  '600' => "600 : PEKERJAAN UMUM",
                  '610' => "610 : PENGAIRAN",
                  '620' => "620 : JALAN",
                  '630' => "630 : JEMBATAN",
                  '640' => "640 : BANGUNAN",
                  '642' => "642 : BANGUNAN PENDIK",
                  '650' => "650 : TATA KOTA",
                  '660' => "660 : TATA LINGKUNGAN",
                  '670' => "670 : KETENAGAAN / DAYA",
                  '671' => "671 : LISTRIK / PLN",
                  '680' => "680 : PERALATAN BERAT",
                  '690' => "690 : AIR MINUM",
                  '700' => "700 : PENGAWASAN",
                  '701' => "701 : IDEM URUSAN DALAM",
                  '702' => "702 : IDEM BID PERALATAN",
                  '800' => "800 : KEPEGAWAIAN",
                  '800.4' => "800.4 : PEGADUAN",
                  '811' => "811 : LAMARAN",
                  '811.1' => "811.1 : TESTING",
                  '811.3' => "811.3 : PANGGILAN",
                  '812' => "812 : PENGUJIAN KESEHATAN",
                  '813' => "813 : PENGANGKATAN CPNS",
                  '813.2' => "813.2 : IDEM GOL II",
                  '813.3' => "813.2 : IDEM GOL III",
                  '814' => "814 : IDEM TENAGA HONOR",
                  '821.1' => "821.1 : PENGANGKATAN / PN",
                  '821.2' => "821.2 : IDEM DALAM JABATAN",
                  '822' => "822 : NAIK GAJI BERKALA",
                  '823' => "823 : KENAIKAN PANGKAT",
                  '824' => "824 : PINDAH MELIMPAH",
                  '826' => "826 : TUGAS BELAJAR",
                  '831' => "831 : TAMBAH MASA KERJA",
                  '832' => "832 : PENY. PANGKAT / GAJI",
                  '833' => "833 : PENGHARGAAN IJAZAH",
                  '834' => "834 : JENJANG PANGKAT",
                  '835' => "835 : PENILAIAN AK KREDIT",
                  '841' => "841 : BERI TUNJANGAN",
                  '842.1' => "842.1 : TASPEN",
                  '842.3' => "842.3 : ASURANSI",
                  // '843' => " : ", // BLM DI ISI 
                  '951' => "951 : CUTI TAHUNAN",
                  '852' => "852 : CUTI BESAR",
                  '853' => "853 : SAKIT",
                  '855' => "855 : CUTI HAJI", //ADA UPDATE TAN NOMER
                  '856' => "856 : CUTI DILUAR TANGGUNGAN",
                  '857' => "857 : CUTI ALASAN LAIN",
                  '861' => "861 : PENGHARGAAN",
                  '861.1' => "861.1 : SATYA LENCANA",
                  '861.5' => "861.5 : PEGAWAI TELADAN",
                  '862' => "862 : HUKUMAN",
                  '862.1' => "862.1 : TEGORAN",
                  '863' => "863 : KONDUITE / DP3, Disiplin Pegawai",
                  '864' => "864 : UJIAN DINAS",
                  '865' => "865 : LP2P",
                  '866' => "866 : REHABILITASI",
                  '873.2' => "873.2 : KARPEG",
                  '873.4' => "873.4 : KARIS / KARSU",
                  '874' => "874 : RIWAYAT PEKERJA",
                  '876.1' => "876.1 : SKPP",
                  '877' => "877 : SUMPAH/JANJI",
                  '880' => "880 : PEMBERHENTIAN",
                  '881' => "881 : MINTA SENDIRI",
                  '882' => "882 : DG HAK PENSIUN",
                  '882.5' => "882.5 : PENSIUN JANDA",
                  '882.6' => "882.6 : IDEM YATIM - PIATU",
                  '883' => "883 : KARENA MENINGGAL",
                  '884' => "884 : KARENA ALASAN LAIN",
                  '885' => "885 : UANG PESANGON",
                  '886' => "886 : UANG TUNGGU",
                  '887' => "887 : IDEM SEMENTARA",
                  '888' => "888 : TIDAK DENGAN HORMAT",
                  '890' => "890 : PENDIDIK PEGAWAI",
                  '892' => "892 : PENDIDIK REGULER",
                  '893' => "893 : NON REGULER",
                  '893.3' => "893.3 : KURSUS KURSUS",
                  '894' => "894 : PENDIDIK KELUAR NEGRI",
                  '896' => "896 : TENAGA PENGAJAR",
                  '900' => "900 : KEUANGAN",
                  '902' => "902 : APBN",
                  '903' => "903 : APBD",
                  '911' => "911 : ANGGARAN RUTIN",
                  '912' => "912 : ANGGARAN PEMBANGUNAN",
                  '913' => "913 : BELANJA TAMBAHAN",
                  '914' => "914 : DIK",
                  '915' => "915 : DIP",
                  '930' => "930 : VERIFIKASI",
                  '931' => "931 : SPM RUTIN",
                  '932' => "932 : SPM PEMBANGUNAN",
                  '934' => "934 : SPJ RUTIN",
                  '935' => "935 : SPJ PENGEMBANG",
                  '936' => "936 : NOTA PEMERIKSAAN",
                  '937' => "937 : PINDAH PEMBUKUAN",
                  '940' => "940 : PEMBUKUAN",
                  '941' => "941 : SUSUN HITUNG ANGGARAN",
                  '942' => "942 : MINTA DATA ANGGARAN",
                  '943' => "943 : LAP FISIK PEMBANGUNAN",
                  '950' => "950 : PERBENDAHARAAN",
                  '954' => "954 : ANGKAT/GANTI BENDAHARA",
                  '956' => "956 : TAGIHAN PIUTANG",
                  '960' => "960 : BINA BENDAHARA",
                  '961' => "961 : PEMERIKSAAN KAS ",
                  '962' => "962 : MERIKSA ADM BENDAHARA",
                  '963' => "963 : LAP KEU BENDAHARA",
                  '970' => "970 : PENDAPATAN",
                  '971' => "971 : PERTIMBANGAN KEUANGAN",
                  '972' => "972 : SUBSIDI",
                  '973' => "973 : PAJAK",
                  '974' => "974 : RETRIBUSI",
                  '975' => "975 : BEA",
                  '1894' => "1894 : -"
                  // '' => " : ",
              );
              // Cek apakah ada pilihan sebelumnya, jika tidak default adalah kosong
              $selectedKodeSurat = isset($_POST['kode_surat']) ? $_POST['kode_surat'] : '';
            
            foreach ($kodeSurat as $id => $value) {
                // Tambahkan atribut 'selected' jika ini adalah pilihan yang dipilih
                $selected = ($id == $selectedKodeSurat) ? 'selected' : '';
                echo "<option value='$id' $selected>$value</option>";
              }
              ?>
              </select>
            </div>
          </div>


            <!-- PERIHAL SURAT -->
            <div class="col-sm-12 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="fas fa-file-contract"></i> PERIHAL SURAT</label>
                <input required name="perihal" type="text" class="form-control fw-bold" placeholder="Masukkan Isi Perihal Surat">
              </div>
            </div>
            <div class="col-sm-12 text-left mb-2 mt-2">
              <span class="fw-bold">INFORMASI TAMBAHAN</span> <br> <small>
                Silahkan lengkapi jumlah lampiran, status, dan sifat tindakan surat!
              </small>
            </div>
            <!-- LAMPIRAN -->
            <div class="col-sm-4 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">LAMPIRAN</label>
                <select required name="lampiran" class="custom-select form-control fw-bold">
                  <option value="">--Lampiran--</option>
                  <option value="-">0 Lampiran</option>
                  <option value="1 lampiran">1 Lampiran</option>
                  <option value="2 lampiran">2 Lampiran</option>
                  <option value="3 lampiran">3 Lampiran</option>
                  <option value="4 lampiran">4 Lampiran</option>
                  <option value="5 lampiran">5 Lampiran</option>
                  <option value="6 lampiran">6 Lampiran</option>
                </select>
              </div>
            </div>
            <!-- STATUS -->
            <div class="col-sm-4 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">STATUS</label>
                <select required name="status" class="custom-select form-control fw-bold">
                  <option value="">--Status--</option>
                  <option value="Asli">Asli</option>
                  <option value="Tembusan">Tembusan</option>
                </select>
              </div>
            </div>
            <!-- SIFAT -->
            <div class="col-sm-4 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">SIFAT</label>
                <select required name="sifat" class="custom-select form-control fw-bold">
                  <option value="">--Sifat--</option>
                  <option value="Segera">Biasa</option>
                  <option value="Sangat Segera">Penting</option>
                  <option value="Kilat">Sangat Penting</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12 text-left mb-2 mt-2">
              <span class="fw-bold">UNGGAH FILE SURAT</span> <br> <small>
                Silahkan unggah file surat dalam satu file.
              </small>
            </div>
            <div class="col-sm-12 text-left">
              <div class="form-group form-group-default bg-dop">
                <label class="text-primary text-small fw-bold">UPLOAD FILE</label>
                <input type="file" class="form-control fw-bold" name="userfile" required>
                <small class="small result_default text-danger">* semua file type diizinkan!</small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button name="saveSM" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
          <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
    const isSuratKeluar = false
</script>