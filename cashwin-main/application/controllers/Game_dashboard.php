<?php
class Game_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $fun = $this->router->fetch_method();
        if (!$this->session->userdata('login') && $fun != "app_bid_history" && $fun != 'app_startline_bid_history')
            redirect(site_url("admin/login"));
        $this->load->model("Game", "Game");
        if ($this->input->post('load_date'))
            $this->session->set_userdata('load_date', $this->input->post('load_date'));
    }

    public function index($game_id)
    {
        $data['users'] = $this->Administrator_Model->get_total_users();
        $data['matkas'] = $this->Administrator_Model->getMatkaDetails();
        $data['matka'] = $this->Game->getMatkaDetailByID($game_id);
        $data['matka_id'] = $game_id;
        $this->load->view('admin/game_dashboard/index', $data);
    }

    public function view_user_games()
    {
        $matka_id = $this->input->get('matka_id');
        $game_id = $this->input->get('game_id');
        $data['title'] = 'view ';
        $data['game_id'] = $game_id;
        $data['matka_id'] = $matka_id;
        $data['users'] = $this->Game->get_user_games($game_id, $matka_id);
        $this->load->view('admin/game_dashboard/view_user_games', $data);
    }

    public function view_history()
    {
        $matka_id = $this->input->get('matka_id');
        $game_id = $this->input->get('game_id');
        $user_id = $this->input->get('user_id');
        $data['title'] = 'view ';

        $data['game_id'] = $game_id;
        $data['matka_id'] = $matka_id;
        $data['users'] = $this->Game->get_history($user_id, $matka_id, $game_id);
        $this->load->view('admin/game_dashboard/view_game_history', $data);
    }

    public function market_load()
    {
        $date = ($this->session->userdata('load_date')) ? $this->session->userdata('load_date') : date('Y/m/d');
        $data['matkas'] = $this->Game->all_matka($date);
        $data['date'] = $date;
        $this->load->view('admin/game_dashboard/market_load', $data);
    }

    public function starline_load()
    {
        $date = ($this->session->userdata('load_date')) ? $this->session->userdata('load_date') : date('Y/m/d');
        $data['starlines'] = $this->Game->all_starline($date);
        $data['date'] = $date;
        $this->load->view('admin/game_dashboard/starline_load', $data);
    }

    public function gamedata()
    {
        $bettype = array("Open" => "open", "Closed" => "close");
        $data['from_date'] = $date_from = ($this->input->get('from_date')) ?: date('Y-m-d');
        $data['to_date'] = $date_to = ($this->input->get('to_date')) ?: date('Y-m-d');
        $matka_id = $this->input->get('matka_id');
        $type = $this->input->get('bettype');
        $game_id = $this->input->get('game_id');
        $user_id = $this->input->get('user_id');
        $status = $this->input->get('status');
        $data['gamedata'] = $this->Game->totalGameData($matka_id, $type, $game_id, $user_id, $status, $date_from, $date_to);
        $this->load->view('admin/game_dashboard/gamedata', $data);
    }

    public function gamedatabyid($id)
    {
        $data['gamedata'] = $this->Game->gamedatabyid($id);
        $this->load->view('admin/game_dashboard/gamedata', $data);
    }

    public function singleGameData($id, $type = "open")
    {
        $date = ($this->session->userdata('load_date')) ? $this->session->userdata('load_date') : date('Y/m/d');
        $data['games'] = $this->Game->games($type);
        $data['matka'] = $this->Game->matkabyid($id);
        $data['gamedata'] = $this->Game->gamedata($id, $type, '', '', $date);
        $data['maxPlayedBy'] = $this->Game->maxPlayedGame($id, $type, '', '', $date);
        $data['type'] = $type;
        $data['date'] = $date;
        $data['matka_type'] = "matka";
        if ($id > 20)
            $data['matka_type'] = "starline";
        $this->load->view('admin/game_dashboard/singlegamedata', $data);
    }

    public function singlePlayerData($id, $type = "open", $game_name = '', $digit = '')
    {
        $date = ($this->session->userdata('load_date')) ? $this->session->userdata('load_date') : date('Y/m/d');
        $data['game'] = $this->Game->games($type, $game_name);
        $data['gamedata'] = $this->Game->gameDataWithUser($id, $type, $data['game']->game_id, $digit, $date);
        $data['maxPlayedBy'] = $this->Game->maxPlayedGame($id, $type, $data['game']->game_id, $digit, $date);
        $data['matka'] = $this->Game->matkabyid($id);
        $data['type'] = $type;
        $data['date'] = $date;
        $data['digit'] = $digit;
        $this->load->view('admin/game_dashboard/singleplayerdata', $data);
    }

    public function stastics($type = "")
    {
        if ($type == "")
            $stats = 0;
        if ($type == "add_point")
            $stats = $this->db->select('SUM(request_points) as points')->where(['type' => 'Add', 'request_status' => 'approved'])->get('tblRequest')->row()->points;
        if ($type == "withdrawl_point")
            $stats = $this->db->select('SUM(request_points) as points')->where(['type' => 'Withdrawal', 'request_status' => 'approved'])->get('tblRequest')->row()->points * (-1);
        if ($stats == "")
            $stats = 0;
        return $stats;
    }
}