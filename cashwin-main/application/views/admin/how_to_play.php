<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<div class="content-wrapper">

    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <div class="row" style="padding-bottom: 7px;">
                    <div class="col-md-6">
                        <h5 class="font-strong mb-4">How to Play</h5>
                    </div>

                </div>
                <?php echo form_open_multipart(''); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>How To Play Content</label>
                            <!--<input type="text" name="how_to_play" class="form-control" value="<?= $setting->how_to_play ?>" required="required">-->
                            <textarea rows="4" cols="50" class="form-control"
                                name="how_to_play"><?= $setting->how_to_play ?></textarea>
                            <!--<textarea id="summernote" name="how_to_play"  class="form-control"><?= $setting->how_to_play ?></textarea>-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Video Link</label>
                            <input type="text" name="video_link" class="form-control"
                                value="<?= $setting->video_link ?>" required="required">
                        </div>
                    </div>





                </div>

            </div>
            <div class="ibox-footer">
                <button type="submit" name="submitw" class="btn btn-primary">Update</button>
                <!-- <button class="btn btn-outline-secondary" type="reset">Cancel</button> -->
            </div>
            </form>

        </div>





    </div>




</div>
<!-- END PAGE CONTENT-->
<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            toolbar: [

                // This is a Custom Button in a new Toolbar Area
                ['custom', ['examplePlugin']],

                // You can also add Interaction to an existing Toolbar Area
                ['style', ['style', 'examplePlugin']]
            ]
        });
    });
</script>
<?php include('includes/footer.php') ?>