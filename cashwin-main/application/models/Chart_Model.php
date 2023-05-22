<?php
class Chart_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getChartDetails($name)
    {
        return $this->db->where('name', $name)->order_by('date')->get('charts')->result_array();
    }

    public function getChartDetailsById($id)
    {
        return $this->db->where('cid', $id)->order_by('date')->get('charts')->result_array();
    }

    public function getChartDetailName($name, $date)
    {
        return $this->db->where(array('name' => $name, 'date' => $date))->get('charts')->row_array();
    }

    public function chartdate($chart)
    {
        $sdate = $chart[0]['date'];
        $edate = end($chart)['date'];
        //echo $sdate;
        //echo $edate;
        return $this->getStart($sdate, $edate);
    }

    public function getWeek($sdate)
    {
        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', strtotime("-" . $i . "days", strtotime($sdate)));
            $dayName = date('D', strtotime($date));
            if ($dayName == "Mon") {
                $start = $date;
                break;
            }
        }

        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', strtotime("+" . $i . "days", strtotime($sdate)));
            $dayName = date('D', strtotime($date));
            if ($dayName == "Sat") {
                $end = $date;
                break;
            }
        }
        return array("s" => $start, "e" => $end);
    }

    public function date_compare($sdate, $edate)
    {
        $date1 = date_create($sdate);
        $date2 = date_create($edate);
        $diff = date_diff($date1, $date2);
        return $diff->format("%R%a");
    }

    public function getStart($sdate, $edate)
    {
        ini_set('memory_limit', '256M');
        set_time_limit(0);
        //echo $edate;
        $week[0] = $this->getWeek($sdate);
        $date2 = $this->date_compare($week[0]['e'], $edate);
        $date = date('Y-m-d', strtotime("+2 days", strtotime($week[0]['e'])));
        for ($i = 1; $i <= ceil($date2 / 7); $i++) {
            $week[$i] = $this->getWeek($date);
            $date = date('Y-m-d', strtotime("+2 days", strtotime($week[$i]['e'])));
        }
        return $week;
    }

    public function getStarline()
    {
        $starline = $this->db->where('name', 'Starline')->order_by('date')->get('charts')->result_array();
        $a = array();
        foreach ($starline as $s) {
            $date = $s['date'];
            $cid = $s['cid'];
            $start_num = $s['starting_num'];
            $result_num = $s['result_num'];
            $a[$date][$cid]['start_num'] = $start_num;
            $a[$date][$cid]['rest_num'] = $result_num;
        }
        return $a;
    }
    public function getTbl_Starline()
    {
        return $this->db->get('tblStarline')->result_array();
    }
    public function declare_result($id, $udate, $closed)
    {
        $set = array('open_declare_date' => date('Y-m-d H:i:s'));
        if ($closed == 1)
            $set = array('close_declare_date' => date('Y-m-d H:i:s'));
        return $this->db->where(['cid' => $id, 'date' => $udate])->update('charts', $set);
    }


}