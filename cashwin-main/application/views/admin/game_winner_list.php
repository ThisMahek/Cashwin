<div class="modal-header">
  <h4 class="modal-title">Winners List</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
  <h4>Total Bid Amount: <span id="show_bet_amt">0</span></h4>
  <h4>Total Winning Amount: <span id="show_win_amt">0</span></h4>
  <div class="table-wrapper table-responsive">
    <div id="datatable1_wrapper" class="dataTables_wrapper no-footer" style="overflow-x: scroll!important;">
      <table id=""
        class="table-responsive table-bordered table display responsive nowrap dataTable no-footer dtr-inline"
        role="grid" aria-describedby="datatable1_info" style="width:100% !important;">
        <!--<table class="table table-bordered">-->
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Bid Points</th>
            <th scope="col">Winning Amount</th>
            <th scope="col">Type</th>
            <th>Bid TX ID</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($winner_array) && $winner_array != '') {
            $i = 1;
            $total_bet_amt = 0;
            $total_win_amt = 0;
            foreach ($winner_array as $record):
              ?>
              <tr>
                <td>
                  <?= $i ?>
                </td>
                <td>
                  <?= fullname($record['user_id']); ?>
                </td>
                <td>
                  <?= $record['amt'] ?>
                </td>
                <td>
                  <?= $record['amt'] * $record['points']; ?>
                </td>
                <td>
                  <?= getGameName($record['game_id']); ?>
                </td>
                <td>
                  <?= $record['bid_id'] ?>
                </td>
              </tr>
              <?php
              $total_bet_amt += $record['amt'];
              $total_win_amt += $record['amt'] * $record['points'];
              ?>

              <?php
              $i++;
            endforeach; ?>
            <input type="hidden" id="get_bet_amt" value="<?= $total_bet_amt; ?>">
            <input type="hidden" id="get_win_amt" value="<?= $total_win_amt; ?>">
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<script>
  $(document).ready(function () {
    var t_bet_amt = $('#get_bet_amt').val();
    var t_win_amt = $('#get_win_amt').val();
    $('#show_bet_amt').html(t_bet_amt);
    $('#show_win_amt').html(t_win_amt);
    $('#datatable_winnerlist').DataTable({
      dom: 'Bfrtip',
      ordering: false,
      searching: false,
      //   paging:false,
      "aLengthMenu": [
        [5, 15, 30, 50],
        [5, 15, 30, 50]
      ],
      "iDisplayLength": 5
    });
  });
</script>