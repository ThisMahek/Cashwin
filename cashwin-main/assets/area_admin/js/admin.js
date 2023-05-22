$(function() {
	$( "#update_profile_setting" ).click(function() {
		$("#update_profile_setting_callback").html("<img  src='../../../assets/images/loader.gif'/>");
			$.post(admin_sitepath+"listing/update_profile_settings", $( "#profile_setting_form" ).serialize(),function( data ) {
				
				$("#update_profile_setting_callback").html(data);
			});			
			
		});
	$( "#update_location_setting" ).click(function() {		
		$("#update_location_setting_callback").html("<img  src='../../../assets/images/loader.gif'/>");
		$.post( admin_sitepath+"listing/update_profile_settings", $( "#location_setting_form" ).serialize(),function( data ) {
	
			$("#update_location_setting_callback").html(data);
		});		
		
	});
	/*update business setting*/
	$( "#update_business_setting" ).click(function() {	
		$("#update_business_setting_callback").html("<img  src='../../../assets/images/loader.gif'/>");
		$.post(admin_sitepath+"listing/update_profile_settings?rand="+Math.random(),$( "#business_settings" ).serialize(),function( data ) {			
			$("#update_business_setting_callback").html(data);			
		});		
		
	});
	

});




/*Load albums on page load*/
$( document ).ready(function() {
	$.post( "area_admin/media/get_album",function( data ) {
		  $("#all_album").html(data);
		});
	$.post( "media/get_video_album",function( data ) {
		  $("#video_album").html(data);
		});
	});


/*Saving Categories*/

/*localaity check or uncheck all 
 * @file register locality page
 * */
$('#sel ').click( function() {
	
	$('#select_all option').attr('selected', false);
					
	if($(this).is(':checked')){
		$('#select_all option').attr('selected', 'selected');
		$("#s_txt").html("Unselect All");
	}else{									
    $('#select_all option').attr('selected', false);
    $("#s_txt").html("Select All");
	}
});

//save cat to fields 

$( "#fields_form_btn" ).click(function() {	
	$(".fields_callback").html("<img  src='assets/images/loader.gif'/>");	
	$.post( "servicefields/save", $( "#fields_form" ).serialize(),function( data ) {			
		$(".fields_callback").html(data);			
	});
});

//service fields forms save by form id

	
function save_forms(form_id)
{
	$(".form_callback"+form_id).html("<img  src='../../../assets/images/loader.gif'/>");
	$.post(  admin_sitepath+"listing/service_fields_save", $( "#form"+form_id ).serialize(),function( data ) {			
		$(".form_callback"+form_id).html(data);			
	});
	
}
			
			
/*get subcat multiselect by cat id*/

$("#cat_multi").change(function() {
	var get_catid=this.value;
	$("#sb_cat_callack").html("<img  src='assets/images/loader.gif'/>");
	$.post( "promotion/get_cats",{"cat_id":get_catid} ,function( data ) {			
		$("#sb_cat_callack").html(data);			
	});
});

function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=600');");
}


$( "#update_member_code" ).click(function() {	
	$("#update_member_code_callback").html("<img  src='../../../assets/images/loader.gif'/>");	
	$.post( "membership_code", $( "#membership_refferal" ).serialize(),function( data ) {			
		$("#update_member_code_callback").html(data);			
		
	});
});



$( "#btn-transfer" ).click(function() {
	   var c_txt='';
	$("input[name='select_tr']").each(function(index, value) {
		if($(this).is(":checked")){
			c_txt=c_txt+","+$(this).val();    	
		}
   	});
	$("#get_usr").attr('value',c_txt);
	
	$("#bulk_callback").html("<img  src='../../../assets/images/loader.gif'/>");	
	$.post( admin_sitepath+"listing/bulk_transfer", $( "#form_transfer" ).serialize(),function( data ) {			
		$("#bulk_callback").html(data);			
		
	});
	
	});

