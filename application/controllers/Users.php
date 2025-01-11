<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('session', 'pdflibrary', 'pdfgenerator'));
	}
	public function index()
	{
		$ceks = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga", "lembaga_status = 1")->row();
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']   	= $this->Mcrud->get_users_by_un($ceks);
			$data['users']  	= $this->Mcrud->get_users();
			$data['jabatan'] 	= $this->db->get_where("tbl_bagian", array('id_bagian' => $data['user']->row()->bagian_id))->row();
			$data['judul_web'] 	= "Sistem Informasi Administrasi Surat | SIAS";

			$this->load->view('users/header', $data);
			$this->load->view('users/beranda', $data);
			$this->load->view('users/footer');

			if (isset($_POST['updateSandiAkun'])) {
				$id	 		= htmlentities(strip_tags($this->input->post('id')));
				$new_password	= htmlentities(strip_tags($this->input->post('newpassword')));
				$confirm_password	= htmlentities(strip_tags($this->input->post('confirmpassword')));

				if ($new_password == $confirm_password) {
					$data = array(
						'pegawai_password' 	=> sha1($new_password)
					);
					$this->Mcrud->update_user(array('id_user' => $id), $data);
					$this->session->set_flashdata(
						'msg',
						'
							<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									</button>
									<b>BERHASIL!</b><br />Password berhasil diupdate.
							</div>'
					);
				} else {
					$this->session->set_flashdata(
						'msg',
						'
							<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									</button>
									<b>GAGAL!</b><br />Password dan Konfirmasi Password tidak sama.
							</div>'
					);
				}
				redirect('users/');
			}
			if (isset($_POST['updatePegawai'])) {
				$id   	 		= htmlentities(strip_tags($this->input->post('id')));
				$nama   	 	= htmlentities(strip_tags($this->input->post('nama')));
				$tplahir	 	= htmlentities(strip_tags($this->input->post('tplahir')));
				$tgllahir	 	= htmlentities(strip_tags($this->input->post('tgllahir')));
				$jk	 			= htmlentities(strip_tags($this->input->post('jk')));
				$pdd	 		= htmlentities(strip_tags($this->input->post('pdd')));
				$telp	 		= htmlentities(strip_tags($this->input->post('telp')));
				$email	 		= htmlentities(strip_tags($this->input->post('email')));
				$alamat	 		= htmlentities(strip_tags($this->input->post('alamat')));
				$jenis	 		= htmlentities(strip_tags($this->input->post('jenis')));
				$pangkat	 	= htmlentities(strip_tags($this->input->post('pangkat')));

				$data = array(
					'pegawai_nama'	 	 	=> $nama,
					'pegawai_tempat_lahir'	=> $tplahir,
					'pegawai_tanggal_lahir'	=> $tgllahir,
					'pegawai_jk'	 	 	=> $jk,
					'pegawai_pdd'	 	 	=> $pdd,
					'pegawai_telp'	 	 	=> $telp,
					'pegawai_email'	 	 	=> $email,
					'pegawai_alamat'	 	=> $alamat,
					'pegawai_jenis'	 	 	=> $jenis,
					'pegawai_pangkat'	 	=> $pangkat,
					'lembaga_id'			=> $data['md']->id_lembaga
				);
				$this->Mcrud->update_user(array('id_user' => $id), $data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>BERHASIL!</strong><br />Pengguna berhasil diperbaharui.
					</div>'
				);
				redirect('users/');
			}
		}
	}

	public function md()
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$p = "md";
			$data['md'] 		  = $this->db->get_where("tbl_lembaga")->row(1);
			$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";

			$ceklevel = $data['user']->row()->pegawai_level;
			if ($ceklevel == 'kepala' or $ceklevel == 'ktu' or $ceklevel == 'kasi' or $ceklevel == 'staf') {
				redirect('404_content');
			} else {
				if (isset($_POST['updateLembaga'])) {
					$id			 		= htmlentities(strip_tags($this->input->post('id')));
					$lembaga			= htmlentities(strip_tags($this->input->post('lembaga')));
					$telp	 	  		= htmlentities(strip_tags($this->input->post('telp')));
					$alamat	 	  		= htmlentities(strip_tags($this->input->post('alamat')));
					$website			= htmlentities(strip_tags($this->input->post('website')));
					$email	 	  		= htmlentities(strip_tags($this->input->post('email')));
					$tahun	 	  		= htmlentities(strip_tags($this->input->post('tahun')));
					$kabupaten 	  		= htmlentities(strip_tags($this->input->post('kabupaten')));
					$provinsi	 	  	= htmlentities(strip_tags($this->input->post('provinsi')));
					$kepala	 			= htmlentities(strip_tags($this->input->post('kepala')));
					$nip	 			= htmlentities(strip_tags($this->input->post('nip')));
					$jabatan	 		= htmlentities(strip_tags($this->input->post('jabatan')));
					$kop_1	 	  		= htmlentities(strip_tags($this->input->post('kop1')));
					$kop_2	 	  		= htmlentities(strip_tags($this->input->post('kop2')));

					$data = array(
						'nm_lembaga'		=> $lembaga,
						'telp'	 			=> $telp,
						'alamat'	 		=> $alamat,
						'website'	 		=> $website,
						'email'	 			=> $email,
						'tahun'	 			=> $tahun,
						'kabupaten'			=> $kabupaten,
						'provinsi'			=> $provinsi,
						'nm_kepala'			=> $kepala,
						'nip'				=> $nip,
						'jabatan'			=> $jabatan,
						'kop_1'	 			=> $kop_1,
						'kop_2'	 			=> $kop_2,
					);
					$this->Mcrud->update_md(array('id' => $id), $data);
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Berhasil!</strong><br /> Data Lembaga berhasil disimpan.
						</div>'
					);
					redirect('users/md');
				}
				if (isset($_POST['updateFoto'])) {
					$namafile 		= 'profil_' . time() . $_FILES['userfiles']['name'];
					$format = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
					$this->upload->initialize(array(
						"file_name" 	=> $namafile,
						"upload_path"   => "./foto/",
						"max_size"		=> 1024,
						"allowed_types" => 'jpg|jpeg|gif|png'
					));
					if ($this->upload->do_upload('foto')) {
						$id		= htmlentities(strip_tags($this->input->post('id')));
						$foto	= htmlentities(strip_tags($this->input->post('foto_nama')));
						$data 	= array(
							'foto'	 			=> $namafile . '.' . $format,
						);
						$this->Mcrud->update_md(array('id' => $id), $data);
						$this->session->set_flashdata(
							'msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Berhasil!</strong><br /> Profil Sekolah berhasil disimpan.
							</div>'
						);
						unlink('./foto/' . $foto);
					} else {
						$this->session->set_flashdata(
							'msg',
							'
							<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Gagal!</strong><br /> Profil Sekolah gagal disimpan.
							</div>'
						);
					}
					redirect('users/md');
				}
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pengaturan/$p", $data);
			$this->load->view('users/footer');
		}
	}

	public function pengguna($aksi = '', $id = '')
	{
		$ceks = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga", "lembaga_status = 1")->row();
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$ceklevel = $data['user']->row()->pegawai_level;
			if ($ceklevel == 'kepala' or $ceklevel == 'ktu' or $ceklevel == 'kasi' or $ceklevel == 'staf' or $ceklevel == 'jfu') {
				redirect('404_content');
			}
			$this->db->order_by('pegawai_nama', 'ASC');
			$data['level_users']  = $this->Mcrud->get_level_users();
			$data['level_bagian']  = $this->Mcrud->get_bagian();
			if ($aksi == 't') {
				$p = "pengguna_tambah";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			} elseif ($aksi == 'd') {
				$p = "pengguna_detail";
				$data['query'] = $this->db->get_where("tbl_users", "id_user = '$id'")->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			} elseif ($aksi == 'e') {
				$p = "pengguna_edit";
				$data['query'] = $this->db->get_where("tbl_users", "id_user = '$id'")->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			} elseif ($aksi == 'h') {
				$data['query'] = $this->db->get_where("tbl_users", "id_user = '$id'")->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
				if ($ceks == $data['query']->pegawai_nip) {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
								<strong>GAGAL HAPUS DATA!</strong></br>Maaf, Anda tidak bisa menghapus pengguna "' . $ceks . '" ini.
						</div>'
					);
				} else {
					if ($data['query']->pegawai_status == 1) {
						$this->session->set_flashdata(
							'msg',
							'
							<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
									<strong>GAGAL HAPUS DATA!</strong></br>Maaf, Anda tidak bisa menghapus pengguna "' . $ceks . '" ini, karena pengguna masih aktif.
							</div>'
						);
					} else {
						$this->Mcrud->delete_user_by_id($id);
						$this->session->set_flashdata(
							'msg',
							'
						<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
						<strong>BERHASIL HAPUS DATA!</strong><br>Pengguna "' . $ceks . '" berhasil dihapus.
						</div>'
						);
					}
				}
				redirect('users/pengguna');
			} else {
				$p = "pengguna";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pengaturan/$p", $data);
			$this->load->view('users/footer');
			date_default_timezone_set('Asia/Jakarta');
			$tgl_create = date('Y-m-d H:i:s');
			if (isset($_POST['savePegawai'])) {
				$nama   	 	= htmlentities(strip_tags($this->input->post('nama')));
				$tplahir	 	= htmlentities(strip_tags($this->input->post('tplahir')));
				$tgllahir	 	= htmlentities(strip_tags($this->input->post('tgllahir')));
				$jk	 			= htmlentities(strip_tags($this->input->post('jk')));
				$pdd	 		= htmlentities(strip_tags($this->input->post('pdd')));
				$telp	 		= htmlentities(strip_tags($this->input->post('telp')));
				$email	 		= htmlentities(strip_tags($this->input->post('email')));
				$alamat	 		= htmlentities(strip_tags($this->input->post('alamat')));
				$jenis	 		= htmlentities(strip_tags($this->input->post('jenis')));
				$pangkat	 	= htmlentities(strip_tags($this->input->post('pangkat')));
				$nip	 		= htmlentities(strip_tags($this->input->post('nip')));
				$password	 	= htmlentities(strip_tags($this->input->post('nip')));
				$level	 		= htmlentities(strip_tags($this->input->post('level')));
				$status	 		= htmlentities(strip_tags($this->input->post('status')));
				$bagian	 		= htmlentities(strip_tags($this->input->post('jabatan')));

				$cek_user = $this->db->get_where("tbl_users", "pegawai_nip = '$nip'")->num_rows();
				
				$cek_level = $this->db->get_where("tbl_users", "pegawai_level = '$level'")->num_rows();
				
				$levelDiizinkan = ['staf','kasi','jfu'];
				if (in_array($level,$levelDiizinkan)) {
					if ($cek_user != 0) {
						$this->session->set_flashdata(
							'msg',
							'
							<div class="alert alert-warning alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									</button>
									<strong>GAGAL!</strong><br />NIP Pegawai "' . $nip . '" sudah terdaftar.
							</div>'
						);
					} else {
						$data = array(
							'pegawai_nama'	 	 	=> $nama,
							'pegawai_tempat_lahir'	=> $tplahir,
							'pegawai_tanggal_lahir'	=> $tgllahir,
							'pegawai_jk'	 	 	=> $jk,
							'pegawai_pdd'	 	 	=> $pdd,
							'pegawai_telp'	 	 	=> $telp,
							'pegawai_email'	 	 	=> $email,
							// 'pegawai_foto'	 	 	=> $foto,
							'pegawai_alamat'	 	=> $alamat,
							'pegawai_jenis'	 	 	=> $jenis,
							'pegawai_pangkat'	 	=> $pangkat,
							'pegawai_nip'	 	 	=> $nip,
							'pegawai_password'	 	=> sha1($password),
							'pegawai_level'	 	 	=> $level,
							'pegawai_status'	 	=> $status,
							'pegawai_create'	 	=> $tgl_create,
							'bagian_id'	 	 		=> $bagian,
							'lembaga_id'			=> $data['md']->id_lembaga
						);
						$this->Mcrud->save_user($data);
						$this->session->set_flashdata(
							'msg',
							'
								<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										</button>
										<strong>BERHASIL!</strong><br />Pengguna berhasil ditambahkan.
								</div>'
						);
					}
				} else if ($cek_level != 0) {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
								<strong>PERINGATAN!</strong><br>Hak akses "' . $level . '" sedang aktif. Silahkan nonaktifkan terlebih dahulu akun "' . $level . '"
						</div>'
					);
				} else {
					if ($cek_user != 0) {
						$this->session->set_flashdata(
							'msg',
							'
							<div class="alert alert-warning alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									</button>
									<strong>GAGAL!</strong><br /> NIP Pegawai "' . $nip . '" sudah terdaftar.
							</div>'
						);
					} else {
						$data = array(
							'pegawai_nama'	 	 	=> $nama,
							'pegawai_tempat_lahir'	=> $tplahir,
							'pegawai_tanggal_lahir'	=> $tgllahir,
							'pegawai_jk'	 	 	=> $jk,
							'pegawai_pdd'	 	 	=> $pdd,
							'pegawai_telp'	 	 	=> $telp,
							'pegawai_email'	 	 	=> $email,
							// 'pegawai_foto'	 	 	=> $foto,
							'pegawai_alamat'	 	=> $alamat,
							'pegawai_jenis'	 	 	=> $jenis,
							'pegawai_pangkat'	 	=> $pangkat,
							'pegawai_nip'	 	 	=> $nip,
							'pegawai_password'	 	=> sha1($password),
							'pegawai_level'	 	 	=> $level,
							'pegawai_status'	 	=> $status,
							'pegawai_create'	 	=> $tgl_create,
							'bagian_id'	 	 		=> $bagian,
							'lembaga_id'			=> $data['md']->id_lembaga
						);
						$this->Mcrud->save_user($data);
						$this->session->set_flashdata(
							'msg',
							'
								<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										</button>
										<strong>BERHASIL!</strong><br />Pengguna berhasil ditambahkan.
								</div>'
						);
					}
				}
				redirect('users/pengguna/');
			}
			if (isset($_POST['updatePegawai'])) {
				$id   	 	= htmlentities(strip_tags($this->input->post('id')));
				$nama   	 	= htmlentities(strip_tags($this->input->post('nama')));
				$tplahir	 	= htmlentities(strip_tags($this->input->post('tplahir')));
				$tgllahir	 	= htmlentities(strip_tags($this->input->post('tgllahir')));
				$jk	 			= htmlentities(strip_tags($this->input->post('jk')));
				$pdd	 		= htmlentities(strip_tags($this->input->post('pdd')));
				$telp	 		= htmlentities(strip_tags($this->input->post('telp')));
				$email	 		= htmlentities(strip_tags($this->input->post('email')));
				$alamat	 		= htmlentities(strip_tags($this->input->post('alamat')));
				$jenis	 		= htmlentities(strip_tags($this->input->post('jenis')));
				$pangkat	 	= htmlentities(strip_tags($this->input->post('pangkat')));
				$nip	 		= htmlentities(strip_tags($this->input->post('nip')));
				$password	 	= htmlentities(strip_tags($this->input->post('nip')));
				$level	 		= htmlentities(strip_tags($this->input->post('level')));
				$status	 		= htmlentities(strip_tags($this->input->post('status')));
				$bagian	 		= htmlentities(strip_tags($this->input->post('jabatan')));

				$cek_nip_pegawai = $this->db->query("SELECT id_user, pegawai_nip FROM tbl_users WHERE pegawai_nip='$nip' AND id_user != '$id'")->num_rows();
				$cek_level_pegawai = $this->db->query("SELECT id_user, pegawai_level FROM tbl_users WHERE pegawai_level='$level' AND id_user != '$id'")->num_rows();
				$cek_user = $this->db->get_where("tbl_users", "pegawai_nip = '$nip'")->num_rows();
				$cek_level = $this->db->get_where("tbl_users", "pegawai_level = '$level'")->num_rows();

				if ($level == 'staf' or $level == 'kasi' or $level == 'jfu') {
					if ($cek_nip_pegawai != 0) {
						$this->session->set_flashdata(
							'msg',
							'
								<div class="alert alert-warning alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										</button>
										<strong>GAGAL!</strong><br />NIP Pegawai "' . $nip . '" sudah terdaftar.
								</div>'
						);
					} else {
						$data = array(
							'pegawai_nama'	 	 	=> $nama,
							'pegawai_tempat_lahir'	=> $tplahir,
							'pegawai_tanggal_lahir'	=> $tgllahir,
							'pegawai_jk'	 	 	=> $jk,
							'pegawai_pdd'	 	 	=> $pdd,
							'pegawai_telp'	 	 	=> $telp,
							'pegawai_email'	 	 	=> $email,
							'pegawai_alamat'	 	=> $alamat,
							'pegawai_jenis'	 	 	=> $jenis,
							'pegawai_pangkat'	 	=> $pangkat,
							'pegawai_nip'	 	 	=> $nip,
							'pegawai_level'	 	 	=> $level,
							'pegawai_status'	 	=> $status,
							'pegawai_create'	 	=> $tgl_create,
							'bagian_id'	 	 		=> $bagian,
							'lembaga_id'			=> $data['md']->id_lembaga
						);
						$this->Mcrud->update_user(array('id_user' => $id), $data);
						$this->session->set_flashdata(
							'msg',
							'
								<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										</button>
										<strong>BERHASIL</strong><br />Pengguna berhasil ditambahkan.
								</div>'
						);
					}
				} else if ($cek_level_pegawai != 0) {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
								<strong>PERINGATAN!</strong><br>Hak akses "' . $level . '" sedang aktif. Silahkan nonaktifkan terlebih dahulu akun "' . $level . '"
						</div>'
					);
				} else {
					if ($cek_nip_pegawai != 0) {
						$this->session->set_flashdata(
							'msg',
							'
							<div class="alert alert-warning alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									</button>
									<strong>GAGAL!</strong><br /> NIP Pegawai "' . $nip . '" sudah terdaftar.
							</div>'
						);
					} else {
						$data = array(
							'pegawai_nama'	 	 	=> $nama,
							'pegawai_tempat_lahir'	=> $tplahir,
							'pegawai_tanggal_lahir'	=> $tgllahir,
							'pegawai_jk'	 	 	=> $jk,
							'pegawai_pdd'	 	 	=> $pdd,
							'pegawai_telp'	 	 	=> $telp,
							'pegawai_email'	 	 	=> $email,
							'pegawai_alamat'	 	=> $alamat,
							'pegawai_jenis'	 	 	=> $jenis,
							'pegawai_pangkat'	 	=> $pangkat,
							'pegawai_nip'	 	 	=> $nip,
							'pegawai_level'	 	 	=> $level,
							'pegawai_status'	 	=> $status,
							'pegawai_create'	 	=> $tgl_create,
							'bagian_id'	 	 		=> $bagian,
							'lembaga_id'			=> $data['md']->id_lembaga
						);
						$this->Mcrud->update_user(array('id_user' => $id), $data);
						$this->session->set_flashdata(
							'msg',
							'
								<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										</button>
										<strong>BERHASIL!</strong><br />Pengguna berhasil diperbaharui.
								</div>'
						);
					}
				}
				redirect('users/pengguna');
			}
			if (isset($_POST['updateSandi'])) {
				$id	 		= htmlentities(strip_tags($this->input->post('id')));
				$new_password	= htmlentities(strip_tags($this->input->post('newpassword')));
				$confirm_password	= htmlentities(strip_tags($this->input->post('confirmpassword')));

				if ($new_password == $confirm_password) {
					$data = array(
						'pegawai_password' 	=> sha1($new_password)
					);
					$this->Mcrud->update_user(array('id_user' => $id), $data);
					$this->session->set_flashdata(
						'msg',
						'
							<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									</button>
									<b>BERHASIL!</b><br />Password berhasil diupdate.
							</div>'
					);
				} else {
					$this->session->set_flashdata(
						'msg',
						'
							<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									</button>
									<b>GAGAL!</b><br />Password dan Konfirmasi Password tidak sama.
							</div>'
					);
				}
				redirect('users/pengguna');
			}
		}
	}

	public function bagian($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$ceklevel = $data['user']->row()->pegawai_level;
			if ($ceklevel == 'kepala' or $ceklevel == 'ktu' or $ceklevel == 'kasi' or $ceklevel == 'staf' or $ceklevel == 'jfu') {
				redirect('404_content');
			}
			$this->db->join('tbl_lembaga', 'tbl_bagian.lembaga_id=tbl_lembaga.id_lembaga');
			if ($data['user']->row()->pegawai_level == 'user') {
				$this->db->where('tbl_bagian.id_user', "$id_user");
			}
			$data['bagian'] 		  = $this->db->get("tbl_bagian");
			$this->db->order_by('tbl_bagian.bagian_nama', 'ASC');

			if ($aksi == 't') {
				$p = "bagian_tambah";
				if ($data['user']->row()->pegawai_level == 'admin') {
					redirect('404_content');
				}

				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			} elseif ($aksi == 'h') {
				if ($data['user']->row()->pegawai_level != 'admin') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_bagian", array('id_bagian' => "$id"))->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
				$this->Mcrud->delete_bagian_by_id($id);
				$this->session->set_flashdata(
					'msg',
					'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>BERHASIL!</strong><br />Jabatan berhasil dihapus.
						</div>'
				);
				redirect('users/bagian');
			} else {
				$p = "bagian";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/pengaturan/$p", $data);
			$this->load->view('users/footer');
			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('Y-m-d H:i:s');
			if (isset($_POST['saveJabatan'])) {
				$id   	 	= htmlentities(strip_tags($this->input->post('id')));
				$jabatan   	 	= htmlentities(strip_tags($this->input->post('jabatan')));
				$data = array(
					'bagian_nama'	 => $jabatan,
					'bagian_create'	 => $tgl,
					'lembaga_id'	=> $data['md']->id_lembaga,
					'user_id'		 => $id_user
				);
				$this->Mcrud->save_bagian($data);
				$this->session->set_flashdata(
					'msg',
					'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>BERHASIL!</strong><br />Jabatan berhasil ditambahkan.
						</div>'
				);
				redirect('users/bagian');
			}

			if (isset($_POST['updateJabatan'])) {
				$id   	 	= htmlentities(strip_tags($this->input->post('id')));
				$jabatan   	= htmlentities(strip_tags($this->input->post('jabatan')));

				$data = array(
					'bagian_nama'	 => $jabatan,
					'bagian_create'	 => $tgl,
				);
				$this->Mcrud->update_bagian(array('id_bagian' => $id), $data);
				$this->session->set_flashdata(
					'msg',
					'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>BERHASIL!</strong><br />Jabatan berhasil diperbaharui.
						</div>'
				);
				redirect('users/bagian');
			}
		}
	}

	public function control($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		$data['user'] = $this->Mcrud->get_users_by_un($ceks);
		if (!isset($ceks)) {
			redirect('web/login');
		} elseif ($data['user']->row()->pegawai_level == 'admin' or $data['user']->row()->pegawai_level == 'petugas' or $data['user']->row()->pegawai_level == 'kepala' or $data['user']->row()->pegawai_level == 'ktu') {
			$this->db->join('tbl_bagian', 'tbl_sm.sm_bagian=tbl_bagian.id_bagian');
			$this->db->select('*');
			$this->db->from('tbl_sm');
			$this->db->where('sm_dibaca BETWEEN 3 AND', 4);
			$this->db->order_by('tbl_sm.sm_dibaca', 'asc');
			$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
			$data['control'] = $this->db->get();
			$data['level_users']  = $this->Mcrud->get_level_users();
			if ($aksi == 'd') {
				$p = "control_detail";
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			} else {
				$p = "control";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
		} else {
			redirect('404_content');
		}
	}

	public function staf($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		$data['user'] = $this->Mcrud->get_users_by_un($ceks);

		date_default_timezone_set('Asia/Jakarta');
		$tgl = date('Y-m-d');

		if (!isset($ceks)) {
			redirect('web/login');
		} elseif ($data['user']->row()->pegawai_level == 'admin' or $data['user']->row()->pegawai_level == 'staf') {
			$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
			$this->db->order_by('tbl_sm.sm_no_surat_asal', 'asc');
			$data['staf'] = $this->db->get_where("tbl_sm", array('sm_bagian' => $data['user']->row()->bagian_id));
			$data['jabatan'] = $this->db->get_where("tbl_bagian", array('id_bagian' => $data['user']->row()->bagian_id))->row();
			$data['level_bagian']  = $this->Mcrud->get_bagian();
			$data['level_users']  = $this->Mcrud->get_level_users();
			if ($aksi == 'view') {
				$p = "preview";
				if ($data['user']->row()->pegawai_level == 'admin') {
					redirect('404_content');
				}
				$data['sql'] = $this->db->get_where("tbl_ska", array('id_ska' => "$id"))->row();
				$data['judul_web'] = "Cetak Surat Disposisi";
			} else if ($aksi == 'cetak') {
				if ($data['user']->row()->pegawai_level == 'jfu' or $data['user']->row()->pegawai_level == 'kasi' or $data['user']->row()->pegawai_level == 'ktu' or $data['user']->row()->pegawai_level == 'kepala') {
					redirect('404_content');
				} else if ($data['user']->row()->pegawai_level == 'staf') {
					$uuid = decrypt_url($id);
					$this->db->join('tbl_bagian', 'tbl_sm.sm_bagian=tbl_bagian.id_bagian');
					$data['sql'] = $this->db->get_where("tbl_sm", array('id_sm' => "$uuid"))->row();
					$data['judul_web'] = "Sistem Informasi Administrasi Surat | SIAS";
					$pdf = new FPDF('P', 'mm', 'A4');
					$pdf->AddPage();
					$pdf->AliasNbPages();
					$pdf->SetTitle('Lembar Disposisi - ' . $data['sql']->sm_no_urut, true);
					$pdf->SetFont('Arial', '', 7);
					$pdf->Image('foto/' . $data['md']->foto, 15, 20, 25);

					$pdf->SetFont('Arial', 'B', 16);
					$pdf->Ln(5);
					$pdf->Cell(0, 5, '', 'LTR', 1, 'C');

					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->kop_1, 'R', 1, 'C');
					$pdf->SetFont('Arial', 'B', 14);
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->kop_2, 'R', 1, 'C');
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->alamat, 'R', 1, 'C');
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->telp, 'R', 1, 'C');
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, 'Website: ' . $data['md']->website . '; email: ' . $data['md']->email, 'R', 1, 'C');
					$pdf->Cell(0, 5, '', 'LBR', 1, 'C');

					$pdf->SetFont('Arial', 'B', 13);
					$pdf->Cell(0, 15, 'LEMBAR DISPOSISI', 'LBR', 1, 'C');
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(0, 10, 'PERHATIKAN: Dilarang memisahkan sehelai surat yang digabung dalam berkas ini', 'LBR', 1, 'C');

					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(50, 7, ' Nomor Surat', 'LB', 0, 'L');
					$pdf->Cell(85, 7, ': ' . $data['sql']->sm_no_surat_asal, 'BR', 0, 'L');
					$pdf->Cell(20, 7, ' Status', 'B', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_status, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Tanggal Surat', 'LB', 0, 'L');
					$pdf->Cell(85, 7, ': ' . format_indo($data['sql']->sm_tgl_surat), 'BR', 0, 'L');
					$pdf->Cell(20, 7, ' Sifat', 'B', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_sifat, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Lampiran', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_lampiran, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Diterima tanggal', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . format_indo($data['sql']->sm_tgl_diterima), 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' No. Agenda', 'LB', 0, 'L');
					$pdf->Cell(85, 7, ': ' . $data['sql']->sm_no_urut, 'BR', 0, 'L');
					$pdf->Cell(20, 7, ' Klasifikasi', 'B', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_penerima, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Dari Instansi', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_pengirim, 'BR', 1, 'L');

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');
					$pdf->Cell(0, 5, 'Perihal', 'LR', 1, 'C');
					$pdf->SetFont('Arial', 'I', 10);
					$pdf->MultiCell(0, 5, $data['sql']->sm_perihal, 'LR', 'C', false);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');

					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(50, 7, ' Diteruskan kepada', 'TLB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['md']->jabatan, 'TBR', 1, 'L');
					$pdf->Cell(50, 7, ' Pada tanggal', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . format_indo($data['sql']->sm_tgl_kepala), 'BR', 1, 'L');

					$pdf->Cell(100, 10, 'Disposisi kepala kepada', 'LB', 0, 'C');
					$pdf->Cell(0, 10, 'Petunjuk', 'LBR', 1, 'C');
					$pdf->Cell(100, 20, $data['sql']->bagian_nama, 'LBR', 0, 'C');
					$pdf->Cell(0, 20, ' ' . $data['sql']->sm_segera, 'LBR', 1, 'L');

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');
					$pdf->Cell(0, 5, 'Catatan kepala', 'LR', 1, 'L');
					$pdf->SetFont('Arial', 'I', 10);
					$pdf->MultiCell(0, 5, $data['sql']->sm_catatan, 'LR', 'L', false);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');

					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(50, 7, ' Disposisi jabatan', 'TLB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->bagian_nama, 'TBR', 1, 'L');

					$pdf->Cell(50, 7, ' Diteruskan kepada', 'LB', 0, 'L');

					$disposisi = explode(';', $data['sql']->sm_disposisi);
					foreach ($disposisi as $b) {
						foreach ($data['level_users']->result() as $a) {
							if ($b == $a->id_user) {
								$dataDisposisi = $a->pegawai_nama;
							}
						}
						$aa[] = $dataDisposisi;
					}
					$pdf->Cell(0, 7, ': ' . implode(', ', $aa), 'BR', 1, 'L');
					$pdf->Cell(50, 7, ' Pada penyelesaian', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . format_indo($data['sql']->sm_tgl_disposisi), 'BR', 1, 'L');

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');
					$pdf->Cell(0, 5, 'Catatan ' . $data['sql']->bagian_nama, 'LR', 1, 'L');
					$pdf->SetFont('Arial', 'I', 10);
					$pdf->MultiCell(0, 5, $data['sql']->sm_kasi_ctt, 'LR', 'L', false);
					$pdf->Cell(0, 2, '', 'LRB', 1, 'L');

					$pdf->Output('I', 'Lembar Disposisi' . $data['sql']->sm_no_urut . '.pdf');
				}
			} else {
				$p = "staf";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
		} else {
			redirect('404_content');
		}
	}

	public function jfu($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		$data['user'] = $this->Mcrud->get_users_by_un($ceks);

		date_default_timezone_set('Asia/Jakarta');
		$tgl = date('Y-m-d');

		if (!isset($ceks)) {
			redirect('web/login');
		} elseif ($data['user']->row()->pegawai_level == 'admin' or $data['user']->row()->pegawai_level == 'jfu') {
			$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
			$this->db->order_by('tbl_sm.sm_no_surat_asal', 'asc');
			$data['jfu'] = $this->db->get_where("tbl_sm", array('sm_bagian' => $data['user']->row()->bagian_id));
			$data['jabatan'] = $this->db->get_where("tbl_bagian", array('id_bagian' => $data['user']->row()->bagian_id))->row();
			$data['level_bagian']  = $this->Mcrud->get_bagian();
			$data['level_users']  = $this->Mcrud->get_level_users();

			$data['sql'] = $this->db->query("SELECT * FROM tbl_sm INNER JOIN tbl_bagian ON tbl_sm.sm_bagian=tbl_bagian.id_bagian INNER JOIN tbl_lampiran ON tbl_sm.token_lampiran=tbl_lampiran.token_lampiran WHERE sm_disposisi LIKE '%$id_user%' ORDER BY id_sm DESC");

			if ($aksi == 'cetak') {
				if ($data['user']->row()->pegawai_level != 'jfu') {
					redirect('404_content');
				} else if ($data['user']->row()->pegawai_level == 'jfu') {
					$this->db->join('tbl_bagian', 'tbl_sm.sm_bagian=tbl_bagian.id_bagian');
					$uuid = decrypt_url($id);
					$data['sql'] = $this->db->get_where("tbl_sm", array('id_sm' => "$uuid"))->row();
					$data['judul_web'] = "Sistem Informasi Administrasi Surat | SIAS";
					$pdf = new FPDF('P', 'mm', 'A4');
					$pdf->AddPage();
					$pdf->AliasNbPages();
					$pdf->SetTitle('Lembar Disposisi - ' . $data['sql']->sm_no_urut, true);
					$pdf->SetFont('Arial', '', 7);
					$pdf->Image('foto/' . $data['md']->foto, 15, 20, 25);

					$pdf->SetFont('Arial', 'B', 16);
					$pdf->Ln(5);
					$pdf->Cell(0, 5, '', 'LTR', 1, 'C');

					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->kop_1, 'R', 1, 'C');
					$pdf->SetFont('Arial', 'B', 14);
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->kop_2, 'R', 1, 'C');
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->alamat, 'R', 1, 'C');
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->telp, 'R', 1, 'C');
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, 'Website: ' . $data['md']->website . '; email: ' . $data['md']->email, 'R', 1, 'C');
					$pdf->Cell(0, 5, '', 'LBR', 1, 'C');

					$pdf->SetFont('Arial', 'B', 13);
					$pdf->Cell(0, 15, 'LEMBAR DISPOSISI', 'LBR', 1, 'C');
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(0, 10, 'PERHATIKAN: Dilarang memisahkan sehelai surat yang digabung dalam berkas ini', 'LBR', 1, 'C');

					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(50, 7, ' Nomor Surat', 'LB', 0, 'L');
					$pdf->Cell(85, 7, ': ' . $data['sql']->sm_no_surat_asal, 'BR', 0, 'L');
					$pdf->Cell(20, 7, ' Status', 'B', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_status, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Tanggal Surat', 'LB', 0, 'L');
					$pdf->Cell(85, 7, ': ' . format_indo($data['sql']->sm_tgl_surat), 'BR', 0, 'L');
					$pdf->Cell(20, 7, ' Sifat', 'B', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_sifat, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Lampiran', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_lampiran, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Diterima tanggal', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . format_indo($data['sql']->sm_tgl_diterima), 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' No. Agenda', 'LB', 0, 'L');
					$pdf->Cell(85, 7, ': ' . $data['sql']->sm_no_urut, 'BR', 0, 'L');
					$pdf->Cell(20, 7, ' Klasifikasi', 'B', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_penerima, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Dari Instansi', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_pengirim, 'BR', 1, 'L');

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');
					$pdf->Cell(0, 5, 'Perihal', 'LR', 1, 'C');
					$pdf->SetFont('Arial', 'I', 10);
					$pdf->MultiCell(0, 5, $data['sql']->sm_perihal, 'LR', 'C', false);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');

					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(50, 7, ' Diteruskan kepada', 'TLB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['md']->jabatan, 'TBR', 1, 'L');
					$pdf->Cell(50, 7, ' Pada tanggal', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . format_indo($data['sql']->sm_tgl_kepala), 'BR', 1, 'L');

					$pdf->Cell(100, 10, 'Disposisi kepala kepada', 'LB', 0, 'C');
					$pdf->Cell(0, 10, 'Petunjuk', 'LBR', 1, 'C');
					$pdf->Cell(100, 20, $data['sql']->bagian_nama, 'LBR', 0, 'C');
					$pdf->Cell(0, 20, ' ' . $data['sql']->sm_segera, 'LBR', 1, 'L');

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');
					$pdf->Cell(0, 5, 'Catatan kepala', 'LR', 1, 'L');
					$pdf->SetFont('Arial', 'I', 10);
					$pdf->MultiCell(0, 5, $data['sql']->sm_catatan, 'LR', 'L', false);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');

					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(50, 7, ' Disposisi jabatan', 'TLB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->bagian_nama, 'TBR', 1, 'L');

					$pdf->Cell(50, 7, ' Diteruskan kepada', 'LB', 0, 'L');

					$disposisi = explode(';', $data['sql']->sm_disposisi);
					foreach ($disposisi as $b) {
						foreach ($data['level_users']->result() as $a) {
							if ($b == $a->id_user) {
								$dataDisposisi = $a->pegawai_nama;
							}
						}
						$aa[] = $dataDisposisi;
					}
					$pdf->Cell(0, 7, ': ' . implode(', ', $aa), 'BR', 1, 'L');
					$pdf->Cell(50, 7, ' Pada penyelesaian', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . format_indo($data['sql']->sm_tgl_disposisi), 'BR', 1, 'L');

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');
					$pdf->Cell(0, 5, 'Catatan ' . $data['sql']->bagian_nama, 'LR', 1, 'L');
					$pdf->SetFont('Arial', 'I', 10);
					$pdf->MultiCell(0, 5, $data['sql']->sm_kasi_ctt, 'LR', 'L', false);
					$pdf->Cell(0, 2, '', 'LRB', 1, 'L');

					$pdf->Output('I', 'Lembar Disposisi' . $data['sql']->sm_no_urut . '.pdf');
				}
			} else {
				$p = "jfu";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
		} else {
			redirect('404_content');
		}
	}

	public function kasi($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		$data['user'] = $this->Mcrud->get_users_by_un($ceks);

		date_default_timezone_set('Asia/Jakarta');
		$tgl = date('Y-m-d');

		if (!isset($ceks)) {
			redirect('web/login');
		} elseif ($data['user']->row()->pegawai_level == 'admin' or $data['user']->row()->pegawai_level == 'kasi') {
			$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
			$this->db->order_by('tbl_sm.sm_no_surat_asal', 'asc');
			$data['kasi'] = $this->db->get_where("tbl_sm", array('sm_bagian' => $data['user']->row()->bagian_id));
			$data['jabatan'] = $this->db->get_where("tbl_bagian", array('id_bagian' => $data['user']->row()->bagian_id))->row();
			$data['level_bagian']  = $this->Mcrud->get_bagian();
			$data['level_users']  = $this->Mcrud->get_level_users();
			if ($aksi == 'd') {
				$p = "kasi_detail";
				$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
				if (isset($_POST['updateDisposisi'])) {
					$petunjuk1 			= implode(";", $_POST['petunjuk1']);
					$catatan   	 		= htmlentities(strip_tags($this->input->post('catatan')));
					$data2 = array(
						'sm_tgl_disposisi' 		=> $tgl,
						'sm_disposisi' 			=> $petunjuk1,
						'sm_kasi_ctt'			=> $catatan,
						'sm_dibaca' 			=> '4'
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					redirect('users/kasi');
				}
			} else {
				$p = "kasi";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
		} else {
			redirect('404_content');
		}
	}

	public function disposisi($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		$data['user'] = $this->Mcrud->get_users_by_un($ceks);
		if (!isset($ceks)) {
			redirect('web/login');
		} elseif ($data['user']->row()->pegawai_level == 'admin' or $data['user']->row()->pegawai_level == 'ktu') {
			$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
			$this->db->order_by('tbl_sm.sm_no_surat_asal', 'asc');
			$data['disposisi'] = $this->db->get_where("tbl_sm", array('sm_bagian' => $data['user']->row()->bagian_id));
			$data['jabatan'] = $this->db->get_where("tbl_bagian", array('id_bagian' => $data['user']->row()->bagian_id))->row();
			$data['level_bagian']  = $this->Mcrud->get_bagian();
			$data['level_users']  = $this->Mcrud->get_level_users();

			if ($aksi == 'detail') {
				$p = "ktu_detail";
				$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
				if (isset($_POST['updateDisposisi'])) {
					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d');
					$petunjuk1 			= implode(";", $_POST['petunjuk1']);
					$catatan   	 		= htmlentities(strip_tags($this->input->post('catatan')));
					$data2 = array(
						'sm_tgl_disposisi' 		=> $tgl,
						'sm_disposisi' 			=> $petunjuk1,
						'sm_kasi_ctt'			=> $catatan,
						'sm_dibaca' 			=> '4'
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					redirect('users/disposisi');
				}
			} else {
				$p = "ktu_disposisi";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
		} else {
			redirect('404_content');
		}
	}

	public function kdis($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		$data['user'] = $this->Mcrud->get_users_by_un($ceks);
		if (!isset($ceks)) {
			redirect('web/login');
		} elseif ($data['user']->row()->pegawai_level == 'admin' or $data['user']->row()->pegawai_level == 'kepala') {
			$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
			$this->db->order_by('tbl_sm.sm_no_surat_asal', 'asc');
			$data['kdis'] = $this->db->get_where("tbl_sm", array('sm_bagian' => $data['user']->row()->bagian_id));
			$data['jabatan'] = $this->db->get_where("tbl_bagian", array('id_bagian' => $data['user']->row()->bagian_id))->row();
			$data['level_bagian']  = $this->Mcrud->get_bagian();
			$data['level_users']  = $this->Mcrud->get_level_users();

			if ($aksi == 'detail') {
				$p = "kepala_kdis";
				$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
				if (isset($_POST['updateDisposisi'])) {
					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d');
					$petunjuk1 			= implode(";", $_POST['petunjuk1']);
					$catatan   	 		= htmlentities(strip_tags($this->input->post('catatan')));
					$data2 = array(
						'sm_tgl_disposisi' 		=> $tgl,
						'sm_disposisi' 			=> $petunjuk1,
						'sm_kasi_ctt'			=> $catatan,
						'sm_dibaca' 			=> '4'
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					redirect('users/kdis');
				}
			} else {
				$p = "kepala_disposisi";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
		} else {
			redirect('404_content');
		}
	}

	public function ktu($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		$data['user'] = $this->Mcrud->get_users_by_un($ceks);

		if (!isset($ceks)) {
			redirect('web/login');
		} elseif ($data['user']->row()->pegawai_level == 'admin' or $data['user']->row()->pegawai_level == 'ktu') {
			$this->db->select('*');
			$this->db->from('tbl_sm');
			$this->db->where('sm_dibaca BETWEEN 1 AND', 2);
			$this->db->order_by('tbl_sm.sm_no_surat_asal', 'asc');
			$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
			$data['ktu'] = $this->db->get();
			$data['jabatan'] = $this->db->get_where("tbl_bagian", array('id_bagian' => $data['user']->row()->bagian_id))->row();
			$p = "ktu";
			$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";

			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');

			if (isset($_POST['saveAjuan'])) {
				$id_ajuan   	= htmlentities(strip_tags($this->input->post('id')));
				$dibaca   	 	= htmlentities(strip_tags($this->input->post('dibaca')));
				$catatan   	 	= htmlentities(strip_tags($this->input->post('catatan')));
				date_default_timezone_set('Asia/Jakarta');
				$ajuan 	 		= date('Y-m-d');
				$data 			= array(
					'sm_dibaca' 	=> $dibaca,
					'sm_tgl_ajuan' 	=> $ajuan,
					'sm_ktu_ctt' 	=> $catatan,
				);
				$this->Mcrud->update_sm(array('id_sm' => "$id_ajuan"), $data);
				redirect('users/ktu');
			}
		} else {
			redirect('404_content');
		}
	}

	public function kepala($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		$data['user'] = $this->Mcrud->get_users_by_un($ceks);

		date_default_timezone_set('Asia/Jakarta');
		$tgl = date('Y-m-d');

		if (!isset($ceks)) {
			redirect('web/login');
		} elseif ($data['user']->row()->pegawai_level == 'admin' or $data['user']->row()->pegawai_level == 'kepala') {
			$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
			$this->db->order_by('tbl_sm.sm_no_surat_asal', 'asc');
			$data['kepala'] = $this->db->get_where("tbl_sm", array('sm_dibaca' => '2'));
			$data['jabatan'] = $this->db->get_where("tbl_bagian", array('id_bagian' => $data['user']->row()->bagian_id))->row();
			$data['level_bagian']  = $this->Mcrud->get_bagian();
			if ($aksi == 'd') {
				$p = "kepala_detail";
				$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
				if (isset($_POST['saveDisposisi'])) {
					$jabatan   	 		= htmlentities(strip_tags($this->input->post('jabatan')));
					$petunjuk1 			= implode(",", $_POST['petunjuk1']);
					$petunjuk2 			= implode(",", $_POST['petunjuk2']);
					$catatan   	 		= htmlentities(strip_tags($this->input->post('catatan')));
					$data2 = array(
						'sm_segera' 		=> $petunjuk1,
						'sm_biasa' 			=> $petunjuk2,
						'sm_catatan' 		=> $catatan,
						'sm_bagian' 		=> $jabatan,
						'sm_tgl_kepala' 	=> $tgl,
						'sm_dibaca' 		=> '3'
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					redirect('users/kepala');
				}
				if (isset($_POST['btnpriview'])) {
					$file = 'lampiran/surat_masuk/004_13_10_21_asdf_SM_1634094537.pdf';
					$filename = 'lampiran/surat_masuk/004_13_10_21_asdf_SM_1634094537.pdf';

					header('Content-type: application/pdf');
					header('Content-Disposition: inline; filename="' . $filename . '"');
					header('Content-Transfer-Encoding: binary');
					header('Accept-Ranges: bytes');

					@readfile($file);
				}
			} else {
				$p = "kepala";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
		} else {
			redirect('404_content');
		}
	}

	public function sm($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user'] = $this->Mcrud->get_users_by_un($ceks);
			$this->db->join('tbl_lampiran', 'tbl_sm.token_lampiran=tbl_lampiran.token_lampiran');
			$this->db->order_by('tbl_sm.sm_no_surat_asal', 'asc');
			$data['sm'] = $this->db->get("tbl_sm");
			$data['level_users']  = $this->Mcrud->get_level_users();
			if ($aksi == 't') {
				$p = "sm_tambah";
				if ($data['user']->row()->pegawai_level == 'admin' or $data['user']->row()->pegawai_level == 'user') {
					redirect('404_content');
				}
				$data['judul_web'] 	= "Sistem Informasi Administrasi Surat | SIAS";
			} elseif ($aksi == 'd') {
				$p = "sm_detail";
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
				if (isset($_POST['btndisposisi'])) {
					$data2 = array(
						'disposisi' => '1'
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					redirect('users/sm');
				}
				if (isset($_POST['btndisposisi0'])) {
					$data2 = array(
						'disposisi' => '0'
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					redirect('users/sm');
				}
			} elseif ($aksi == 'e') {
				$p = "sm_edit";
				if ($data['user']->row()->pegawai_level == 'admin' or $data['user']->row()->pegawai_level == 'user') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			} elseif ($aksi == 'h') {
				if ($data['user']->row()->pegawai_level != 'petugas') {
					redirect('404_content');
				} else {
					$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
					$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";

					$query_h = $this->db->get_where("tbl_lampiran", array('token_lampiran' => $data['query']->token_lampiran));
					foreach ($query_h->result() as $baris) {
						unlink('./lampiran/surat_masuk/' . $baris->nama_berkas);
					}
					$this->Mcrud->delete_lampiran($data['query']->token_lampiran);
					$this->Mcrud->delete_sm_by_id($id);
					$this->session->set_flashdata(
						'msg',
						'<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
						<b>Berhasil!</b><br />Data berhasil dihapus</div>'
					);
				}

				redirect('users/sm');
			} elseif ($aksi == 'c') {
				if ($data['user']->row()->pegawai_level == 'staf' or $data['user']->row()->pegawai_level == 'kasi' or $data['user']->row()->pegawai_level == 'ktu' or $data['user']->row()->pegawai_level == 'kepala') {
					redirect('404_content');
				} else if ($data['user']->row()->pegawai_level == 'petugas' or $data['user']->row()->pegawai_level == 'admin') {
					$this->db->join('tbl_bagian', 'tbl_sm.sm_bagian=tbl_bagian.id_bagian');
					$data['sql'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
					$data['judul_web'] = "Sistem Informasi Administrasi Surat | SIAS";

					$pdf = new FPDF('P', 'mm', 'A4');
					$pdf->AddPage();
					$pdf->AliasNbPages();
					$pdf->SetTitle('Lembar Disposisi - ' . $data['sql']->sm_no_urut, true);
					$pdf->SetFont('Arial', '', 7);
					$pdf->Image('foto/' . $data['md']->foto, 15, 20, 25);

					$pdf->SetFont('Arial', 'B', 16);
					$pdf->Ln(5);
					$pdf->Cell(0, 5, '', 'LTR', 1, 'C');

					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->kop_1, 'R', 1, 'C');
					$pdf->SetFont('Arial', 'B', 14);
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->kop_2, 'R', 1, 'C');
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->alamat, 'R', 1, 'C');
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, $data['md']->telp, 'R', 1, 'C');
					$pdf->Cell(25, 5, '', 'L', 0, 'C');
					$pdf->Cell(0, 5, 'Website: ' . $data['md']->website . '; email: ' . $data['md']->email, 'R', 1, 'C');
					$pdf->Cell(0, 5, '', 'LBR', 1, 'C');

					$pdf->SetFont('Arial', 'B', 13);
					$pdf->Cell(0, 15, 'LEMBAR DISPOSISI', 'LBR', 1, 'C');
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(0, 10, 'PERHATIKAN: Dilarang memisahkan sehelai surat yang digabung dalam berkas ini', 'LBR', 1, 'C');

					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(50, 7, ' Nomor Surat', 'LB', 0, 'L');
					$pdf->Cell(85, 7, ': ' . $data['sql']->sm_no_surat_asal, 'BR', 0, 'L');
					$pdf->Cell(20, 7, ' Status', 'B', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_status, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Tanggal Surat', 'LB', 0, 'L');
					$pdf->Cell(85, 7, ': ' . format_indo($data['sql']->sm_tgl_surat), 'BR', 0, 'L');
					$pdf->Cell(20, 7, ' Sifat', 'B', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_sifat, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Lampiran', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_lampiran, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Diterima tanggal', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . format_indo($data['sql']->sm_tgl_diterima), 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' No. Agenda', 'LB', 0, 'L');
					$pdf->Cell(85, 7, ': ' . $data['sql']->sm_no_urut, 'BR', 0, 'L');
					$pdf->Cell(20, 7, ' Klasifikasi', 'B', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_penerima, 'BR', 1, 'L');

					$pdf->Cell(50, 7, ' Dari Instansi', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->sm_pengirim, 'BR', 1, 'L');

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');
					$pdf->Cell(0, 5, 'Perihal', 'LR', 1, 'C');
					$pdf->SetFont('Arial', 'I', 10);
					$pdf->MultiCell(0, 5, $data['sql']->sm_perihal, 'LR', 'C', false);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');

					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(50, 7, ' Diteruskan kepada', 'TLB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['md']->jabatan, 'TBR', 1, 'L');
					$pdf->Cell(50, 7, ' Pada tanggal', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . format_indo($data['sql']->sm_tgl_kepala), 'BR', 1, 'L');

					$pdf->Cell(100, 10, 'Disposisi kepala kepada', 'LB', 0, 'C');
					$pdf->Cell(0, 10, 'Petunjuk', 'LBR', 1, 'C');
					$pdf->Cell(100, 20, $data['sql']->bagian_nama, 'LBR', 0, 'C');
					$pdf->Cell(0, 20, ' ' . $data['sql']->sm_segera, 'LBR', 1, 'L');

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');
					$pdf->Cell(0, 5, 'Catatan kepala', 'LR', 1, 'L');
					$pdf->SetFont('Arial', 'I', 10);
					$pdf->MultiCell(0, 5, $data['sql']->sm_catatan, 'LR', 'L', false);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');

					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(50, 7, ' Disposisi jabatan', 'TLB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . $data['sql']->bagian_nama, 'TBR', 1, 'L');

					$pdf->Cell(50, 7, ' Diteruskan kepada', 'LB', 0, 'L');

					$disposisi = explode(';', $data['sql']->sm_disposisi);
					foreach ($disposisi as $b) {
						foreach ($data['level_users']->result() as $a) {
							if ($b == $a->id_user) {
								$dataDisposisi = $a->pegawai_nama;
							}
						}
						$aa[] = $dataDisposisi;
					}

					$pdf->Cell(0, 7, ': ' . implode(', ', $aa), 'BR', 1, 'L');
					$pdf->Cell(50, 7, ' Pada penyelesaian', 'LB', 0, 'L');
					$pdf->Cell(0, 7, ': ' . format_indo($data['sql']->sm_tgl_disposisi), 'BR', 1, 'L');

					$pdf->SetFont('Arial', 'B', 10);
					$pdf->Cell(0, 2, '', 'LR', 1, 'L');
					$pdf->Cell(0, 5, 'Catatan ' . $data['sql']->bagian_nama, 'LR', 1, 'L');
					$pdf->SetFont('Arial', 'I', 10);
					$pdf->MultiCell(0, 5, $data['sql']->sm_kasi_ctt, 'LR', 'L', false);
					$pdf->Cell(0, 2, '', 'LRB', 1, 'L');

					$pdf->Output('I', 'Lembar Disposisi' . $data['sql']->sm_no_urut . '.pdf');
				}
			} else {
				$p = "sm";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
			if (isset($_POST['saveSM'])) {
				$namafile 		= date('Y-m-d') . '_' . 'SM_' . time() . $_FILES['userfiles']['name'];
				$this->upload->initialize(array(
					"file_name" => $namafile,
					"upload_path"   => "./lampiran/surat_masuk/",
					"max_size"		=> 1024,
					"allowed_types" => 'pdf|docx|jpg|png|jpeg',
				));

				if ($this->upload->do_upload('userfile')) {
					$user 			= htmlentities(strip_tags($this->input->post('user')));
					$no_agenda 		= htmlentities(strip_tags($this->input->post('agenda')));
					$no_surat 		= htmlentities(strip_tags($this->input->post('t_no_surat')));
					$tgl_surat  	= htmlentities(strip_tags($this->input->post('tgl_surat')));
					$diterima_tgl   = htmlentities(strip_tags($this->input->post('diterima_tgl')));
					$pengirim	  	= htmlentities(strip_tags($this->input->post('pengirim')));
					$klasifikasi   	= htmlentities(strip_tags($this->input->post('klasifikasi')));
					$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
					$lampiran   	= htmlentities(strip_tags($this->input->post('lampiran')));
					$status   	 	= htmlentities(strip_tags($this->input->post('status')));
					$sifat   	 	= htmlentities(strip_tags($this->input->post('sifat')));

					date_default_timezone_set('Asia/Jakarta');
					$waktu 			= date('Y-m-d H:m:s');
					$tgl 	 		= date('Y-m-d');
					$token 			= md5("$id_user-$no_surat-$waktu");

					$cek_status = $this->db->get_where('tbl_sm', "token_lampiran='$token'")->num_rows();
					if ($cek_status == 0) {
						$data = array(
							'sm_no_urut'		=> $no_agenda,
							'sm_penerima'		=> $klasifikasi,
							'sm_tgl_diterima'	=> $diterima_tgl,
							'sm_sifat'	 		=> $sifat,
							'sm_no_surat_asal'	=> $no_surat,
							'sm_tgl_surat'		=> $tgl_surat,
							'sm_pengirim'		=> $pengirim,
							'sm_perihal'	 	=> $perihal,
							'sm_lampiran'		=> $lampiran,
							'sm_status' 		=> $status,
							'token_lampiran'	=> $token,
							'sm_dibaca'			=> '1',
							'sm_create'			=> $waktu,
							'user_id'			=> $user,
						);
						$this->Mcrud->save_sm($data);
					}

					$nama   = $this->upload->data('file_name');
					$ukuran = $this->upload->data('file_size');

					$this->db->insert('tbl_lampiran', array('nama_berkas' => $nama, 'ukuran' => $ukuran, 'token_lampiran' => "$token"));
					redirect('users/sm/');
				}
			}
			if (isset($_POST['updateSM'])) {
				$id 			= htmlentities(strip_tags($this->input->post('id')));
				$user 			= htmlentities(strip_tags($this->input->post('user')));
				$no_agenda 		= htmlentities(strip_tags($this->input->post('agenda')));
				$no_surat 		= htmlentities(strip_tags($this->input->post('no_surat')));
				$tgl_surat  	= htmlentities(strip_tags($this->input->post('tgl_surat')));
				$diterima_tgl   = htmlentities(strip_tags($this->input->post('diterima_tgl')));
				$pengirim	  	= htmlentities(strip_tags($this->input->post('pengirim')));
				$klasifikasi   	= htmlentities(strip_tags($this->input->post('klasifikasi')));
				$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
				$lampiran   	= htmlentities(strip_tags($this->input->post('lampiran')));
				$status   	 	= htmlentities(strip_tags($this->input->post('status')));
				$sifat   	 	= htmlentities(strip_tags($this->input->post('sifat')));

				date_default_timezone_set('Asia/Jakarta');
				$waktu 			= date('Y-m-d H:m:s');
				$data = array(
					'sm_no_urut'		=> $no_agenda,
					'sm_penerima'		=> $klasifikasi,
					'sm_tgl_diterima'	=> $diterima_tgl,
					'sm_sifat'	 		=> $sifat,
					'sm_no_surat_asal'	=> $no_surat,
					'sm_tgl_surat'		=> $tgl_surat,
					'sm_pengirim'		=> $pengirim,
					'sm_perihal'	 	=> $perihal,
					'sm_lampiran'		=> $lampiran,
					'sm_status' 		=> $status,
					'sm_dibaca'			=> '1',
					'sm_create'			=> $waktu,
					'user_id'			=> $user,
				);
				$this->Mcrud->update_sm(array('id_sm' => $id), $data);
				$this->session->set_flashdata(
					'msg',
					'<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
					<b>Berhasil!</b><br />Data Berhasil diperbaharui</div>'
				);
				redirect('users/sm');
			}
			if (isset($_POST['uploadSM'])) {
				$id 				= htmlentities(strip_tags($this->input->post('id')));
				$token_lampiran		= htmlentities(strip_tags($this->input->post('token_lampiran')));
				$no_surat 			= htmlentities(strip_tags($this->input->post('no_surat')));

				$namafile 		= date('Y-m-d') . '_' . 'SM_' . time() . $_FILES['userfiles']['name'];
				$this->upload->initialize(array(
					"file_name" => $namafile,
					"upload_path"   => "./lampiran/surat_masuk/",
					"allowed_types" => "*" //jpg|jpeg|png|gif|bmp|pdf,
				));

				$query_h = $this->db->get_where("tbl_lampiran", array('token_lampiran' => $token_lampiran));
				foreach ($query_h->result() as $baris) {
					unlink('./lampiran/surat_masuk/' . $baris->nama_berkas);
				}
				$this->Mcrud->delete_lampiran($token_lampiran);
				if ($this->upload->do_upload('userfile')) {
					date_default_timezone_set('Asia/Jakarta');
					$waktu 			= date('Y-m-d H:m:s');
					$tgl 	 		= date('Y-m-d');
					$token 			= md5("$id_user-$no_surat-$waktu");

					$cek_status = $this->db->get_where('tbl_sm', "token_lampiran='$token'")->num_rows();
					if ($cek_status == 0) {
						$data = array(
							'token_lampiran'	=> $token
						);
						$this->Mcrud->update_sm(array('id_sm' => $id), $data);
					}

					$nama   = $this->upload->data('file_name');
					$ukuran = $this->upload->data('file_size');

					$this->db->insert('tbl_lampiran', array('nama_berkas' => $nama, 'ukuran' => $ukuran, 'token_lampiran' => "$token"));
					$this->session->set_flashdata(
						'msg',
						'<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
						<b>Berhasil!</b><br />File baru berhasil diunggah</div>'
					);
					redirect('users/sm');
				}
			}
		}
	}

	public function ska($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$id_user = $this->session->userdata('duodragondev');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user'] = $this->Mcrud->get_users_by_un($ceks);
			$cekLevelPegawai = $data['user']->row()->pegawai_level;
			if ($cekLevelPegawai == 'admin' or $cekLevelPegawai == 'petugas') {
				$this->db->join('tbl_bagian', 'tbl_ska.ska_bagian=tbl_bagian.id_bagian');
				$this->db->order_by('tbl_ska.ska_no_urut', 'asc');
				$data['ska'] = $this->db->get("tbl_ska");
			} elseif ($cekLevelPegawai == 'ktu') {
				$this->db->select('*');
				$this->db->from('tbl_ska');
				$this->db->where('ska_dibaca BETWEEN 2 AND 4 OR ska_bagian =', $data['user']->row()->bagian_id);
				$this->db->order_by('tbl_ska.ska_no_urut', 'asc');
				$this->db->join('tbl_bagian', 'tbl_ska.ska_bagian=tbl_bagian.id_bagian');
				$data['ska'] = $this->db->get("");
			} elseif ($cekLevelPegawai == 'kepala') {
				$this->db->select('*');
				$this->db->from('tbl_ska');
				$this->db->where('ska_dibaca BETWEEN 3 AND', 4);
				$this->db->order_by('tbl_ska.ska_no_urut', 'asc');
				$this->db->join('tbl_bagian', 'tbl_ska.ska_bagian=tbl_bagian.id_bagian');
				$data['ska'] = $this->db->get("");
			} elseif ($cekLevelPegawai == 'kasi') {
				$this->db->order_by('tbl_ska.ska_no_urut', 'asc');
				$this->db->join('tbl_bagian', 'tbl_ska.ska_bagian=tbl_bagian.id_bagian');
				$data['ska'] = $this->db->get_where("tbl_ska", array('ska_bagian' => $data['user']->row()->bagian_id));
			} else {
				$data['jabatan'] = $this->db->get_where("tbl_bagian", array('id_bagian' => $data['user']->row()->bagian_id))->row();
				$this->db->order_by('tbl_ska.ska_no_urut', 'asc');
				$data['ska'] = $this->db->get_where("tbl_ska", array('user_id' => $data['user']->row()->id_user));
			}
			if ($aksi == 't') {
				$level = $data['user']->row()->pegawai_level;
				if ($level == 'kepala' or $level == 'ktu' or $level == 'kasi') {
					redirect('404_content');
				} elseif ($level == 'admin' or $level == 'petugas' or $level == 'staf') {
					$p = "ska_tambah";
					$data['judul_web'] 	  = "Tambah Surat Keterangan Aktif | SIS Administrasi";
				}
			} elseif ($aksi == 'd') {
				$p = "ska_detail";
				$this->db->join('tbl_users', 'tbl_ska.user_id=tbl_users.id_user');
				$this->db->join('tbl_bagian', 'tbl_ska.ska_bagian=tbl_bagian.id_bagian');
				$data['baris'] = $this->db->get_where("tbl_ska", array('id_ska' => "$id"))->row();
				$data['jabatan'] = $this->db->get_where("tbl_bagian", array('id_bagian' => $data['user']->row()->bagian_id))->row();
				$data['judul_web'] 	  = "Detail Surat Keterangan Aktif | SIS Administrasi";
			} elseif ($aksi == 'e') {
				$p = "ska_edit";
				if ($cekLevelPegawai == 'jfu' or $cekLevelPegawai == 'kasi' or $cekLevelPegawai == 'ktu' or $cekLevelPegawai == "kepala") {
					redirect('404_content');
				} elseif ($cekLevelPegawai == 'staf' or $cekLevelPegawai == 'petugas' or $cekLevelPegawai == 'admin') {
					$data['query'] = $this->db->get_where("tbl_ska", array('id_ska' => "$id"))->row();
					$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
				}
			} elseif ($aksi == 'h') {
				if ($data['user']->row()->pegawai_level == 'admin') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_ska", array('id_ska' => "$id"))->row();
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
				$this->Mcrud->delete_ska_by_id($id);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong><br>Surat berhasil dihapus.
					</div>'
				);
				redirect('users/ska');
			} elseif ($aksi == 'cetak') {
				if ($cekLevelPegawai == 'jfu') {
					redirect('404_content');
				}
				$data['sql'] = $this->db->get_where("tbl_ska", array('id_ska' => "$id"))->row();
				// title dari pdf
				$this->data['title_pdf'] = $data['sql']->ska_no_urut . ' - ' . $data['sql']->ska_hal;
				// filename dari pdf ketika didownload
				$file_pdf = $data['sql']->ska_no_urut . ' - ' . $data['sql']->ska_hal;
				// setting paper
				$paper = 'A4';
				//orientasi paper potrait / landscape
				$orientation = "portrait";
				$html = $this->load->view('users/ska/ska_cetak', $this->data, true);
				// run dompdf
				$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
			} else {
				$p = "ska";
				$data['judul_web'] 	  = "Sistem Informasi Administrasi Surat | SIAS";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/ska/$p", $data);
			$this->load->view('users/footer');

			if (isset($_POST['saveSKA'])) {
				$no_awal   	 		= htmlentities(strip_tags($this->input->post('no_awal')));
				// $no_urut   	 		= htmlentities(strip_tags($this->input->post('no_urut')));
				$no_surat   	 	= htmlentities(strip_tags($this->input->post('no_surat')));
				$lampiran   	 	= htmlentities(strip_tags($this->input->post('lampiran')));
				$sifat   	 		= htmlentities(strip_tags($this->input->post('sifat')));
				$perihal   	 		= htmlentities(strip_tags($this->input->post('perihal')));
				$kepada   	 		= htmlentities(strip_tags($this->input->post('kepada')));
				$tembusan   	 	= htmlentities(strip_tags($this->input->post('tembusan')));
				$pembuka   	 		= $this->input->post('pembuka');
				$isi   	 			= $this->input->post('isi');
				$penutup   	 		= $this->input->post('penutup');
				$jenis   	 		= htmlentities(strip_tags($this->input->post('jenis')));
				$tanggal   	 		= htmlentities(strip_tags($this->input->post('tanggal')));

				date_default_timezone_set('Asia/Jakarta');
				$tgl = date('Y-m-d H:i:s');

				$data = array(
					'ska_no_awal' 		=> $no_awal,
					// 'ska_no_urut'		=> $no_urut,
					'ska_no_surat'		=> $no_surat,
					'ska_lampiran'		=> $lampiran,
					'ska_sifat'			=> $sifat,
					'ska_hal'			=> $perihal,
					'ska_kpd'			=> $kepada,
					'ska_tanggal'		=> $tanggal,
					// 'ska_text_pembuka'	=> $pembuka,
					'ska_isi'			=> $isi,
					// 'ska_text_penutup'	=> $penutup,
					'ska_tembusan'		=> $tembusan,
					'ska_jenis	'		=> $jenis,
					'ska_bagian'		=> $data['user']->row()->bagian_id,
					'ska_dibaca'		=> 1,
					'ska_create'		=> $tgl,
					'user_id'			=> $data['user']->row()->id_user

				);
				$this->Mcrud->save_ska($data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>BERHASIL!</strong><br> Surat Keluar berhasil ditambahkan.
					</div>'
				);

				redirect('users/ska/t');
			}

			if (isset($_POST['updateSKA'])) {
				$id					= htmlentities(strip_tags($this->input->post('id')));
				$no_awal   	 		= htmlentities(strip_tags($this->input->post('no_awal')));
				// $no_urut   	 		= htmlentities(strip_tags($this->input->post('no_urut')));
				$no_surat   	 	= htmlentities(strip_tags($this->input->post('no_surat')));
				$lampiran   	 	= htmlentities(strip_tags($this->input->post('lampiran')));
				$sifat   	 		= htmlentities(strip_tags($this->input->post('sifat')));
				$perihal   	 		= htmlentities(strip_tags($this->input->post('perihal')));
				$kepada   	 		= htmlentities(strip_tags($this->input->post('kepada')));
				$tembusan   	 	= htmlentities(strip_tags($this->input->post('tembusan')));
				$pembuka   	 		= $this->input->post('pembuka');
				$isi   	 			= $this->input->post('isi');
				$penutup   	 		= $this->input->post('penutup');
				$jenis   	 		= htmlentities(strip_tags($this->input->post('jenis')));
				$tanggal   	 		= htmlentities(strip_tags($this->input->post('tanggal')));

				$data = array(
					'ska_no_awal' 		=> $no_awal,
					// 'ska_no_urut'		=> $no_urut,
					'ska_no_surat'		=> $no_surat,
					'ska_lampiran'		=> $lampiran,
					'ska_sifat'			=> $sifat,
					'ska_hal'			=> $perihal,
					'ska_kpd'			=> $kepada,
					'ska_tanggal'		=> $tanggal,
					'ska_text_pembuka'	=> $pembuka,
					'ska_isi'			=> $isi,
					'ska_text_penutup'	=> $penutup,
					'ska_tembusan'		=> $tembusan,
					'ska_jenis	'		=> $jenis,
					'ska_dibaca'		=> 1
				);
				$this->Mcrud->update_ska(array('id_ska' => $id), $data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>BERHASIL!</strong><br> Surat Keluar berhasil diperbaharui.
					</div>'
				);
				redirect('users/ska');
			}

			if (isset($_POST['vervalKasiSKA'])) {
				$id					= htmlentities(strip_tags($this->input->post('id')));
				$dibaca				= htmlentities(strip_tags($this->input->post('dibaca')));
				$catatan				= htmlentities(strip_tags($this->input->post('catatan')));

				date_default_timezone_set('Asia/Jakarta');
				$tanggal = date('Y-m-d');

				$data = array(
					'ska_dibaca'		=> $dibaca,
					'ska_tgl_kasi'		=> $tanggal,
					'ska_kasi_ctt'		=> $catatan,
				);
				$this->Mcrud->update_ska(array('id_ska' => $id), $data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>BERHASIL!</strong><br> Surat Keluar berhasil disimpan.
					</div>'
				);
				redirect('users/ska');
			}
			if (isset($_POST['vervalKtuSKA'])) {
				$id					= htmlentities(strip_tags($this->input->post('id')));
				$dibaca				= htmlentities(strip_tags($this->input->post('dibaca')));
				$catatan			= htmlentities(strip_tags($this->input->post('catatan')));
				// $nomor				= htmlentities(strip_tags($this->input->post('no_urut')));
				$nomor				= htmlentities(strip_tags($this->input->post('ska_no_surat')));
				list($_a,$no_urut,$_b,$_c)=array_pad(explode('/',$nomor),4,null);
				// $tanggal			= htmlentities(strip_tags($this->input->post('tgl_ajuan')));

				date_default_timezone_set('Asia/Jakarta');
				$tanggal = date('Y-m-d');

				$data = array(
					'ska_no_urut'		=> $no_urut,
					'ska_dibaca'		=> $dibaca,
					'ska_tgl_ktu'		=> $tanggal,
					'ska_ktu_ctt'		=> $catatan,
				);
				$this->Mcrud->update_ska(array('id_ska' => $id), $data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>BERHASIL!</strong><br> Surat Keluar berhasil disimpan.
					</div>'
				);
				redirect('users/ska');
			}
			if (isset($_POST['vervalKepalaSKA'])) {
				$id					= htmlentities(strip_tags($this->input->post('id')));
				$dibaca				= htmlentities(strip_tags($this->input->post('dibaca')));
				$catatan				= htmlentities(strip_tags($this->input->post('catatan')));
				// $tanggal				= htmlentities(strip_tags($this->input->post('tgl_ajuan')));

				date_default_timezone_set('Asia/Jakarta');
				$tanggal = date('Y-m-d');

				$data = array(
					'ska_dibaca'		=> $dibaca,
					'ska_tgl_kepala'	=> $tanggal,
					'ska_kepala_ctt'	=> $catatan,
				);
				$this->Mcrud->update_ska(array('id_ska' => $id), $data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>BERHASIL!</strong><br> Surat Keluar berhasil disimpan.
					</div>'
				);
				redirect('users/ska');
			}
		}
	}

	public function lap_sm()
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			    = $this->Mcrud->get_users_by_un($ceks);
			$data['judul_web']			= "Sistem Informasi Administrasi Surat | SIAS";

			$this->load->view('users/header', $data);
			$this->load->view('users/laporan/lap_sm', $data);
			$this->load->view('users/footer');

			if (isset($_POST['filterSM'])) {
				$tgl1 	= date('Y-m-d', strtotime(htmlentities(strip_tags($this->input->post('tgl1')))));
				$tgl2 	= date('Y-m-d', strtotime(htmlentities(strip_tags($this->input->post('tgl2')))));

				redirect("users/data_sm/$tgl1/$tgl2");
			}
		}
	}

	public function data_sm($tgl1 = '', $tgl2 = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {

			if ($tgl1 != '' and $tgl2 != '') {
				$data['sql'] = $this->db->query("SELECT * FROM tbl_sm INNER JOIN tbl_bagian ON tbl_sm.sm_bagian=tbl_bagian.id_bagian WHERE (sm_tgl_surat BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sm DESC");
				$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
				$data['judul_web'] = "Sistem Informasi Administrasi Surat | SIAS";
				$this->load->view('users/header', $data);
				$this->load->view('users/laporan/data_sm', $data);
				$this->load->view('users/footer', $data);

				if (isset($_POST['cetakSM'])) {
					include('fpdf_mc.php');

					$data['sm'] = $this->db->query("SELECT * FROM tbl_sm INNER JOIN tbl_bagian ON tbl_sm.sm_bagian=tbl_bagian.id_bagian WHERE (sm_tgl_surat BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sm DESC")->result();
					// $pdf = new FPDF('P', 'mm', 'A4');
					$pdf = new PDF_MC_Table();
					$pdf->AddPage();
					$pdf->AliasNbPages();
					$pdf->SetTitle('Laporan Surat Masuk', true);
					$pdf->SetFont('Arial', '', 7);
					$pdf->Image('foto/logo.png', 10, 10, 20);
					$pdf->SetLineHeight(5);
					$pdf->SetWidths([8,15,22,22,50,73]);

					$pdf->SetFont('Arial', 'B', 15);
					$pdf->Cell(0, 5, $data['md']->kop_1, '', 1, 'C');
					$pdf->Cell(0, 5, $data['md']->kop_2, '', 1, 'C');
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(0, 5, $data['md']->alamat . ' - ' . $data['md']->telp, '', 1, 'C');
					$pdf->Cell(0, 5, 'Website: ' . $data['md']->website . '; Email: ' . $data['md']->email, '', 1, 'C');
					$pdf->Ln(3);
					$pdf->Cell(0, 0.8, '', '', 1, 'C', true);
					$pdf->Ln(0.5);
					$pdf->Cell(0, 0.5, '', '', 1, 'C', true);

					$pdf->Ln(5);
					$pdf->SetFont('Arial', 'B', 11);
					$pdf->Cell(0, 5, 'LAPORAN SURAT MASUK', 0, 1, 'C');
					$pdf->Cell(0, 5, 'TAHUN ' . substr($tgl1, 0, 4), 0, 1, 'C');

					$pdf->Ln(5);
					$pdf->SetFont('Arial', '', 8);
					$pdf->Cell(0, 5, 'Laporan Tgl. ' . date('d-m-Y', strtotime($tgl1)) . '/' . date('d-m-Y', strtotime($tgl2)), 0, 1, 'L');

					$pdf->SetDrawColor(80, 80, 80);
					$pdf->SetFillColor(200, 200, 200);
					$pdf->SetTextColor(0);
					$pdf->SetFont('Arial', 'B', 8);
					$pdf->Cell(8, 10, "NO", 1, 0, 'C', 'F');
					$pdf->Cell(15, 10, "AGENDA", 1, 0, 'C', 'F');
					$pdf->Cell(22, 10, "TGL. MASUK", 1, 0, 'C', 'F');
					$pdf->Cell(22, 10, "TGL. SURAT", 1, 0, 'C', 'F');
					$pdf->Cell(50, 10, "INSTANSI", 1, 0, 'C', 'F');
					$pdf->Cell(0, 10, "PERIHAL", 1, 1, 'C', 'F');
					$no = 1;
					$pdf->SetDrawColor(80, 80, 80);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->SetTextColor(0);
					$pdf->SetFont('Arial', '', 8);
					foreach ($data['sm'] as $load) {
						$pdf->Row([
							$no++,
							$load->sm_no_urut,
$load->sm_tgl_diterima,
$load->sm_tgl_surat,
$load->sm_pengirim,
$load->sm_perihal
						]);
						// $cellWidth = 73; //lebar sel
						// $cellHeight = 5; //tinggi sel satu baris normal
						// //periksa apakah teksnya melibihi kolom?
						// if ($pdf->GetStringWidth($load->sm_perihal) < $cellWidth) {
						// 	//jika tidak, maka tidak melakukan apa-apa
						// 	$line = 1;
						// } else {
						// 	//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
						// 	//dengan memisahkan teks agar sesuai dengan lebar sel
						// 	//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel
						// 	$textLength = strlen($load->sm_perihal);	//total panjang teks
						// 	$errMargin = 2;		//margin kesalahan lebar sel, untuk jaga-jaga
						// 	$startChar = 0;		//posisi awal karakter untuk setiap baris
						// 	$maxChar = 0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
						// 	$textArray = array();	//untuk menampung data untuk setiap baris
						// 	$tmpString = "";		//untuk menampung teks untuk setiap baris (sementara)
						// 	while ($startChar < $textLength) { //perulangan sampai akhir teks
						// 		//perulangan sampai karakter maksimum tercapai
						// 		while (
						// 			$pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) &&
						// 			($startChar + $maxChar) < $textLength
						// 		) {
						// 			$maxChar++;
						// 			$tmpString = substr($load->sm_perihal, $startChar, $maxChar);
						// 		}
						// 		//pindahkan ke baris berikutnya
						// 		$startChar = $startChar + $maxChar;
						// 		//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
						// 		array_push($textArray, $tmpString);
						// 		//reset variabel penampung
						// 		$maxChar = 0;
						// 		$tmpString = '';
						// 	}
						// 	//dapatkan jumlah baris
						// 	$line = count($textArray);
						// }

						// $pdf->cell(8, ($line * $cellHeight), $no++, 1, 0, 'C');
						// $pdf->cell(15, ($line * $cellHeight), $load->sm_no_urut, 1, 0, 'C');
						// $pdf->cell(22, ($line * $cellHeight), $load->sm_tgl_diterima, 1, 0, 'C');
						// $pdf->cell(22, ($line * $cellHeight), $load->sm_tgl_surat, 1, 0, 'C');
						// $pdf->cell(50, ($line * $cellHeight), $load->sm_pengirim, 1, 0, 'L');
						// $pdf->MultiCell($cellWidth, $cellHeight, $load->sm_perihal, 1, 1, 'L', false);
					}

					$pdf->Ln(5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(130, 5, '', 0, 0, 'L');
$pdf->Cell(0, 5, $data['md']->jabatan, 0, 1, 'L');
$pdf->Ln(10);

// Menambahkan ruang untuk tanda tangan
$pdf->Cell(130, 20, '', 0, 0, 'L'); // Menentukan tinggi ruang untuk tanda tangan, sesuaikan jika perlu
$pdf->Image('foto/ttd.png', $pdf->GetX(), $pdf->GetY(), 30); // Menambahkan gambar tanda tangan dengan lebar 30, sesuaikan jika perlu

$pdf->Ln(20); // Menambahkan jarak setelah tanda tangan
$pdf->Cell(130, 5, '', 0, 0, 'L');
$pdf->Cell(0, 5, $data['md']->nm_kepala, 0, 1, 'L');


					$pdf->Output('I', 'Laporan Surat Masuk' . '.pdf');
				}
			} else {
				redirect('404_content');
			}
		}
	}

	public function lap_ska()
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			    = $this->Mcrud->get_users_by_un($ceks);
			$data['judul_web']			= "Sistem Informasi Administrasi Surat | SIAS";

			$this->load->view('users/header', $data);
			$this->load->view('users/laporan/lap_ska', $data);
			$this->load->view('users/footer');

			if (isset($_POST['filterSKA'])) {
				$tgl1 	= date('Y-m-d', strtotime(htmlentities(strip_tags($this->input->post('tgl1')))));
				$tgl2 	= date('Y-m-d', strtotime(htmlentities(strip_tags($this->input->post('tgl2')))));

				redirect("users/data_ska/$tgl1/$tgl2");
			}
		}
	}

	public function data_ska($tgl1 = '', $tgl2 = '')
	{
		$ceks 	 = $this->session->userdata('duodragondev@gmail.com');
		$data['md'] = $this->db->get_where("tbl_lembaga")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {

			if ($tgl1 != '' and $tgl2 != '') {
				$data['sql'] = $this->db->query("SELECT * FROM tbl_ska INNER JOIN tbl_bagian ON tbl_ska.ska_bagian=tbl_bagian.id_bagian WHERE (ska_tanggal BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_ska DESC");
				$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
				$data['judul_web'] = "Sistem Informasi Administrasi Surat | SIAS";
				$this->load->view('users/header', $data);
				$this->load->view('users/laporan/data_ska', $data);
				$this->load->view('users/footer', $data);

				if (isset($_POST['cetakSKA'])) {
					$data['ska'] = $this->db->query("SELECT * FROM tbl_ska INNER JOIN tbl_bagian ON tbl_ska.ska_bagian=tbl_bagian.id_bagian WHERE (ska_tanggal BETWEEN '$tgl1' AND '$tgl2') ORDER BY ska_tanggal DESC")->result();
					$pdf = new FPDF('P', 'mm', 'A4');
					$pdf->AddPage();
					$pdf->AliasNbPages();
					$pdf->SetTitle('Laporan Surat Keluar', true);
					$pdf->SetFont('Arial', '', 7);
					$pdf->Image('foto/logo.png', 10, 10, 20);

					$pdf->SetFont('Arial', 'B', 16);
					$pdf->Cell(0, 5, $data['md']->kop_1, '', 1, 'C');
					$pdf->Cell(0, 5, $data['md']->kop_2, '', 1, 'C');
					$pdf->SetFont('Arial', '', 10);
					$pdf->Cell(0, 5, $data['md']->alamat . ' - ' . $data['md']->telp, '', 1, 'C');
					$pdf->Cell(0, 5, 'Website: ' . $data['md']->website . '; Email: ' . $data['md']->email, '', 1, 'C');
					$pdf->Ln(3);
					$pdf->Cell(0, 0.8, '', '', 1, 'C', true);
					$pdf->Ln(0.5);
					$pdf->Cell(0, 0.5, '', '', 1, 'C', true);

					$pdf->Ln(5);
					$pdf->SetFont('Arial', 'B', 11);
					$pdf->Cell(0, 5, 'LAPORAN SURAT KELUAR', 0, 1, 'C');
					$pdf->Cell(0, 5, 'TAHUN ' . substr($tgl1, 0, 4), 0, 1, 'C');

					$pdf->Ln(5);
					$pdf->SetFont('Arial', '', 8);
					$pdf->Cell(0, 5, 'Laporan Tgl. ' . date('d-m-Y', strtotime($tgl1)) . '/' . date('d-m-Y', strtotime($tgl2)), 0, 1, 'L');

					$pdf->SetFont('Arial', 'B', 11);
					$pdf->SetDrawColor(80, 80, 80);
					$pdf->SetFillColor(200, 200, 200);
					$pdf->SetTextColor(0);
					$pdf->SetFont('Arial', 'B', 8);
					$pdf->Cell(8, 10, "NO", 1, 0, 'C', 'F');
					$pdf->Cell(20, 10, "TGL SURAT", 1, 0, 'C', 'F');
					$pdf->Cell(30, 10, "JABATAN", 1, 0, 'C', 'F');
					$pdf->Cell(60, 10, "KEPADA", 1, 0, 'C', 'F');
					$pdf->Cell(0, 10, "PERIHAL", 1, 1, 'C', 'F');
					$no = 1;
					$pdf->SetDrawColor(80, 80, 80);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->SetTextColor(0);
					$pdf->SetFont('Arial', '', 8);
					foreach ($data['ska'] as $load) {
						$cellWidth = 72; //lebar sel
						$cellHeight = 5; //tinggi sel satu baris normal
						//periksa apakah teksnya melibihi kolom?
						if ($pdf->GetStringWidth($load->ska_hal) < $cellWidth) {
							//jika tidak, maka tidak melakukan apa-apa
							$line = 1;
						} else {
							//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
							//dengan memisahkan teks agar sesuai dengan lebar sel
							//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel
							$textLength = strlen($load->ska_hal);	//total panjang teks
							$errMargin = 2;		//margin kesalahan lebar sel, untuk jaga-jaga
							$startChar = 0;		//posisi awal karakter untuk setiap baris
							$maxChar = 0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
							$textArray = array();	//untuk menampung data untuk setiap baris
							$tmpString = "";		//untuk menampung teks untuk setiap baris (sementara)
							while ($startChar < $textLength) { //perulangan sampai akhir teks
								//perulangan sampai karakter maksimum tercapai
								while (
									$pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) &&
									($startChar + $maxChar) < $textLength
								) {
									$maxChar++;
									$tmpString = substr($load->ska_hal, $startChar, $maxChar);
								}
								//pindahkan ke baris berikutnya
								$startChar = $startChar + $maxChar;
								//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
								array_push($textArray, $tmpString);
								//reset variabel penampung
								$maxChar = 0;
								$tmpString = '';
							}
							//dapatkan jumlah baris
							$line = count($textArray);
						}

						$pdf->cell(8, ($line * $cellHeight), $no++, 1, 0, 'C');
						$pdf->cell(20, ($line * $cellHeight), $load->ska_tanggal, 1, 0, 'C');
						$pdf->cell(30, ($line * $cellHeight), $load->bagian_nama, 1, 0, 'L');
						$pdf->cell(60, ($line * $cellHeight), $load->ska_kpd, 1, 0, 'L');
						$pdf->MultiCell($cellWidth, $cellHeight, $load->ska_hal, 1, 1, 'L', false);
					}

					$pdf->Ln(5);
					$pdf->SetFont('Arial', '', 9);
					$pdf->Cell(130, 5, '', 0, 0, 'L');
					$pdf->Cell(0, 5, $data['md']->jabatan, 0, 1, 'L');
					$pdf->Ln(10);
					$pdf->Cell(130, 5, '', 0, 0, 'L');
					$pdf->Cell(0, 5, $data['md']->nm_kepala, 0, 1, 'L');

					$pdf->Output('I', 'Laporan Surat Keluar' . '.pdf');
				}
			} else {
				redirect('404_content');
			}
		}
	}
}
