<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Starline extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('Starline_model');
		if (!$this->session->userdata('login'))
			redirect(site_url("admin/login"));
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function hourly_market($type = FALSE, $id = FALSE)
	{
		// $data['status'] = $this->session->flashdata("status");
		if ($type) {
			$status = "";
			if ($type == "activate" && $id) {
				if ($this->Starline_model->enable($id, "hourly_market"))
					$status = "Hourly Market activated successfully.";
			}
			if ($type == "deactivate" && $id) {
				if ($this->Starline_model->disable($id, "hourly_market"))
					$status = "Hourly Market deactivated successfully.";
			}
			if ($type == "delete" && $id) {
				if ($this->Starline_model->deletehmarket($id, "hourly_market"))
					$status = "Hourly Market Deleted successfully.";
				$this->session->set_flashdata("status", $status);
				redirect(site_url("starline/hourly_market"));
			}

		}
		if ($this->input->post('AddHourlyMarket')) {
			if ($this->Starline_model->add_hourly_market())
				$data['status'] = "New Hourly Market Added successfully.";
		}
		if ($this->input->post('DeclareRes')) {
			if ($this->Starline_model->update_hourly_market("result", $this->input->post('DeclareRes')))
				$data['status'] = "Hourly Market Result Updated successfully.";
		}
		if ($this->input->post('UpdateHourlyMarket')) {
			if ($this->Starline_model->update_hourly_market("data"))
				$data['status'] = "Hourly Market Updated successfully.";
		}

		$data['lists'] = $this->Starline_model->list_hourly_market();

		$this->load->view('admin/hourly-market', $data);
	}

	public function daily_market($type = FALSE, $id = FALSE)
	{
		$data['status'] = $this->session->flashdata("status");
		if ($type) {
			$status = "";
			if ($type == "activate" && $id) {
				if ($this->Starline_model->enable($id, "daily_market"))
					$status = "Daily Market activated successfully.";
			}
			if ($type == "deactivate" && $id) {
				if ($this->Starline_model->disable($id, "daily_market"))
					$status = "Daily Market activated successfully.";
			}
			if ($type == "onloader" && $id) {
				if ($this->Starline_model->loader($id, '1', "daily_market"))
					$status = "Daily Market Loader on successfully.";
			}
			if ($type == "offloader" && $id) {
				if ($this->Starline_model->loader($id, '0', "daily_market"))
					$status = "Daily Market Loader off successfully.";
			}
			if ($type == "bgon" && $id) {
				if ($this->Starline_model->bg_color_status($id, '1', "daily_market"))
					$status = "Daily Market background color on successfully.";
			}
			if ($type == "bgoff" && $id) {
				if ($this->Starline_model->bg_color_status($id, '0', "daily_market"))
					$status = "Daily Market background color off successfully.";
			}
			if ($type == "delete" && $id) {
				if ($this->Starline_model->delete($id, "daily_market"))
					$status = "Daily Market Deleted successfully.";
			}
			$this->session->set_flashdata("status", $status);
			redirect(site_url("admin/daily_market"));
		}
		if ($this->input->post('AddDailyMarket')) {
			if ($this->Starline_model->add_daily_market())
				$data['status'] = "New Daily Market Added successfully.";
		}
		if ($this->input->post('DeclareRes')) {
			if ($this->Starline_model->update_daily_market("result", $this->input->post('update_chart'), array('id' => $this->input->post('DeclareRes'))))
				$data['status'] = "Daily Market Result Updated successfully.";
		}
		if ($this->input->post('UpdateDailyMarket')) {
			if ($this->Starline_model->update_daily_market("data", false, array('id' => $this->input->post('UpdateDailyMarket'))))
				$data['status'] = "Daily Market Updated successfully.";
		}
		if ($this->input->post('AddWeeklyChart')) {
			if ($this->Starline_model->update_daily_market("weekly_chart", false, array('id' => $this->input->post('chartname'))))
				$data['status'] = "Daily Market Updated successfully.";
		}

		$data['lists'] = $this->Starline_model->list_daily_market();
		$data['autoLists'] = $this->Starline_model->list_daily_market(FALSE, FALSE, FALSE, FALSE, "auto");
		$data['manualLists'] = $this->Starline_model->list_daily_market(FALSE, FALSE, FALSE, FALSE, "manual");
		$this->load->view('daily-market', $data);
	}
	public function weekely_chart()
	{
		$data['status'] = "";
		if ($this->input->post('update_weekly_chart')) {
			if ($this->Starline_model->update_weekly_chart())
				$data['status'] = "Weekly Chart Updated successfully.";
		}

		$data['lists'] = $this->Starline_model->list_weekly_chart();

		$this->load->view('weekely-chart', $data);
	}
	public function astrology_chart($aid = "", $type = NULL, $id = "")
	{
		$data['status'] = "";
		if ($type) {
			if ($type == "delete" && $id) {
				if ($this->Starline_model->delete($id, "w_panel_chart"))
					$status = "Panel Chart Deleted successfully.";
				redirect(site_url("admin/astrology_chart/" . $aid));
			}

		}
		if ($this->input->post('addchart')) {
			if ($this->Starline_model->add_w_panel_chart())
				$data['status'] = "Weekly Chart inserted successfully.";
		}
		if ($this->input->post('update_chart')) {
			if ($this->Starline_model->update_w_panel_chart($this->input->post('update_chart')))
				$data['status'] = "Weekly  panel Chart Updated successfully.";
		}
		$data['lists'] = $this->Starline_model->list_w_panel_chart();
		if ($this->input->post('addjodi')) {
			if ($this->Starline_model->add_w_jodi_chart())
				$data['status'] = "Weekly jodi Chart inserted successfully.";
		}
		if ($this->input->post('update_w_jodi_chart')) {
			if ($this->Starline_model->update_w_jodi_chart($this->input->post('update_w_jodi_chart')))
				$data['status'] = "Weekly  jodi Chart Updated successfully.";
		}
		$data['jodi'] = $this->Starline_model->list_w_jodi_chart();
		if ($this->input->post('addopen')) {
			if ($this->Starline_model->add_w_open_chart())
				$data['status'] = "Weekly Open/Close Chart inserted successfully.";
		}
		if ($this->input->post('update_w_open_chart')) {
			if ($this->Starline_model->update_w_open_chart($this->input->post('update_w_open_chart')))
				$data['status'] = "Weekly  Open/Close Chart Updated successfully.";
		}
		$data['chart'] = $this->Starline_model->list_weekly_chart();
		$data['open'] = $this->Starline_model->list_w_open_chart();


		$this->load->view('astrology_chart', $data);
	}
	public function free_games()
	{
		$data['status'] = "";
		if ($this->input->post('update_open_close')) {
			if ($this->Starline_model->update_open_close())
				$data['status'] = "Fix Free Games Updated successfully.";
		}

		$data['lists'] = $this->Starline_model->list_open_close();
		$this->load->view('open_close', $data);
	}

	public function fix_free_games($aid = "", $type = NULL, $id = "")
	{
		$data['status'] = "";
		if ($type) {
			if ($type == "delete" && $id) {
				if ($this->Starline_model->delete($id, "w_open_chart"))
					$status = "Fix Free Games Deleted successfully.";
				redirect(site_url("admin/fix_free_games/" . $aid));
			}

		}
		if ($this->input->post('addopen')) {
			if ($this->Starline_model->add_w_free_game())
				$data['status'] = "Fix Free Games inserted successfully.";
		}
		if ($this->input->post('update_w_open_chart')) {
			if ($this->Starline_model->update_w_free_game($this->input->post('update_w_open_chart')))
				$data['status'] = "Fix Free Games Updated successfully.";
		}
		$data['chart'] = $this->Starline_model->list_open_close();
		$data['open'] = $this->Starline_model->list_w_free_game();


		$this->load->view('open_close_chart', $data);
	}
	public function banner_content()
	{
		$this->load->view('banner-content');
	}

	public function notice_banner()
	{
		$this->load->view('notice-banner');
	}

	public function header_content()
	{
		$data['status'] = "";
		if ($this->input->post('UpdateHeaderContent')) {
			if ($this->Starline_model->update_header_content())
				$data['status'] = "Header content Updated successfully.";
		}

		$data['lists'] = $this->Starline_model->list_header_content();
		$this->load->view('header-content', $data);
	}

	public function disclaimer()
	{
		$data['status'] = "";
		if ($this->input->post('UpdateDisclaimer')) {
			if ($this->Starline_model->update_disclaimer())
				$data['status'] = "Disclaimer Updated successfully.";
		}

		$data['lists'] = $this->Starline_model->list_disclaimer();
		$this->load->view('disclaimer', $data);
	}
	// 	public function free_games()
