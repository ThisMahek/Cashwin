<?php
    function fullname($userid)
    {
        $CI = &get_instance();
        $CI->load->model('Administrator_Model');
        $user = $CI->Administrator_Model->userbyid($userid);
        if(!$user)
            return '<i class="text-danger">User Deleted</i>';
        return $user->name;
    }
    
    function fullNamewithMob($userid)
    {
        $CI = &get_instance();
        $CI->load->model('Administrator_Model');
        $user = $CI->Administrator_Model->userbyid($userid);
        if(!$user)
            return '<i class="text-danger">User Deleted</i>';
        return $user->name.' ('.$user->mobileno.')';
    }
    
    function getGameName($id)
	{
	    $CI = &get_instance();
        $CI->load->model('Administrator_Model');
	    $q = $CI->Administrator_Model->getGameName($id);
	    return $q;
	}
	 function show_hide_delete_button($matka_id,$bet_type,$date)
	{
	    $CI = &get_instance();
	   // if($bet_type == 'open'){
	       // $CI->db->where('bet_type',$bet_type);
	   // }
	    $q =  $CI->db->where(['matka_id'=>$matka_id,'date'=>$date,'status!='=>'pending','bet_type'=>$bet_type])->get('tblgamedata')->result();
	    return  $q;
	}
	
	 function show_hide_star_on_delete_button($matka_id,$bet_type,$date)
	{
	    $CI = &get_instance();
	    $q =  $CI->db->where(['matka_id'=>$matka_id,'date'=>$date,'bet_type'=>$bet_type])->get('tblgamedata')->row();
	    return  $q;
	}