<?php
class UserDashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$fun = $this->router->fetch_method();
		if (!$this->session->userdata('login') && $fun != "app_bid_history" && $fun != 'app_startline_bid_history')
			redirect(site_url("admin/login"));
	}

	public function dashboard($userid)
	{
		if (!$this->session->userdata('login')) {
			redirect(site_url("admin/login"));
		}
		if (!file_exists(APPPATH . 'views/admin/index.php')) {
			show_404();
		}
		$data['userid'] = $userid;
		$data['users'] = $this->UserDashboard_Model->get_user_profile_by_id($userid);

		$data['add_point_reqs'] = $this->Administrator_Model->add_point_req($userid);
		$data['from_date'] = $date_from = ($this->input->get('from_date')) ?: date('Y-m-d');
		$data['to_date'] = $date_to = ($this->input->get('from_date')) ?: date('Y-m-d');
		$game_type = "matka";
		$status = "";
		$data['user_bid_history'] = $this->Game->user_bid_history("", "", "", $userid, "", $date_from, $date_to, $game_type);
		$data['user_win_history'] = $this->Game->user_bid_history("", "", "", $userid, "win", $date_from, $date_to, $game_type);
		$data['last_credit'] = $this->UserDashboard_Model->last_credit_by_id($userid);
		$data['last_withdrwal'] = $this->UserDashboard_Model->last_withdrwal_by_id($userid);
		$data['withdraw_request'] = $this->Administrator_Model->withdraw_point_req($userid);
		$data['credit_debit'] = $this->UserDashboard_Model->get_credit_debit_history($userid);
		// print_r($data['credit_debit'] );exit;

		$data['total_bids'] = $this->UserDashboard_Model->get_bid_history($userid);

		// if($is_demo==0)
		$this->load->view('admin/user_dashboard/index1', $data);
		//     else
		// 		$this->load->view('admin/user_dashboard/index',$data);
	}

	public function total_bids_by_id($userid)
	{
		$data['title'] = 'Total Bids Of User';
		$data['user'] = $this->UserDashboard_Model->get_user_profile_by_id($userid);
		$data['users'] = $this->UserDashboard_Model->get_bid_history($userid);
		$data['uid'] = $userid;
		$this->load->view('admin/user_dashboard/app_bid_history', $data);
	}

	public function debit_credit_details_by_id($userid)
	{
		$data['title'] = 'Full Credit/Debit Details Of User';
		$data['user'] = $this->UserDashboard_Model->get_user_profile_by_id($userid);
		$data['users'] = $this->UserDashboard_Model->get_credit_debit_history($userid);
		$data['uid'] = $userid;
		$this->load->view('admin/user_dashboard/debit_credit_details', $data);
	}



}