<style type="text/css">
    @font-face {
        font-family: "James_Fajardo";
        src: url("assets/fonts/James_Fajardo.ttf");
        src: url("assets/fonts/James_Fajardo.ttf") format("ttf"),
            url("assets/fonts/James_Fajardo.ttf") format("truetype");
    }

    @page {
        margin-top: 2cm;
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 2cm;
    }

    body {
        font-family: Arial, Helvetica, sans-serif, 'James Fajardo';
    }

    table {
        font-family: Arial, Helvetica, sans-serif, arial, sans-serif;
        font-size: 14px;
        color: #000;
        border-width: none;
        border-collapse: collapse;
        width: 100%;
    }

    th {
        padding-bottom: 8px;
        padding-top: 8px;
        border-color: #666666;
        background-color: #dedede;
        text-align: left;
    }

    td {
        text-align: left;
    }

    .nmr_srt {
        font-family: 'James Fajardo';
        font-weight: normal;
        font-size: 14px;
        vertical-align: middle;
        padding: 0 2px;
    }

    .kop_1 {
        font-size: 16pt;
        font-weight: bold;
        text-transform: uppercase;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        margin-bottom: -15px;
    }

    .kop_2 {
        font-size: 14pt;
        font-weight: bold;
        text-transform: uppercase;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        margin-bottom: -10px;
    }

    .jln {
        font-size: 10pt;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
    }

    .email {
        font-size: 10pt;
        margin-top: -22px;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
    }

    .paragraf {
        font-size: 10pt;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table>
                        <tr>
                            <td width="80">
                                <img src="<?php echo base_url(); ?>foto/logo.png" alt="logo" width="100">
                            </td>
                            <td>
                                <p class="kop_1"><?php echo $md->kop_1; ?></p>
                                <p class="kop_2"><?php echo $md->kop_2; ?></p>
                                <p class="jln"><?php echo $md->alamat . ' - ' . $md->kabupaten . ' - ' . $md->provinsi ?></p>
                                <p class="email"><?php echo 'Email: ' . $md->email . ' Telp. ' . $md->telp; ?></p>
                            </td>
                        </tr>
                    </table>

                    <table style="margin-top: -10px;">
                        <tr>
                            <td colspan="4">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td width=" 7%">Nomor</td>
                            <td width="1%">: </td>
                            <td width="25%"><?php echo $sql->ska_no_awal . '<span class="nmr_srt">' . $sql->ska_no_urut . '</span>' . $sql->ska_no_surat; ?></td>
                            <td width="15%" style="text-align: right;">
                                <?php echo format_indo($sql->ska_tanggal); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Sifat</td>
                            <td>: </td>
                            <td colspan="2"><?php echo $sql->ska_sifat; ?></td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td>: </td>
                            <td colspan="2"><?php echo $sql->ska_lampiran; ?></td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>: </td>
                            <td colspan="2"><?php echo $sql->ska_hal ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"><br></td>
                        </tr>
                        <tr>
                            <td colspan="4">Yth.</td>
                        </tr>
                        <tr>
                            <td colspan="4"><?php echo implode('<br>', explode(';', $sql->ska_kpd)); ?></td>
                        </tr>
                    </table>
                    <p class="paragraf"><?php echo $sql->ska_text_pembuka; ?></p>
                    <p class="paragraf"><?php echo $sql->ska_isi; ?></p>
                    <p class="paragraf"><?php echo $sql->ska_text_penutup; ?></p>
                    <table>
                        <tr>
                            <td width="60%"></td>
                            <td width="40%"><?php echo $md->jabatan; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?php echo $md->nm_lembaga; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <?php if ($sql->ska_jenis == 1) {
                                    echo "<br><br>^<br><br><br>";
                                } else {
                                    echo "<br><br><br><br>";
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?php echo $md->nm_kepala; ?></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td width="60%">Tembusan:</td>
                        </tr>
                        <tr>
                            <td><?php echo implode('<br>', explode(';', $sql->ska_tembusan)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>