$('document').ready(function () {
    $('.featureCheckBox').change(function () {
        var make_id = $(this).val();
        $.ajax({
            url: base_url + "/ajax/feature/",
            type: "POST",
            dataType: 'json',
            data: {'make_id': make_id},
        }).done(function (response) {

        });

        return false;
    });
});