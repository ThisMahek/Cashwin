<?php
class UserDashboard_Model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function last_credit_by_id($userid)
	{
		$this->db->where('user_id', $userid)->where('type', 'Add');
		return $this->db->order_by('request_id', "desc")->limit(1)->get('tblRequest')->row();
	}
	public function last_withdrwal_by_id($userid)
	{

		$this->db->where('user_id', $userid)->where('type', 'Withdrawal');
		return $this->db->order_by('request_id', "desc")->limit(1)->get('tblRequest')->row();
	}

	public function get_user_profile_by_id($userid)
	{
		$query = $this->db->join('tblwallet', 'user_profile.id=tblwallet.user_id')->where('id', $userid)->get('user_profile');
		return $query->row();
	}

	public function get_bid_history($user_id)
	{
		$sel = "SELECT tblgamedata.*, matka.name as matka_name,tblgame.name as game_name FROM `tblgamedata` JOIN matka ON tblgamedata.matka_id=matka.id JOIN tblgame ON tblgamedata.game_id=tblgame.game_id where user_id='$user_id' ORDER BY `time` DESC";
		$query = $this->db->query($sel);
		$aa = $query->result_array();
		return ($aa) ? $aa : false;
	}

	public function get_credit_debit_history($user_id)
	{
		$this->db->where('user_id', $user_id);
		return $this->db->order_by('request_id', "desc")->get('tblRequest')->result();
	}




}