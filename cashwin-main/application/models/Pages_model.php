<?php
class Pages_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getGameDetails()
    {
        //where('DATE(updated_at)', date('Y-m-d'))->
        return $this->db->order_by("matka_order", "asc")->get('matka')->result_array();
    }
    public function getGameDetails2()
    {
        return $this->db->order_by("matka_order", "asc")->get('matka')->result_array();
    }
    public function getGameDetails1()
    {
        return $this->db->get('games')->result_array();
    }

    public function getStarline()
    {
        return $this->db->get('tblStarline')->result_array();
    }

    public function getgamesDetails($name)
    {
        return $this->db->where('name', $name)->get('matka')->result_array();
    }

}