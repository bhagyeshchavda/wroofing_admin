jQuery(document).ready(function ($) {
    $(".form-ajax").validate({
        rules: {
            name: "required",
            password: {
                required: true,
                minlength: 6
            },
            city: "required",
            gender: "required"

        },
        messages: {
            name: "This field is required",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            city: "Please enter your city",
            gender: "This field is required"
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(element.parents('.form-group'));
            }
            else { // This is the default behavior 
                error.insertAfter(element);
            }
        },
    });

    $('body').on('submit', '.form-ajax', function (event) {
        if (event.isDefaultPrevented()) {
            return false;
        }
        event.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        var btnsubmit = form.find("button[type=submit]");
        var currentIcon = btnsubmit.find('i').attr('class');
        var currentText = btnsubmit.html();
        var submitSuccess = form.data('success');

        btnsubmit.find('i').attr('class', 'fa fa-spinner fa-spin');
        btnsubmit.prop("disabled", true);

        if (btnsubmit.data('loading-text')) {
            btnsubmit.html('<i class="fa fa-spinner fa-spin"></i> ' + btnsubmit.data('loading-text'));
        }

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            dataType: 'json',
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (response) {

            show_message(response);

            if (submitSuccess) {
                eval(submitSuccess)(form, response);
            }

            if (response.data.redirect) {
                setTimeout(function () {
                    window.location = response.data.redirect;
                }, 1000);
                return false;
            }

            btnsubmit.find('i').attr('class', currentIcon);
            btnsubmit.prop("disabled", false);

            if (btnsubmit.data('loading-text')) {
                btnsubmit.html(currentText);
            }

            if (response.status === false) {
                return false;
            }

            return false;
        }).fail(function (response) {
            btnsubmit.find('i').attr('class', currentIcon);
            btnsubmit.prop("disabled", false);

            if (btnsubmit.data('loading-text')) {
                btnsubmit.html(currentText);
            }

            show_message(response);
            return false;
        });
    });
    /* GENERATE POST / PAGE SLUG */
    function reload_data(form) {
        var dataTable = $('#categoriesdatatable').DataTable();
        $('#form-add input[type="text"], #form-add textarea').val(null);
        $('#form-add #parent_id').val(null).trigger('change.select2');
        dataTable.draw();
        setTimeout(function(){
            $("#jquery-message").html('');
        }, 2000);
    }
    function ajaxRequest(url, data = null, options = {}) {
        let jqxhr = $.ajax({
            type: options.method || 'POST',
            url: url,
            dataType: options.dataType || 'json',
            data: data,
            cache: false,
            async: typeof options.async !== 'undefined' ? options.async : true,
        });

        jqxhr.done(function (response) {
            if (options.callback || false) {
                options.callback(response);
            }
        });

        jqxhr.fail(function (response) {
            if (options.failCallback || false) {
                options.failCallback(response);
            }
        });

        return jqxhr.responseJSON;
    }
    let bodyElement = $('body');

    bodyElement.on('change', '.show_on_front-change', function () {
        let showOnFront = $(this).val();

        if (showOnFront == 'posts') {
            $('.select-show_on_front').prop('disabled', true);
        }

        if (showOnFront == 'page') {
            $('.select-show_on_front').prop('disabled', false);
        }
    });

    bodyElement.on('click', '.cancel-button', function () {
        window.location = "";
    });

    bodyElement.on('change', '.generate-slug', function () {
        let title = $(this).val();

        ajaxRequest(APP_URL+'admin/load-data/generateSlug', {
            title: title
        }, {
            method: 'GET',
            callback: function (response) {
                $('input[name=slug]').val(response.slug).trigger('change');
            }
        });
    });

    bodyElement.on('click', '.slug-edit', function () {
        let slugInput = $(this).closest('.input-group').find('input:first');
        slugInput.prop('readonly', !slugInput.prop('readonly'));
    });

    bodyElement.on('click', '.close-message', function () {
        let id = $(this).data('id');
        ajaxRequest('/remove-message', {
            id: id,
        }, {
            method: 'POST',
            callback: function (response) {

            }
        });
    });

    /* START SEO CONTENT CHECK */
    $("body").on('click', '.custom-seo', function () {
        let item = $(this);
        let title = $('input[name=title]').val();
        if($("textarea").hasClass("cms-content-editor") == true){
            var description = tinyMCE.activeEditor.getContent();
        }else{
            var description = '';
        }

        if ($("#meta_title").val() && $("#meta_description").val()) {
            item.hide('slow');
            $(".box-custom-seo").show('slow');
            return false;
        }

        let csrf_token = jQuery("input[name='_token']").val();

        $.ajax({
            type: 'POST',
            url: APP_URL+'admin/ajax/SeoContent',
            dataType: 'json',
            data: {
                'title': title,
                'description': description,
                "_token": csrf_token,
            }
        }).done(function (data) {

            if (data.status === false) {
                show_message(data);
                return false;
            }

            if (!$("#meta_title").val()) {
                $("#meta_title").val(data.title);
            }

            if (!$("#meta_description").val()) {
                $("#meta_description").val(data.description);
            }

            if (!$("#meta_title").val()) {
                $(".review-title").text(data.title);
            }

            if (!$("#meta_description").val()) {
                $(".review-description").text(data.description);
            }

            if ($("#meta_description").val()) {
                $("#review-description").val(data.description);
            }

            item.hide('slow');
            $(".box-custom-seo").show('slow');
            return false;
        }).fail(function (data) {
            show_message(data);
            return false;
        });
    });

    $("#meta_title, #meta_description, #meta_url").on('change', function () {
        let title = $('#meta_title').val();
        let description = $('#meta_description').val();
        let csrf_token = jQuery("input[name='_token']").val();

        $.ajax({
            type: 'POST',
            url: APP_URL+'admin/ajax/SeoContent',
            dataType: 'json',
            data: {
                'title': title,
                'description': description,
                "_token": csrf_token,
            }
        }).done(function (data) {

            if (data.status === false) {
                show_message(data.message);
                return false;
            }

            $(".review-title").text(data.title);
            $(".review-description").text(data.description);
            //$(".review-url span").text(data.slug);
            //if (!$("#meta_url").val()) $("#meta_url").val(data.slug);
            return false;
        }).fail(function (data) {
            show_message(data);
            return false;
        });
    });

    $('form').on('change', 'input[name=slug]', function () {
        let slug = $(this).val();
        $(".review-url span").text(slug);
    });

    $("input[name=title], textarea[name=content]").on('change', function () {

        let csrf_token = jQuery("input[name='_token']").val();
        let title = $('input[name=title]').val();

        if($("textarea").hasClass("cms-content-editor") == true){
            var description = tinyMCE.activeEditor.getContent();
        }else{
            var description = '';
        }

        $.ajax({
            type: 'POST',
            url: APP_URL+'admin/ajax/SeoContent',
            dataType: 'json',
            data: {
                'title': title,
                'description': description,
                "_token": csrf_token,
            }
        }).done(function (data) {

            if (data.status === false) {
                show_message(data);
                return false;
            }

            if (!$("#meta_title").val()) {
                $(".review-title").text(data.title);
            }

            if (!$("#meta_description").val()) {
                $(".review-description").text(data.description);
            }

            return false;
        }).fail(function (data) {
            show_message(data);
            return false;
        });
    });
    /* END SEO CONTENT CHECK */
    let current_slug = jQuery('input[name=slug]').val();
    $('form').on('change', 'input[name=slug]', function () {
        let csrf_token = jQuery("input[name='_token']").val();
        let edit_slug = jQuery('input[name=slug]').val();
        let editPageReq = jQuery(this).hasClass('edit-slug');

        if(editPageReq == true){
            $.ajax({
                type: 'POST',
                url: APP_URL+'/admin/ajax/checkSlugAvai',
                dataType: 'json',
                data: {
                    'slug': edit_slug,
                    'current_slug': current_slug,
                    "_token": csrf_token,
                }
            }).done(function (data) {
                if (data.success == false) {
                    $("input[name=slug]").val('');
                    $("input[name=slug]").val(data.slug);
                }
                return false;
            }).fail(function (data) {
                show_message(data);
                return false;
            });
        } 
    });
});