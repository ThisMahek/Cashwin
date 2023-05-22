<?php
class Game_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_winner($id, $n)
    {
        $query = $this->db->query("UPDATE tblgamedata set points=points*2 , status='win' where id=3 and matka_id=5");
        $query2 = $this->db->query("SELECT * from tblgamedata where matka_id='$id' and digits='$n'");
        return $query2->result_array();
    }

    public function gameData($data, $closed = 0, $is_starline = 0)
    {
        extract($data);
        $game_id = $game['game_id'];
        $anum = ($bet_type == 'open') ? $snum : $enum;
        // if($is_starline==0)
        //     echo 'ANUM: '.$anum.' SNUM: '.$snum.' ENUM: '.$enum.' NUM: '.$num.'<br>';
        // else
        //     echo 'ANUM: '.$anum.' SNUM: '.$snum.' NUM: '.$num.'<br>';
        if ($closed)
            $query = "SELECT * from tblgamedata where matka_id='$matka_id' and game_id='$game_id' and date='$date' and status='pending'";
        else
            $query = "SELECT * from tblgamedata where matka_id='$matka_id' and game_id='$game_id' and bet_type='$bet_type' and date='$date' and status='pending'";
        //echo $query;
        $wn = $this->db->query($query)->result_array();
        //print_r($wn);
        $status = "";
        foreach ($wn as $w) {
            //echo $w['user_id'].'---';
            //  echo $w['id'];
            //  echo "; ";
            //  echo $w['digits'].'---'.$w['bet_type'].'<br>';

            //  echo $game['game_name'];
            //  echo $this->sum($anum).'<br>';
            //  echo $this->bioSum($snum, $enum);


            //((($game['game_name']=='single_digit')) && ($w['digits'] == $this->sum($anum))) ||
            //((($game['game_name']=='sp_motor') || ($game['game_name']=='dp_motor')) && ($w['digits'] == $anum)) ||
            //((($game['game_name']=='panel_group')) && (($w['digits'] == $anum) && ($w['bet_type'] == $enum))) ||
            //((($game['game_name']=='red_bracket')) && (($w['digits'] == $this->sum($enum)) && ($w['bet_type'] == $snum)))

            if (
                ((($game['game_name'] == 'panel_group') || ($game['game_name'] == 'cycle_pana') || ($game['game_name'] == 'single_pana') || ($game['game_name'] == 'double_pana') || ($game['game_name'] == 'triple_pana') || ($game['game_name'] == 'sp_motor') || ($game['game_name'] == 'dp_motor')) && ($w['digits'] == $anum)) ||
                ((($game['game_name'] == 'red_bracket') || ($game['game_name'] == 'jodi_digits') || ($game['game_name'] == 'group_jodi')) && ($w['digits'] == $this->bioSum($snum, $enum))) ||
                ((($game['game_name'] == 'single_digit') || ($game['game_name'] == 'odd_even')) && ($w['digits'] == $this->sum($anum))) ||
                ((($game['game_name'] == 'half_sangam')) && ((($w['digits'] == $this->sum($snum) . '-' . $enum)) || (($w['digits'] == $snum . '-' . $this->sum($enum))))) ||
                ((($game['game_name'] == 'full_sangam')) && (($w['digits'] == $snum . '-' . $enum))) ||

                (($game['game_name'] == 'jodi_digit') && ($w['digits'] == (string) $num)) ||
                (($game['game_name'] == 'left_digit') && ($w['digits'] == (string) $num[0])) ||
                (($game['game_name'] == 'right_digit') && ($w['digits'] == (string) $num[1]))

                //  ((($game['game_name']=='half_sangam')) && ( (($w['digits'] == $this->sum($snum)) && ($w['bet_type'] == $enum)) || (($w['digits'] == $snum) && ($w['bet_type'] == $this->sum($enum))) )) ||
                //  ((($game['game_name']=='full_sangam')) && (($w['digits'] == $snum) && ($w['bet_type'] == $enum)))
            ) {
                $status = 'win';
            } else {
                $status = 'loss';
            }

            //  echo "<strong>".$status."</strong><br>";
            if ($status != "")
                $this->setGameData($w, $game, $status, $is_starline);
        }
        return $status;
    }

    public function getPoint($game, $digit, $points_column = "points")
    {
        if ($game['game_name'] == 'panel_group' || $game['game_name'] == 'cycle_pana')
            $pt = $this->getPointByGameName($this->noOfRound($digit), $points_column);
        else
            $pt = $game[$points_column];
        return $pt;
    }

    public function getPointByNo($digit)
    {
        //$pt = $this->noOfRound($digit);
        $pt = $this->getPointByGameName($this->noOfRound($digit), $points_column);
        //$pt = 10;
        return $pt;
    }
    public function getPointByGameName($gameName, $points_column = 'points')
    {
        //echo $gameName;
        $game = $this->db->where('game_name', $gameName)->get('tblgame')->row();
        $pt = ($game->$points_column > 0) ? $game->$points_column : 0;
        return $pt;
    }

    public function noOfRound($digit)
    {
        //$digit = '1'.$digit;
        if ($digit > 0) {
            $d1 = $digit % 10;
            $d2 = (int) ($digit / 10) % 10;
            $d3 = (int) ($digit / 100) % 10;
            $out = "";

            if (($d1 == $d2) && ($d1 == $d3) && ($d2 == $d3))
                $out = "triple_pana";
            else if (($d1 == $d2) || ($d1 == $d3) || ($d2 == $d3))
                $out = "double_pana";
            else if (($d1 != $d2) && ($d1 != $d3) && ($d2 != $d3))
                $out = "single_pana";
        } else {
            $out = "";
        }

        return $out;
    }

    public function setGameData($w, $data, $type = 'win', $is_starline = 0)
    {
        $it = $w["id"];
        if ($type == 'win') {
            $ut = $w["user_id"];
            $points_column = "points";
            if ($is_starline)
                $points_column = "starline_points";
            $pt = ($data['game_name'] == 'panel_group' || $data['game_name'] == 'cycle_pana') ? $this->getPoint($data, $w['digits'], $points_column) : $data[$points_column];
            //$pt2 = $w["points"]*$data["points"];
            $pt2 = $w["points"] * $pt;
            // echo '<hr>'.$pt2.' Points added.<hr>';
            $ins = array(
                'matka_id' => $w["matka_id"],
                'user_id' => $ut,
                'game_id' => $w["game_id"],
                'digits' => $w["digits"],
                'amt' => $pt2,
                'bid_id' => $it,
                'type' => 'c',
                'date' => date("d/m/Y")
            );
            $this->db->insert('history', $ins);

            //updated to this line ..........
            $this->db->query("UPDATE tblwallet set wallet_points=wallet_points+('$pt2') where user_id='$ut'");
            $this->db->query("UPDATE tblgamedata set status='win' where id='$it'");
            $data = "yes";
        } else {
            $this->db->query("UPDATE tblgamedata set status='loss' where id='$it'");
            $data = "no";
        }
        // echo $data;
        return $data;
    }
    public function getWinner($data, $udate = null, $closed = 0)
    {
        extract($data);
        $date = ($udate == null) ? date('d/m/Y') : date('d/m/Y', strtotime($udate));
        //$date = '14/07/2019';
        if ($closed == 0)
            $this->db->where('is_close', 0);
        $games = $this->db->where('is_deleted', 0)->get('tblgame')->result_array();
        foreach ($games as $game):
            //if(($game['is_close']==1) && ($closed==0)) continue;
            // echo '<h1>'.$game['game_name'].'</h1>';
            $data['matka_id'] = $matka_id;
            $data['game'] = $game;
            $data['date'] = $date;
            if (($game['is_close'] == 1) && ($closed == 1)) {
                // echo "<br>no open or close";
                if ($data['enum'] != "")
                    $this->gameData($data, 1);
            } else {
                // echo "<br>open or close";
                $bets = array('open');
                if ($closed == 1)
                    $bets = array('close');
                foreach ($bets as $bet):
                    // echo "<br>".$bet;
                    $data['bet_type'] = $bet;
                    $this->gameData($data);
                endforeach;
            }
            // echo "<hr>";
            // print_r($game);
            // echo "<hr>";
        endforeach;
        return 1;
    }

    public function getStarlineWinner($data, $udate = null, $closed = 0)
    {
        extract($data);
        $date = ($udate == null) ? date('d/m/Y') : date('d/m/Y', strtotime($udate));
        //$date = '14/07/2019';

        $games = $this->db->where(['is_deleted' => 0, 'is_starline' => 1])->get('tblgame')->result_array();
        foreach ($games as $game):
            echo '<h1>' . $game['game_name'] . '</h1>';
            $data['matka_id'] = $matka_id;
            $data['game'] = $game;
            echo $data['date'] = $date;
            // if(($game['is_close']==1) && ($closed==1)) {
            //     echo "<br>no open or close";
            //     if($data['enum']!="")
            //         $this->gameData($data, 1);
            // } else {
            echo "<br>starline open";
            $bets = array('open'); // if($closed==1)
            //     $bets = array('close');
            foreach ($bets as $bet):
                echo "<br>" . $bet;
                $data['bet_type'] = $bet;
                $this->gameData($data, 0, 1);
            endforeach;
            // }
            echo "<hr>";
            // print_r($game);
            // echo "<hr>";
        endforeach;
        return 1;
    }

    // for showing winnerlist
    public function gameDataforwinner($data, $closed = 0)
    {
        extract($data);
        $loss = false;
        $game_id = $game['game_id'];
        // if($matka_id>100):
        //     $snum = (int)($num/10);
        //     $enum = (int)($num%10);
        // endif;
        $anum = ($bet_type == 'open') ? $snum : $enum;
        // echo 'ANUM: '.$anum.' SNUM: '.$snum.' ENUM: '.$enum.' NUM: '.$num.'<br>';
        if ($closed)
            $query = "SELECT * from tblgamedata where matka_id='$matka_id' and game_id='$game_id' and date='$date' and status='pending'";
        else
            $query = "SELECT * from tblgamedata where matka_id='$matka_id' and game_id='$game_id' and bet_type='$bet_type' and date='$date' and status='pending'";
        //echo $query;
        $wn = $this->db->query($query)->result_array();

        $ins = array();

        if (!empty($wn)) {
            // echo '<pre>';
            // print_r($wn);
            // die;
            foreach ($wn as $w) {

                $status = "";


                if (
                    ((($game['game_name'] == 'panel_group') || ($game['game_name'] == 'cycle_pana') || ($game['game_name'] == 'single_pana') || ($game['game_name'] == 'double_pana') || ($game['game_name'] == 'single_pana_bulk') || ($game['game_name'] == 'double_pana_bulk') || ($game['game_name'] == 'triple_pana') || ($game['game_name'] == 'sp_motor') || ($game['game_name'] == 'dp_motor') || ($game['game_name'] == 'sp_dp') || ($game['game_name'] == 'choice_pana') || ($game['game_name'] == 'two_digit') || ($game['game_name'] == 'double_pana_sp_dp') || ($game['game_name'] == 'double_pana_two_digit') || ($game['game_name'] == 'triple_pana_sp_dp')) && ($w['digits'] == $anum)) ||
                    ((($game['game_name'] == 'red_bracket') || ($game['game_name'] == 'jodi_digits') || ($game['game_name'] == 'jodi_digit_bulk') || ($game['game_name'] == 'group_jodi') || ($game['game_name'] == 'digit_based_jodi')) && ($w['digits'] == $this->bioSum($snum, $enum))) ||
                        //((($game['game_name']=='sp_dp') || ($game['game_name']=='odd_even') || ($game['game_name']=='digit_based_jodi') || ($game['game_name']=='choice_pana') || ($game['panel_group']=='digit_based_jodi') || ($game['panel_group']=='two_digit'))) ||
                    ((($game['game_name'] == 'single_digit') || ($game['game_name'] == 'odd_even') || ($game['game_name'] == 'single_digit_bulk')) && ($w['digits'] == $this->sum($anum))) ||
                    ((($game['game_name'] == 'half_sangam')) && ((($w['digits'] == $this->sum($snum) . '-' . $enum)) || (($w['digits'] == $snum . '-' . $this->sum($enum))))) ||
                    ((($game['game_name'] == 'full_sangam')) && (($w['digits'] == $snum . '-' . $enum)))
                    //  ((($game['game_name']=='panel_group') || ($game['game_name']=='cycle_pana') || ($game['game_name']=='single_pana') || ($game['game_name']=='double_pana') || ($game['game_name']=='single_pana_bulk') || ($game['game_name']=='double_pana_bulk') || ($game['game_name']=='triple_pana') || ($game['game_name']=='sp_motor') || ($game['game_name']=='dp_motor') || ($game['game_name']=='sp_dp') || ($game['game_name']=='choice_pana') || ($game['game_name']=='two_digit') || ($game['game_name']=='double_pana_sp_dp') || ($game['game_name']=='double_pana_two_digit') || ($game['game_name']=='triple_pana_sp_dp')) && ($w['digits'] == $anum)) ||
                    //  ((($game['game_name']=='red_bracket') || ($game['game_name']=='jodi_digits') || ($game['game_name']=='jodi_digit_bulk') || ($game['game_name']=='group_jodi') || ($game['game_name']=='digit_based_jodi')) && ($w['digits'] == $this->bioSum($snum, $enum))) ||
                    //  //((($game['game_name']=='sp_dp') || ($game['game_name']=='odd_even') || ($game['game_name']=='digit_based_jodi') || ($game['game_name']=='choice_pana') || ($game['panel_group']=='digit_based_jodi') || ($game['panel_group']=='two_digit'))) ||
                    //  ((($game['game_name']=='single_digit') || ($game['game_name']=='odd_even') || ($game['game_name']=='single_digit_bulk')) && ($w['digits'] == $this->sum($anum))) ||
                    //  ((($game['game_name']=='half_sangam')) && ( (($w['digits'] == $this->sum($snum).'-'.$enum)) || (($w['digits'] == $snum.'-'.$this->sum($enum))) )) ||
                    //  ((($game['game_name']=='full_sangam')) && (($w['digits'] == $snum.'-'.$enum)))
                ) {
                    $arr = ['panel_group', 'cycle_pana', 'choice_pana', 'double_pana_sp_dp', 'triple_pana_sp_dp', 'double_pana_two_digit', 'sp_motor', 'dp_motor', 'sp_dp', 'two_digit', 'single_pana_bulk', 'double_pana_bulk'];
                    $pt = (in_array($game['game_name'], $arr)) ? $this->getPoint($game, $w['digits']) : $game["points"];
                    if ($w["matka_id"] > 100)
                        $pt = (in_array($game['game_name'], $arr)) ? $this->getPoint($game, $w['digits'], 1) : $game["starline_points"];

                    $ins[] = array(
                        'user_id' => $w["user_id"],
                        'game_id' => $w["game_id"],
                        'digits' => $w["digits"],
                        'amt' => $w["points"],
                        'points' => $pt,
                        'bid_id' => $w['id']

                    );
                } else {
                    $loss = true;
                }
            }

        }
        //  print_r($ins);
        if (count($ins) == 0)
            $ins = $loss;
        return $ins;
    }

    public function getWinnerlist($data, $udate = null, $closed = 0, $is_jackpot = 0)
    {
        extract($data);
        $winner_arr = array();
        $date = ($udate == null) ? date('d/m/Y') : date('d/m/Y', strtotime($udate));

        if ($is_jackpot)
            $this->db->where('game_id', 2)->or_where('game_id', 3);
        $games = $this->db->where('is_deleted', 0)->order_by('game_id', "ASC")->get('tblgame')->result_array();
        foreach ($games as $game):
            // echo '<h1>'.$game['game_name'].'</h1>';
            $data['matka_id'] = $matka_id;
            $data['game'] = $game;
            $data['date'] = $date;

            if (($game['is_close'] == 1) && ($closed == 1)) {
                // echo "<br>no open or close";
                if ($data['enum'] != "")
                    $bet_arr = $this->gameDataforwinner($data, 1);

            } else {
                // echo "<br>open or close";
                $bets = array('open');
                if ($closed == 1)
                    $bets = array('close');
                foreach ($bets as $bet):
                    // echo "<br>".$bet;
                    $data['bet_type'] = $bet;
                    $bet_arr = $this->gameDataforwinner($data);

                endforeach;
            }
            // echo "<hr>";

            if (!empty($bet_arr)) {
                array_push($winner_arr, $bet_arr);
            }

        endforeach;
        // print_r($winner_arr);
        return $winner_arr;
    }
    public function bioSum($snum, $enum = '')
    {
        $s = $this->sum($snum);
        $e = '';
        if ($enum != '')
            $e = $this->sum($enum);
        return $s . $e;
    }

    public function sum($num)
    {
        $sum = 0;
        //$num = (int)$num;
        for ($i = 0; $i < strlen($num); $i++) {
            $sum += $num[$i];
        }
        $sum = $sum % 10;
        return $sum;
    }

    public function pana_digits($type = '')
    {
        $pana_array = array();
        // $single_pana_array = array();
        // $double_pana_array = array();
        // $tripple_pana_array = array();
        for ($i = 1; $i <= 10; $i++) {
            for ($j = $i; $j <= 10; $j++) {
                for ($k = $j; $k <= 10; $k++) {
                    $arr = "";
                    $arr = ($i == 10) ? 0 : $i;
                    $arr .= ($j == 10) ? 0 : $j;
                    $arr .= ($k == 10) ? 0 : $k;
                    if ($type == 'all') {
                        $pana_array[] = $arr;

                    }
                    if ($type == 'single-pana' || $type == 7) {
                        if ($i != $j && $j != $k) {
                            //$single_pana_array[]=$arr;
                            $pana_array[] = $arr;
                        }
                    }
                    if ($type == 'tripple-pana' || $type == 9) {
                        if ($i == $j && $j == $k) {
                            //$tripple_pana_array[]=$arr;
                            $pana_array[] = $arr;
                        }
                    }
                    if ($type == 'double-pana' || $type == 8) {
                        if (($i == $j || $j == $k) && !($i == $j && $j == $k) && !($i != $j && $j != $k)) {
                            // $double_pana_array[]=$arr;
                            $pana_array[] = $arr;

                        }
                    }

                }

            }
        }
        if ($type == 'single_digit' || $type == '2' || $type == '12') {
            $arr = range(0, 9);
            $pana_array = $arr;
        }
        if ($type == 'jodi_digit' || $type == '3' || $type == '17') {
            $arr = range(00, 99);
            $pana_array = $arr;
        }
        $array = $pana_array;
        return $array;
    }

    //       public function all_game_number($type='')
    //     {
    //     $pana_array = array();
    //     for($i=1;$i<=10;$i++){
    //      for($j=$i;$j<=10;$j++){
    //       for($k=$j;$k<=10;$k++){
    //       		  $arr = "";
    //             $arr = ($i==10)?0:$i;
    //             $arr .= ($j==10)?0:$j;
    //             $arr .= ($k==10)?0:$k;
    //               if($type=='all'){
    //             $pana_array[] = $arr;

    //               }
    //             if($type=='7'){
    //                 if($i!=$j && $j!=$k){
    //                 //$single_pana_array[]=$arr;
    //                  $pana_array[] = $arr;
    //                 }
    //             }
    //             if($type=='9'){
    //                 if($i==$j && $j==$k){
    //             //$tripple_pana_array[]=$arr;
    //              $pana_array[] = $arr;
    //             }
    //                 }
    //                  if($type=='8'){
    //                 if(($i==$j || $j==$k ) && !($i==$j &&$j==$k) && !($i!=$j && $j!=$k)){
    //               // $double_pana_array[]=$arr;
    //                 $pana_array[] = $arr;

    //                 }
    //           }
    //           }

    //       }
    //      }
    //     $array=$pana_array;
    //     return $array; 
    //   }

    public function reverse_game($post = "")
    {
        $post = $this->input->post();

        // $matka_type   =   $post['game_type'];
        $matka_id = $post['matkaid'];
        $game_date = date('Y-m-d', strtotime($post['date']));
        $bet_type = ($post['bet_type'] != 'both') ? $post['bet_type'] : "";
        $reverse_amt_type = $post['reverse_amt_type'];
        $pending_status = $post['pending_status'];
        $cancel_status = $post['cancel_status'];
        $delete_status = $post['delete_status'];
        $reverse_points = $reverse_amt_type; //win_amt, bet_amt, both, no
        $set_to_pending = $pending_status; //0, 1
        $set_to_cancelled = $cancel_status; //0, 1
        $delete_gamedata = $delete_status; //0, 1

        if ($reverse_points == 'win_amt'):
            $this->db->where('status', 'win');
        endif;
        if ($reverse_points == 'bet_amt'):
            $this->db->where('status', 'pending');
        endif;
        if ($reverse_points == 'both'):
            $this->db->group_start();
            $this->db->where('status', 'pending')->or_where('status', 'win');
            $this->db->group_end();
        endif;
        if ($bet_type != ""):
            $this->db->where('bet_type', $bet_type);
        endif;
        $qrys = $this->db->where(['DATE(time)' => $game_date, 'matka_id' => $matka_id, 'bid_revert' => 0])->get('tblgamedata')->result();
        $gamedata_ids = array();
        foreach ($qrys as $qry_res):
            $gamedata_id = $qry_res->id;
            if ($reverse_points != "no" || $set_to_pending == 1 || $set_to_cancelled == 1 || $delete_gamedata == 1):
                if ($reverse_points == 'win_amt' || $reverse_points == 'bet_amt' || $reverse_points == 'both'):
                    $reverse_amt = 0;
                    $old_amt = 0;
                    $game_data_update = false;
                    if ($reverse_points == 'win_amt' || $reverse_points == 'both'):
                        $win_data = $this->db->get_where("history", ['bid_id' => $gamedata_id, 'type' => 'c'])->row();
                        if ($win_data):
                            // $this->db->get_where("history", ['amt' => 0], ['bid_id' => $gamedata_id, 'type' => 'c']);
                            $reverse_amt += $win_data->amt;
                            $userid = $win_data->user_id;
                            $old_amt = $win_data->amt;
                            $game_data_update = true;
                            $this->db->update("history", ['amt' => 0], ['bid_id' => $gamedata_id, 'type' => 'c']);
                            $bid_revert_data = array(
                                'history_bid_id	' => $gamedata_id,
                                'old_amt' => $win_data->amt,
                                'amt' => 0,
                                'type' => 'c'
                            );
                            $this->db->insert('bid_revert_history', $bid_revert_data);
                        endif;
                    endif;
                    if ($reverse_points == 'bet_amt' || $reverse_points == 'both'):
                        $bid_data = $this->db->get_where("history", ['bid_id' => $gamedata_id, 'type' => 'd'])->row();
                        if ($bid_data):
                            // $this->db->get_where("history", ['amt' => 0], ['bid_id' => $gamedata_id, 'type' => 'd']);
                            $reverse_amt -= $bid_data->amt;
                            $old_amt = $bid_data->amt;
                            $userid = $bid_data->user_id;
                            $game_data_update = true;
                            $this->db->update("history", ['amt' => 0], ['bid_id' => $gamedata_id, 'type' => 'd']);
                            $bid_revert_data = array(
                                'history_bid_id	' => $gamedata_id,
                                'old_amt' => $bid_data->amt,
                                'amt' => 0,
                                'type' => 'd'
                            );
                            $this->db->insert('bid_revert_history', $bid_revert_data);
                        endif;
                    endif;
                    if ($game_data_update == true):
                        $this->db->update("tblgamedata", ['points' => 0, 'bid_revert' => 1], ['id' => $gamedata_id]);
                    endif;
                    // if(!isset($userid))
                    //     return 'not_userid';
                    if (isset($userid) && $reverse_amt != 0):
                        $updated_wallet_points = 0;
                        $updated_wallet_points = $this->db->get_where("tblwallet", ['user_id' => $userid])->row()->wallet_points - $reverse_amt;
                        // if($updated_wallet_points<0)
                        //     return 'low_balance';
                        $this->db->update("tblwallet", ['wallet_points' => $updated_wallet_points], ['user_id' => $userid]);
                        // echo "User ID:".$userid." reverse amt of ".$reverse_amt." Updated balance: ".$updated_wallet_points." on bid_id: ".$gamedata_id."<br>";
                    endif;
                endif;
                $new_status = "pending";
                if ($set_to_cancelled == 1)
                    $new_status = "cancelled";
                if ($set_to_pending == 1 || $set_to_cancelled == 1):
                    // $this->db->update("tblgamedata", ['status' => $new_status, 'old_status' => $qry_res->status], ['id' => $gamedata_id]);
                    $this->db->update("tblgamedata", ['status' => $new_status], ['id' => $gamedata_id]);
                    // echo "User ID:".$userid." bet status changed from: ".$qry_res->status." to: ".$new_status." on bid_id: ".$gamedata_id."<br>";
                endif;
                if ($delete_gamedata == 1):
                    $this->db->delete("tblgamedata", ['id' => $gamedata_id]);
                    $this->db->delete("history", ['bid_id' => $gamedata_id]);
                endif;
            endif;
        endforeach;
        $new_set_status = "pending";
        if ($set_to_cancelled == 1)
            $new_set_status = "cancelled";
        $qry1 = "UPDATE tblgamedata SET status='$new_set_status' WHERE date='$game_date' AND matka_id='$matka_id' AND bet_type='$bet_type'";
        if ($set_to_pending == 1 || $set_to_cancelled == 1) {
            $this->db->query($qry1);
        }
        return true;
    }
}