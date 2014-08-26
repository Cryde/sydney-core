/**
 * Created by mael on 26/08/14.
 */
$(function () {
    $('.uptimfield').click(function (e) {
        e.preventDefault();
        $('#cachetime').val($(this).attr('href'));
    });

    $('#layout').change(function () {
        var valSelect = $(this).val();
        $.ajax({
            url: '/adminpages/services/getpreviewlayout/',
            data: {layoutname: valSelect},
            success: function (data) {
                if (data != null) {
                    $('.previewLayout').html(data);
                }
            }
        });
    });
    $('#layout').change();
});
