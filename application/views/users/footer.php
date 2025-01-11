<!-- /content area -->
</div>
<!-- Footer -->
<footer class="footer">
  <div class="container">
    <div class="copyright ml-auto">
      <b><?php echo  date('Y') .  " &copy " ?> <i class="fa fa-buysellads" aria-hidden="true"></i>dministrasi</b>
    </div>
  </div>
</footer>
<!-- /footer -->
<!-- /main content -->
</div>
<!-- /page content -->
</div>
<!-- /page container -->
<!-- Modal resetPassword-->
<div class="modal fade" id="resetPassword" tabindex="-1" role="dialog" aria-labelledby="resetPassword">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fw-bold"><i class="fas fa-user-cog"></i>&nbsp; UBAH SANDI</h3>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
      </div>
      <form action="<?php echo base_url(); ?>users/" method="post" enctype="multipart/form-data">
        <div class="modal-body text-left">
          <span class="fw-bold">Ubah Sandi/Password</span> <br> <small>
            Silahkan buat sandi dengan kombinasi Angka, Huruf Besar/Kecil dan Simbol.
          </small>
          <div class="row mt-4">
            <div class="col-sm-12 text-left">
              <div class="form-group form-group-default">
                <input name="id" type="hidden" class="form-control fw-bold" value="<?php echo $user->row()->id_user ?>">
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
          <button name="updateSandiAkun" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
          <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal -->
