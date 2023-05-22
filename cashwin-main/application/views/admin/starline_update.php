<?php
include('includes/header.php');
include('includes/sidebar.php');
?>


<div class="content-wrapper">

    <div class="page-content fade-in-up">
        <div class="card">
            <div class="card-header">
                <h5>Update Starline</h5>
                <div class="card-header-right">
                    <i class="icofont icofont-rounded-down"></i>
                    <i class="icofont icofont-refresh"></i>
                    <i class="icofont icofont-close-circled"></i>
                </div>
            </div>
            <div class="card-block">
                <div class="container">

                    <div class="col-sm-8">
                        <div class="validation_errors_alert">

                        </div>
                    </div>
                    <?php
                    foreach ($users as $u) { ?>
                        <!-- <div class="col-sm-8"> -->
                        <?php echo form_open_multipart('admin/starline_update2/' . $u['id']); ?>
                        <br />
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" readonly name="id" required class="form-control"
                                    value="<?php echo $u['id']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Game Time</label>
                            <div class="col-sm-10">
                                <input
                                    data-clocklet="class-name: clocklet-options-1; format: hh:mm A; alignment: center; placement: top;"
                                    name="stime" placeholder="<?php echo $u['s_game_time']; ?>" required
                                    class="form-control" value="<?php echo $u['s_game_time']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Bid Time</label>
                            <div class="col-sm-10">
                                <input
                                    data-clocklet="class-name: clocklet-options-1; format: hh:mm A; alignment: center; placement: top;"
                                    name="btime" placeholder="<?php echo $u['s_game_end_time']; ?>" required
                                    class="form-control" value="<?php echo $u['s_game_end_time']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Game Number</label>
                            <div class="col-sm-10">
                                <input type="text" name="snum" required class="form-control"
                                    value="<?php echo $u['s_game_number']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label></label>
                            <div class="col-sm-10">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <textarea id="description" style="visibility: hidden;"></textarea>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>

<!-- END PAGE CONTENT-->

<?php include('includes/footer.php') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/clocklet@0.2.6/css/clocklet.min.css">
<script src="https://cdn.jsdelivr.net/npm/clocklet@0.2.6"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Changa|Frank+Ruhl+Libre:500">
<style>
    .clocklet-options-1 {
        font-family: Changa, sans-serif;
        border-radius: 50%;
    }
</style>