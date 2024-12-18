(function ($) {
    "use strict";

    $(document).on('change', '.search_feedback_data', function () {
        $("#search_feedback").trigger('submit');
    });

    $(document).on('keypress', '.start_no_space', function (e) {
        if (e.which == 32) {
            return false;
        }
    });
    $(document).on('click', '[data-delete]', function () {
        var ele_sele = $(this).data('delete')
        $(document).find(ele_sele).trigger('submit');
    });
    $(document).on('change', '.my-preview', function () {
        previewSelectedFile(this);
    });
    $('.isUnlimited').on('click', function () {
        let setter = false;
        if ($(this).is(':checked')) {
            setter = true;
        }
        $($(this).data('target')).attr('readonly', setter);
    });

    $('.isUnlimited:checked').each(function (key, element) {
        $($(element).data('target')).attr('readonly', true);
    });
})(jQuery);
function updateCommentApprovalStatus($element) {
    const id = $($element).data('id');
    $("#update_feedback_comment_"+id).trigger('submit');
}
function previewSelectedFile(input) {
    "use strict";
    var previewattr = $(input).data('preview');
    var preview = $(document).find(previewattr)
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        preview.show();
        $(document).find(previewattr + "-default").hide();
    }
}

function check_permission($element) {
    "use strict";
    var checked = $($element).prop('checked');
    var value = $($element).val();

    if (checked) {
        if (value == "add board" || value == "edit board" || value == "delete board") {
            $('#board_show').prop('checked', true);
        }

        if (value == "add category" || value == "edit category" || value == "delete category") {
            $('#category_show').prop('checked', true);
        }

        if (value == "add changelogs" || value == "edit changelogs" || value == "delete changelogs") {
            $('#changelogs_show').prop('checked', true);
        }

        if (value == "add roadmap" || value == "edit roadmap" || value == "delete roadmap") {
            $('#roadmap_show').prop('checked', true);
        }

        if (value == "add feedback" || value == "edit feedback" || value == "delete feedback") {
            $('#feedback_show').prop('checked', true);
        }

        if (value == "add staff" || value == "edit staff" || value == "delete staff") {
            $('#staff_show').prop('checked', true);
        }
    } else {
        if (value == "show board") {
            $('#board_add').prop('checked', false);
            $('#board_edit').prop('checked', false);
            $('#board_delete').prop('checked', false);
        }

        if (value == "show category") {
            $('#category_add').prop('checked', false);
            $('#category_edit').prop('checked', false);
            $('#category_delete').prop('checked', false);
        }

        if (value == "show changelogs") {
            $('#changelogs_add').prop('checked', false);
            $('#changelogs_edit').prop('checked', false);
            $('#changelogs_delete').prop('checked', false);
        }

        if (value == "show roadmap") {
            $('#roadmap_add').prop('checked', false);
            $('#roadmap_edit').prop('checked', false);
            $('#roadmap_delete').prop('checked', false);
        }

        if (value == "show feedback") {
            $('#feedback_add').prop('checked', false);
            $('#feedback_edit').prop('checked', false);
            $('#feedback_delete').prop('checked', false);
        }

        if (value == "show staff") {
            $('#staff_add').prop('checked', false);
            $('#staff_edit').prop('checked', false);
            $('#staff_delete').prop('checked', false);
        }
    }


}

function show_payment_section($element) {
    "use strict";
    $("#offline_payment_section").addClass("d-none");
    $("#stripe_payment_section").addClass("d-none");
    $("#paypal_payment_section").addClass("d-none");
    $("#paytm_payment_section").addClass("d-none");

    let value = $($element).val();

    if (value == "offline") {

        $("#reference").attr('required', true);
        $("#offline_payment_section").removeClass("d-none");

    } else if (value == "paypal") {

        $("#paypal_payment_section").removeClass("d-none");

    } else if (value == "stripe") {

        $("#stripe_payment_section").removeClass("d-none");

    } else if (value == "paytm") {

        $("#paytm_payment_section").removeClass("d-none");

    }
}

function is_default_img($this) {
    "use strict";
    let element = $($this);
    var hide_section = $(element.data("section"));
    var input = $(element.data("input"));
    var image_exist = $($this).data("imageexist");

    if (element.is(':checked')) {
        input.prop('required', false);
        hide_section.addClass('d-none');
    } else {
        if (image_exist == 0) {
            input.prop('required', true);
        }
        hide_section.removeClass('d-none');
    }
}

function createSlug($this) {
    var title = $($this).val();
    if (title != "") {
        var slug = title.toLowerCase().trim().replace(/ /g, '-').replace(/[-]+/g, '-').replace(/[^\w-]+/g, '');
        $("#input-board_slug").val(slug);
    }
}

function show_rightbar_section($element) {
    "use strict";
    let id = $($element).data('id');
    let url = $($element).data('url');
    let action = $($element).data('action');

    $.ajax({
        type: 'GET',
        url: url,
        data: {
            id: id,
            action: action
        },
        success: function (data) {
            if (data != "") {
                $("#system_right_bar_content").html(data);
                $("body").toggleClass("right-bar-enabled");
            }
        }
    });
}

function closeSidebar() {
    "use strict";
    $("body").removeClass("right-bar-enabled");
}

function adminLogout() {
    "use strict";
    $("#admin-logout-form").trigger('submit');
}
function updateRoadmapStatus($element) {
    "use strict";
    const id = $($element).data('id');
    $("#update_feedback_roadmap_" + id).trigger('submit');
}

function updateApprovalStatus($element) {
    "use strict";
    const id = $($element).data('id');
    $("#update_feedback_approval_status_" + id).trigger('submit');
}

function changeDefaultBoard($element){
    "use strict";
    const id = $($element).data('id');
    $("#default_board_" + id).trigger('submit');
}

function recaptcha_enable($element){
    "use strict";
    const value = $($element).val();
    if (value==1){
        $("#enable_captcha_section").removeClass('d-none');
        $("#nocaptcha_secret").attr('required',true);
        $("#nocaptcha_sitekey").attr('required',true);
    }else{
        $("#enable_captcha_section").addClass('d-none');
        $("#nocaptcha_secret").attr('required',false);
        $("#nocaptcha_sitekey").attr('required',false);
    }
}