<!-- Modal addPegawai -->
<div class="modal fade" id="editPegawai" tabindex="-1" role="dialog" aria-labelledby="editPegawai">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold"><i class="fas fa-user-edit"></i>&nbsp; EDIT PROFIL</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
      </div>
      <form action="<?php echo base_url(); ?>users/" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <!-- JENIS PEGAWAI -->
            <div class="col-sm-12 text-left mb-4">
              <h4 class="small fw-bold">JENIS PEGAWAI</h4>
              <label class="form-radio-label">
                <input class="form-radio-input form-control" type="radio" name="jenis" value="0" <?php if ($user->row()->pegawai_jenis == 0) {
                                                                                                    echo "checked";
                                                                                                  } ?>>
                <span class="form-radio-sign fw-bold">&nbsp; PNS</span>
              </label>
              <label class="form-radio-label">
                <input class="form-radio-input form-control" type="radio" name="jenis" value="1" <?php if ($user->row()->pegawai_jenis == 1) {
                                                                                                    echo "checked";
                                                                                                  } ?>>
                <span class="form-radio-sign fw-bold">&nbsp; PPPK/P3K</span>
              </label>
              <label class="form-radio-label">
                <input class="form-radio-input form-control" type="radio" name="jenis" value="2" <?php if ($user->row()->pegawai_jenis == 2) {
                                                                                                    echo "checked";
                                                                                                  } ?>>
                <span class="form-radio-sign fw-bold">&nbsp; NON PNS/PPPK</span>
              </label>
            </div>
            <!-- NAMA LENGKAP -->
            <div class="col-sm-12 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold"><i class="fas fa-address-card"></i> NAMA LENGKAP PEGAWAI<small class="text-danger">*</small></label>
                <input name="id" type="hidden" class="form-control fw-bold" value="<?php echo $user->row()->id_user; ?>">
                <input required name="nama" type="text" class="form-control fw-bold" placeholder="Masukkan Nama Lengkap" value="<?php echo $user->row()->pegawai_nama; ?>">
                <small class="text-muted">*Nama pegawai berdasarkan ijazah</small>
              </div>
            </div>
            <!-- NIP -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default bg-dop">
                <label class="text-primary fw-bold">NIP</label>
                <input readonly name="nip" type="number" maxlength="18" class="form-control fw-bold" value="<?php echo $user->row()->pegawai_nip; ?>">
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
                    if ($id == $user->row()->pegawai_pangkat) {
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
                <input class="form-radio-input form-control" type="radio" name="jk" value="L" <?php if ($user->row()->pegawai_jk == "L") {
                                                                                                echo "checked";
                                                                                              } ?>>
                <span class="form-radio-sign fw-bold">&nbsp; Laki-laki</span>
              </label>
              <label class="form-radio-label">
                <input class="form-radio-input form-control" type="radio" name="jk" value="P" <?php if ($user->row()->pegawai_jk == "P") {
                                                                                                echo "checked";
                                                                                              } ?>>
                <span class="form-radio-sign fw-bold">&nbsp; Perempuan</span>
              </label>
            </div>
            <!-- TEMPAT LAHIR -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">TEMPAT LAHIR</label>
                <input required name="tplahir" type="text" class="form-control fw-bold" placeholder="Masukkan Tempat Lahir" value="<?php echo $user->row()->pegawai_tempat_lahir; ?>">
              </div>
            </div>
            <!-- TANGGAL LAHIR -->
            <div class="col-sm-6 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">TANGGAL LAHIR</label>
                <input required name="tgllahir" type="date" class="form-control fw-bold" value="<?php echo $user->row()->pegawai_tanggal_lahir; ?>">
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
                    if ($id == $user->row()->pegawai_pdd) {
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
                <input required name="telp" type="number" class="form-control fw-bold" placeholder="Masukkan Telp" value="<?php echo $user->row()->pegawai_telp; ?>">
              </div>
            </div>
            <!-- ALAMAT EMAIL -->
            <div class="col-sm-12 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">ALAMAT EMAIL</label>
                <input name="email" type="email" class="form-control fw-bold" placeholder="Masukkan Alamat Email" value="<?php echo $user->row()->pegawai_email; ?>">
              </div>
            </div>
            <!-- TEMPAT TINGGAL -->
            <div class="col-sm-12 text-left">
              <div class="form-group form-group-default">
                <label class="text-primary fw-bold">ALAMAT TINGGAL</label>
                <input name="alamat" type="alamat" class="form-control fw-bold" placeholder="Masukkan Alamat Tempat Tinggal" value="<?php echo $user->row()->pegawai_alamat; ?>">
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
<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.js"></script>
<script src="<?php echo base_url(); ?>assets/js/core/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/datatables/dataTables.rowReorder.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/datatables/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugin/jquery_zoom/jquery.zoom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugin/countdown/jquery.countdownTimer.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/jquery.validate/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/select2/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/select2/bootstrap_multiselect.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/atlantis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    var cs = $('#basic-datatables').DataTable({
      "lengthMenu": [
        [10, 15, 25, 100, -1],
        [10, 15, 25, 100, "All"]
      ],
      "searching": true,
      "paging": true,
      "order": [
        [3, "asc"]
      ],
      rowReorder: {
        selector: 'td:nth-child(3)'
      },
      responsive: true
    });
    cs.on('order.dt search.dt', function() {
      cs.column(0, {
        search: 'applied',
        order: 'applied'
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1;
      });
    }).draw();
    $('#alert-logout-header').click(function() {
      var getLink = $(this).attr('href');
      swal({
        title: "Apakah Anda Yakin?",
        text: "Anda akan keluar/logout dari aplikasi!",
        icon: "warning",
        // buttons: true,
        buttons: ["Batal", "Oke, Keluar"],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          setTimeout(function() {
            swal('Successfully Logout', 'Anda berhasil keluar, tunggu beberapa saat!', {
              icon: 'success',
              buttons: false,
            });
          }, 10);
          window.setTimeout(function() {
            window.location.replace(getLink);
          }, 1500);
        }
      });
      return false;
    });
    $('#alert-logout-sidebar').click(function() {
      var getLink = $(this).attr('href');
      swal({
        title: "Apakah Anda Yakin?",
        text: "Anda akan keluar/logout dari aplikasi!",
        icon: "warning",
        // buttons: true,
        buttons: ["Batal", "Oke, Keluar"],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          setTimeout(function() {
            swal('Successfully Logout', 'Anda berhasil keluar, tunggu beberapa saat!', {
              icon: 'success',
              buttons: false,
            });
          }, 10);
          window.setTimeout(function() {
            window.location.replace(getLink);
          }, 1500);
        }
      });
      return false;
    });

    if (isSuratKeluar) {
      changeNoSurat()
    }else{
      changeNoAgenda()
    }
      
    $(".select2").select2();
  });

  function changeNoSurat(element =null){
    var nosurat = $("[name='no_surat']").val().split('/')
    const kodesurat = '101.6.21.770'
    const nourut = $("[name='no_urut']").val()
    
    const typeel = $(element).attr('name')
    const valel = $(element).val()
    switch (typeel) {
      case 'tahun':
        nosurat[3] = valel
        break;
      case 'kode_surat':
        nosurat[0] = valel
        break;
    
      default:
        nosurat[1] = nourut
        break;
    }
    nosurat[1] = nourut
    $("[name='no_surat']").val(nosurat.join('/'))
  }

  function changeNoAgenda(element =null){
    const nosekolah = $("[name='nomor_sekolah']").val()
    var noagenda = $("[name='agenda']")
    // noagenda.val(`_/${nosekolah}/_`)
    var noagendaArr = noagenda.val().split('/')
    
    const typeel = $(element).attr('name')
    const valel = $(element).val()
    switch (typeel) {
      case 'tahun':
        noagendaArr[2] = valel
        break;
      case 'klasifikasi':
        noagendaArr[0] = valel
        break;
    
      default:
        noagendaArr[1] = nosekolah
        break;
    }
    noagendaArr[1] = nosekolah
    $("[name='agenda']").val(noagendaArr.join('/'))
  }

  function deleteData(id, uri) {
    var url = $(this).attr('href');
    var getLink = base_url + uri + id;
    if (swal({
        title: "Apakah Anda Yakin?",
        text: "Data terpilih akan dihapus!",
        icon: "warning",
        buttons: ["Batal", "Oke, Hapus"],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          window.location.href = getLink
        }
      }));
    return false;
  }

  function validasiFoto() {
    var inputFileFoto = document.getElementById('foto');
    var pathFileFoto = inputFileFoto.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (!ekstensiOk.exec(pathFileFoto)) {
      $('.result_default').hide();
      $('#result_foto').show();
      $('#result_foto').text('*Ekstensi file Foto tidak diperbolehkan!');
      $.notify({
        // options
        icon: 'flaticon-error',
        message: '*Ekstensi file Foto tidak diperbolehkan!'
      }, {
        // settings
        type: 'warning',
        delay: 3000,
        placement: {
          from: "top",
          align: "right"
        }
      });
      inputFileFoto.value = '';
      return false;
    } else {
      if (inputFileFoto.files && inputFileFoto.files[0]) {
        $('.img-thumbnail').remove();
        var reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('pratinjauFoto').innerHTML = '<img src="' + e.target.result + '" class="img-thumbnail" width="70%" />';
          $('.result_default').show();
          $('#result_foto').hide();
        };
        reader.readAsDataURL(inputFileFoto.files[0]);
      }
    }
  }
  $('#catatan').fadeOut("slow");

  function opsiCatatan() {
    var x = document.getElementById("dibaca").value;
    if (x == "0") {
      $('#catatan').fadeIn("slow");
    } else {
      $('#catatan').fadeOut("slow");
    }
  }
</script>
</body>

</html>