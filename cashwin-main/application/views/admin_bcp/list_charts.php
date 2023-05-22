<?php 
	include('includes/header.php');
	include('includes/sidebar.php');
?>

    <div class="content-wrapper">

        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="ibox-body">
                    <div class="row" style="padding-bottom: 7px;">
                        <div class="col-md-6">
                            <h5 class="font-strong mb-4">Charts</h5></div>
                        <div class="col-md-6">

                        </div>
                    </div>
                        <?php echo form_open_multipart('admin/chartshow'); ?>
                            <div class="form-group row">
                                <h5><label class="col-form-label">Select Chart</label></h5> 
                                <select class="form-control" name="chart">
                                <?php 
                                foreach($charts as $c) {
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
        </div>
        </div>
        <!-- END PAGE CONTENT-->

        <?php include('includes/footer.php')?>