/*change sub locality to other if selected*/
$( "#sub_loc" ).change(function() {
	  var get_locality=$(this).val();
	  if(get_locality=="other")
	  {
		  $("#other_subloc").show();
	  }else{
		  $("#other_subloc").hide();
	  }
	}); 
 

/*save banners*/
function save_banner_link(banner_no,banner_id)
{	
		$("#banner"+banner_no+"_callback").html("Saving...");	
		$.post( admin_sitepath+"assign_banner/save_banner_link",
		{'banner_link':$("#banner"+banner_no+"_link").val(),
			'banner_id':banner_id},function( data ) {			
			$("#banner"+banner_no+"_callback").html(data);		
		});
}

/*block ad*/
function block_ad(id)
{
	$("#block_callback"+id).html("blocking...");
	
	$.post( admin_sitepath+"admin_view/block_ad",
			{'block_id':id},function( data ) {				
		
				$("#block_callback"+id).html("");
				$("#unblock_link"+id).show();
				$("#block_link"+id).hide();		
	});
}
/* unblock ad*/
function unblock_ad(id)
{
		
	$.post( admin_sitepath+"admin_view/unblock_ad",
			{'block_id':id},function( data ) {				
		
				$("#unblock_link"+id).hide();
				$("#block_link"+id).show();
				
		
		
	});
}

/*update ad form */
/*update business setting*/
$( "#ad_update" ).click(function() {	
	$("#ad_callback").html("<img  src='../../../assets/images/loader.gif'/>");
	$.post(admin_sitepath+"admin_view/update_ad?rand="+Math.random(),$( "#ad_form" ).serialize(),function( data ) {			
		$("#ad_callback").html(data);			
	});		
	
});
/*get sub category for ads select*/
$("#main_cat").change(function() {
	var get_catid=this.value;
	
	$("#subcat_select").html("<img  src='../assets/images/loader.gif'/>");
	$.post( admin_sitepath+"lead/get_subcategory",{"cat_id":get_catid} ,function( data ) {
		$("#subcat_select").html(data);			
	});
});

/* Category seletion and edit code */
/*Select Category*/
$( document ).ready(function() {
$("#category_select").change(function() {		
	var get_id=$(this).val();	
	//create an element inside cat_container
	var create_box="catbox"+get_id;
		
	//check if container is already shown
	if($('#'+create_box).length >0)
	{
		$("#"+create_box).html("<img  src='assets/images/loader.gif'/>");	
		$.post( admin_sitepath+"listing/get_categories",{"cat_id":get_id,"business_id":$("#business_id").val()},function( data ) {		
			  $("#"+create_box).html(data);
			})
	}else{
		$("#cat_container").append("<div id='"+create_box+"'></div>");
		$("#"+create_box).html("<img  src='assets/images/loader.gif'/>");	
		$.post( admin_sitepath+"listing/get_categories",{"cat_id":get_id,"business_id":$("#business_id").val()},function( data ) {		
			  $("#"+create_box).html(data);
			})
	}
	  
	});
});

/*save forms cateogry cat_save*/
$( "#cat_save" ).click(function() {	
	$("#cat_save_callback").html("<img  src='assets/images/loader.gif'/>");	
	$( "#cat_container form" ).each(function(index) {		
			//get form id this.id;
			$.post(admin_sitepath+"listing/save_forms_cat",$("#"+this.id).serialize(),function( data ) {								
				$("#cat_save_callback").html("<div class='alert alert-success'>Your category preferences have been saved !</div>");
			})
		});
});
     
/*Saving Categories*/

/*get user saved Categories*/
$( document ).ready(function() {
	$("#cat_container").html("<img  src='assets/images/loader.gif'/>");
	$.post( admin_sitepath+"listing/get_all_cats",{"business_id":$("#business_id").val()},function( data ) {
		  $("#cat_container").html(data);		  
		})	
});

function remove_cat(form_id)
{	
	$.post(admin_sitepath+"listing/remove_cat",{"forms_id":form_id,"business_id":$("#business_id").val()},function( data ) {
		$("#form_id"+form_id).slideUp(400, function() {
			$("#form_id"+form_id).remove();
		});	  
		})	
}

