<?php
class Excel_export_model extends CI_Model
{
    function fetch_data($matka_id, $date = NULL, $mtype = "matka")
    {
        if ($mtype == "starline")
            $this->db->where('starline_points >', 0);
        $games = $this->db->where('is_deleted', 0)->get("tblgame")->result();
        $game_data = array();
        foreach ($games as $game):
            $cycle_pana = 0;
            if ($game->game_name == "cycle_pana")
                $cycle_pana = 1;
            $points = ($mtype == "matka") ? $game->points : $game->starline_points;
            $common = ($mtype == "matka") ? "close" : "open";
            if ($game->is_close == 0 || $game->game_name == "half_sangam") // && $mtype=="matka"
                $data = array(
                    "points" => $points,
                    "open" => $this->fetch_game_data($matka_id, $game->game_id, $date, "open", $cycle_pana),
                    "close" => $this->fetch_game_data($matka_id, $game->game_id, $date, "close", $cycle_pana)
                );
            else
                $data = array(
                    "points" => $points,
                    "common" => $this->fetch_game_data($matka_id, $game->game_id, $date, $common, $cycle_pana) //"open"
                ); foreach ($data as $type => $report):
                if ($type == "points"):
                    $game_data[$game->game_name][$type] = $report;
                    continue;
                endif;
                $game_data = $this->process_game_data($report, $game, $type, $cycle_pana, $game_data);
            endforeach;
            //$game_data[$game->game_name] = $new_data;
        endforeach;
        // print_r($game_data);exit;
        // $game = array(
        //     "jodi" => array(),
        //     "single" => array(
        //         "open" => array(),
        //         "close" => array()
        //     ),
        //     "single_pana" => array(),
        //     "double_pana" => array(),
        //     "triple_pana" => array(),
        //     "half_sangam" => array(),
        //     "full_sangam" => array()
        // );
        return $game_data;

    }

    function process_game_data($data, $game, $type = "common", $is_cycle_pana = 0, $game_data)
    {
        $this->load->model("Game_model");
        $cp_games = array("single_pana", "double_pana", "triple_pana", "cycle_pana");
        if (in_array($game->game_name, $cp_games)):
            if ($is_cycle_pana == 1):
                foreach ($data as $act_game_name => $res):
                    if (!isset($game_data[$act_game_name][$type])):
                        $game_data[$act_game_name][$type] = $res;
                    else: // Extra Validation required
                        foreach ($res as $digit => $point):
                            $game_data[$act_game_name][$type][$digit] = (isset($game_data[$act_game_name][$type][$digit])) ? $game_data[$act_game_name][$type][$digit] + $point : $point;
                        endforeach;
                    endif;
                endforeach;
            else:
                $game_name = $game->game_name;
                if (!isset($game_data[$game_name][$type])):
                    $game_data[$game_name][$type] = $data;
                else: // Extra Validation required
                    foreach ($data as $digit => $point):
                        $game_data[$game_name][$type][$digit] = (isset($game_data[$game_name][$type][$digit])) ? $game_data[$game_name][$type][$digit] + $point : $point;
                    endforeach;
                endif;
            endif;
        else:
            $game_data[$game->game_name][$type] = $data;
        endif;
        return $game_data;
    }

    function fetch_game_data($matka_id, $game_id, $date = NULL, $type = "open", $cycle_pana = 0)
    {
        if ($date == NULL)
            $date = date('d/m/Y');
        $games = $this->db->select("SUM(points) as points, digits")->where(['matka_id' => $matka_id, 'game_id' => $game_id, 'bet_type' => $type, 'status' => 'pending', 'date' => $date])->group_by('digits')->get("tblgamedata")->result();
        $game_data = array();
        foreach ($games as $game):
            $game_data["'" . $game->digits . "'"] = $game->points;
        endforeach;
        if ($cycle_pana == 1)
            $game_data = $this->fetch_game_data_cycle_pana($game_data);
        return $game_data;
    }

    function fetch_game_data_cycle_pana($game_datas)
    {
        $this->load->model("Game_model");
        $game_data = array();
        foreach ($game_datas as $digits => $points):
            $type = $this->Game_model->noOfRound(explode("'", $digits)[1]);
            $game_data[$type][$digits] = $points;
        endforeach;
        return $game_data;
    }

    function genrate_file_name($matka_id, $type = "matka")
    {
        if ($type == "matka"):
            $matka = $this->db->select("name")->where(['id' => $matka_id])->get("matka")->row();
            $res = $matka->name . " - " . date("d M, Y");
        else:
            $starline = $this->db->select("s_game_time")->where(['id' => $matka_id])->get("tblStarline")->row();
            $res = "Starline" . " " . $starline->s_game_time . " - " . date("d M, Y");
        endif;
        return $res;
    }
}