<!-- HTML Code -->
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
                                <th class="text-center">No.</th>
                                <th class="text-center">Status</th>
                                <th>Diterima Tgl.</th>
                                <th>Instansi</th>
                                <th>Perihal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($ktu->result() as $baris) {
                            ?>
                                <tr>
                                    <td class="text-center fw-bold"><?php echo $no; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($baris->sm_dibaca == 3) { ?>
                                            <span class="badge badge-success fw-bold"><i class="fas fa-check-circle"></i>&nbsp; Disposisi</span>
                                        <?php } elseif ($baris->sm_dibaca == 2) { ?>
                                            <span class="badge badge-primary fw-bold"><i class="fas fa-bell"></i>&nbsp; Diajukan</span>
                                        <?php } elseif ($baris->sm_dibaca == 1) { ?>
                                            <span class="badge badge-warning fw-bold"><i class="fas fa-spinner"></i>&nbsp; Menunggu</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger fw-bold"><i class="fas fa-exclamation-triangle"></i>&nbsp; Koreksi</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo format_indo($baris->sm_tgl_diterima); ?></td>
                                    <td><?php echo $baris->sm_pengirim; ?></td>
                                    <td><?php echo $baris->sm_perihal; ?></td>
                                    <td>
                                        <?php if ($baris->sm_dibaca == 2) { ?>
                                            <a href="" class="btn btn-info btn-sm mt-1 mb-1 fw-bold" data-toggle="modal" data-target="#detailSM<?php echo $baris->id_sm; ?>"><i class="fas fa-eye"></i> Detail</a>
                                        <?php } elseif ($baris->sm_dibaca == 1) { ?>
                                            <a href="" class="btn btn-info btn-sm mt-1 mb-1 fw-bold" data-toggle="modal" data-target="#detailSM<?php echo $baris->id_sm; ?>"><i class="fab fa-telegram-plane"></i> Ajukan</a>
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
                                                            <div class="col-lg-6">
                                                                <div class="table-responsive" style="overflow-x: auto;">
                                                                    <table class="table table-striped table-hover" cellspacing="0" style="width: 100%;">
                                                                        <thead class="bg-default table-bordered">
                                                                            <tr class="text-black">
                                                                                <th colspan="2">NOMOR AGENDA (<?php echo $baris->sm_no_urut; ?>)</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="table-bordered">
                                                                            <tr class="fw-bold">
                                                                                <td width="30%">Kode</td>
                                                                                <td width="70%"><?php echo $baris->sm_penerima; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Berkas</td>
                                                                                <td><?php echo $baris->sm_status; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Sifat</td>
                                                                                <td><span class="badge badge-success fw-bold mt-1 mb-1"><i class="fas fa-bell"></i>&nbsp;<?php echo $baris->sm_sifat; ?></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Diterima</td>
                                                                                <td><?php echo format_indo($baris->sm_tgl_diterima); ?></td>
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
                                                                            <tr class="fw-bold">
                                                                                <td width="30%">Status</td>
                                                                                <td width="70%">
                                                                                    <?php
                                                                                    if ($baris->sm_dibaca == 3) { ?>
                                                                                        <span class="badge badge-success fw-bold"><i class="fas fa-check-circle"></i>&nbsp; Verifikasi Kepala</span>
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
                                                                            if ($baris->sm_dibaca == 3) { ?>
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
                                                                                    <td><?php echo format_indo(substr($baris->sm_create, 0, 8)); ?></td>
                                                                                </tr>
                                                                            <?php } else { ?>
                                                                                <tr>
                                                                                    <td>Tanggal</td>
                                                                                    <td><?php echo format_indo(substr($baris->sm_create, 0, 8)); ?></td>
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
                                                                                        <td width="70%" id="no_surat_<?php echo $baris->id_sm; ?>"><?php echo $baris->sm_no_surat_asal; ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Instansi</td>
                                                                                        <td id="instansi_<?php echo $baris->id_sm; ?>"><?php echo $baris->sm_pengirim; ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Perihal</td>
                                                                                        <td class="p-4" id="perihal_<?php echo $baris->id_sm; ?>"><br /><?php echo $baris->sm_perihal; ?><br /><br /></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Tanggal Surat</td>
                                                                                        <td id="tgl_surat_<?php echo $baris->id_sm; ?>"><?php echo format_indo($baris->sm_tgl_surat); ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Lampiran</td>
                                                                                        <td id="lampiran_<?php echo $baris->id_sm; ?>"><?php echo $baris->sm_lampiran; ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>File</td>
                                                                                        <td>
                                                                                            <a href="<?php echo base_url(); ?>lampiran/surat_masuk/<?php echo $baris->nama_berkas; ?>" target="_blank" class="btn btn-xs btn-primary mb-1 mt-1 fw-bold"><i class="fas fa-eye"></i>&nbsp; Preview</a>
                                                                                            <a href="<?php echo base_url(); ?>lampiran/surat_masuk/<?php echo $baris->nama_berkas; ?>" target="_blank" class="btn btn-xs btn-primary mb-1 mt-1 fw-bold"><i class="fas fa-cloud-download-alt"></i>&nbsp; Download</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <form action="" method="post" enctype="multipart/form-data">
                                                                    <div class="row">
                                                                        <!-- TGL. AJUAN -->
                                                                        <div class="col-sm-6 text-left">
                                                                            <div class="form-group form-group-default bg-dop">
                                                                                <label class="text-primary fw-bold"><i class="far fa-calendar-alt"></i> TANGGAL AJUAN</label>
                                                                                <input readonly name="tgl_ajuan" type="text" value="<?php echo format_indo(date('Y-m-d')) ?>" class="form-control fw-bold">
                                                                                <input readonly name="id" type="hidden" value="<?php echo $baris->id_sm; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <!-- AJUKAN KE -->
                                                                        <div class="col-sm-6 text-left">
                                                                            <div class="form-group form-group-default bg-dop">
                                                                                <label class="text-primary fw-bold"><i class="fas fa-clipboard-check"></i> TINDAKAN SELANJUTNYA</label>
                                                                                <select required name="dibaca" id="dibaca_<?php echo $baris->id_sm; ?>" class="custom-select form-control fw-bold" onchange="prepareWhatsAppMessage('<?php echo $baris->id_sm; ?>')">
                                                                                    <option value="">--Pilih Tindakan--</option>
                                                                                    <option value="0" <?php echo ($baris->sm_dibaca == 0) ? 'selected' : '' ?>>Koreksi Kembali</option>
                                                                                    <option value="2" <?php echo ($baris->sm_dibaca == 2) ? 'selected' : '' ?>>Ajukan ke Kepala</option>
                                                                                    <?php if ($baris->sm_dibaca == 3) { ?>
                                                                                        <option value="3" <?php echo ($baris->sm_dibaca == 3) ? 'selected' : '' ?>>Verifikasi ke Kepala</option>
                                                                                    <?php } elseif ($baris->sm_dibaca == 4) { ?>
                                                                                        <option value="4" <?php echo ($baris->sm_dibaca == 4) ? 'selected' : '' ?>>Terbit</option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <!-- CATATAN -->
                                                                        <div class="col-sm-12 text-left" id="catatan">
                                                                            <div class="form-group form-group-default bg-dop">
                                                                                <label class="text-primary fw-bold"><i class="fas fa-file-alt"></i> CATATAN</label>
                                                                                <input name="catatan" type="catatan" class="form-control fw-bold" placeholder="Berikan catatan untuk surat ini jika diperlukan.">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php if ($baris->sm_dibaca == 1) { ?>
                                                            <button name="saveAjuan" type="submit" class="btn btn-sm btn-primary fw-bold" onclick="sendWhatsApp()"><i class="fa fa-check"></i> Update Data</button>
                                                        <?php } ?>
                                                        <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->
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

<!-- JavaScript Code -->
<script>
function prepareWhatsAppMessage(id) {
    const selectElement = document.getElementById(`dibaca_${id}`);
    if (selectElement.value === "2") {
        const noSurat = document.getElementById(`no_surat_${id}`).innerText;
        const instansi = document.getElementById(`instansi_${id}`).innerText;
        const perihal = document.getElementById(`perihal_${id}`).innerText;
        const tglSurat = document.getElementById(`tgl_surat_${id}`).innerText;
        const lampiran = document.getElementById(`lampiran_${id}`).innerText;

        const message = `Diberitahukan kepada ibu guru, surat masuk baru telah diterima dengan detail berikut:\n` +
                `- No. Surat: ${noSurat}\n` +
                `- Instansi: ${instansi}\n` +
                `- Perihal: ${perihal}\n` +
                `- Tanggal Surat: ${tglSurat}\n` +
                `- Lampiran: ${lampiran}\n\n` +
                // `Silakan cek detail surat melalui akun anda`;
                // `Silakan cek detail surat melalui akun anda: ` +
                // `https://sipsmkarosbaya.my.id/`;
                `Silakan cek detail surat melalui akun anda: https://sipsmkarosbaya.my.id/` ;
        sendWhatsApp('082333381891', message);
        // sendWhatsApp('0895631152500', message);
    }
}

function sendWhatsApp(target, message) {
    var formData = new FormData();
    formData.append('target', target);
    formData.append('message', message);

    fetch('https://api.fonnte.com/send', {
        method: 'POST',
        headers: {
            'Authorization': 'DPXLwojnJ2fNM5jixry1' // Ganti TOKEN dengan token aktual Anda 
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // Handle response as needed
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle error as needed
    });
}
</script>
