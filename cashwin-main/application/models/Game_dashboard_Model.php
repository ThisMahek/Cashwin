<?php
class Game_dashboard_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getMatkaDetailByID($id)
    {
        $type = "matka";
        if ($id > 20)
            $type = "tblStarline";
        return $this->db->where('id', $id)->get($type)->row();
    }

    public function get_history($user_id, $matka_id, $game_id)
    {
        //  $sel = "SELECT DISTINCT tblgame.name,user_profile.username, tblgamedata.points, tblgamedata.digits, date, tblgamedata.time,bet_type,tblgamedata.user_id, tblgamedata.matka_id,tblgamedata.game_id, tblgamedata.id from tblgame, user_profile,tblgamedata where tblgame.game_id='$game_id' and tblgamedata.game_id='$game_id' and user_id=user_profile.id and user_id='$user_id' and matka_id='$matka_id' order by tblgamedata.id";
        $sel = "SELECT DISTINCT SUM(tblgamedata.points) as sum_points, tblgame.name,user_profile.username, tblgamedata.points, tblgamedata.digits, date, tblgamedata.time,bet_type,tblgamedata.user_id, tblgamedata.matka_id,tblgamedata.game_id, tblgamedata.id from tblgame, user_profile,tblgamedata where tblgame.game_id='$game_id' and tblgamedata.game_id='$game_id' and user_id=user_profile.id and user_id='$user_id' and matka_id='$matka_id' GROUP bY name, digits order by tblgame.name, digits";
        $query = $this->db->query($sel);
        $aa = $query->result_array();
        return ($aa) ? $aa : false;
    }

    public function all_matka($date = '')
    {
        if ($date == '')
            $date = date('Y-m-d');
        //SELECT *, (SELECT SUM(points) FROM tblgamedata WHERE tblgamedata.matka_id=2 GROUP BY tblgamedata.matka_id) as gamedata FROM `matka`
        // Sub Query
        //SELECT SUM(points) FROM tblgamedata WHERE tblgamedata.matka_id=2 GROUP BY tblgamedata.matka_id
        //SELECT * FROM matka JOIN (SELECT SUM(tblgamedata.points) as total_bet, SUM(IF(bet_type='open', tblgamedata.points, 0)) as open_bet, SUM(IF(bet_type='close', tblgamedata.points, 0)) as close_bet, `tblgamedata`.`matka_id` as matka FROM `tblgamedata` GROUP BY `tblgamedata`.`matka_id`) B on matka.id=B.matka
        //SELECT * FROM matka JOIN (SELECT SUM(tblgamedata.points) as total_bet, SUM(IF(bet_type='open', tblgamedata.points, 0)) as open_bet, SUM(IF(bet_type='close', tblgamedata.points, 0)) as close_bet, `tblgamedata`.`matka_id` as matka, SUM(IF(history.type='c', history.amt, 0)) as dist_amt FROM `tblgamedata` LEFT JOIN history ON history.bid_id=tblgamedata.id AND history.type='c' GROUP BY `tblgamedata`.`matka_id`) B on matka.id=B.matka ORDER BY `matka`.`id` ASC
        $this->db->select('SUM(tblgamedata.points) as total_bet, SUM(IF(bet_type="open", tblgamedata.points, 0)) as open_bet, SUM(IF(bet_type="close", tblgamedata.points, 0)) as close_bet, `tblgamedata`.`matka_id` as matka, SUM(IF(history.type="c", history.amt, 0)) as dist_amt, SUM(IF(bet_type="open", IF(history.type="c", history.amt, 0), 0)) as open_dist_amt, SUM(IF(bet_type="close", IF(history.type="c", history.amt, 0), 0)) as close_dist_amt')->from('tblgamedata')
            ->join('history', "history.bid_id=tblgamedata.id AND history.type='c'", 'left')
            ->where('DATE(tblgamedata.time)', "'" . $date . "'", false)
            ->group_by('tblgamedata.matka_id');
        $subQuery = $this->db->get_compiled_select();

        $this->db
            ->join('(' . $subQuery . ') B', 'matka.id=B.matka')
            ->order_by('matka.id', 'DESC');
        //->select("*, IFNULL(($subQuery1), 0) as opengamepoint, IFNULL(($subQuery2), 0) as closegamepoint", FALSE)
        $query = $this->db->get('matka');
        return $query->result();
    }

    public function total_load($type = "matka", $today = false)
    {
        $date = date('Y-m-d');
        if ($type == "starline")
            $type = "tblStarline";
        $this->db->select('IFNULL(SUM(tblgamedata.points), 0) as total_bet, IFNULL(SUM(IF(bet_type="open", tblgamedata.points, 0)), 0) as open_bet, IFNULL(SUM(IF(bet_type="close", tblgamedata.points, 0)), 0) as close_bet, `tblgamedata`.`matka_id` as matka, SUM(IF(history.type="c", history.amt, 0)) as dist_amt, SUM(IF(bet_type="open", IF(history.type="c", history.amt, 0), 0)) as open_dist_amt, SUM(IF(bet_type="close", IF(history.type="c", history.amt, 0), 0)) as close_dist_amt')->from('tblgamedata')
            ->join('history', "history.bid_id=tblgamedata.id AND history.type='c'", 'left');
        if ($today == true)
            $this->db->where('DATE(tblgamedata.time)', "'" . $date . "'", false);
        $this->db->group_by('tblgamedata.matka_id');
        $subQuery = $this->db->get_compiled_select();

        $this->db->select('IFNULL(SUM(total_bet), 0) as actual_bet, IFNULL(SUM(dist_amt), 0) as actual_dist_amt')
            ->join('(' . $subQuery . ') B', $type . '.id=B.matka');
        $query = $this->db->get($type);
        $res = $query->row();
        return $res;
    }

    public function all_starline($date = '')
    {
        if ($date == '')
            $date = date('Y-m-d');
        $this->db->select('SUM(tblgamedata.points) as total_bet, SUM(IF(bet_type="open", tblgamedata.points, 0)) as open_bet, SUM(IF(bet_type="close", tblgamedata.points, 0)) as close_bet, `tblgamedata`.`matka_id` as matka, SUM(IF(history.type="c", history.amt, 0)) as dist_amt, SUM(IF(bet_type="open", IF(history.type="c", history.amt, 0), 0)) as open_dist_amt, SUM(IF(bet_type="close", IF(history.type="c", history.amt, 0), 0)) as close_dist_amt')->from('tblgamedata')
            ->join('history', "history.bid_id=tblgamedata.id AND history.type='c'", 'left')
            ->where('DATE(tblgamedata.time)', "'" . $date . "'", false)
            ->group_by('tblgamedata.matka_id');
        $subQuery = $this->db->get_compiled_select();

        $this->db
            ->join('(' . $subQuery . ') B', 'tblStarline.id=B.matka')
            ->order_by('tblStarline.id', 'DESC');
        $query = $this->db->get('tblStarline');
        return $query->result();
    }

    public function games($type = 'open', $game_name = '')
    {
        $this->db->where('is_deleted', 0);
        //  if($type=='open')
        //      $this->db->where('is_close', 0);
        if ($game_name != ""):
            $this->db->where('game_name', $game_name);
            return $this->db->get('tblgame')->row();
        endif;
        return $this->db->get('tblgame')->result();
    }

    public function totalGameData(
        $matka_id = '',
        $type = '',
        $game_id = '',
        $user_id = '',
        $status = '',
        $date_from = '',
        $date_to = '',
        $game_type = '',
        $open_pana = '',
        $close_pana = ''
    ) {
        if ($date_from != "" && $date_to != "")
            $this->db->where('DATE(time) >=', "'" . $date_from . "'", false)->where('DATE(time) <=', "'" . $date_to . "'", false);
        if ($matka_id != "")
            $this->db->where('matka_id', $matka_id);
        if ($type != "")
            $this->db->where('bet_type', $type);
        if ($game_id != "")
            $this->db->where('game_id', $game_id);
        if ($user_id != "")
            $this->db->where('user_id', $user_id);
        if ($status != "")
            $this->db->where('status', $status);
        if ($type == 'Open') {
            if ($open_pana != "") {
                $sum = array_sum(str_split($open_pana));
                $single_digit = $sum % 10;
                $pana = $open_pana;
                $this->db->group_start()->where('digits', $single_digit)->or_where('digits', $pana)->group_end();
            }
        }
        if ($type == 'Close') {
            if ($close_pana != "") {
                $a = array_sum(str_split($open_pana));
                $b = array_sum(str_split($close_pana));
                $jodi_digit = $a . $b;
                // $single_digit=$close_pana % 10;
                $single_digit = $b;
                $pana = $close_pana;
                $full_sangam = $open_pana . "-" . $close_pana;
                $half_sangam = $single_digit . "-" . $close_pana;
                // $b=floor($digit/10);
                // $digit=$b;
                $this->db->group_start()->where('digits', "$b")->or_where('digits', $jodi_digit)->or_where('digits', $pana)->or_where('digits', $full_sangam)->or_where('digits', $half_sangam)->group_end();
            }
        }
        if ($game_type == 'dmatka') {
            if ($open_pana != "") {
                $right_digit = $open_pana % 10;
                $left_digit = floor($open_pana / 10);
                $jodi_digit = $open_pana;
                $this->db->group_start()->where('digits', $left_digit)->or_where('digits', $right_digit)->or_where('digits', $jodi_digit)->group_end();
            }
        }
        if ($game_type == 'starline') {
            if ($open_pana != "") {
                $b = array_sum(str_split($open_pana));
                $single_digit = $b;
                $pana = $open_pana;
                $this->db->group_start()->where('digits', $single_digit)->or_where('digits', $pana)->group_end();
            }
        }
        if ($game_type != "" && $game_type == 'starline')
            $this->db->where('matka_id>', 50);
        else if ($game_type != "" && $game_type == 'dmatka')
            $this->db->where('matka_id>', 20)->where('matka_id<=', 25);
        else
            $this->db->where('matka_id<=', 20);

        return $this->db->where('status', 'pending')->get('tblgamedata')->result();
    }





    public function winning_GameData($matka_id = '', $type = '', $game_id = '', $user_id = '', $status = '', $date_from = '', $date_to = '', $game_type = '')
    {
        if ($date_from != "" && $date_to != "")
            $this->db->where('DATE(time) >=', "'" . $date_from . "'", false)->where('DATE(time) <=', "'" . $date_to . "'", false);
        if ($matka_id != "")
            $this->db->where('matka_id', $matka_id);
        if ($type != "")
            $this->db->where('bet_type', $type);
        if ($game_id != "")
            $this->db->where('game_id', $game_id);
        if ($user_id != "")
            $this->db->where('user_id', $user_id);
        if ($status != "") {
            if ($status == 'win' || $status == 'loss' || $status == 'pending')
                $this->db->where('status', $status);
            else
                $this->db->where_in('status', ['loss', 'pending']);
        }
        if ($game_type != "" && $game_type == 'starline')
            $this->db->where('matka_id>', 50);
        else if ($game_type != "" && $game_type == 'dmatka')
            $this->db->where('matka_id>', 20)->where('matka_id<=', 25);
        else
            $this->db->where('matka_id<=', 20);
        return $this->db->get('tblgamedata')->result();
    }

    public function user_bid_history($matka_id = '', $type = '', $game_id = '', $user_id = '', $status = '', $date_from = '', $date_to = '', $game_type = '')
    {
        if ($date_from != "" && $date_to != "")
            $this->db->where('DATE(time) >=', "'" . $date_from . "'", false)->where('DATE(time) <=', "'" . $date_to . "'", false);
        if ($matka_id != "")
            $this->db->where('matka_id', $matka_id);
        if ($type != "")
            $this->db->where('bet_type', $type);
        if ($game_id != "")
            $this->db->where('game_id', $game_id);
        if ($user_id != "")
            $this->db->where('user_id', $user_id);
        if ($game_type != "" && $game_type == 'starline')
            $this->db->where('matka_id>', 50);
        else if ($game_type != "" && $game_type == 'dmatka')
            $this->db->where('matka_id>', 20)->where('matka_id<=', 25);
        else
            $this->db->where('matka_id<=', 20);
        if ($status != "") {
            if ($status == 'win' || $status == 'loss' || $status == 'pending')
                $this->db->where('status', $status);
            else
                $this->db->where_in('status', ['loss', 'pending']);
        }
        // if($status!="")
        //     $this->db->where('status', 'win');
        return $this->db->get('tblgamedata')->result();
    }


    public function maxPlayedGame($matka_id = '', $type = '', $game_id = '', $digit = '', $date = '')
    {
        $this->db->select("*")->from('tblgamedata');
        if ($matka_id != "")
            $this->db->where('matka_id', $matka_id);
        if ($type != "")
            $this->db->where('bet_type', $type);
        if ($game_id != "")
            $this->db->where('game_id', $game_id);
        if ($digit != "")
            $this->db->where('digits', $digit);
        if ($date != "")
            $this->db->where('DATE(tblgamedata.time)', "'" . $date . "'", false);
        $this->db->group_by('game_id')->order_by('points', 'desc')->order_by('id', 'asc');
        $gameDatas = $this->db->get()->result();
        $gameDataRes = array();
        foreach ($gameDatas as $key => $gameData):
            $gameDataRes[$gameData->game_id] = $gameData;
        endforeach;
        return $gameDataRes;
    }

    public function gamedata($matka_id = '', $type = '', $game_id = '', $digit = '', $date = '')
    {
        $sel = "SUM(points) as total_points, tblgamedata.*";
        $this->db->select($sel)->from('tblgamedata');
        if ($matka_id != "")
            $this->db->where('matka_id', $matka_id);
        if ($type != "")
            $this->db->where('bet_type', $type);
        if ($game_id != "")
            $this->db->where('game_id', $game_id);
        if ($digit != "")
            $this->db->where('digits', $digit);
        if ($date != "")
            $this->db->where('DATE(tblgamedata.time)', "'" . $date . "'", false);
        $this->db->group_by('game_id, digits')->order_by('game_id, digits');
        //SELECT SUM(points) as total_points, tblgamedata.*  FROM `tblgamedata` WHERE matka_id=2 GROUP BY game_id, digits ORDER BY game_id
        $gameDatas = $this->db->get()->result();
        $gameDataRes = array();
        foreach ($gameDatas as $key => $gameData):
            $gameDataRes[$gameData->game_id]["'" . $gameData->digits . "'"] = $gameData;
        endforeach;
        // print_r($gameDataRes);
        return $gameDataRes;
    }

    public function gameDataWithUser($matka_id = '', $type = '', $game_id = '', $digit = '', $date = '')
    {
        $sel = "points as total_points, tblgamedata.*";
        $this->db->select($sel)->from('tblgamedata');
        if ($matka_id != "")
            $this->db->where('matka_id', $matka_id);
        if ($type != "")
            $this->db->where('bet_type', $type);
        if ($game_id != "")
            $this->db->where('game_id', $game_id);
        if ($digit != "")
            $this->db->where('digits', $digit);
        if ($date != "")
            $this->db->where('DATE(tblgamedata.time)', "'" . $date . "'", false);
        $this->db->order_by('game_id, digits'); //, digits
        //SELECT SUM(points) as total_points, tblgamedata.*  FROM `tblgamedata` WHERE matka_id=2 GROUP BY game_id, digits ORDER BY game_id
        $gameDatas = $this->db->get()->result();
        $gameDataRes = array();
        foreach ($gameDatas as $key => $gameData):
            $gameDataRes[$gameData->game_id]["'" . $gameData->digits . "'"][] = $gameData;
        endforeach;
        // print_r($gameDatas);exit;
        return $gameDataRes;
    }

    public function gamebyid($id)
    {
        $this->db->where('game_id', $id);
        return $this->db->get('tblgame')->row();
    }
    public function gameStarlinebyid($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tblStarline')->row();
    }
    public function gamedatabyid($id)
    {
        $this->db->where('game_id', $id);
        return $this->db->get('tblgamedata')->result();
    }

    public function gamedatabyidtype($id, $type)
    {
        $this->db->where('game_id', $id);
        $this->db->where('bet_type', $type);
        return $this->db->get('tblgamedata')->result();
    }

    public function userbyid($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('user_profile')->row();
    }

    public function matkabyid($id)
    {
        $type = "matka";
        if ($id > 50)
            $type = "tblStarline";
        $this->db->where('id', $id);
        return $this->db->get($type)->row();
    }
















}