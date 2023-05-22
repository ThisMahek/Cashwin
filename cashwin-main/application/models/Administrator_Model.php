<?php
class Administrator_Model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function adminLogin($email, $encrypt_password)
	{
		//Validate
		$this->db->where('email', $email);
		$this->db->where('password', $encrypt_password);

		$result = $this->db->get('users');
		if ($result->num_rows() == 1) {
			return $result->row(0);
		} else {
			return false;
		}
	}
	public function app_setting()
	{
		$query = $this->db->get('app_setting');
		$app_data = $query->row();
		// print_r($app_data);
		return $app_data;
		// 			exit;

	}
	public function totaladdpoint()
	{
		$query = $this->db->query("SELECT request_points,time FROM `tblRequest` WHERE type='Add' AND request_status='approved'");

		$results = $query->result_array();

		return $results;
	}
	public function totalwithdrawpoint()
	{
		$query = $this->db->query("SELECT request_points,time FROM `tblRequest` WHERE type='Withdrawal' AND request_status='approved'");

		$results = $query->result_array();

		return $results;
	}
	public function getTotalWalletAmt()
	{
		$total_wallet = $this->db->select("SUM(tblwallet.wallet_points) as points")->from('tblwallet')->join('user_profile', 'user_profile.id=tblwallet.user_id')->where('user_profile.login_status', 0)->get()->row();
		return $total_wallet->points;
	}

	public function update_appsetting()
	{
		$app = array(

			//  'withdraw_text'=>$this->input->post('withdrawtext'),
			// 'add_fund_text'=>$this->input->post('add_fund_text'),
			//  'withdraw_no'=>$this->input->post('withdrawnumber'),
			// 'privacy_policy'=>$this->input->post('privacy_pol'),
			// 'account_holder_name'=>$this->input->post('account_holder_name'),
			// 'account_number'=>$this->input->post('account_number'),
			// 'ifsc_code'=>$this->input->post('ifsc_code'),

			// 'google_upi'=>$this->input->post('google_upi'),
			// 'phonepe_upi'=>$this->input->post('phonepe_upi'),
			// 'upi'=>$this->input->post('upi'),
			// 'is_show_message'=>$this->input->post('is_show_message'),
			//  'min_amount'=>$this->input->post('min_amount'),
			// 'maximum_deposite'=>$this->input->post('maximum_deposite'),
			// 'w_amount'=>$this->input->post('w_amount'),
			// 'maximum_withdrawal'=>$this->input->post('maximum_withdrawal'),
			// 'minimum_transfer'=>$this->input->post('minimum_transfer'),
			// 'maximum_transfer'=>$this->input->post('maximum_transfer'),
			// 'welcome_bonus'=>$this->input->post('welcome_bonus'),
			// 'withdraw_open_time'=>$this->input->post('withdraw_open_time'),
			// 'withdraw_close_time'=>$this->input->post('withdraw_close_time'),
			// 'is_global_batting'=>$this->input->post('is_global_batting'),
			//  'tag_line'=>$this->input->post('tag_line'),
			'message' => $this->input->post('message'),
			'withdraw_text' => $this->input->post('withdraw_text'),
			'withdraw_no' => $this->input->post('withdraw_no'),
			'home_text' => $this->input->post('home_text'),
			'min_amount' => $this->input->post('min_amount'),
			//  'msg_status'=>$this->input->post('msg_status'),
			'app_link' => $this->input->post('app_link'),
			'share_link' => $this->input->post('share_link'),
			'add_fund_text' => $this->input->post('add_fund_text'),
			'chart_url' => $this->input->post('chart_url'),
			//     'no_chart_msg'=>$this->input->post('no_chart_msg'),
			'r_addpoint' => $this->input->post('r_addpoint'),
			'r_starline' => $this->input->post('r_starline'),
			'r_withdraw' => $this->input->post('r_withdraw'),
			'r_game' => $this->input->post('r_game'),
			'r_profile' => $this->input->post('r_profile'),
			'r_version' => $this->input->post('r_version'),
			'privacy_policy' => $this->input->post('privacy_pol'),
			'upi' => $this->input->post('upi'),
			'upi_name' => $this->input->post('upi_name'),
			'upi_desc' => $this->input->post('upi_desc'),
			//  'transfer_fee'=>$this->input->post('transfer_fee'),
		);
		$this->db->where('id', 1);
		$this->db->update('app_setting', $app);

		$site_arr = array(
			'mobile' => $this->input->post('mobile_no'),
			'whatsapp' => $this->input->post('whatsapp_no')
		);
		$this->db->where('id', 1);
		$this->db->update('site_config', $site_arr);

		return 1;
	}

	public function update_contact_setting()
	{
		$app = array(
			'mobile_number' => $this->input->post('mobile_number'),
			// 'mobile_number_optional'=>$this->input->post('mobile_number_optional'),
			'whatsapp_no' => $this->input->post('whatsapp_no'),
			'home_contact' => $this->input->post('home_contact'),
			// 'landline_2'=>$this->input->post('landline_2'),
			// 'email_1'=>$this->input->post('email_1'),
			'email_2' => $this->input->post('email_2'),
			'facebook' => $this->input->post('facebook'),
			'twitter' => $this->input->post('twitter'),
			'youtube' => $this->input->post('youtube'),
			'google_plus' => $this->input->post('google_plus'),
			'instagram' => $this->input->post('instagram'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude'),
			'address' => $this->input->post('address'),


		);
		$this->db->where('id', 1);
		$this->db->update('app_setting', $app);



		return 1;
	}

	public function update_how_to_play()
	{
		$app = array(
			'how_to_play' => $this->input->post('how_to_play'),
			'video_link' => $this->input->post('video_link'),
		);
		$this->db->where('id', 1);
		$this->db->update('app_setting', $app);
		return 1;
	}
	public function update_slider_status($id, $data)
	{
		$this->db->where('id', $id)->update('sliders_img', $data);
		return true;
	}
	public function get_posts($slug = FALSE)
	{
		if ($slug === FALSE) {
			$query = $this->db->order_by('id', 'DESC');
			$query = $this->db->get('posts');
			return $query->result_array();
		}

		$query = $this->db->get_where('posts', array('slug' => $slug));
		return $query->row_array();
	}
	public function deletegamedata($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('tblgamedata');
	}

	public function gamedata($from = "", $to = "")
	{
		if ($from == "")
			$from = date("d/m/Y");
		if ($to == "")
			$to = date("d/m/Y");
		//date BETWEEN '$from' AND '$to'
		$this->db->where('DATE(time) >=', "'" . $from . "'", false);
		$this->db->where('DATE(time) <=', "'" . $to . "'", false);
		return $this->db->get('tblgamedata')->result();
	}
	public function gamebyid($id)
	{
		$this->db->where('game_id', $id);
		return $this->db->get('tblgame')->row();
	}
	public function userbyid($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('user_profile')->row();
	}
	public function matkabyid($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('matka')->row();
	}
	public function starlinebyid($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('tblStarline')->row();
	}
	public function create_post()
	{
		$slug = url_title($this->input->post('title'), "dash", TRUE);

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'body' => $this->input->post('body'),
			'category_id' => $this->input->post('category_id')
		);
		return $this->db->insert('posts', $data);
	}

	public function delete($id, $table, $key = 'id')
	{
		$this->db->where($key, $id);
		$this->db->delete($table);
		return true;
	}

	public function get_categories()
	{
		$this->db->order_by("id", "DESC");
		$query = $this->db->get('categories');
		return $query->result_array();
	}

	public function add_user($post_image, $password)
	{
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => $password,
			'username' => $this->input->post('username'),
			'zipcode' => $this->input->post('zipcode'),
			'contact' => $this->input->post('contact'),
			'address' => $this->input->post('address'),
			'gender' => $this->input->post('gender'),
			'role_id' => '2',
			'status' => $this->input->post('status'),
			'dob' => $this->input->post('dob'),
			'image' => $post_image,
			'password' => $password,
			'register_date' => date("Y-m-d H:i:s")

		);
		return $this->db->insert('users', $data);
	}

	public function get_users($username = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}

		if ($username === FALSE) {
			$this->db->order_by('users.id', 'DESC');
			//$this->db->join('categories', 'categories.id = posts.category_id');
			$query = $this->db->get('users');
			return $query->result_array();
		}

		$query = $this->db->get_where('users', array('username' => $username));
		return $query->row_array();
	}

	public function enable($id, $table)
	{
		$data = array(
			'status' => 0
		);
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
	}
	public function disable($id, $table)
	{
		$data = array(
			'status' => 1
		);
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
	}

	public function get_user($id = FALSE)
	{
		if ($id === FALSE) {
			$query = $this->db->get('users');
			return $query->result_array();
		}

		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row_array();
	}

	public function get_user_profile()
	{
		$query = $this->db->where('mobileno !=', '0')->join('tblwallet', 'user_profile.id=tblwallet.user_id')->get('user_profile');
		return $query->result_array();
	}
	public function get_unapproved_user_profile()
	{
		$query = $this->db->where('mobileno !=', '0')->where('bank_status', '0')->join('tblwallet', 'user_profile.id=tblwallet.user_id')->get('user_profile');
		return $query->result_array();
	}

	public function getGameName($id)
	{
		$q = "SELECT name FROM tblgame WHERE game_id='$id'";
		$query = $this->db->query($q)->row_array();
		return $query['name'];
	}

	public function get_games($mid)
	{
		$q = "SELECT * FROM tblgamedata LEFT JOIN tblgame ON tblgamedata.game_id=tblgame.game_id WHERE tblgamedata.matka_id='$mid' GROUP BY tblgame.game_id";
		//$q = "SELECT * from tblgame order by game_id";
		$query = $this->db->query($q);
		return $query->result_array();
	}

	public function get_point_lists($mid)
	{
		//CONVERT(varchar, '2017-08-25', 101)
		$limit = 0; //46600;
		$q = "SELECT game_id,date,bet_type,digits,tblgamedata.points FROM tblgamedata WHERE tblgamedata.matka_id='$mid' and tblgamedata.id>" . $limit . " ORDER BY date DESC";
		$query = $this->db->query($q);
		$tbl = $query->result_array();
		$t = array();
		foreach ($tbl as $tb):
			$gid = $tb['game_id'];
			$bet_type = $tb['bet_type'];
			$digits = $tb['digits'];
			if ($gid == 12 || $gid == 13) {
				$bet = '--';
				$digit = $bet_type . '-' . $digits;
			} else {
				$bet = $bet_type;
				$digit = $digits;
			}
			if (!isset($t[$tb['date']][$gid][$bet][$digit]))
				$t[$tb['date']][$gid][$bet][$digit] = 0;
			$t[$tb['date']][$gid][$bet][$digit] += $tb['points'];
		endforeach;
		$d = array();
		$i = 0;
		foreach ($t as $k => $tx): foreach ($tx as $k1 => $txt): foreach ($txt as $k2 => $txts): foreach ($txts as $k3 => $txtx):
						$d[$i][] = $this->getGameName($k1);
						$d[$i][] = $k2;
						$d[$i][] = $k;
						$d[$i][] = $k3;
						$d[$i][] = $txtx;
						$i++;
					endforeach;
				endforeach;
			endforeach;
		endforeach;
		//print_r($d);
		//array(array("gid", "bettype", "digits", "points"))
		return $d;
	}

	public function get_user_games($id, $mid)
	{
		$q = "SELECT DISTINCT user_profile.id, user_profile.username FROM tblgamedata LEFT JOIN user_profile ON tblgamedata.user_id=user_profile.id WHERE tblgamedata.game_id='$id' and tblgamedata.matka_id='$mid'";
		//$q = "SELECT DISTINCT user_profile.id, user_profile.username from tblgame, user_profile,tblgamedata where tblgamedata.game_id='$id' and user_id=user_profile.id";
		$query = $this->db->query($q);
		return $query->result_array();
	}


	public function get_history($user_id, $matka_id, $game_id)
	{
		$sel = "SELECT DISTINCT tblgame.name,user_profile.username, tblgamedata.points, tblgamedata.digits, date, tblgamedata.time,bet_type,tblgamedata.user_id, tblgamedata.matka_id,tblgamedata.game_id, tblgamedata.id from tblgame, user_profile,tblgamedata where tblgame.game_id='$game_id' and tblgamedata.game_id='$game_id' and user_id=user_profile.id and user_id='$user_id' and matka_id='$matka_id' order by tblgamedata.id";
		$query = $this->db->query($sel);
		$aa = $query->result_array();
		return ($aa) ? $aa : false;
	}

	public function get_today_matka_bid_amount($matka_id = "")
	{
		$today = date('Y-m-d');
		$bet_amt_query = "";
		if ($matka_id == "") {
			$bet_amt_query = "SELECT SUM(points) as matka_bid_amt from tblgamedata where DATE(time)='$today'";
		} else {
			$bet_amt_query = "SELECT SUM(points) as matka_bid_amt from tblgamedata where matka_id='$matka_id' AND DATE(time)='$today'";
		}
		$query = $this->db->query($bet_amt_query);
		$aa = $query->result_array();
		return ($aa) ? $aa : false;
	}

	public function get_today_bid_amount()
	{
		$today = date('Y-m-d');
		$today_bet_amt = "SELECT SUM(points) as bid_amt from tblgamedata where DATE(time)='$today' ";
		$query = $this->db->query($today_bet_amt);
		$aa = $query->row_array();
		return ($aa) ? $aa : false;
	}

	public function get_bid_history($user_id)
	{
		//SELECT tblgamedata.*, matka.name as matka_name,tblgame.name as game_name FROM `tblgamedata` JOIN matka ON tblgamedata.matka_id=matka.id JOIN tblgame ON tblgamedata.game_id=tblgame.game_id where user_id=866
		$sel = "SELECT tblgamedata.*, matka.name as matka_name,tblgame.name as game_name FROM `tblgamedata` JOIN matka ON tblgamedata.matka_id=matka.id JOIN tblgame ON tblgamedata.game_id=tblgame.game_id where user_id='$user_id' ORDER BY tblgamedata.date DESC";
		//  $sel = "SELECT DISTINCT tblgame.name,user_profile.username, tblgamedata.points, tblgamedata.digits, date, tblgamedata.time,bet_type,tblgamedata.user_id, tblgamedata.matka_id,tblgamedata.game_id, tblgamedata.id from tblgame, user_profile,tblgamedata where tblgame.game_id='$game_id' and tblgamedata.game_id='$game_id' and user_id=user_profile.id and user_id='$user_id' and matka_id='$matka_id' order by tblgamedata.id";
		$query = $this->db->query($sel);
		$aa = $query->result_array();
		return ($aa) ? $aa : false;
	}

	public function get_startline_bid_history($user_id)
	{
		//SELECT tblgamedata.*, matka.name as matka_name,tblgame.name as game_name FROM `tblgamedata` JOIN matka ON tblgamedata.matka_id=matka.id JOIN tblgame ON tblgamedata.game_id=tblgame.game_id where user_id=866
		$sel = "SELECT tblgamedata.*, tblStarline.s_game_time as matka_name,tblgame.name as game_name FROM `tblgamedata` JOIN tblStarline ON tblgamedata.matka_id=tblStarline.id JOIN tblgame ON tblgamedata.game_id=tblgame.game_id where user_id='$user_id' ORDER BY tblgamedata.date DESC";
		//  $sel = "SELECT DISTINCT tblgame.name,user_profile.username, tblgamedata.points, tblgamedata.digits, date, tblgamedata.time,bet_type,tblgamedata.user_id, tblgamedata.matka_id,tblgamedata.game_id, tblgamedata.id from tblgame, user_profile,tblgamedata where tblgame.game_id='$game_id' and tblgamedata.game_id='$game_id' and user_id=user_profile.id and user_id='$user_id' and matka_id='$matka_id' order by tblgamedata.id";
		$query = $this->db->query($sel);
		$aa = $query->result_array();
		return ($aa) ? $aa : false;
	}

	public function add_wallet($no)
	{
		$query = $this->db->query("SELECT * FROM user_profile where mobileno='$no'");
		return $query->result_array();
	}

	public function add_wallet2($id, $wa)
	{


		$query = $this->db->query("Update tblwallet set wallet_points=wallet_points+'$wa' where user_id='$id'");

		if ($query) {
			return true;

		}

	}

	public function add_wallet3($id, $wa)
	{
		$query = $this->db->query("Insert into tblwallet(wallet_points,user_id) values('$wa','$id')");

		if ($query) {
			return true;

		}

	}

	public function check_wallet($id)
	{
		$query = $this->db->query("select * from tblwallet where user_id= '$id'");
		return $query->result_array();
	}

	public function check_wallet_amt($id)
	{
		$query = $this->db->query("select SUM(wallet_points) as amt from tblwallet where user_id= '$id'");
		return $query->row_array()['amt'];
	}

	public function ch_amt($amt, $id)
	{
		$wallet = $this->check_wallet_amt($id);
		$am = $wallet - $amt;
		return (int) $am;
	}

	public function notify($q)
	{
		$query = $this->db->query($q);

		if ($q)
			return true;

	}

	public function add_point_req_by_admin($points, $user_id)
	{
		$type = ($points > 0) ? "Add" : "Withdrawal";
		$insert_query = array("request_points" => $points, "user_id" => $user_id, "type" => $type, "request_status" => "approved", "is_admin" => 1);
		$query = $this->db->insert('tblRequest', $insert_query);
		return $query;
	}

	public function add_pending_point_req()
	{
		$query = $this->db->where('type', 'Add')->where('request_status', 'pending')->order_by("time", "desc")->get('tblRequest');
		return $query->result_array();
	}
	public function add_point_req($uid = "")
	{
		if ($uid != "")
			$this->db->where('user_id', $uid);
		$query = $this->db->where(['type' => 'Add', 'request_status' => 'pending'])->order_by("time", "desc")->get('tblRequest');
		return $query->result_array();
	}

	public function add_point_req2($id, $comment = "")
	{
		$query = $this->db->query("SELECT * FROM `tblRequest` where type='Add' and request_id='$id'");
		$query2 = $this->db->update('tblRequest', ['request_status' => 'approved', 'comment' => $comment], ['type' => 'Add', 'request_id' => $id]);
		return $query->result_array();
	}

	public function add_point_req3($id, $points)
	{
		$pints = $this->check_wallet($id);
		if ($pints)
			$query = $this->add_wallet2($id, $points);
		else
			$query = $this->add_wallet3($id, $points);
		if ($query)
			return true;
	}

	public function point_req_cancel($id, $comment = "")
	{
		$query = $this->db->update('tblRequest', ['request_status' => 'cancel', 'comment' => $comment], ['request_id' => $id]);
		return $query;
	}

	public function point_req_count()
	{
		$query = $this->db->query("SELECT SUM(IF(type='Withdrawal', 1, 0)) as withdrawal, SUM(IF(type='Add', 1, 0)) as deposit FROM `tblRequest` WHERE request_status='pending'");
		return $query->row();
	}

	public function point_req($user)
	{

		//$query = $this->db->query("SELECT * FROM `tblRequest` WHERE user_id='$user' and request_status='approved'");
		$q = "
            SELECT  tblgamedata.user_id, NULL as comment, points AS Point,digits AS Digit , bet_type AS Type , time AS Date FROM tblgamedata WHERE  user_id = $user
            UNION
            SELECT  history.user_id ,NULL, amt ,digits,type, time FROM history WHERE history.user_id = $user AND history.type = 'c'
            UNION
            SELECT tblRequest.user_id,tblRequest.comment, request_points, NULL AS request_id ,type ,time FROM tblRequest  WHERE tblRequest.user_id = $user and tblRequest.request_status = 'approved'
            order by user_id, Date desc
            ";

		$query = $this->db->query($q);
		$result = $query->result_array();
		return $result;
	}

	public function withdraw_point_req($user_id = FALSE)
	{
		$where['type'] = 'Withdrawal';
		$where['request_status'] = 'pending';
		if ($user_id == TRUE) {
			$where['user_id'] = $user_id;
		}
		return $this->db->get_where('tblRequest', $where)->result_array();
		// $query = $this->db->query("SELECT * FROM `tblRequest` WHERE type='Withdrawal' and request_status='pending' ");
		//	return $query->result_array();
	}
	public function withdraw_point_req_3()
	{

		$query = $this->db->query("SELECT * FROM `tblRequest` WHERE type='Withdrawal' and request_status='pending' ");
		return $query->result_array();
	}
	public function withdraw_report()
	{

		$query = $this->db->query("SELECT * FROM `tblRequest` WHERE type='Withdrawal' and request_status='approved' or request_status='cancel'  ");
		return $query->result_array();
	}
	public function desposit_history()
	{

		$query = $this->db->query("SELECT * FROM `tblRequest` WHERE type='Add' and request_status='approved' ");
		return $query->result_array();
	}

	public function withdraw_point_req2($id, $comment = "")
	{
		$query = $this->db->query("SELECT * FROM `tblRequest` WHERE type='Withdrawal' and request_id='$id'");
		$aa = $query->row_array();
		$amt = $aa['request_points'];
		$user_id = $aa['user_id'];
		//  if($this->ch_amt($amt, $user_id)>=0)
		$wallet_amt = $this->check_wallet_amt($user_id);
		if (($wallet_amt - $amt) >= 0)
			$query2 = $this->db->update('tblRequest', ['request_status' => 'approved', 'comment' => $comment], ['type' => 'Withdrawal', 'request_id' => $id]);
		return $aa;
	}

	public function withdraw_point_req3($id, $points)
	{
		if ($this->ch_amt($points, $id) >= 0)
			$query = $this->db->query("	UPDATE tblwallet set wallet_points=wallet_points-'$points' where user_id='$id' ");
		if ($query)
			return true;
	}

	public function starline()
	{
		$query = $this->db->query("	SELECT * FROM `tblStarline`");
		return $query->result_array();
	}

	public function starline_update($id)
	{
		$query = $this->db->query("	SELECT * FROM `tblStarline` where id='$id' ");
		return $query->result_array();
	}

	public function starline_update2($id, $snum)
	{
		if ($id == "")
			return false;
		$starline_data = $this->db->where('id', $id)->get('tblStarline')->row();
		$snum = trim($snum);
		$stime = isset($_POST['stime']) ? $_POST['stime'] : $starline_data->s_game_time;
		$btime = isset($_POST['btime']) ? $_POST['btime'] : $starline_data->s_game_end_time;
		$stime = date('h:i A', strtotime($stime));
		$btime = date('h:i A', strtotime($btime));
		$snums = explode('-', $snum);
		$data = array("s_game_number" => $snum, "s_game_time" => $stime, "s_game_end_time" => $btime);
		$query = $this->db->update('tblStarline', $data, array("id" => $id));

		//  $snum=trim($this->input->post('snum'));
		//  $stime=trim($this->input->post('stime'));
		//  $btime=trim($this->input->post('btime'));
		//  $stime = date('h:i A', strtotime($stime));
		//  $btime = date('h:i A', strtotime($btime));
		//  $snums = explode('-',$snum);
		//  $data = array("s_game_number" => $snum, "s_game_time" => $stime, "s_game_end_time" => $btime);
		//  $query = $this->db->update('tblStarline', $data, array("id" => $id));

		//Send Notifications
		$send_notifications = true;
		if ($send_notifications):
			$message = $snum;
			@send_notice("", $stime, $message);
		endif;

		$this->update_chart($id, $starline_data->s_game_time, $snums[0], $snums[1]);
		if ($query)
			return true;
	}

	public function update_user_data($post_image)
	{
		$data = array(
			'name' => $this->input->post('name'),
			'zipcode' => $this->input->post('zipcode'),
			'contact' => $this->input->post('contact'),
			'address' => $this->input->post('address'),
			'gender' => $this->input->post('gender'),
			'status' => $this->input->post('status'),
			'dob' => $this->input->post('dob'),
			'image' => $post_image,
			'register_date' => date("Y-m-d H:i:s")
		);

		$this->db->where('id', $this->input->post('id'));
		$d = $this->db->update('users', $data);
	}

	public function get_siteconfiguration($id = FALSE)
	{
		if ($id === FALSE) {
			$query = $this->db->get('site_config');
			return $query->result_array();
		}

		$query = $this->db->get_where('site_config', array('id' => $id));
		return $query->row_array();
	}

	public function update_siteconfiguration($id = FALSE)
	{
		if ($id === FALSE) {
			$query = $this->db->get('site_config');
			return $query->result_array();
		}

		$query = $this->db->get_where('site_config', array('id' => $id));
		return $query->row_array();
	}

	public function update_siteconfiguration_data($post_image)
	{
		$data = array(
			'site_title' => $this->input->post('site_title'),
			'site_name' => $this->input->post('site_name'),
			'logo_img' => $post_image
		);

		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('site_config', $data);
	}

	public function get_mobile_data()
	{
		$query = $this->db->get('site_config');
		return $query->row_array();
	}

	public function update_mobile_data()
	{
		$data = array('mobile' => $this->input->post('mobile'));
		return $this->db->update('site_config', $data);
	}
	//slider
	public function create_slider($post_image)
	{
		$data = array(
			'title' => $this->input->post('title'),
			'image' => $post_image,
			'description' => $this->input->post('description'),
			'status' => $this->input->post('status')
		);
		return $this->db->insert('sliders_img', $data);
	}

	public function get_sliders($id = false)
	{
		if ($id === FALSE) {
			$query = $this->db->get('sliders_img');
			return $query->result_array();
		}

		$query = $this->db->get_where('sliders_img', array('id' => $id));
		return $query->row_array();
	}

	public function get_slider_data($id = FALSE)
	{
		if ($id === FALSE) {
			$query = $this->db->get('sliders_img');
			return $query->result_array();
		}

		$query = $this->db->get_where('sliders_img', array('id' => $id));
		return $query->row_array();
	}

	public function update_slider_data($post_image)
	{
		$data = array(
			'title' => $this->input->post('title'),
			'image' => $post_image,
			'description' => $this->input->post('description'),
			'status' => $this->input->post('status')
		);

		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('sliders_img', $data);
	}

	public function getChart()
	{
		return $this->db->get('charts')->result_array();
	}

	public function getChartDetails($name)
	{
		return $this->db->where('name', $name)->get('charts')->result_array();
	}

	public function update_chart_data()
	{
		$snum = $this->input->post('snum');
		$enum = $this->input->post('enum');
		//die($this->input->post('name'));
		$data = array(
			'name' => $this->input->post('name'),
			'date' => $this->input->post('date'),
			'starting_num' => (!empty($snum)) ? $snum : NULL,
			'result_num' => $this->input->post('num'),
			'end_num' => (!empty($enum)) ? $enum : NULL
		);
		$this->db->where('name', $this->input->post('name') and 'date', $this->input->post('date'));
		return $this->db->update('charts', $data);
	}

	public function add_chart_data()
	{
		$snum = $this->input->post('snum');
		$enum = $this->input->post('enum');
		//die($this->input->post('chart'));
		$data = array(
			'name' => $this->input->post('chart'),
			'date' => $this->input->post('date'),
			'starting_num' => (!empty($snum)) ? $snum : NULL,
			'result_num' => $this->input->post('num'),
			'end_num' => (!empty($enum)) ? $enum : NULL
		);
		//	$this->db->where('name', $this->input->post('name'));
		return $this->db->insert('charts', $data);
	}



	public function getUserDetails()
	{
		return $this->db->get('users')->result_array();
	}

	public function getMumbaiMatkaDetails()
	{
		return $this->db->where('is_delhi_game', 0)->get('matka')->result_array();
	}

	public function getMatkaDetails()
	{
		return $this->db->get('matka')->result_array();
	}

	public function get_total_users()
	{
		//return $this->db->get('user_profile')->result_array();
		$active = $this->db->where('mobileno !=', '0')->get('user_profile')->num_rows();
		$inactive = $this->db->where('mobileno', '0')->get('user_profile')->num_rows();
		$tota = $active + $inactive;
		return $tota;
	}

	// public function create_matka($team_image)

	// 	{
