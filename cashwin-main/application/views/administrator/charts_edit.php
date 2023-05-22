<h2>Charts</h2>

<div class="card p-3 m-2">
   <div class="container w-50 mx-auto p-2 my-3">
      <?php echo form_open_multipart('administrator/chartupdate'); ?>
      <div class="form-group row">
         <h3><label class="col-form-label">Select Chart</label></h3>
         <select class="form-control" name="chart">
            <?php
            foreach ($charts as $c) {
               ?>
               <option value="<?php echo $c['name']; ?>"><?php echo $c['name']; ?></option>
            <?php }
            ?>
         </select>

      </div>
      <button type="submit" name="submit" class="btn btn-primary">Show</button>
      </form>
   </div>
</div>