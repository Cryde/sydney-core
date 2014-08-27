/**
 * Created by mael on 26/08/14.
 */
$(function(){
    var pagstructureid = $('#script-pageId').val();
    var emodule = $('#script-eModule').val();

    $(document).ready(function () {
        $(this).Antidot_Contenttabs();
    });

    if($(".contentEditor").length > 0){
       $(".contentEditor").smartEditor();
    }
//    Used for pop windows when mouse is hover a pagediv content
    $('li.panel').popover({
        'placement': 'top',
        'container': 'body',
        'toggle': 'popover',
        'html' : true,
        trigger: 'hover'
    });
    /*
    * 						data-container="body"
     data-toggle="popover"
     data-placement="left"*/
})