//         $snum = $this->input->post('snum');
//         $enum = $this->input->post('enum');
//         $name= $this->input->post('name');
//         $query = $this->db->get_where('matka', array(
//         'name' => $name
//     ));
//     $count = $query->num_rows();
//      if ($count === 0) {
// 		$data = array(
// 			'name' => $this->input->post('name'), 
// 		    'start_time' => $this->input->post('stime'),
// 		    'end_time' => $this->input->post('etime'),
// 		    'starting_num'  => (!empty($snum)) ? $snum : NULL,
// 		    'number' =>  $this->input->post('num'),   
// 		    'end_num' => (!empty($enum)) ? $enum : NULL,
// 		    'bid_start_time' => $this->input->post('fstime'),
// 		    'bid_end_time' => $this->input->post('fetime')
// 		 //   'min_bid' => $this->input->post('minbid'),
// 		 //   'Max_bid' => $this->input->post('maxbid')
// 		    //'image' => $team_image,
// 		    //'status' => $this->input->post('status'),
// 		    // 'assigned_user' => $this->input->post('user')
// 		    );

	// 		 $data1 = array(
// 			'name' => $this->input->post('name'), 
// 			'date'=> date('Y-m-d'), 
// 		    'starting_num'  => $this->input->post('snum'),
// 		    'result_num' =>  $this->input->post('num'),   
// 		    'end_num' => $this->input->post('enum')
// 		    );   
// 		$this->session->set_flashdata('success', 'Your matka has been created.'); 
// 		$this->db->insert('matka', $data);
// 		$this->db->insert('charts', $data1);
// 		$ref= "list";
// 	}
// 	else {
// 	    $ref= "add";
// 	    $this->session->set_flashdata('fail', 'Name already Exist .');
// 	}
// 	return $ref;
// }


	public function add_daily_market()
	{
		$name = $this->input->post('name');
		$query = $this->db->get_where('matka', array('name' => $name));
		$last_matka_order = $this->db->select('matka_order')->order_by('matka_order', 'desc')->limit('1')->get('matka')->row()->matka_order;

		$count = $query->num_rows();
		if ($count === 0) {
			$data = array(
				'name' => $name,
				'bid_start_time' => $this->input->post('stime'),
				'bid_end_time' => $this->input->post('etime'),
				'sat_start_time' => $this->input->post('sstime'),
				'sat_end_time' => $this->input->post('setime'),
				'start_time' => $this->input->post('sustime'),
				'end_time' => $this->input->post('suetime'),
				'matka_order' => $last_matka_order + 1
			);
			$this->db->insert('matka', $data);
			$this->session->set_flashdata('success', 'Market has been added.');
			$ref = "list";

		} else {
			$ref = "add";
			$this->session->set_flashdata('fail', 'Market Name already Exist.');
		}
		return $ref;
	}
	public function listmatka($teamId = FALSE, $limit = FALSE, $offset = FALSE, $type = 'matka', $matka_id = '', $date_from = '', $date_to = '')
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		$where = [];
		if ($type == 'dmatka') {
			$where['is_delhi_game'] = 1;
		} else {
			$where['is_delhi_game'] = 0;
		}
		if ($teamId === FALSE) {
			//   if($matka_id!="")
			//         $where['id']= $matka_id; 
			//  if($date_from!="" && $date_to!="")
			//         $this->db->where('DATE(time) >=', "'".$date_from."'", false)->where('DATE(time) <=', "'".$date_to."'", false);
			// if($bettype!="")
			// $where['bet_type']= $bettype; 

			$this->db->order_by('matka.id', 'DESC');
			$query = $this->db->get_where('matka', $where);
			return $query->result_array();
		}
		$where['id'] = $teamId;
		$query = $this->db->get_where('matka', $where);
		return $query->row_array();
	}

	public function memberlistteams($id)
	{

		$this->db->order_by('matka.id', 'DESC');
		//$this->db->join('categories as cat', 'cat.id = posts.category_id');
// 			$query = $this->db->where('assigned_user',$id)->get('matka');
		return $query->result_array();
	}

	public function update_starline_data()
	{
		//$id=$this->input->post('id');
		$id = $this->input->post('id');
		//   print_r($id);exit;
		$starline_data = $this->db->where('id', $id)->get('tblStarline')->row();

		$snum = trim($this->input->post('snum'));
		$stime = isset($_POST['stime']) ? $_POST['stime'] : $starline_data->s_game_number;
		$btime = isset($_POST['btime']) ? $_POST['btime'] : $starline_data->s_game_end_time;
		$stime = date('h:i A', strtotime($stime));
		$btime = date('h:i A', strtotime($btime));
		$snums = explode('-', $snum);
		$data = array("s_game_number" => $snum, "s_game_time" => $stime, "s_game_end_time" => $btime);
		$query = $this->db->update('tblStarline', $data, array("id" => $id));

		//Send Notifications
		//         $send_notifications = true;
		//         if($send_notifications):
		//             $message = $snum;
		//             @send_notice("",$stime, $message);
		//         endif;
		//  $this->update_chart($id, $starline_data->s_game_time, $snum[0], $number, $snums[1], $date);
		//  $this->update_chart($id, "Starline", $snums[0], $snums[1]);
		if ($query)
			return true;
	}
	public function update_team_data()
	{
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$game_type = $this->uri->segment(3);

		$c = 0;
		$snum = $this->input->post('snum');
		$enum = $this->input->post('enum');
		$num = $this->input->post('num');
		$id = $this->input->post('id');
		$matka_data = $this->db->where('id', $id)->get('matka')->row();
		$name = isset($_POST['name']) ? $_POST['name'] : $matka_data->name;
		$bettype = $this->input->post('bettype');
		if ($bettype == 'Close') {
			$r_num = $matka_data->number[0] . $num;
			$number = $r_num;
			$end_number = $snum;
			$start_number = $matka_data->starting_num;
			// $close_updated_at=date('d-m-Y');
		}
		if (empty($bettype)) {
			$number = $this->input->post('num');
			$end_number = (!empty($enum)) ? $enum : NULL;
			$start_number = (!empty($snum)) ? $snum : NULL;
		}
		if ($bettype == 'Open') {
			$number = $this->input->post('num');
			$end_number = (!empty($enum)) ? $enum : NULL;
			$start_number = (!empty($snum)) ? $snum : NULL;
			//$open_updated_at=date('d-m-Y');

		}
		if (empty($bettype) && $game_type == 'dmatka') {
			$number = $num;
			$end_number = (!empty($num[1])) ? $num[1] : NULL;
			$start_number = (!empty($num[0])) ? $num[0] : NULL;


		}


		$date = $this->input->post('udate');
		$data = array(
			'name' => $name,
			'start_time' => isset($_POST['stime']) ? $_POST['stime'] : $matka_data->start_time,
			//$this->input->post('stime'),
			'end_time' => isset($_POST['etime']) ? $_POST['etime'] : $matka_data->end_time,
			//$this->input->post('etime'),
			'sat_start_time' => isset($_POST['sstime']) ? $_POST['sstime'] : $matka_data->sat_start_time,
			// $this->input->post('sstime'),
			'sat_end_time' => isset($_POST['setime']) ? $_POST['setime'] : $matka_data->sat_end_time,
			//$this->input->post('setime'),
			'starting_num' => $start_number, //(!empty($snum)) ? $snum : NULL,
			'number' => $number, //$this->input->post('num'),
			'end_num' => $end_number,
			//(!empty($enum)) ? $enum : NULL,
			'bid_start_time' => isset($_POST['fstime']) ? $_POST['fstime'] : $matka_data->bid_start_time, //$this->input->post('fstime'),
			'bid_end_time' => isset($_POST['fetime']) ? $_POST['fetime'] : $matka_data->bid_end_time, //$this->input->post('fetime')
			//  'close_updated_at'=>isset($close_updated_at)?$close_updated_at:$matka_data->close_updated_at,
			//   'open_updated_at'=>isset($open_updated_at)?$open_updated_at:$matka_data->open_updated_at,
			//  'min_bid' => $this->input->post('minbid'),
			//  'max_bid' => $this->input->post('maxbid'),
			//  'image' => $team_image,
			//  'status' => $this->input->post('status')
		);
		$this->db->where('id', $id);
		$this->db->update('matka', $data);
		//$dt = date('Y-m-d', strtotime('-3 hour'));

		return $this->update_chart($id, $name, $start_number, $number, $end_number, $date);
	}

	public function update_chart($id, $name, $snum, $num, $enum = null, $date = null)
	{
		$dt = ($date == null) ? date('Y-m-d') : $date;
		$data1 = array(
			'name' => $name,
			'cid' => $id,
			'date' => $dt,
			'starting_num' => (!empty($snum)) ? $snum : NULL,
			'result_num' => $num,
			'end_num' => (!empty($enum)) ? $enum : NULL
		);
		$where = array('cid' => $id, 'date' => $dt);
		$data2 = $this->db->select("COUNT(id) as counter")->where($where)->get('charts')->row();
		if ($data2->counter > 0) {
			$this->db->where($where);
			$this->db->update('charts', $data1);
		} else {
			$this->db->insert('charts', $data1);
		}
		return true;
	}

	public function get_admin_data()
	{
		$id = $this->session->userdata('user_id');
		if ($id === FALSE) {
			$query = $this->db->get('users');
			return $query->result_array();
		}

		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row_array();
	}

	public function change_password($new_password)
	{
		$data = array(
			'password' => md5($new_password)
		);
		$this->db->where('id', $this->session->userdata('user_id'));
		return $this->db->update('users', $data);
	}

	public function match_old_password($password)
	{
		$id = $this->session->userdata('user_id');
		if ($id === FALSE) {
			$query = $this->db->get('users');
			return $query->result_array();
		}
		$query = $this->db->get_where('users', array('password' => $password));
		return $query->row_array();
	}

	// function start fron forget password
	public function email_exists()
	{
		$email = $this->input->post('email');
		$query = $this->db->query("SELECT email, password FROM users WHERE email='$email'");
		if ($row = $query->row()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function temp_reset_password($temp_pass)
	{
		$data = array(
			'email' => $this->input->post('email'),
			'reset_pass' => $temp_pass
		);
		$email = $data['email'];

		if ($data) {
			$this->db->where('email', $email);
			$this->db->update('users', $data);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function is_temp_pass_valid($temp_pass)
	{
		$this->db->where('reset_pass', $temp_pass);
		$query = $this->db->get('users');
		if ($query->num_rows() == 1) {
			return TRUE;
		} else
			return FALSE;
	}

	public function games($game_type = '', $game_id = '')
	{
		$where['is_deleted'] = 0;

		if ($game_type == 'dmatka') {
			$select = '*';
			$where['is_delhi_game'] = 1;
			$where['is_starline'] = 0;
		} elseif ($game_type == 'starline') {
			$select = 'tblgame.*,starline_points as points';
			$where['is_starline'] = 1;
			$where['is_delhi_game'] = 0;
		} elseif ($game_type == 'matka') {
			$select = '*';
			$where['is_delhi_game'] = 0;
			$where['is_matka'] = 1;
		}
		if ($game_id != "")
			$where['game_id'] = $game_id;
		return $this->db->select($select)->get_where('tblgame', $where)->result();
	}



	public function gamesStarline()
	{
		return $this->db->where(['id>' => 50])->get('tblStarline')->result();
	}

	public function starline_games()
	{
		return $this->db->where('is_close', 0)->where('is_deleted', '0')->get('tblgame')->result();
	}
	public function games_rate()
	{
		return $this->db->where('is_deleted', '0')->get('tblgame')->result();
	}
	public function update_game_rate($id, $game_type)
	{
		if ($game_type == 'starline'):
			$data = array(
				'starline_points' => $this->input->post('rate')
			);
		endif;
		if ($game_type == 'matka' || $game_type == 'dmatka'):
			$data = array(
				'points' => $this->input->post('rate')
			);
		endif;

		$this->db->where('game_id', $id);
		$this->db->update('tblgame', $data);
		$data_notice = array(
			'rate' => ($this->input->post('rate')) * 10
		);
		$type = ($game_type == 'matka' || $game_type == 'dmatka') ? 0 : 1;
		$this->db->where('game_id', $id)->where('type', $type)->update('tblNotice', $data_notice);

		return true;
	}

	public function update_starline_game_rate($id)
	{
		$data = array(
			'starline_points' => $this->input->post('rate')
		);
		$this->db->where('game_id', $id);
		$this->db->update('tblgame', $data);

		$data_notice = array(
			'rate' => ($this->input->post('rate')) * 10
		);
		$this->db->where('game_id', $id)->where('type', 1);
		$this->db->update('tblNotice', $data_notice);

		return true;
	}
	public function update_game_and_starline_rate($id)
	{
		$data = array(
			'points' => $this->input->post('game_rate'),
			'starline_points' => $this->input->post('starline_rate')
		);
		$this->db->where('game_id', $id);
		$this->db->update('tblgame', $data);
		$data_notice_game_rate = array(
			'rate' => ($this->input->post('game_rate')) * 10
		);
		$this->db->where('game_id', $id)->where('type', 0);
		$this->db->update('tblNotice', $data_notice_game_rate);
		$data_notice_starline = array(
			'rate' => ($this->input->post('starline_rate')) * 10
		);
		$this->db->where('game_id', $id)->where('type', 1);
		$this->db->update('tblNotice', $data_notice_starline);
		return true;
	}
	public function enable_user($id, $table)
	{
		$data = array(
			'status' => 'active'
		);
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
	}


	public function disable_user($id, $table)
	{
		$data = array(
			'status' => 'inactive'
		);
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
	}
	public function userbank_allow($id, $table)
	{
		$data = array(
			'bank_status' => 1
		);
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
	}
	public function userbank_block($id, $table)
	{
		$data = array(
			'bank_status' => 0
		);
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
	}

	public function delete_user($id, $table, $mobile)
	{
		$data = array(
			"mobileno" => "0",
			"old_mobileno" => $mobile,
			"login_status" => 1,
			'status' => 'deleted'
		);
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
	}

	public function getMatkaName($game_type = '')
	{

		if ($game_type == 'dmatka') {
			$where['is_delhi_game'] = 1;
		} else {
			$where['is_delhi_game'] = 0;
		}
		return $this->db->select('id,name')->where($where)->where('status', 'active')->get('matka')->result();
	}

	public function getStarinMatkaName()
	{
		return $this->db->select('id,s_game_time as name')->where('id>', 50)->get('tblStarline')->result();
	}


	public function getNotification()
	{
		return $this->db->get('tblNotification')->result();
	}

	public function get_bid_revert($date_from = '', $date_to = '', $matka_id = '')
	{
		if ($date_from != "" && $date_to != "")
			$this->db->where('DATE(time) >=', "'" . $date_from . "'", false)->where('DATE(time) <=', "'" . $date_to . "'", false);
		if ($matka_id != "")
			$this->db->where('matka_id', $matka_id);
		return $this->db->where('bid_revert', 0)->get('tblgamedata')->result();
	}
	public function d_games()
	{
		return $this->db->where('is_delhi_game', '1')->get('tblgame')->result();
	}

	public function transfer_money_history($date_from = '', $date_to = '')
	{
		if ($date_from != "" && $date_to != "")
			$this->db->where('DATE(time) >=', "'" . $date_from . "'", false)->where('DATE(time) <=', "'" . $date_to . "'", false);
		$query = $this->db->order_by('time', 'DESC')->get('tbltransfer_request');
		return $query->result_array();
	}
	public function getUserEnquiry()
	{
		return $this->db->where('status', 1)->get('enquiry')->result_array();
	}
	public function update_user_pin($userid = FALSE)
	{
		if ($userid) {
			$data = array('mid' => $this->input->post('pin'));
			$this->db->where('id', $userid);
			return $d = $this->db->update('user_profile', $data);
		}
		return false;
	}
	public function getChartData($date_val = "", $type)
	{
		if ($type == 'starline') {
			$this->db->select('charts.*');
			$this->db->join('tblStarline', 'tblStarline.id= charts.cid', 'left');
			$where['charts.cid>'] = 50;
		} else {
			$this->db->select('matka.id as matka_id,charts.*');
			$this->db->join('matka', 'matka.id=charts.cid', 'left');
			// $this->db->join('tblgamedata','tblgamedata.matka_id=matka.id','right');
			if ($type == 'dmatka') {
				$where['matka.is_delhi_game'] = 1;
				$where['charts.cid<='] = 50;
			}
			if ($type == 'matka') {
				$where['matka.is_delhi_game'] = 0;
				$where['charts.cid<='] = 50;
			}
		}
		if ($date_val != "") {
			$where['charts.date'] = $date_val;
		}
		return $this->db->get_where('charts', $where)->result_array();
	}
	public function update_user_profile_data()
	{
		$data = array(
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'pincode' => $this->input->post('pincode'),
			'accountno' => $this->input->post('accountno'),
			'bank_name' => $this->input->post('bank_name'),
			'ifsc_code' => $this->input->post('ifsc_code'),
			'account_holder_name' => $this->input->post('account_holder_name'),
			'paytm_no' => $this->input->post('paytm_no'),
			'tez_no' => $this->input->post('tez_no'),
			'phonepay_no' => $this->input->post('phonepay_no'),
			'mid' => $this->input->post('mid'),
			'dob' => $this->input->post('dob'),
		);

		$this->db->where('id', $this->input->post('id'));
		//		$this->db->where('id', $this->input->post('id'));
		$d = $this->db->update('user_profile', $data);
		return $d;
	}

	public function get_winner_list_ajax($matka_id, $date, $bet_type)
	{
		$query = $this->db->select('history.*,tblgame.name as game_name,user_profile.username as user_name,user_profile.mobileno as mobile_phone,tblgamedata.bet_type,tblgamedata.points')
			->join('tblgame', 'history.game_id=tblgame.game_id')
			->join('user_profile', 'history.user_id=user_profile.id')
			->join('tblgamedata', 'history.bid_id=tblgamedata.id')
			->where('history.matka_id', $matka_id)->where('tblgamedata.bet_type', $bet_type)->
			where('history.date', $date)->where('tblgamedata.status', 'win')->
			where('history.type', 'c')->group_by('history.bid_id')->order_by('history.game_id', 'ASC')->get('history');
		return $query->result();
	}

	public function check_declare_result($matka_id, $date, $bet_type)
	{
		$query = $this->db->where(['matka_id' => $matka_id, 'bet_type' => $bet_type, 'date' => $date, 'status' => 'pending'])->get('tblgamedata');
		return $query->num_rows();
	}
	public function declare_mataka_result_in_db($id = "", $snum = "", $enum = "", $num = "", $bettype = "")
	{

		$response = array();
		// $id = $this->input->post('id');
		// $snum = $this->input->post('snum');
		// $enum = $this->input->post('enum');
		// $num = $this->input->post('num');
		$udate = $this->input->post('udate');
		$update_result = $this->input->post('update_result');
		$type = $this->input->post('type');
		// $data['select_matka'] = $id;
		$matka_data = $this->db->where('id', $id)->get('matka')->row();
		$name = $this->input->post('name') ?? ($matka_data ? $matka_data->name : "");
		if ($num != "" && $update_result) {
			if ($type == 'starline') {
				$sum_number = $snum . "-" . $num;
				$response = $this->starline_update2($id, $sum_number);
			} else {
				$chart_data = $this->db->where(['cid' => $id, 'date' => $udate])->get('charts')->row();
				if ($bettype == 'Open') {
					$response = $this->update_team_data();
				} elseif ($chart_data->starting_num == "" && $chart_data->starting_num == null && $bettype = 'Close') {
					$response = 2;

				} elseif ($chart_data->starting_num != "" && $chart_data->starting_num != null && $bettype = 'Close') {
					$response = $this->update_team_data();
				}
			}
		}

		return $response;
	}

}