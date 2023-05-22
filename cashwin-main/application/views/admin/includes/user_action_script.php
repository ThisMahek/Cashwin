<?php
    $ajax_url = site_url('admin/view_users'); //current_url()
?>
<script>
    function activate(id) {
        if(confirm('Are you sure to activate this user ?')){
            //AJAX method: Activate
            window.location.href = "<?php echo site_url('admin/view_users')?>/activate/"+id;
        } else {
           event.preventDefault();
        }
    }
    
    function deactivate(id) {
        if(confirm('Are you sure to deactivate this user ?')){
            //AJAX method: Deactivate
            window.location.href = "<?php echo site_url('admin/view_users')?>/deactivate/"+id;
        } else {
           event.preventDefault(); 
        }
    }
    function userbank_allow(id) {
        if(confirm('Are you sure to allow deposit, withdraw and add bank account permission ?')){
            //AJAX method: Activate
            window.location.href = "<?php echo site_url('admin/view_users')?>/userbank_allow/"+id;
        } else {
           event.preventDefault();
        }
    }
    
    function userbank_block(id) {
        if(confirm('Are you sure to block deposit, withdraw and add bank account permission ?')){
            //AJAX method: Deactivate
            window.location.href = "<?php echo site_url('admin/view_users')?>/userbank_block/"+id;
        } else {
           event.preventDefault(); 
        }
    }
    function update_user(id) {
        alert(id);
         if(confirm('Are you sure to block deposit, withdraw and add bank account permission ?')){
            //AJAX method: Deactivate
            window.location.href = "<?php echo site_url('admin/view_users')?>/update_user/"+id;
        } else {
          event.preventDefault(); 
        }
    }
</script>