function delete_album_photo(e) {
    var t = confirm("Are you sure !\n you want to delete the photo?");
    1 == t && $.post("media/delete_album_photo", {
        del_id: e
    }, function() {
        $("#album_photo_callback" + e).fadeOut("slow")
    })
}

function delete_album_video(e) {
    var t = confirm("Are you sure !\n you want to delete the video?");
    1 == t && $.post("media/delete_album_video", {
        del_id: e
    }, function() {
        $("#album_video_callback" + e).fadeOut("slow")
    })
}

function remove_cat(e) {
    $.post("category/remove_cat", {
        forms_id: e
    }, function() {
        $("#form_id" + e).slideUp(400, function() {
            $("#form_id" + e).remove()
        })
    })
}

function save_forms(e) {
    $(".form_callback" + e).html("<img  src='assets/images/loader.gif'/>"), $.post("servicefields/save", $("#form" + e).serialize(), function(t) {
        $(".form_callback" + e).html(t)
    })
}

function popUp(URL) {
    day = new Date, id = day.getTime(), eval("page" + id + " = window.open(URL, '" + id + "', 'directories=0,titlebar=0,toolbar=0,location=0,scrollbars=0,location=0,status=yes,statusbar=0,menubar=0,resizable=0,width=400,height=350');")
}

function get_vendor_discount(e) {
    $("#vendors_list").html("<img  src='assets/images/loader.gif'/>"), $.post("vendor_discount/get_vendors", {
        sub_id: e
    }, function(e) {
        $("#vendors_list").html(e)
    })
}

