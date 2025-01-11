<div class="page-inner">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between mb-4">
          <div>
            <h3 class="card-title mb-0 font-weight-bold">Data Jabatan</h3>
            <div class="small text-muted"><?php echo $md->nm_lembaga; ?></div>
          </div>
          <div class="btn-toolbar">
            <?php
            if ($user->row()->pegawai_level == 'admin') { ?>
              <a href="" data-toggle="modal" data-target="#addBagian">
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
            <thead class="bg-warning">
              <tr class="text-white">
                <th>No.</th>
                <th>Nama Jabatan</th>
                <th>Sekolah</th>
                <?php
                if ($user->row()->pegawai_level == 'admin' or $user->row()->pegawai_level == 'admin') { ?>
                  <th>Aksi</th>
                <?php
                } ?>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($bagian->result() as $baris) {
              ?>
                <tr>
                  <td class="text-center fw-bold"></td>
                  <td><?php echo $baris->bagian_nama; ?></td>
                  <td><?php echo $baris->nm_lembaga; ?></td>
                  <?php
                  if ($user->row()->pegawai_level == 'admin' or $user->row()->pegawai_level == 'admin') { ?>
                    <td class="text-center">
                      <a class="btn btn-primary btn-xs mt-1 mb-1" data-toggle="modal" data-target="#editBagian<?php echo $baris->id_bagian; ?>" title="Detail" href=""><i class="fas fa-eye"></i></a>
                      <a href="" class="btn btn-xs btn-danger mt-1 mb-1" onclick="return deleteData(<?php echo $baris->id_bagian; ?>, 'users/bagian/h/')" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    <!-- Modal editBagian -->
                    <div class="modal fade" id="editBagian<?php echo $baris->id_bagian; ?>" tabindex="-1" role="dialog" aria-labelledby="editBagian<?php echo $baris->id_bagian; ?>">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title fw-bold"><i class="fas fa-user-tag"></i>&nbsp; EDIT JABATAN</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
                          </div>
                          <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                              <div class="row">
                                <!-- JABATAN -->
                                <div class="col-sm-12 text-left">
                                  <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">JABATAN</label>
                                    <input name="id" type="hidden" class="form-control fw-bold" value="<?php echo $baris->id_bagian; ?>">
                                    <input required name="jabatan" type="text" class="form-control fw-bold" placeholder="Nama Jabatan" value="<?php echo $baris->bagian_nama; ?>">
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button name="updateJabatan" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
                              <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->
                  <?php
                  } ?>
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
<!-- Modal addBagian -->
<div class="modal fade" id="addBagian" tabindex="-1" role="dialog" aria-labelledby="addBagian">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold"><i class="fas fa-user-tag"></i>&nbsp; TAMBAH JABATAN</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <!-- JABATAN -->
            <div class="col-sm-12 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">JABATAN</label>
                <input required name="jabatan" type="text" class="form-control fw-bold" placeholder="Nama Jabatan">
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button name="saveJabatan" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
          <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal -->