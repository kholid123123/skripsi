<?php
$menu1         = strtolower($this->uri->segment(1));
$sub_menu2     = strtolower($this->uri->segment(2));
$sub_menu3     = strtolower($this->uri->segment(3));
$id             = strtolower($this->uri->segment(4));
$md = $this->db->get_where("tbl_lembaga")->row(1);
$sql = $this->db->get_where("tbl_ska", array('id_ska' => "$id"))->row();
// echo '<pre>';
// print_r($sql->ska_isi);
// die;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $sql->ska_no_urut . ' - ' . $sql->ska_hal; ?></title>
    <base href="<?php echo base_url(); ?>" />
</head>
<style type="text/css">
    @font-face {
        font-family: "James_Fajardo";
        src: url("assets/fonts/James_Fajardo.ttf");
        src: url("assets/fonts/James_Fajardo.ttf") format("ttf"),
            url("assets/fonts/James_Fajardo.ttf") format("truetype");
    }

    @page {
        margin-top: 1.5cm;
        margin-left: 1.5cm;
        margin-right: 1.5cm;
        margin-bottom: 0.1cm;
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
        font-size: 15pt;
        
        text-transform: uppercase;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        margin-bottom: -20px;
    }

    .kop_2 {
        font-size: 16pt;
        font-weight: bold;
        text-transform: uppercase;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        margin-bottom: -20px;
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
    .underline-bold {
    text-decoration: underline;
    font-weight: bold;
    }
.kode-pos {
    /* font-size: 10pt; */
    margin-top: -22px;
    display: block;
    text-align: right;
}




</style>

<body>
    <table style="margin-top: -25px;">
        <tr>
            <td width="80">
                <img src="<?php echo base_url(); ?>foto/profil_1.png" alt="logo" width="100">
            </td>
            <td>
                <p class="kop_1"><?php echo $md->kop_1; ?></p>
                <p class="kop_2"><?php echo $md->kop_2; ?></p>
                <p class="jln"><?php echo $md->alamat . ','. $md->telp. ', email: ' . $md->email; ?></p>
                <p class="email"><?php echo '<strong style="font-size: 16pt;">BANGKALAN</strong>'; ?></p>
                <p class="jln"><?php echo  ' <span class="kode-pos">Kode Pos: 69151</span>'; ?></p>

            </td>
        </tr>
    </table>

    <table style="margin-top: -20px;">
        <tr>
            <td colspan="4">
                <hr>
            </td>
        </tr>
        <tr>
            <td width=" 7%">Nomor</td>
            <td width="1%">: </td>
            <td width="25%"><?php echo $sql->ska_no_surat; ?></td>
            <td width="15%" style="text-align: right;"><?php echo '<span>Arosbaya,</span> ' . format_indo($sql->ska_tanggal); ?></td>

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
            <td colspan="4">Kepada Yth.</td>
        </tr>
        <tr>
            <td colspan="4"><?php echo implode('<br>', explode(';', $sql->ska_kpd)); ?></td>
        </tr>
    </table>
    <!-- <p class="paragraf"><?php echo $sql->ska_text_pembuka; ?></p> -->
    <p class="paragraf"><?php echo $sql->ska_isi; ?></p>
    <!-- <p class="paragraf"><?php echo $sql->ska_text_penutup; ?></p> -->
    <table style="margin-top: 40px;">
        <tr>
            <td width="65%"></td>
            <td width="35%"><?php echo $md->jabatan; ?></td>
        </tr>
        <tr>
            <td></td>
          <td>
    <?php 
    if ($sql->ska_jenis == 1) {
        echo "<br><br><img src='foto/ttd.png' alt='Tanda Tangan'><br><br>";
    } else {
        echo "<br><br><br><br>";
    } 
    ?>
</td>

        </tr>
        <tr>
            <td></td>
            <td>
            <span class="underline-bold"><?php echo strtoupper($md->nm_kepala); ?></span><br>
               Pembina<br>
                NIP. <?php echo strtoupper($md->nip); ?>
            </td>
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
</body>

</html>