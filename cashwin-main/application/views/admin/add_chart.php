<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">

    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <center>
                    <div style="color:green; ">
                        <h5>
                            <?php echo $this->session->flashdata('success'); ?>
                        </h5>
                    </div>
                </center>
                <div class="row" style="padding-bottom: 7px;">

                    <div class="col-md-6">
                        <h5 class="font-strong mb-4">ADD CHART</h5>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <?php echo form_open_multipart('admin/chart_add'); ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Chart Name</label>
                    <div class="col-sm-10">

                        <select class="form-control" name="chart">
                            <?php print_r($charts);
                            foreach ($charts as $c) {
                                ?>
                                <option value="<?php echo $c['name']; ?>"><?php echo $c['name']; ?></option>
                            <?php }
                            ?>
                        </select>

                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                        <input type="date" name="date" value="<?php echo $transaction['date'] ?>" class="form-control"
                            placeholder="Enter Date">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Value</label>

                    <div class="col-sm-3">
                        <input type="number" oninput="sum1()" id="snum"
                            value="<?php echo $transaction['starting_num'] ?>" name="snum" max="999"
                            class="form-control" placeholder="Starting Number">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="num" id="number" max="99"
                            value="<?php echo $transaction['result_num'] ?>" class="form-control" placeholder="Number">
                    </div>
                    <div class="col-sm-3">
                        <input type="number" oninput="sum1()" value="<?php echo $transaction['end_num'] ?>" id="enum"
                            name="enum" max="999" class="form-control" placeholder="End Number">

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
                <textarea id="description" style="visibility: hidden;"></textarea>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
<script>
    function sum1() {
        var sum = 0;
        var sum1 = 0;
        var n = "";
        var n1 = ""
        var a = parseInt(document.getElementById("snum").value);
        var en = parseInt(document.getElementById("enum").value);
        var b = document.getElementById("number");
        while (a) {
            sum += a % 10;
            a = Math.floor(a / 10);
        }
        var res = sum % 10;
        var n = res.toString();
        while (en) {
            sum1 += en % 10;
            en = Math.floor(en / 10);
        }
        var res1 = sum1 % 10;
        var n1 = res1.toString();
        if (n1 == 0) {
            n1 = "";
        }
        if (n == 0) {
            n = "";
        }
        b.value = n + n1;

        //console.log(res);
    }

</script>
<?php include('includes/footer.php') ?>