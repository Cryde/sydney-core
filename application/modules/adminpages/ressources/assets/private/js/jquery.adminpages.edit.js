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
        ANTIDOT.Registry.smartEditor = $(".contentEditor").smartEditor();
    }
})
