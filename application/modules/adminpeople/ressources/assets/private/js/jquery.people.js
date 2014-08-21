$(function() {
    var servurl = '/adminpeople/services/displaypeople';

    function ajserach(topost) {
        topost = oPaginator.refreshOpts(topost);
        $('#ajaxbox').msgbox({'message': 'Loading...', 'showtime': 0, 'modal': true});
        $('#peoplelisting').load(servurl, topost, function (e) {
        $('#ajaxbox').msgbox({'message': 'Here you go...', 'showtime': 1, 'modal': false});
        oPaginator.refreshPaginator();
        });
    };

    function augmentdef(o) {
        var d = {};
        $('#fstatus,#fgroup,#searchinput').each(function (e) {
            var pname = $(this).attr('name');
            d[pname] = $(this).val();
            });
        return $.extend(d, o);
    };

    // on search box
    $('#searchinput').attr('name', 'searchstr').attr('title', 'Search on name').bind('keypress', function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
        var o = {'searchstr': $(this).val()};
        ajserach(augmentdef(o));
        };
    });

    // on dropdowns
    $('#fstatus,#fgroup').change(function (e) {
        var o = {};
        var pname = $(this).attr('name');
        o[pname] = $(this).val();
        ajserach(augmentdef(o));
    });

    var oPaginator;
      if($("#peoplelisting").length > 0) {
          oPaginator = $("#peoplelisting").paginator({
            'embeded' : $('#script-embed').val(),
            'context' : $('#script-context').val(),
            'filter' : $('#script-filter').val(),
            'mode' : $('#script-mode').val(),
            'ajaxurl_displayresult' : '/adminpeople/services/displaypeople'
         });
     }
});