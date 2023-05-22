<?php 
    $conn= mysqli_connect('localhost','rdgames_newdatabase', 'rdgames_newdatabase','rdgames_newdatabase');
    
    $q = "select * from tblStarline where s_game_time !=''";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        $i = 0;
        while($row = $result->fetch_assoc()) {
          $data[$i]['id'] = $row['id'];
          $data[$i]['s_game_time'] = $row['s_game_time'];
          $data[$i]['s_game_end_time'] = $row['s_game_end_time'];
          if(strtotime(date('Y-m-d')) == strtotime(date('Y-m-d', strtotime($row['updated_at']))))
            $data[$i]['s_game_number'] = $row['s_game_number'];
          else
            $data[$i]['s_game_number'] = "***";
            
          $i++;
        }
    }
    else
    {
          
          $data = "0";
    }
    
    
    echo json_encode($data);
    ?>