function get_vendor_discount_main(e) {
    $("#vendors_list").html("<img  src='assets/images/loader.gif'/>"), $.post("vendor_discount/get_vendors", {
        cat_id: e
    }, function(e) {
        $("#vendors_list").html(e)
    })
}
$(function() {
    $("#update_profile_setting").click(function() {
        $("#update_profile_setting_callback").html("<img  src='../assets/images/loader.gif'/>"), $.post("update_profile_settings", $("#profile_setting_form").serialize(), function(e) {
            $("#update_profile_setting_callback").html(e)
        })
    }), $("#update_location_setting").click(function() {
        $("#update_location_setting_callback").html("<img  src='../assets/images/loader.gif'/>"), $.post("update_profile_settings", $("#location_setting_form").serialize(), function(e) {
            $("#update_location_setting_callback").html(e)
        })
    }), $("#update_business_setting").click(function() {
        $("#update_business_setting_callback").html("<img  src='../assets/images/loader.gif'/>"), $.post("update_profile_settings", $("#business_settings").serialize(), function(e) {
            $("#update_business_setting_callback").html(e)
        })
    })
}), $(document).ready(function() {
    $.post("media/get_album", function(e) {
        $("#all_album").html(e)
    }), $.post("media/get_video_album", function(e) {
        $("#video_album").html(e)
    }), $.post("media/get_product_album", function(e) {
        $("#all_product").html(e)
    })
}), $(document).ready(function() {
    $("#category_select").change(function() {
        var e = $(this).val(),
            t = "catbox" + e;
        $("#" + t).length > 0 ? ($("#" + t).html("<img  src='assets/images/loader.gif'/>"), $.post("category/get_categories", {
            cat_id: e
        }, function(e) {
            $("#" + t).html(e)
        })) : ($("#cat_container").append("<div id='" + t + "'></div>"), $("#" + t).html("<img  src='assets/images/loader.gif'/>"), $.post("category/get_categories", {
            cat_id: e
        }, function(e) {
            $("#" + t).html(e)
        }))
    })
}), $("#cat_save").click(function() {
    $("#cat_save_callback").html("<img  src='assets/images/loader.gif'/>"), $("#cat_container form").each(function() {
        $.post("category/save_forms_cat", $("#" + this.id).serialize(), function() {
            $("#cat_save_callback").html("<div class='alert alert-success'>Your category preferences have been saved !</div>")
        })
    })
}), $(document).ready(function() {
    $("#cat_container").html("<img  src='assets/images/loader.gif'/>"), $.post("category/get_all_cats", function(e) {
        $("#cat_container").html(e)
    })
}), $("#sel ").click(function() {
    $("#select_all option").attr("selected", !1), $(this).is(":checked") ? ($("#select_all option").attr("selected", "selected"), $("#s_txt").html("Unselect All")) : ($("#select_all option").attr("selected", !1), $("#s_txt").html("Select All"))
}), $("#fields_form_btn").click(function() {
    $(".fields_callback").html("<img  src='assets/images/loader.gif'/>"), $.post("servicefields/save", $("#fields_form").serialize(), function(e) {
        $(".fields_callback").html(e)
    })
}), $("#cat_multi").change(function() {
    var e = this.value;
    $("#sb_cat_callack").html("<img  src='assets/images/loader.gif'/>"), $.post(site_url + "promotion/get_cats", {
        cat_id: e
    }, function(e) {
        $("#sb_cat_callack").html(e)
    })
}), $("#update_member_code").click(function() {
    $("#update_member_code_callback").html("<img  src='../assets/images/loader.gif'/>"), $.post("membership_code", $("#membership_refferal").serialize(), function(e) {
        $("#update_member_code_callback").html(e)
    })
}), $("#category_select").change(function() {
    var e = this.value;
    $("#subcat_select").html("<img  src='../assets/images/loader.gif'/>"), $.post(site_url + "lead/get_subcategory", {
        cat_id: e
    }, function(e) {
        $("#subcat_select").html(e)
    })
}), $("#lead_select").change(function() {
    var e = this.value;
    $("#subcat_select").html("<img  src='../assets/images/loader.gif'/>"), $.post("lead/get_subcategory", {
        cat_id: e
    }, function(e) {
        $("#subcat_select").html(e)
    })
}), $("#sub_loc").change(function() {
    var e = $(this).val();
    "other" == e ? $("#other_subloc").show() : $("#other_subloc").hide()
}), $("#cat_id").change(function() {
    var e = this.value;
    $("#subcat_select").html("<img  src='../assets/images/loader.gif'/>"), $.post("lead/get_subcategory", {
        cat_id: e
    }, function(e) {
        $("#subcat_select").html(e)
    })
}), $("#submit_requirement").click(function() {
    $("#requirement_callback").html("<img  src='assets/images/loader.gif'/>"), $.post("inquiry/submit_requirement", $("#requirement_form").serialize(), function(e) {
        $("#requirement_callback").html(e)
    })
}), $("#btn-vendor-list").click(function() {
    $("#vendors_list").html("<img  src='assets/images/loader.gif'/>"), $.post("vendor_discount/get_vendors", $("#vendor-list-form").serialize(), function(e) {
        $("#vendors_list").html(e)
    })
}), $("#ad_update").click(function() {
    $("#ad_callback").html("<img  src='../../assets/images/loader.gif'/>"), $.post(site_url + "create_ad/update_ad", $("#ad_form").serialize(), function(e) {
        $("#ad_callback").html(e)
    })
}), $("#payment_login").click(function() {
    $("#payment_login_callback").html("<img  src='" + site_url + "assets/images/loader.gif'/>");
    var e = $("#signin_mobile").val(),
        t = $("#signin_pass").val();
    $.post(site_url + "ad_create2/login", {
        mobile: e,
        password: t
    }, function(t) {
        t == e ? ($("#collapseTwo").attr("class", "panel-collapse collapse"), $("#collapseThree").attr("class", "panel-collapse collapse in"), $("#collapseThree").css({
            height: "auto"
        }), $("#payment_login_callback").html(""), $("#cart_sign_out").show(), $("#sign_username").html(e), $("#collapseTwo").remove()) : $("#payment_login_callback").html(t)
    })
}), $("#sign_up_toggle").click(function() {
    $("#form_sign_up").toggle("slow", function() {})
}), $("#edit_order").click(function() {
    $("#edit_order").slideUp()
}), $("#select_template").click(function() {
    "none" == $("#cart_price").val() ? ($("#tem_error").slideDown(), $("#cart_price").focus(), $("#order_summary").html("")) : "1" == $("#check_tem_sess").val() ? ($("#tem_error").slideUp(), $("#collapseOne").attr("class", "panel-collapse collapse"), $("#collapseThree").attr("class", "panel-collapse collapse in"), $("#collapseThree").css({
        height: "auto"
    }), $("#order_summary").html($("#cart_price :selected").text()), $("#edit_order").show()) : ($("#tem_error").slideUp(), $("#collapseOne").attr("class", "panel-collapse collapse"), $("#collapseTwo").attr("class", "panel-collapse collapse in"), $("#collapseTwo").css({
        height: "auto"
    }), $("#order_summary").html($("#cart_price :selected").text()), $("#edit_order").show())
}), $("#proceed_to_pay").click(function() {
    $("#proceed_to_pay_callback").html("<img  src='" + site_url + "assets/images/loader.gif'/>"), $.post("ad_create2/check_login", function(e) {
        $("#proceed_to_pay_callback").html(""), "1" == e ? $.post("ad_create2/redirect_to_payment", $("#final_payment_form").serialize(), function(e) {
            $("#proceed_to_pay_callback").html("invalid_template" == e ? "<b class='alert alert-danger'>Error : Invalid ad template !</b>" : e)
        }) : $("#login_reg_section").slideDown()
    })
}), $("#proceed_to_pay_btn").click(function() {
    $("#proceed_to_pay_btn_callback").html("<img  src='" + site_url + "assets/images/loader.gif'/>"), $.post(site_url + "subscribe/check_login", function(e) {
        $("#proceed_to_pay_btn_callback").html(""), "1" == e ? $.post(site_url + "subscribe/redirect_to_payment", $("#final_payment_form").serialize(), function(e) {
            $("#proceed_to_pay_btn_callback").html("invalid_plan" == e ? "<b class='alert alert-danger'>Error : Invalid Plan !</b>" : e)
        }) : $("#login_reg_section").slideDown()
    })
}), $("#proceed_to_pay_reg_btn").click(function() {
    $("#proceed_to_pay_reg_btn_callback").html("<img  src='" + site_url + "assets/images/loader.gif'/>"), $.post(site_url + "subscribe/redirect_to_reg_payment", $("#final_payment_form").serialize(), function(e) {
        $("#proceed_to_pay_reg_btn_callback").html(e)
    })
}), $("#btn-reg").click(function() {
    $(".login_callback").html("<img  src='" + site_url + "assets/images/loader.gif'/>"), $.post(site_url + "user_reg/register", $("#user_reg").serialize(), function(e) {
        "otp_sent" == e ? ($(".login_callback").html(""), $("#register_form_div").slideUp(), $("#otp_form_div").slideDown()) : $(".login_callback").html(e)
    })
}), $("#otp-reg").click(function() {
    $(".otp_callback").show(), $(".otp_callback").html("<img  src='" + site_url + "assets/images/loader.gif'/>"), $.post(site_url + "user_reg/otp", $("#otp_form_reg").serialize(), function(e) {
        $(".otp_callback").html(e)
    })
}), $("#go_back_freebie").click(function() {
    $("#otp_form_div").slideUp(), $(".otp_callback").hide(), $("#register_form_div").slideDown()
}), $("#freebie_login_btn").click(function() {
    $(".otp_callback").hide(), $("#otp_login_form").slideDown(), $("#otp_login_form").attr("style", "none"), $("#user_reg").slideUp()
}), $("#go_back_freebie1").click(function() {
    $("#otp_login_form").slideUp(), $("#user_reg").slideDown()    
}),
$("#otp-login-btn").click(function() {
    $(".freebie_login_callback").html("<img  src='" + site_url + "assets/images/loader.gif'/>"), $.post(site_url + "user_reg/login", $("#otp_login_form").serialize(), function(e) {
        $(".freebie_login_callback").html(e)
    })
}), $("#get_otp_btn").click(function() {
    $(".get_otp_callback").html("<img  src='" + site_url + "assets/images/loader.gif'/>"), $.post(site_url + "user_reg/get_otp", {
        otp_no: $("#otp_mob").val()
    }, function(e) {
        $(".get_otp_callback").html(e)
    })
});
