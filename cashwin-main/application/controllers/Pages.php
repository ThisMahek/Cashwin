<?php
class Pages extends CI_Controller
{

	public function view($page = 'home_old')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$data['title'] = ucfirst($page);
		$data['lgames'] = $this->Pages_model->getGameDetails();
		$data['lgames1'] = $this->Pages_model->getGameDetails2();
		$data['hourly_markets'] = $this->Starline_model->list_hourly_market();
		$data['users'] = $this->Administrator_Model->starline();
		// 			$data['chart'] = $this->Chart_Model->getStarline();
// 			$data['time'] = $this->Chart_Model->getTbl_Starline();

		//$data['starline']  =$this->Pages_model->getStarline();
		$starline = json_decode(file_get_contents("{base_url()}/restApi/api.php?api=getStarline"));
		//print_r($starline);
		$data['starline'] = $starline;
		//	$this->load->view('templates/header');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}
	public function privacy_policy()
	{
		$this->load->view('pages/privacy_policy');
	}

	public function starline()
	{
		$this->load->view('pages/starline');
	}

	public function chart($page = 'chart1')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$chartname = $this->input->get('cname');
		$sun = array("TIME BAZAR", "MILAN DAY", "JANNAT DAY", "JANNAT NIGHT");
		$sat = array("RAJDHANI NIGHT");
		$data['title'] = ucfirst($page);
		$data['chart'] = $this->Chart_Model->getChartDetails($chartname);
		$data['chartdate'] = $this->Chart_Model->chartdate($this->Chart_Model->getChartDetails($chartname));
		$data['sun'] = false;
		$data['sat'] = true;
		if (in_array($chartname, $sun))
			$data['sun'] = true;
		if (in_array($chartname, $sat))
			$data['sat'] = false;
		//	$this->load->view('templates/header');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}

	public function web_chart($page = 'web_chart')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$chartname = $this->input->get('cname');
		$sun = array("TIME BAZAR", "MILAN DAY", "JANNAT DAY", "JANNAT NIGHT");
		$sat = array("RAJDHANI NIGHT");
		$data['title'] = ucfirst($page);
		$data['chart'] = $this->Chart_Model->getChartDetails($chartname);
		if (!empty($this->Chart_Model->getChartDetails($chartname))) {
			$data['chartdate'] = $this->Chart_Model->chartdate($this->Chart_Model->getChartDetails($chartname));
		} else {
			$data['chartdate'] = array();
		}
		// 			$data['chartdate'] = $this->Chart_Model->chartdate($this->Chart_Model->getChartDetails($chartname));
		$data['sun'] = false;
		$data['sat'] = true;
		if (in_array($chartname, $sun))
			$data['sun'] = true;
		if (in_array($chartname, $sat))
			$data['sat'] = false;
		//	$this->load->view('templates/header');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}

	public function starline_charts($page = 'starline_charts')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$chartid = $this->input->get('cid');
		$data['title'] = ucfirst($page);
		$data['chart'] = $this->Chart_Model->getStarline();
		$data['time'] = $this->Chart_Model->getTbl_Starline();
		//$data['chart']  =$this->Chart_Model->getChartDetailsById($chartid);
		//$data['chartdate'] = $this->Chart_Model->chartdate($this->Chart_Model->getChartDetailsById($chartid));
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}



	public function starline_chart($page = 'starline_chart1')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$chartid = $this->input->get('cid');
		$data['title'] = ucfirst($page);
		$data['chart'] = $this->Chart_Model->getStarline();
		$data['time'] = $this->Chart_Model->getTbl_Starline();
		//$data['chart']  =$this->Chart_Model->getChartDetailsById($chartid);
		//$data['chartdate'] = $this->Chart_Model->chartdate($this->Chart_Model->getChartDetailsById($chartid));
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}

	public function charts($page = 'charts')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$chartname = $this->input->get('cname');
		$sun = array("TIME BAZAR", "MILAN DAY");
		$sat = array("RAJDHANI NIGHT");
		$data['title'] = ucfirst($page);
		$data['chart'] = $this->Chart_Model->getChartDetails($chartname);
		$data['chartdate'] = $this->Chart_Model->chartdate($this->Chart_Model->getChartDetails($chartname));
		$data['sat'] = true;
		if (in_array($chartname, $sun))
			$data['sun'] = true;
		if (in_array($chartname, $sat))
			$data['sat'] = false;
		//	$this->load->view('templates/header');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}

	public function web_jodi_chart($page = 'web_jodi_chart')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		$chartname = $this->input->get('cname');
		$sun = array("TIME BAZAR", "MILAN DAY");
		$sat = array("RAJDHANI NIGHT");
		$data['title'] = ucfirst($page);
		$data['chart'] = $this->Chart_Model->getChartDetails($chartname);
		$data['chartdate'] = $this->Chart_Model->chartdate($this->Chart_Model->getChartDetails($chartname));
		$data['sat'] = true;
		if (in_array($chartname, $sun))
			$data['sun'] = true;
		if (in_array($chartname, $sat))
			$data['sat'] = false;
		//	$this->load->view('templates/header');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}

	public function game_rates($page = 'game_rates')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}
		//$chartname = $this->input->get('cname');
		$data['title'] = ucfirst($page);
		$data['games'] = $this->Pages_model->getGameDetails1();
		//	$this->load->view('templates/header');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}

	public function index()
	{
		$data['title'] = ucfirst($page);
		$data['lgames'] = $this->Pages_model->getGameDetails();
		$data['lgames1'] = $this->Pages_model->getGameDetails2();
		$data['hourly_markets'] = $this->Starline_model->list_hourly_market();
		$data['users'] = $this->Administrator_Model->starline();
		// 			$data['chart'] = $this->Chart_Model->getStarline();
// 			$data['time'] = $this->Chart_Model->getTbl_Starline();

		//$data['starline']  =$this->Pages_model->getStarline();
		$starline = json_decode(file_get_contents("{base_url()}/restApi/api.php?api=getStarline"));
		//print_r($starline);
		$data['starline'] = $starline;
		$this->load->view('pages/index', $data);
	}
}