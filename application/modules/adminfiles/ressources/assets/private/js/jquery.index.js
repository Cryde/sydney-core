/**
 * Specific to the Controller IndexAction
 */

$(function(){
    if ($('#script-id').val() > 0) {

        if ($("#fileEdit").length > 0) {
            $("#filesBrowse").hide();

            $("#fileEdit").filemanager( {
                'embeded': $('#script-embed').val(),
                'context': $('#script-context').val(),
                'filter': $('#script-filter').val(),
                'mode': $('#script-mode').val(),
                'id': $('#script-id').val()
            });
        }
    } else {
        if($("#filelisting").length > 0)
            $("#filelisting").filemanager( {
                'embeded': $('#script-embed').val(),
                'context': $('#script-context').val(),
                'filter': $('#script-filter').val(),
                'mode': $('#script-mode').val(),
                'id': $('#script-id').val(),
                'q': $('#script-query').val()
            });
    }

});