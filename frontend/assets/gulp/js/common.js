$('.perform-ajax-call').on('click', function (e) {

    var element_clicked = $(this);

    var url = element_clicked.data('href');
    if(element_clicked.data('ref') != undefined) {
        url = element_clicked.data('ref');
    }

    if(!url) {
        return true;
    }

    var ajax_call_data = {};
    if($(this).data('attribute') != undefined)
        ajax_call_data = $(this).data('attribute')

    $.ajax({
        type: 'POST',
        url: url,
        data: ajax_call_data

    }).done(function (response) {
        ajaxCallSuccessActions(element_clicked, response);
    })
})


function ajaxCallSuccessActions(element, response) {
    if (response.hide_model) {
        element.closest(".modal").modal('hide');
    }

    var enable_refresh = element.data('success') == 'refresh';

    var hide_modal = element.data('success') == 'hide-modal';

    var magic_ajax = element.data('magic-ajax');

    if(hide_modal) {
        element.closest('.modal').modal('hide')
    }
    if(enable_refresh){
        window.location.reload();
    }else {
        if(magic_ajax == undefined)
            return;

        if(response.new_content != undefined) {
            $.each(response.new_content, function (key, value) {
                $(key).html(value);
            })
        }

        if(response.add_classes != undefined) {
            $.each(response.add_classes, function (key, value) {
                $(key).addClass(value);
            })
        }

        if(response.remove_classes != undefined) {
            $.each(response.remove_classes, function (key, value) {
                $(key).removeClass(value);
            })
        }

        if(response.change_attributes != undefined) {
            $.each(response.change_attributes, function (key, value) {
                $.each(value, function (attribute, attribute_value) {
                    $(key).attr(attribute, attribute_value)
                })
            })
        }

        if(response.add_data_attribute != undefined) {
            $.each(response.add_data_attribute, function (key, value) {
                $.each(value, function (attribute, attribute_value) {
                    $(key).data(attribute, attribute_value)
                })
            })
        }

    }
}