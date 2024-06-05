
function get_message_response(response) {
    // Get response message
    if (response.data) {
        if (response.data.message) {
            return {
                status: response.status,
                message: response.data.message
            };
        }
        return false;
    }

    // Get message validate
    if (response.responseJSON) {
        if (response.responseJSON.errors) {
            let message = '';
            $.each(response.responseJSON.errors, function (index, msg) {
                message = msg[0];
                return false;
            });

            return {
                status: false,
                message: message
            };
        }

        else if (response.responseJSON.message) {
            return {
                status: false,
                message: response.responseJSON.message
            };
        }
    }

    // Get message errors
    if (response.message) {
        return {
            status: false,
            message: response.message.message
        };
    }
}

function show_message(response, append = false) {
    let msg = get_message_response(response);

    let msgHTML = `<div class="alert alert-${msg.status ? 'success' : 'danger'} jw-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="">
            <span aria-hidden="true">&times;</span>
        </button>

        ${msg.status ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>'} ${msg.message}
    </div>`;

    if (append) {
        $('#jquery-message').append(msgHTML);
    } else {
        $('#jquery-message').html(msgHTML);
    }
}


function htmlspecialchars(str) {
    str = String(str);
    return str.replace('&', '&amp;').replace('"', '&quot;').replace("'", '&#039;').replace('<', '&lt;').replace('>', '&gt;');
}

function toggle_global_loading(status, timeout = 500) {
    if (status) {
        $("#admin-overlay").fadeIn(300);
    } else {
        setTimeout(function () {
            $("#admin-overlay").fadeOut(300);
        }, timeout);
    }
}

function replace_template(template, data) {
    return template.replace(
        /{(\w*)}/g,
        function (m, key) {
            return data.hasOwnProperty(key) ? data[key] : "";
        }
    );
}

$(document).ready(function () {
    let urlParams = new URLSearchParams(window.location.search);
    let template = urlParams.get('template');
    let bodyElement = $('body');

    if (template) {
        $('select[name="meta[template]"]').val(template).trigger('change');
    }

    bodyElement.on('click', '.show-form-block', function () {
        let form = $(this).closest('.dd-item').find('.form-block-edit');
        if (form.is(':hidden')) {
            form.show('slow');
        } else {
            form.hide('slow');
        }
    });

    bodyElement.on('click', '.remove-form-block', function () {
        $(this).closest('.dd-item').remove();
    });

    bodyElement.on('change', 'select[name="meta[template]"]', function () {
        let template = $(this).val();
        let currentUrl = window.location.href;
        currentUrl = currentUrl.split("?")[0];
        if (!template) {
            window.location = currentUrl + '?template=notemplate';
            return false;
        }

        window.location = currentUrl + '?template=' + template;
    });

    bodyElement.on('click', '.add-block-data', function () {
        let block = $(this).data('block');
        let contentKey = $(this).data('content_key');
        let item = $(this);
        let template = document.getElementById('block-' + block + '-template').innerHTML;
        let marker = (new Date()).getTime();
        template = replace_template(template, {
            'marker': marker,
            'content_key': contentKey,
        });

        item.closest('.page-block-content').find('.dd-empty').remove();
        item.closest('.page-block-content').find('.dd-list').append(template);

        //initSelect2('#page-block-' + marker);
    });
});

$(document).ready((function () { $(".jw-widget-builder").nestable({ noDragClass: "dd-nodrag", maxDepth: 1 }), $("#widget-container").on("click", ".dropdown-action", (function () { let e = $(this).closest(".widget-block").find(".sidebar-blocks"); e.is(":hidden") ? e.show() : e.hide() })), $("#widget-container").on("submit", ".form-add-widget", (function () { let e = $(this).serialize(), t = $(this).find("button[type=submit]"), a = t.find("i").attr("class"); return t.find("i").attr("class", "fa fa-spinner fa-spin"), t.prop("disabled", !0), ajaxRequest(juzaweb.adminUrl + "/widgets/get-item", e, { method: "GET", callback: function (e) { let n = e.items || []; $.each(n, (function (e, t) { $("#sidebar-" + e + " .jw-widget-builder .dd-empty").remove(), $("#sidebar-" + e + " .dd-list").append(t.html) })), $.each(n, (function (e, t) { initSelect2("#dd-item-" + t.key) })), t.find("i").attr("class", a), t.prop("disabled", !1) }, failCallback: function () { show_message(response), t.find("i").attr("class", a), t.prop("disabled", !1) } }), !1 })), $("#widget-container").on("click", ".widget-sidebar-item", (function () { let e = $(this), t = e.find("input").is(":checked"), a = e.closest(".form-add-widget"), n = a.find("button[type=submit]"); t ? (e.find("span").html(""), e.find("input").prop("checked", !1)) : (e.find("span").html('<i class="fa fa-check"></i>'), e.find("input").prop("checked", !0)), a.find(".widget-sidebar-item input:checked").length > 0 ? n.prop("disabled", !1) : n.prop("disabled", !0) })), $("#widget-container").on("click", ".show-edit-form", (function () { let e = $(this).closest(".sidebar-item").find(".card-body"); e.is(":hidden") ? e.show() : e.hide() })), $("#widget-container").on("click", ".show-item-form", (function () { let e = $(this).closest(".dd-item").find(".form-item-edit"); e.is(":hidden") ? e.show() : e.hide() })), $("#widget-container").on("click", ".delete-item-form", (function () { $(this).closest(".dd-item").remove() })) }));
