<br>
<div class="container" style="margin-left:0px; width:100%;">
  <table class="table table-striped table-bordered" style="border:1px solid black;">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Result</th>

      </tr>
    </thead>
    <tbody>
      <?php foreach ($transactions as $transaction): ?>
        <tr>

          <td>
            <?php echo $transaction['name'] ?>
          </td>
          <td>
            <?php echo $transaction['date'] ?>
          </td>
          <td>
            <?php echo $transaction['starting_num'] . "-" . $transaction['result_num'] . "-" . $transaction['end_num'] ?>
          </td>

        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

</div>