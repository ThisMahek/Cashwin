<?php
class Starline_Model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/* Hourly Market section start */
	public function add_hourly_market()
	{
		$name = $this->input->post('name');
		$query = $this->db->get_where('hourly_market', array('name' => $name));
		$count = $query->num_rows();
		if ($count === 0) {
			$c_result = array(); //[[{"time":"12:00 AM"},{"result":""}],[{"time":"12:00 AM"},{"result":""}]]
			foreach ($this->input->post('time') as $time):
				$c_result[] = array(array("time" => date("h:i A", strtotime($time))), array("result" => ""));
			endforeach;
			$result = json_encode($c_result);
			$data = array(
				'name' => $name,
				'result' => $result
			);
			$this->session->set_flashdata('success', 'Your Hourly Market has been added.');
			$this->db->insert('hourly_market', $data);
			$ref = "list";
		} else {
			$ref = "add";
			$this->session->set_flashdata('fail', 'Market Name already Exist.');
		}
		return $ref;
	}
	public function deletehmarket($id, $table)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}
	public function list_hourly_market($marketId = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($marketId === FALSE) {
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get('hourly_market');
			return $query->result();
		}
		$query = $this->db->get_where('hourly_market', array('id' => $marketId));
		return $query->row();
	}

	public function update_hourly_market($type = "data", $id = FALSE)
	{
		//$type = data/result
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$id = ($id) ? $id : $this->input->post('id');
		if (!$id)
			return false;
		if ($type == "result"):
			$c_result = array(); //[[{"time":"12:00 AM"},{"result":""}],[{"time":"12:00 AM"},{"result":""}]]
			$stime = $this->input->post('start_time');
			$result = $this->input->post('result');
			foreach (json_decode($this->list_hourly_market($id)->result) as $time):
				$c_result[] = array(array("time" => date("h:i A", strtotime($time[0]->time))), array("result" => ($time[0]->time == $this->input->post('start_time')) ? $this->input->post('result') : $time[1]->result));
			endforeach;
			$results = json_encode($c_result);
			$data = array(
				'result' => $results
			);
			$res = explode('-', $result);
			$datas = array(
				'cid' => $id,
				'time' => date("H:i", strtotime($stime)),
				'starting_num' => $res[0],
				//(!empty($snum)) ? $snum : NULL,
				'result_num' => (isset($res[1])) ? $res[1] : "" //$num,
			);
			$datas['name'] = $this->get_daily_chart($datas['cid']);
			$this->update_hourly_chart($id, $datas, null, "Auto");
		endif;
		if ($type == "data"):
			$c_result = array(); foreach ($this->input->post('time') as $time):
				$c_result[] = array(array("time" => date("h:i A", $time)), array("result" => ""));
			endforeach;
			$result = json_encode($c_result);
			$name = $this->input->post('name');
			$data = array(
				'name' => $name,
				'result' => $result
			);
		endif;
		$this->db->where('id', $id);
		return $this->db->update('hourly_market', $data);
	}
	/* Hourly Market section end */

	/* Daily Market section start */
	public function get_daily_market($id)
	{
		return $query = $this->db->get_where('daily_market', array('id' => $id))->row()->name;
	}
	public function add_daily_market()
	{
		$name = $this->input->post('name');
		$query = $this->db->get_where('daily_market', array('name' => $name));
		$count = $query->num_rows();
		if ($count === 0) {
			$data = array(
				'name' => $this->input->post('name'),
				'start_time' => $this->input->post('stime'),
				'end_time' => $this->input->post('etime'),
				'last_day' => $this->input->post('last_day'),
				'bg_color' => $this->input->post('bg_color')
				// 'assigned_user' => $this->input->post('user')
			);
			$this->session->set_flashdata('success', 'Your Daily Market has been added.');
			$this->db->insert('daily_market', $data);
			$ref = "list";
		} else {
			$ref = "add";
			$this->session->set_flashdata('fail', 'Market Name already Exist.');
		}
		return $ref;
	}

	public function list_daily_market($marketId = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE, $type = "all")
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}
		if ($type != "all") {
			$this->db->where('market_data_type', $type);
		}
		if ($marketId === FALSE) {
			$this->db->order_by('start_time', 'ASC');
			$query = $this->db->get('daily_market');
			return $query->result();
		}
		$query = $this->db->get_where('daily_market', array('id' => $marketId));
		return $query->row();
	}

	public function list_daily_live_market($marketId = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		$this->db->group_start();
		$this->db->group_start();
		$this->db->where('start_time <=', 'TIME("' . date('H:i', strtotime('-5 minutes', strtotime(date('H:i')))) . '")', false)->where('end_time >=', 'TIME("' . date('H:i', strtotime('+20 minutes', strtotime(date('H:i')))) . '")', false);
		$this->db->group_end();
		$this->db->or_where('loader', '1');
		$this->db->group_end();
		$this->db->group_start();
		//$this->db->where('start_time <=', 'TIME("'.date('H:i', strtotime('-5 minutes', strtotime(date('H:i')))).'")', false)->where('end_time >=', 'TIME("'.date('H:i', strtotime('+20 minutes', strtotime(date('H:i')))).'")', false)->group_start();
		//(last_day='sat' OR last_day='sun')
		if (date('l') != "Saturday" && date('l') != "Sunday")
			$this->db->or_where('last_day', 'fri');
		if (date('l') != "Sunday")
			$this->db->or_where('last_day', 'sat');
		$this->db->or_where('last_day', 'sun');
		$this->db->group_end();
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}
		if ($marketId === FALSE || $marketId === "all") {
			$this->db->order_by('start_time', 'ASC');
			$query = $this->db->get('daily_market');
			return $query->result();
		}
		$query = $this->db->get_where('daily_market', array('id' => $marketId));
		return $query->row();
	}

	public function update_daily_market($type = "data", $update_chart = false, $data = array())
	{
		//$type = data/result/both/loader/status/bg_color_status
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$id = (!isset($data['id'])) ? $this->input->post('id') : $data['id'];
		if (!$id)
			return false;
		if ($type == "result" || $type == "both"):
			$snum = $this->input->post('openresult');
			$enum = $this->input->post('closeresult');
			$num = $this->input->post('result');
			$name = $this->input->post('name');
			$date = $this->input->post('udate');
			$data = array(
				'starting_num' => (!empty($snum)) ? $snum : NULL,
				'number' => $this->input->post('result'),
				'end_num' => (!empty($enum)) ? $enum : NULL,
				'text' => $this->input->post('text'),
				'text_status' => ($this->input->post('text_status') === "on") ? 1 : 0
			);
		endif;
		if ($type == "data" || $type == "both"):
			$name = $this->input->post('name');
			$data = array(
				'name' => $name,
				'start_time' => $this->input->post('stime'),
				'end_time' => $this->input->post('etime'),
				'last_day' => $this->input->post('last_day'),
				'bg_color' => $this->input->post('bg_color'),
				'market_pos' => $this->input->post('market_pos')
				//'status' => $this->input->post('status')
			);
		endif;
		if ($type == "weekly_chart"):
			$name = $this->input->post('chartsname');
			$date = $this->input->post('start_date');
			$snums = $this->input->post('starting_number');
			$ress = $this->input->post('result');
			$enums = $this->input->post('end_number');
			$i = 0;
			foreach ($snums as $snum):
				$this->update_chart($id, $name, $snums[$i], $ress[$i], $enums[$i], $date);
				$date = date('Y-m-d', strtotime('+1 days', strtotime($date)));
				$i++;
			endforeach;
		endif;
		if ($type != "weekly_chart"):
			$this->db->where('id', $id);
			$this->db->update('daily_market', $data);
		endif;
		//$dt = date('Y-m-d', strtotime('-3 hour'));
		if (($update_chart === "on") && ($type == "both" || $type == "result"))
			$this->update_chart($id, $name, $snum, $num, $enum, $date);
		return true;
	}
	/* Daily Market section end */

	/* Charts section start */
	public function update_chart($id, $name, $snum, $num, $enum = null, $date = null, $type = "Manual")
	{
		$dt = ($date == null) ? date('Y-m-d') : $date;
		$data1 = array(
			'name' => $name,
			'cid' => $id,
			'date' => $dt,
			'starting_num' => (!empty($snum)) ? $snum : NULL,
			'result_num' => $num,
			'end_num' => (!empty($enum)) ? $enum : NULL,
			'type' => $type
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

	public function list_charts($marketId = FALSE, $marketName = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}

		if ($marketId === FALSE && $marketName === FALSE) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('charts');
		} else {
			if ($marketId !== FALSE)
				$where = array('id' => $marketId);
			elseif ($marketName !== FALSE)
				$where = array('name' => $marketName);
			$query = $this->db->get_where('charts', $where);
		}
		return $query->result();
	}

	public function add_chart_data()
	{
		$snum = $this->input->post('openresult');
		$num = $this->input->post('result');
		$enum = $this->input->post('closeresult');
		$name = $this->input->post('chart');
		$id = $this->input->post('cid');
		$date = $this->input->post('date');

		return $this->update_chart($id, $name, $snum, $num, $enum, $date);
	}
	/* Chart section end */

	/* Header Contents start */
	public function list_header_content($Id = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($Id === FALSE) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('header_content');
			return $query->result();
		}
		$query = $this->db->get_where('header_content', array('id' => $Id));
		return $query->row();
	}

	public function update_header_content($id = '1')
	{
		//$type = data/result
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$id = ($id) ? $id : $this->input->post('id');
		if (!$id)
			return false;
		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('description')
		);
		$this->db->where('id', $id);
		return $this->db->update('header_content', $data);
	}
	/* Header Contents end */

	/* Disclaimer start */
	public function list_disclaimer($Id = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($Id === FALSE) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('disclaimer');
			return $query->result();
		}
		$query = $this->db->get_where('disclaimer', array('id' => $Id));
		return $query->row();
	}

	public function update_disclaimer($id = '1')
	{
		//$type = data/result
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$id = ($id) ? $id : $this->input->post('id');
		if (!$id)
			return false;
		$data = array(
			'disclaimer' => $this->input->post('disclaimer')

		);
		$this->db->where('id', $id);
		return $this->db->update('disclaimer', $data);
	}
	/* Disclaimer end */

	/*About Start*/
	public function list_about($Id = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($Id === FALSE) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('about');
			return $query->result();
		}
		$query = $this->db->get_where('about', array('id' => $Id));
		return $query->row();
	}

	public function update_about($id = '1')
	{
		//$type = data/result
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$id = ($id) ? $id : $this->input->post('id');
		if (!$id)
			return false;
		$data = array(
			'title' => $this->input->post('title'),
			'para_1' => $this->input->post('para_1'),
			'para_2' => $this->input->post('para_2')
		);
		$this->db->where('id', $id);
		return $this->db->update('about', $data);
	}
	/*About End*/

	/* Contact Start*/
	public function list_contact($Id = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($Id === FALSE) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('contact');
			return $query->result();
		}
		$query = $this->db->get_where('contact', array('id' => $Id));
		return $query->row();
	}

	public function update_contact($id = '1')
	{
		//$type = data/result
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$id = ($id) ? $id : $this->input->post('id');
		if (!$id)
			return false;
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'mobile' => $this->input->post('mobile')
		);
		$this->db->where('id', $id);
		return $this->db->update('contact', $data);
	}
	/* Contact End */
	/* weekly chart start*/
	public function list_weekly_chart($Id = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($Id === FALSE) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->from('weekly_chart')->get();
			return $query->result();
		}
		$query = $this->db->get_where('weekly_chart', array('id' => $Id));
		return $query->row();
	}

	public function update_weekly_chart($id = '1')
	{
		//$type = data/result
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$id = ($id) ? $id : $this->input->post('id');
		if (!$id)
			return false;
		$data = array(
			's_date' => $this->input->post('s_date'),
			'e_date' => $this->input->post('e_date')

		);
		$this->db->where('id', $id);
		return $this->db->update('weekly_chart', $data);
	}
	/* weekly report End*/
	/* weekly  panel-chart start*/
	public function add_w_panel_chart()
	{
		$number = $this->input->post('number');
		$query = $this->db->get_where('w_panel_chart', array('number' => $number));
		$count = $query->num_rows();
		if ($count === 0) {
			$data = array(
				'number' => $this->input->post('number'),
				's_number' => $this->input->post('s_number')

			);
			$this->session->set_flashdata('success', 'Your panel Chart has been added.');
			$this->db->insert('w_panel_chart', $data);
			$ref = "list";
		} else {
			$ref = "add";
			$this->session->set_flashdata('fail', 'Chart Name already Exist.');
		}
		return $ref;
	}
	public function list_w_panel_chart($Id = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($Id === FALSE) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->from('w_panel_chart')->get();
			return $query->result();
		}
		$query = $this->db->get_where('w_panel_chart', array('id' => $Id));
		return $query->row();
	}

	public function update_w_panel_chart($id = '1')
	{
		//$type = data/result
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$id = ($id) ? $id : $this->input->post('id');
		if (!$id)
			return false;
		$data = array(
			'number' => $this->input->post('number'),
			's_number' => $this->input->post('s_number')

		);
		$this->db->where('id', $id);
		return $this->db->update('w_panel_chart', $data);
	}
	/* weekly  panel-chart End*/
	/* weekly  jodi-chart Start*/
	public function add_w_jodi_chart()
	{
		$number = $this->input->post('number');
		$query = $this->db->get_where('w_jodi_chart', array('s_number' => $s_number));
		$count = $query->num_rows();
		if ($count === 0) {
			$data = array(

				's_number' => $this->input->post('s_number')

			);
			$this->session->set_flashdata('success', 'Your Jodi Chart has been added.');
			$this->db->insert('w_jodi_chart', $data);
			$ref = "list";
		} else {
			$ref = "add";
			$this->session->set_flashdata('fail', 'Chart Name already Exist.');
		}
		return $ref;
	}
	public function list_w_jodi_chart($Id = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($Id === FALSE) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->from('w_jodi_chart')->get();
			return $query->result();
		}
		$query = $this->db->get_where('w_jodi_chart', array('id' => $Id));
		return $query->row();
	}

	public function update_w_jodi_chart($id = '')
	{
		//$type = data/result
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$id = ($id) ? $id : $this->input->post('id');
		if (!$id)
			return false;
		$data = array(

			's_number' => $this->input->post('s_number')

		);
		$this->db->where('id', $id);
		return $this->db->update('w_jodi_chart', $data);
	}
	/* weekly  jodi-chart End*/
	/* open close Start*/
	public function add_w_open_chart()
	{
		$number = $this->input->post('number');
		$query = $this->db->get_where('w_jodi_chart', array('s_number' => $s_number));
		$count = $query->num_rows();
		if ($count === 0) {
			$data = array(

				's_number' => $this->input->post('s_number'),
				'day' => $this->input->post('day')

			);
			$this->session->set_flashdata('success', 'Your Open/Close Chart has been added.');
			$this->db->insert('w_open_chart', $data);
			$ref = "list";
		} else {
			$ref = "add";
			$this->session->set_flashdata('fail', 'Chart Name already Exist.');
		}
		return $ref;
	}

	public function list_w_open_chart($Id = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($Id === FALSE) {
			// 			$this->db->order_by('id', 'DESC');
			$query = $this->db->from('w_open_chart')->get();
			return $query->result();
		}
		$query = $this->db->get_where('w_open_chart', array('id' => $Id));
		return $query->row();
	}

	public function update_w_open_chart($id = '')
	{
		//$type = data/result
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$id = ($id) ? $id : $this->input->post('id');
		if (!$id)
			return false;
		$data = array(

			's_number' => $this->input->post('s_number'),
			'day' => $this->input->post('day')

		);
		$this->db->where('id', $id);
		return $this->db->update('w_open_chart', $data);
	}

	/* open close Start*/
	public function add_w_free_game()
	{
		$market = $this->input->post('market');
		$query = $this->db->get_where('free_games', array('market' => $market));
		$count = $query->num_rows();
		if ($count === 0) {
			$data = array(

				's_number1' => $this->input->post('s_number1'),
				's_number2' => $this->input->post('s_number2'),
				's_number3' => $this->input->post('s_number3'),
				'market' => $this->input->post('market')

			);
			$this->session->set_flashdata('success', 'Your Free Game has been added.');
			$this->db->insert('free_games', $data);
			$ref = "list";
		} else {
			$ref = "add";
			$this->session->set_flashdata('fail', 'Free Game already Exist.');
		}
		return $ref;
	}

	public function list_w_free_game($Id = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($Id === FALSE) {
			// 			$this->db->order_by('id', 'DESC');
			$query = $this->db->from('free_games')->get();
			return $query->result();
		}
		$query = $this->db->get_where('free_games', array('id' => $Id));
		return $query->row();
	}

	public function update_w_free_game($id = '')
	{
		//$type = data/result
		//$slug = url_title($this->input->post('title'), "dash", TRUE);
		$id = ($id) ? $id : $this->input->post('id');
		if (!$id)
			return false;
		$data = array(

			's_number1' => $this->input->post('s_number1'),
			's_number2' => $this->input->post('s_number2'),
			's_number3' => $this->input->post('s_number3'),
			'market' => $this->input->post('market')

		);
		$this->db->where('id', $id);
		return $this->db->update('free_games', $data);
	}

	public function list_open_close($Id = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($Id === FALSE) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->from('open_close')->get();
			return $query->result();
		}
		$query = $this->db->get_where('open_close', array('id' => $Id));
		return $query->row();
	}

	public function update_open_close($id = '1')
	{
		$id = ($id) ? $id : $this->input->post('id');
		if (!$id)
			return false;
		$data = array(
			'date' => $this->input->post('date'),

		);
		$this->db->where('id', $id);
		return $this->db->update('open_close', $data);
	}


	public function add_open_close()
	{
		// print_r($this->input->post());exit();
		echo $date = $this->input->post('date');
		echo $d_time = $this->input->post('d_time');
		echo $n_time = $this->input->post('n_time');
		$m_name = $this->input->post('m_name');
		$s_number = $this->input->post('s_number');
		for ($i = 0; $i < count($m_name); $i++) {
			// echo $m_name[$i];
			// echo $s_number[$i];
			for ($j = 0; $j < count($s_number); $j++) {
				$da = [$m_name[$i], $s_number[$j]];
			}

		}
		//print_r($da);
		exit();
		// exit();
		$data = array(
			'm_name' => $m_name,
			's_number' => $s_number
		);
		$result = json_encode($data);
		$this->session->set_flashdata('success', 'Your open- close  has been added.');
		$this->db->insert('open_close', $data);
		$ref = "list";
	}
	/* open close End*/
	/*daily chart start*/
	public function add_daily_chart()
	{
		$data = array(

			'date' => $this->input->post('date'),
			'starting_num' => $this->input->post('s_no'),
			'result_num' => $this->input->post('r_no'),
			'end_num' => $this->input->post('e_no'),
			'cid' => $this->input->post('name'),
			'type' => $this->input->post('type')

		);
		$data['name'] = $this->get_daily_chart($data['cid']);
		return $this->db->insert('charts', $data);

	}
	public function get_daily_chart($id = "")
	{
		return $query = $this->db->get_where('hourly_market', array('id' => $id))->row()->name;
	}
	/*daily Chart End*/

	/*hourly chart start*/
	public function add_hourly_chart()
	{
		$id = $this->input->post('cid');
		$s_time = $this->input->post('s_time');
		$date = $this->input->post('date');
		$data = array(
			'cid' => $id,
			'time' => $s_time,
			'starting_num' => $this->input->post('s_no'),
			//(!empty($snum)) ? $snum : NULL,
			'result_num' => $this->input->post('r_no') //$num,
		);
		$data['name'] = $this->get_daily_chart($data['cid']);
		return $this->update_hourly_chart($id, $data, $date, $this->input->post('type'));
	}

	public function update_hourly_chart($id, $data1, $date = null, $type = "Manual")
	{
		$dt = ($date == null) ? date('Y-m-d') : $date;
		$data1['date'] = $dt;
		$where = array('cid' => $id, 'date' => $dt, 'time' => $data1['time']);
		$data2 = $this->db->select("COUNT(id) as counter")->where($where)->get('s_charts')->row();
		if ($data2->counter > 0) {
			$this->db->where($where);
			$this->db->update('s_charts', $data1);
		} else {
			$this->db->insert('s_charts', $data1);
		}
		return true;
	}

	public function list_hourly_chart($Id = FALSE, $status = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		if ($Id === FALSE) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->from('s_charts')->get();
			return $query->result();
		}
		$query = $this->db->get_where('s_chart', array('id' => $Id));
		return $query->row();
	}
/*hourly chart end*/

}