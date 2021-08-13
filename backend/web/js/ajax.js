$('document').ready(function () {
    $('.featureCheckBox').change(function () {
        var make_id = $(this).val();
        var featured_type = $(this).attr('attribute');
        $.ajax({
            url: base_url + "/ajax/feature/",
            type: "POST",
            dataType: 'json',
            data: {'make_id': make_id,'featured_type':featured_type},
        }).done(function (response) {

        });

        return false;
    });
});