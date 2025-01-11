<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcrud extends CI_Model
{

	var $tbl_users				 	= 'tbl_users';
	var $tbl_bagian		 		 	= 'tbl_bagian';
	var $tbl_siswa		 			= 'tbl_siswa';
	var $tbl_sm		 				= 'tbl_sm';
	var $tbl_ska	 				= 'tbl_ska';
	var $tbl_lembaga	 			= 'tbl_lembaga';

	public function get_users()
	{
		$this->db->from($this->tbl_users);
		$query = $this->db->get();
		return $query;
	}

	public function get_users_daftar()
	{
		$this->db->from($this->tbl_users);
		$this->db->where('status', 'terdaftar');
		$query = $this->db->get();
		return $query;
	}

	public function get_level_users()
	{
		$this->db->from($this->tbl_users);
		$this->db->join('tbl_bagian', 'tbl_users.bagian_id=tbl_bagian.id_bagian');
		$query = $this->db->get();
		return $query;
	}

	public function get_bagian()
	{
		$this->db->from($this->tbl_bagian);
		$query = $this->db->get();
		return $query;
	}

	public function get_users_by_un($id)
	{
		$this->db->from($this->tbl_users);
		$this->db->where('pegawai_nip', $id);
		$query = $this->db->get();
		return $query;
	}

	public function get_level_users_by_id($id)
	{
		$this->db->from($this->tbl_users);
		$this->db->where('tbl_user.level', 'user');
		$this->db->where('tbl_user.id_user', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function save_user($data)
	{
		$this->db->insert($this->tbl_users, $data);
		return $this->db->insert_id();
	}

	public function update_user($where, $data)
	{
		$this->db->update($this->tbl_users, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_user_by_id($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tbl_users);
	}

	public function save_bagian($data)
	{
		$this->db->insert($this->tbl_bagian, $data);
		return $this->db->insert_id();
	}

	public function update_bagian($where, $data)
	{
		$this->db->update($this->tbl_bagian, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_bagian_by_id($id)
	{
		$this->db->where('id_bagian', $id);
		$this->db->delete($this->tbl_bagian);
	}

	public function save_ns($data)
	{
		$this->db->insert($this->tbl_ns, $data);
		return $this->db->insert_id();
	}

	public function update_ns($where, $data)
	{
		$this->db->update($this->tbl_ns, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_ns_by_id($id)
	{
		$this->db->where('id_ns', $id);
		$this->db->delete($this->tbl_ns);
	}

	// get data dropdown
	function data_sm($aksi = '', $id = '')
	{
		// ambil data dari db
		if ($aksi != 'semua') {
			$this->db->where('sm_no_surat_asal', $aksi);
		}
		$this->db->where('user_id', $id);
		$this->db->order_by('no_surat', 'asc');
		$query = $this->db->get('tbl_sm')->result();
		return $query;
	}

	public function save_sm($data)
	{
		$this->db->insert($this->tbl_sm, $data);
		return $this->db->insert_id();
	}

	public function update_sm($where, $data)
	{
		$this->db->update($this->tbl_sm, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_sm_by_id($id)
	{
		$this->db->where('id_sm', $id);
		$this->db->delete($this->tbl_sm);
	}

	public function delete_lampiran($id)
	{
		$this->db->where('token_lampiran', $id);
		$this->db->delete('tbl_lampiran');
	}

	public function save_siswa($data)
	{
		$this->db->insert($this->tbl_siswa, $data);
		return $this->db->insert_id();
	}

	public function update_siswa($where, $data)
	{
		$this->db->update($this->tbl_siswa, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_siswa_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_siswa);
	}

	public function save_diklat($data)
	{
		$this->db->insert($this->tbl_diklat, $data);
		return $this->db->insert_id();
	}
	public function update_diklat($where, $data)
	{
		$this->db->update($this->tbl_diklat, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_diklat_by_id($id)
	{
		$this->db->where('id_diklat', $id);
		$this->db->delete($this->tbl_diklat);
	}

	public function save_ska($data)
	{
		$this->db->insert($this->tbl_ska, $data);
		return $this->db->insert_id();
	}

	public function update_ska($where, $data)
	{
		$this->db->update($this->tbl_ska, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_ska_by_id($id)
	{
		$this->db->where('id_ska', $id);
		$this->db->delete($this->tbl_ska);
	}

	public function save_md($data)
	{
		$this->db->insert($this->tbl_lembaga, $data);
		return $this->db->insert_id();
	}
	public function update_md($where, $data)
	{
		$this->db->update($this->tbl_lembaga, $data, $where);
		return $this->db->affected_rows();
	}
}
