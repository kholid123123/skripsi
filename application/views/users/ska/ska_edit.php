<script type="text/javascript">
    function getNumber() {
        var no = document.getElementById("tanggal").value;
        let result = no.substring(8, 10)
        document.getElementById("no_awal").value = result;

    }
</script>
<?php
$sql = $this->db->query("SELECT MAX(ska_no_urut) as noUrut FROM tbl_ska")->row();
$no_max =  $sql->noUrut;
$urutan = (int) substr($no_max, 1, 3);
$urutan++;
$no = sprintf("%03s", $urutan);
?>
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between mb-4">
                    <div>
                        <h3 class="card-title mb-0 font-weight-bold">Edit Surat Keluar</h3>
                        <div class="small text-muted"><?php echo $md->nm_lembaga; ?></div>
                    </div>
                    <div class="btn-toolbar">
                    </div>
                </div>
                <div class="col-lg-12">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <!-- ska -->
                            <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold"><i class="far fa-calendar-alt"></i> TGL. SURAT</label>
                                    <input required name="tanggal" id="tanggal" type="date" class="form-control fw-bold" value="<?php echo $query->ska_tanggal ?>" onchange="getNumber()">
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">JENIS SURAT</label>
                                    <select required name="jenis" class="custom-select form-control fw-bold">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $kodeJenisSurat = array(
                                            1 => "TTE",
                                            2 => "Biasa",
                                        );
                                        foreach ($kodeJenisSurat as $id => $value) {
                                            if ($id == $query->ska_jenis) {
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
                            <!-- ska -->
                            <div class="col-sm-3 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">NO AWAL</label>
                                    <input type="hidden" name="id" value="<?php echo $query->id_ska ?>">
                                    <input readonly required name="no_awal" id="no_awal" type="text" class="form-control fw-bold" placeholder="Masukkan Kode Surat Awal" value="<?php echo $query->ska_no_awal ?>">
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-3 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">NO URUT SEMENTARA</label>
                                    <input readonly name="no_urut" type="text" class="form-control fw-bold" placeholder="Belum Terbit"" value=" <?php echo $no; ?>">
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">NO SURAT</label>
                                    <input required name="no_surat" type="text" class="form-control fw-bold" placeholder="Masukkan Nomor Surat Selanjutnya" value="<?php echo $query->ska_no_surat ?>">
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-3 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">LAMPIRAN</label>
                                    <input required name="lampiran" type="text" class="form-control fw-bold" placeholder="Masukkan Lampiran" value="<?php echo $query->ska_lampiran ?>">
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-3 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">SIFAT</label>
                                    <input required name="sifat" type="text" class="form-control fw-bold" placeholder="Masukkan Sifat Surat" value="<?php echo $query->ska_sifat ?>">
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">PERIHAL</label>
                                    <input name="perihal" type="text" class="form-control fw-bold" placeholder="Masukkan Jumlah Lampiran" value="<?php echo $query->ska_hal ?>">
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default bg-dop">
                                    <label class="text-primary fw-bold"><i class="fas fa-user"></i> KEPADA</label>
                                    <input required name="kepada" type="text" class="form-control fw-bold" placeholder="1. KepadaSatu; 2. KepadaDua; 3. KepadaTiga" value="<?php echo $query->ska_kpd ?>">
                                    <small class="fw-bold text-danger">*Pisahkan dengan titik koma (;) jika penerima lebih dari satu.</small>
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-6 text-left mb-2">
                                <div class="form-group form-group-default bg-dop">
                                    <label class="text-primary fw-bold"><i class="fas fa-building"></i> TEMBUSAN</label>
                                    <input required name="tembusan" type="text" class="form-control fw-bold" placeholder="1. TembusanSatu; 2. TembusanDua; 3. TembusanTiga" value="<?php echo $query->ska_tembusan ?>">
                                    <small class="fw-bold text-danger">*Pisahkan dengan titik koma (;) jika penerima lebih dari satu.</small>
                                </div>
                            </div>
                            <!-- ska -->
                            <!-- <div class="col-sm-12 text-left mb-2 mt-2">
                                <div class="form-group form-group-default bg-info">
                                    <label class="text-white fw-bold"><i class="fas fa-file-signature"></i> KALIMAT PEMBUKA</label>
                                </div>
                                <textarea class="ckeditor" id="ckedtor" name="pembuka"><?php echo $query->ska_text_pembuka ?></textarea>
                            </div> -->
                            <!-- ska -->
                            <div class="col-sm-12 text-left mb-2 mt-2">
                                <div class="form-group form-group-default bg-info">
                                    <label class="text-white fw-bold"><i class="fas fa-file-signature"></i> ISI SURAT</label>
                                </div>
                                <textarea class="ckeditor" id="ckedtor" name="isi"><?php echo $query->ska_isi ?></textarea>
                            </div>
                            <!-- ska -->
                            <!-- <div class="col-sm-12 text-left mb-2 mt-2">
                                <div class="form-group form-group-default bg-info">
                                    <label class="text-white fw-bold"><i class="fas fa-file-signature"></i> KALIMAT PENUTUP</label>
                                </div>
                                <textarea class="ckeditor" id="ckedtor" name="penutup"><?php echo $query->ska_text_penutup ?></textarea>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <button name="updateSKA" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
                        <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>