$(function(){
    $("#tree").fancytree({
        extensions: ["persist", "dnd", "glyph"],
        glyph: {
            map: {
                expanderClosed: "glyphicon glyphicon-plus-sign",
                expanderLazy: "glyphicon glyphicon-plus-sign",
                // expanderLazy: "glyphicon glyphicon-expand",
                expanderOpen: "glyphicon glyphicon-minus-sign",
                // expanderOpen: "glyphicon glyphicon-collapse-down",
                loading: "glyphicon glyphicon-refresh"
                // loading: "icon-spinner icon-spin"
            }
        }
    });
//    $("#sitemap").structureEditor();
//
//    $('li').on('mouseenter', function(e){
//        $(this).find('.adminpages_action_container').css('visibility', 'visible');
//        e.stopPropagation();
//    }).on('mouseleave', function(e){
//        $(this).find('.adminpages_action_container').css('visibility', 'hidden');
//        //e.stopPropagation();
//    });
});