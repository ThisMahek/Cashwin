<?php
class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $fun = $this->router->fetch_method();
        if (!$this->session->userdata('login') && $fun != "app_bid_history" && $fun != 'app_startline_bid_history')
            redirect(site_url("admin/login"));
    }
    public function index()
    {
        $this->load->view('pages/privacy_policy');
    }
    public function user_bid_history($game_type = 'matka')
    {
        if ($game_type == 'matka') {
            $data['matka'] = $this->Administrator_Model->getMatkaName();
            $data['games'] = $this->Administrator_Model->games($game_type);
            $data['name'] = 'Bid History Report';
        }
        if ($game_type == 'starline') {
            $data['matka'] = $this->Administrator_Model->getStarinMatkaName();
            $data['games'] = $this->Administrator_Model->gamesStarline();
            $data['name'] = 'Bid History Report';
        }
        if ($game_type == 'dmatka') {
            $data['matka'] = $this->Administrator_Model->getMatkaName($game_type);
            $data['games'] = $this->Administrator_Model->games($game_type);
            $data['name'] = 'Bid History Report';
        }
        $bettype = array("Open" => "open", "Close" => "close");
        $data['from_date'] = $date_from = ($this->input->get('from_date')) ?: date('Y-m-d');
        $data['to_date'] = $date_to = ($this->input->get('from_date')) ?: date('Y-m-d');
        $matka_id = $this->input->get('matka_id');
        $type = $this->input->get('bettype');
        $game_id = $this->input->get('game_id');
        $user_id = $this->input->get('user_id');
        $status = "";
        $data['select_matka'] = $matka_id;
        $data['bettype'] = $bettype;
        $data['type'] = $type;
        $data['game_type'] = $game_type;
        $data['gamedata'] = $this->Game->user_bid_history($matka_id, $type, $game_id, $user_id, $status, $date_from, $date_to, $game_type);
        // $from = ($this->input->get('from'))?$this->input->get('from'):date('Y-m-d');
        // $to = ($this->input->get('to'))?$this->input->get('to'):date('Y-m-d');
        // $data['from'] = $from;
        // $data['to'] = $to;
        // $data['gamedata'] = $this->Administrator_Model->gamedata(date("Y-m-d", strtotime($from)), date("Y-m-d", strtotime($to)));
        $this->load->view('admin/userbid_history', $data);
    }

    public function withdraw_report()
    {
        $data['users'] = $this->Administrator_Model->withdraw_report();
        $this->load->view('admin/withdraw_report', $data);
    }

    public function deposit_history()
    {
        $data['users'] = $this->Administrator_Model->desposit_history();
        $this->load->view('admin/deposit_history', $data);
    }

    public function bid_winning_report()
    {
        $data['matka'] = $this->Administrator_Model->getMatkaName();
        $data['games'] = $this->Administrator_Model->games();
        $data['name'] = 'Bid Winning Report';
        $bettype = array("Open" => "open", "Closed" => "close");
        $data['from_date'] = $date_from = ($this->input->get('from_date')) ?: date('Y-m-d');
        $data['to_date'] = $date_to = ($this->input->get('from_date')) ?: date('Y-m-d');
        $matka_id = $this->input->get('matka_id');

        $type = $this->input->get('bettype');
        $game_id = $this->input->get('game_id');
        $user_id = $this->input->get('user_id');

        $data['select_matka'] = $matka_id;
        $data['winning_ank'] = $winning_ank;
        $data['bettype'] = $bettype;
        $data['type'] = $type;
        $game_type = 'matka';
        $data['userbid_history'] = $this->Game->user_bid_history($matka_id, $type, $game_id, $user_id, $status = '', $date_from, $date_to, $game_type);
        $data['winning_report'] = $this->Game->winning_GameData($matka_id, $type, $game_id, $user_id, $status = 'win', $date_from, $date_to, $game_type);
        $data['gamedata'] = $this->Game->totalGameData($matka_id, $type, $game_id, $user_id, $status, $date_from, $date_to, $game_type, $winning_ank);
        $this->load->view('admin/bid_win_report', $data);
    }

    public function customer_sale_report($type = 'matka')
    {
        if ($type == 'matka' || $type == 'starline' || $type == 'dmatka') {
            $data['matka'] = $this->Administrator_Model->getMatkaName($type);
            $data['games'] = $this->Administrator_Model->games($type);
            $data['selectedGames'] = $this->Administrator_Model->games($type, $this->input->post('game'));
        }

        $data['game_type'] = $type;
        $data['select_matka'] = "";
        $data['select_game'] = "";
        $data['select_session'] = "";

        if (isset($_POST['sbmt_btn'])) {
            $date = date('d/m/Y', strtotime($this->input->post('select_date')));
            $matka = $this->input->post('matka');
            $game_type = $this->input->post('game');
            $session = $this->input->post('session');
            //  $matka = $this->input->post('matka')??($matka_data?$matka_data->matka:"");
            $data['select_matka'] = $matka;

            $data['select_game'] = $game_type;
            $data['select_session'] = $session;
            $data['select_date'] = $this->input->post('select_date');
        }
        $data['gameData'] = array();
        foreach ($data['selectedGames'] as $game_id):
            $data['gameData'][$game_id->game_id] = $this->db->select('digits,SUM(points) as points')->where('game_id', $game_id->game_id)->group_by('digits')->get('tblgamedata')->result();
        endforeach;
        $data['single_digit'] = $this->db->select('digits,SUM(points) as points')->where('game_id', 2)->group_by('digits')->get('tblgamedata')->result();
        $data['jodi_digit'] = $this->db->select('digits,SUM(points) as points')->where('game_id', 3)->group_by('digits')->get('tblgamedata')->result();
        $data['single_pana'] = $this->db->select('digits,SUM(points) as points')->where('game_id', 7)->group_by('digits')->get('tblgamedata')->result();
        $data['double_pana'] = $this->db->select('digits,SUM(points) as points')->where('game_id', 8)->group_by('digits')->get('tblgamedata')->result();
        $data['triple_pana'] = $this->db->select('digits,SUM(points) as points')->where('game_id', 9)->group_by('digits')->get('tblgamedata')->result();
        $data['single_pana_array'] = $this->Game_model->pana_digits('single-pana');
        $data['double_pana_array'] = $this->Game_model->pana_digits('double-pana');
        $data['triple_pana_array'] = $this->Game_model->pana_digits('tripple-pana');
        $this->load->view('admin/customer_sale_report', $data);
    }

    public function winning_report($game_type = 'matka')
    {
        if ($game_type == 'matka') {
            $data['matka'] = $this->Administrator_Model->getMatkaName($game_type);
            $data['games'] = $this->Administrator_Model->games($game_type);
        }
        if ($game_type == 'starline') {
            $data['matka'] = $this->Administrator_Model->getStarinMatkaName();
            $data['games'] = $this->Administrator_Model->gamesStarline();
        }
        if ($game_type == 'dmatka') {
            $data['matka'] = $this->Administrator_Model->getMatkaName($game_type);
            $data['games'] = $this->Administrator_Model->games($game_type);
        }
        $bettype = array("Open" => "open", "Close" => "close");
        $data['from_date'] = $date_from = ($this->input->get('from_date')) ?: date('Y-m-d');
        $data['to_date'] = $date_to = ($this->input->get('from_date')) ?: date('Y-m-d');
        $matka_id = $this->input->get('matka_id');
        $type = $this->input->get('bettype');
        $game_id = $this->input->get('game_id');
        $user_id = $this->input->get('user_id');
        $status = "win"; //$this->input->get('status');
        $data['select_matka'] = $matka_id;
        $data['bettype'] = $bettype;
        $data['type'] = $type;
        $data['game_type'] = $game_type;
        $data['gamedata'] = $this->Game->winning_GameData($matka_id, $type, $game_id, $user_id, $status, $date_from, $date_to, $game_type);
        $this->load->view('admin/winning_report', $data);
    }
    public function bid_revert()
    {
        $data['from_date'] = $date_from = ($this->input->get('from_date')) ?: date('Y-m-d');
        $data['to_date'] = $date_to = ($this->input->get('from_date')) ?: date('Y-m-d');
        $matka_id = $this->input->get('matka_id');
        $data['select_matka'] = $matka_id;
        // print_r($matka_id);exit;
        $data['matka'] = $this->Administrator_Model->getMatkaName();
        if (!empty($matka_id)):
            $data['bid_revert_data'] = $this->Administrator_Model->get_bid_revert($date_from, $date_to, $matka_id);
        endif;
        //echo $this->db->last_query();die();
        $this->load->view('admin/bid_revert', $data);
    }

    public function winning_prediction($game_type = 'matka')
    {
        if ($game_type == 'matka' || $game_type == 'dmatka') {
            $data['matka'] = $this->Administrator_Model->getMatkaName($game_type);
            $data['games'] = $this->Administrator_Model->games($game_type);
            $data['name'] = 'Winning Prediction';
            if ($game_type == 'matka')
                $pana_type = 'all';
            else
                $pana_type = 'jodi_digit';
        }
        if ($game_type == 'starline') {
            $data['matka'] = $this->Administrator_Model->getStarinMatkaName();
            $data['games'] = $this->Administrator_Model->gamesStarline();
            $data['name'] = 'Winning Prediction';
            $pana_type = 'all';
        }
        $bettype = array("Open" => "open", "Closed" => "close");
        $data['from_date'] = $date_from = ($this->input->get('from_date')) ?: date('Y-m-d');
        $data['to_date'] = $date_to = ($this->input->get('from_date')) ?: date('Y-m-d');
        $matka_id = $this->input->get('matka_id');
        $type = $this->input->get('bettype');
        $game_id = $this->input->get('game_id');
        $user_id = $this->input->get('user_id');
        $status = $this->input->get('status');
        $open_pana = $this->input->get('open_pana');
        $close_pana = $this->input->get('close_pana');
        $data['select_matka'] = $matka_id;
        $data['winning_ank'] = $winning_ank;
        $data['bettype'] = $bettype;
        $data['type'] = $type;
        $data['open_pana'] = $open_pana;
        $data['close_pana'] = $close_pana;
        $data['game_type'] = $game_type;
        $data['pana_digit'] = $this->Game_model->pana_digits($pana_type);
        // print_r($type);exit;
        $data['gamedata'] = $this->Game->totalGameData($matka_id, $type, $game_id, $user_id, $status, $date_from, $date_to, $game_type, $open_pana, $close_pana);
        //echo $this->db->last_query();die();
        $this->load->view('admin/winning_prediction_new', $data);
    }
    public function starline()
    {
        $data['title'] = 'starline ';

        $data['users'] = $this->Administrator_Model->starline();

        // 			$this->load->view('administrator/header-script');
        // 	 	 	 $this->load->view('administrator/header');
        // 	  		 $this->load->view('administrator/header-bottom');
        $this->load->view('admin/starline', $data);
        // 	  		$this->load->view('administrator/footer');
    }
    //     	public function starline_gamerate()
