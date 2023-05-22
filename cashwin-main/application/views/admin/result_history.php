<?php 
	include('includes/header.php');
	include('includes/sidebar.php');
?>

<div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-8">
                          <h5 class="font-strong mb-4">Game Result List</h5></div>
                          <div class="col-md-4">
                              <?php
                                if($this->session->flashdata("success"))
                                    echo "<p class='alert alert-success'>".$this->session->flashdata("success")."<p>";
                              ?>
                          </div>
                       </div>
                        
                      
                        <div class="table-responsive row">
                           <table class="table" id="myTable_2"  >
                            <thead>
                                             <tr>
                                            <th>Id</th>
                                            <th>Matka Name</th>
                                             <th>Result Date</th>
                                             <?php
                                             if($game_type=='matka' )
                                             {
                                             ?>
                                            <th>Open Declare Date</th>
                                            <th>Close Declare Date</th>
                                             <th>Open Pana</th>
                                            <th>Close Pana</th>
                                            <?php }?>
                                            
                                             <?php
                                             if($game_type=='starline' || $game_type=='dmatka' )
                                             {
                                             ?>
                                            <th>Declare Date</th>
                                            <th>Number</th>
                                        
                                            <?php }?>
                                            </tr>
                                            </thead>
                                             <tbody>
                                <?php
                                $i=1;
                                foreach($chart_data as $team) : ?>
                                     <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $team['name']; ?></td>
                                         <td><?php echo date("M d,Y", strtotime($team['date'])); ?></td>
                                          <?php
                                             if($game_type=='matka' )
                                             {
                                             ?>
                                         <td>N/A</td>
                                         <td>N/A</td>
                                         <td><?php echo $team['starting_num']."-".$team['number'][0]; ?></td>
                                          <td><?php echo $team['end_num']!=""?$team['number'][1]."-".$team['end_num']:"*-***"; ?></td>
                                       <?php }?>
                                        <?php
                                             if($game_type=='starline')
                                             {
                                             ?>
                                       
                                        <td>NA</td>
                                          <td><?php echo $team['s_game_number']!=""?$team['s_game_number']:"*-***"; ?></td>
                                       <?php }?>
                                        <?php
                                             if($game_type=='dmatka')
                                             {
                                             ?>
                                       
                                          <td>NA</td>
                                          <td><?php echo $team['number']!=""?$team['number']:"*-***"; ?></td>
                                       <?php }?>
                                    </tr>
                                <?php endforeach; ?>

                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
           <script>
function showPass(id) {
    var txt = $("#btn"+id).text();
    if(txt==='Show Password')
        $("#btn"+id).text('Hide Password');
    else
        $("#btn"+id).text('Show Password');
    $("#pass"+id).toggle();
}
</script>
        <?php include('includes/footer.php')?>