// 	{
// 		$this->load->view('free_games');
// 	}

	public function contact($type = null, $id = "1")
	{
		if ($type) {
			$status = "";
			if ($type == "activate" && $id) {
				if ($this->Starline_model->enable($id, "contact"))
					$status = "Contact activated successfully.";
			}
			if ($type == "deactivate" && $id) {
				if ($this->Starline_model->disable($id, "contact"))
					$status = "Contact deactivated successfully.";
			}
			$this->session->set_flashdata("status", $status);
			redirect(site_url("admin/contact"));
		}

		if ($this->input->post('UpdateContact')) {
			if ($this->Starline_model->update_contact())
				$data['status'] = "Contact Updated successfully.";

		}

		$data['lists'] = $this->Starline_model->list_contact();
		$this->load->view('contact', $data);
	}
	public function about()
	{
		$data['status'] = "";
		if ($this->input->post('UpdateAbout')) {
			if ($this->Starline_model->update_about())
				$data['status'] = "About Us Updated successfully.";
		}

		$data['lists'] = $this->Starline_model->list_about();
		$this->load->view('about', $data);
	}

	public function daily_chart()
	{
		if ($this->input->post('addChart')) {
			$this->Starline_model->add_daily_chart();
			// $data['status'] = "Dialy Market Chart inserted successfully.";
			$this->session->set_flashdata('err', 'Dialy Market Chart inserted successfully');
		}
		$data['charts'] = $this->Starline_model->list_charts();
		$data['lists'] = $this->Starline_model->list_daily_market();
		$this->load->view('daily_chart', $data);
	}

	public function hourly_chart()
	{
		$this->load->model('Starline_model');
		if ($this->input->post('add_Chart')) {
			$this->Starline_model->add_hourly_chart();
			$data['status'] = "Dialy Market Chart inserted successfully.";
			$this->session->set_flashdata('err', 'Dialy Market Chart inserted successfully');
		}
		$data['charts'] = $this->Starline_model->list_hourly_chart();
		$data['lists'] = $this->Starline_model->list_hourly_market();
		$this->load->view('admin/hourly_chart', $data);
	}
}