// 	{
// 		$data['games'] = $this->Administrator_Model->starline_games();
// 		$this->load->view('admin/starline_gamerate', $data);
// 		if(isset($_POST['update'])){
// 		    $this->Administrator_Model->update_starline_game_rate($this->input->post('update'));
//             $this->session->set_flashdata('success', 'Starline Game Rate has been updated successfull.');
// 			redirect('admin/starline_gamerate');

    // 		}
// 	}
    public function transfer_point_request()
    {
        $data['from_date'] = $date_from = ($this->input->get('from_date')) ?: date('Y-m-d');
        $data['to_date'] = $date_to = ($this->input->get('from_date')) ?: date('Y-m-d');
        $data['transfer_data'] = $this->Administrator_Model->transfer_money_history($date_from, $date_to);
        $this->load->view('admin/transfer_point_request', $data);
    }
    //new section delhi market
    // public function delhi_markert()
    // {
    // $data['title'] = 'starline';
    // $data['users'] = $this->Administrator_Model->delhi_markert();
    // $this->load->view('admin/delhi_markert', $data);
    // }
    public function update_winning_prediction()
    {
        $id = $this->input->post('game_id_data');
        $game_id = $this->input->post('game_id');
        $digit = $this->input->post('digit');
        $close_digit = $this->input->post('close_digit');
        if ($game_id == 12 || $game_id == 13) {
            $data['digits'] = $digit . "-" . $close_digit;
        } else {
            $data['digits'] = $digit;
        }
        $x = $this->db->where('id', $id)->update(' tblgamedata', $data);
        //echo $this->db->last_query();die();
        echo "<script>history.go(-1)</script>";
        // echo $digit;
        // die();
    }

}