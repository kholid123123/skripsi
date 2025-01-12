<script type="text/javascript">
    function getNumber() {
        var no = document.getElementById("tanggal").value;
        let result = no.substring(8, 10)
        document.getElementById("no_awal").value = result;

    }
</script>
<?php
$harian = date('Y-m-d');
$sql = $this->db->query("SELECT count(*) as noUrut FROM tbl_ska")->row();
$urutan =  $sql->noUrut;
// $urutan = (int) substr($no_max, 1, 3);
$urutan++;
$no = sprintf("%03s", $urutan);
?>
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h3 class="card-title mb-0 font-weight-bold">Buat Surat Keluar</h3>
                        <div class="small text-muted"><?php echo $md->nm_lembaga; ?></div>
                    </div>
                    <div class="btn-toolbar">
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <!-- ska -->
                            <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold"><i class="far fa-calendar-alt"></i> TGL. SURAT</label>
                                    <input required name="tanggal" id="tanggal" type="date" class="form-control fw-bold" value="<?php echo date('Y-m-d'); ?>" onchange="getNumber()">
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default">
                                    <!-- <label class="text-primary fw-bold">JENIS SURAT</label> -->
                                    <label class="text-primary fw-bold">JENIS TANDA TANGAN SURAT</label>
                                    <select required name="jenis" class="custom-select form-control fw-bold">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $kodeJenisSurat = array(
                                            1 => "TTE",
                                            2 => "Biasa",
                                        );
                                        foreach ($kodeJenisSurat as $id => $value) {
                                            echo "<option value='$id'>$value</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- ska -->
                       
                            <!-- ska -->
                            <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default bg-dop">
                                    <!-- <label class="text-primary fw-bold">NO BERKAS DAN NO URUT</label> -->
                                    <label class="text-primary fw-bold">NO URUT</label>
                                    <input required name="no_urut" type="text" class="form-control fw-bold" value="<?php echo $no; ?>" readonly>
                                </div>
                            </div>
                            <!-- ska -->
                            <!-- <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">NO SURAT</label>
                                    <input required name="no_surat" type="text" class="form-control fw-bold" placeholder="Masukkan Nomor Surat Selanjutnya">
                                </div>
                            </div> -->


                            <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold"><i class="fas fa-bookmark"></i> KODE SURAT</label>
                                    <select onchange="changeNoSurat(this)" required name="kode_surat" class="custom-select form-control fw-bold select2">
                                    <option value="">Pilih Kode Surat</option>
                                    <?php
                                    // Array yang berisi daftar kode surat
                                    $kodeSurat = array(
                                        '000' => "000 : UMUM",
                                        '001.3' => " 001.3 : LAMBANG DAERAH",
                                        '002' => "002 : TANDA PENGHARGAAN",
                                        '002.6' => " 002.6 : SERTIFIKAT/ PIAGAM",
                                        '003' => "003 : HARI BESAR/HARI RAYA",
                                        '004' => "004 : UCAPAN TERIMAKASIH ",
                                        '005' => "005 : UNDANGAN",
                                        '011' => "011 : -",
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
                                        '058' => "058 : BIDANG KEPEGAWAIAN",
                                        '061' => "061 : INST PEMERINTAH",
                                        '062' => "062 : ORG NON PEM",// nomernya blm jelas
                                        '072' => "072 : SURVEY",
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
                                        '188.4' => "188.4 : KEPUTUSAN",
                                        '188.5' => "188.5 : PANITIA KEGIATAN",
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
                                        '975' => "975 : BEA"
                                        
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

<div class="col-sm-6 text-left">
    <div class="form-group form-group-default">
        <label class="text-primary fw-bold"><i class="fas fa-calendar-alt"></i> TAHUN</label>
        <select onchange="changeNoSurat(this)" required name="tahun" class="custom-select form-control fw-bold select2">
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

<div class="col-sm-6 text-left">
    <div class="form-group form-group-default">
    <label class="text-primary fw-bold"><i class="fas fa-school"></i> NOMOR SURAT SEKOLAH</label>
        <input required name="no_surat" type="text" class="form-control fw-bold"
            value="<?php
                // Ambil nilai dari dropdown kode_surat dan tahun
                $no = isset($_POST['kode_surat']) ? $_POST['kode_surat'] : '0'; // $no untuk kode surat
                $i = isset($_POST['tahun']) ? $_POST['tahun'] : '0'; // $i untuk tahun
                
                // Tampilkan No Surat dalam format dinamis
                // echo $no . '/101.6.21.770/' . $i;
                echo "_/_/101.6.21.770/_";
            ?>"
            readonly>
    </div>
</div>


                            
                            <!-- ska -->
                            <div class="col-sm-3 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">LAMPIRAN</label>
                                    <input name="lampiran" type="text" class="form-control fw-bold" placeholder="Masukkan Lampiran">
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-3 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">SIFAT</label>
                                    <input name="sifat" type="text" class="form-control fw-bold" placeholder="Masukkan Sifat Surat">
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default">
                                    <label class="text-primary fw-bold">PERIHAL/JUDUL SURAT</label>
                                    <input required name="perihal" type="text" class="form-control fw-bold" placeholder="Masukkan Perihal/Judul Surat">
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-6 text-left">
                                <div class="form-group form-group-default bg-dop">
                                    <label class="text-primary fw-bold"><i class="fas fa-user"></i> KEPADA</label>
                                    <input required name="kepada" type="text" class="form-control fw-bold" placeholder="1. KepadaSatu; 2. KepadaDua; 3. KepadaTiga">
                                    <small class="fw-bold text-danger">*Pisahkan dengan titik koma (;) jika penerima lebih dari satu.</small>
                                </div>
                            </div>
                            <!-- ska -->
                            <div class="col-sm-6 text-left mb-2">
                                <div class="form-group form-group-default bg-dop">
                                    <label class="text-primary fw-bold"><i class="fas fa-building"></i> TEMBUSAN</label>
                                    <input name="tembusan" type="text" class="form-control fw-bold" placeholder="1. TembusanSatu; 2. TembusanDua; 3. TembusanTiga">
                                    <small class="fw-bold text-danger">*Pisahkan dengan titik koma (;) jika penerima lebih dari satu.</small>
                                </div>
                            </div>
                            <!-- ska -->
                            <!-- <div class="col-sm-12 text-left mb-2 mt-2">
                                <div class="form-group form-group-default bg-info">
                                    <label class="text-white fw-bold"><i class="fas fa-file-signature"></i> KALIMAT PEMBUKA</label>
                                </div>
                                <textarea class="ckeditor" id="ckedtor" name="pembuka"></textarea>
                            </div> -->
                            <!-- ska -->
                            <div class="col-sm-12 text-left mb-2 mt-2">
                                <div class="form-group form-group-default bg-info">
                                    <label class="text-white fw-bold"><i class="fas fa-file-signature"></i> ISI SURAT</label>
                                </div>
                                <textarea class="ckeditor" id="ckedtor" name="isi"></textarea>
                            </div>
                            <!-- ska -->
                            <!-- <div class="col-sm-12 text-left mb-2 mt-2">
                                <div class="form-group form-group-default bg-info">
                                    <label class="text-white fw-bold"><i class="fas fa-file-signature"></i> KALIMAT PENUTUP</label>
                                </div>
                                <textarea class="ckeditor" id="ckedtor" name="penutup"></textarea>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <button name="saveSKA" type="submit" class="btn btn-sm btn-primary fw-bold"><i class="fa fa-check"></i> Simpan</button>
                        <button type="button" class="btn btn-sm btn-danger fw-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const isSuratKeluar = true;
</script>