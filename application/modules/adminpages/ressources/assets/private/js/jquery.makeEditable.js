/*
	Group: jquery plugins
*/

(function($){
	/**
	 * MakeEditable plugin for jquery.
	 * @constructor
	 */
	$.fn.makeEditable = function(options) {
        var defaults = {};
		var options = $.extend(defaults, options);

		return this.each(function(){

			var item = $(this);
			var type = item.attr("type");
			var editclass = item.attr("editclass");
			item.removeClass("blankitem");
			// Add block name
			var friendlyName = item.getFriendlyName() ? item.getFriendlyName() : " ";
			
			$(".actions label", item).not('#labelEditAction-'+item.attr('dbid')).text(friendlyName);
			
			// edit label
			$('#labelEditAction-'+item.attr('dbid')).click(function (e) {
				e.preventDefault();
				var html = $(this).html();
				if ( !$('#inputEditAction-'+item.attr('dbid')).length ) {
					// copy text
					var bck	= html;
					// add input text & set focus
					$(this).html('<input id="inputEditAction-'+item.attr('dbid')+'" type="text" value="'+html+'" />');
					$('#inputEditAction-'+item.attr('dbid')).focus();
					//$('#modalBackground').fadeIn();
					
					$('#inputEditAction-'+item.attr('dbid')).blur(function () {
						if (bck != $('#inputEditAction-'+item.attr('dbid')).val()) {
							item.saveInputEditAction();							
						}
						item.closeInputEditAction();
					});
					
					$('#inputEditAction-'+item.attr('dbid')).keypress(function(e) {
					    if(e.keyCode == 13) {
					    	if (bck != $('#inputEditAction-'+item.attr('dbid')).val()) {
					    		item.saveInputEditAction();
					    	}					    	
					    	item.closeInputEditAction();					    						    	
					    }
					});					
					
				}
				
				
				
			});
			
			// Setup Events
			if ($('.actions .notEditable', item).length == 0) {
			    item.unbind('dblclick');
				item.dblclick(function(e){
					e.preventDefault();
					var target = $(this);
				   	if(item.parents(".contentEditor").attr("enabled") == "true" && !target.hasClass("editing")) item.edit();
			    });
			}
			$(".actions a[href='edit']", item).unbind('click');
			$(".actions a[href='edit']", item).click(function(e){
				e.preventDefault();
				var target = $(this).parents("li");
			   	item.edit();
		    });
			$(".actions a[href='delete']", item).unbind('click');
			$(".actions a[href='delete']", item).click(function(e){
				e.preventDefault();
				var target = $(this).parents("li");
				if(confirm("Are you sure you want to delete this item?"))
					item.deleteit();
		    });
			$(".actions a[href='rollback']", item).unbind('click');
			$(".actions a[href='rollback']", item).click(function(e){
				e.preventDefault();
				var target = $(this).parents("li");
				if(confirm("Are you sure you want to delete draft content?"))
					item.rollback();
		    });
			$(".actions a[href='publishdiv']", item).unbind('click');
			$(".actions a[href='publishdiv']", item).click(function(e){
				e.preventDefault();
				var target = $(this).parents("li");
				item.publishdivit();
		    });
			$(".actions a[href='unpublishdiv']", item).unbind('click');
			$(".actions a[href='unpublishdiv']", item).click(function(e){
				e.preventDefault();
				var target = $(this).parents("li");
				item.unpublishdivit();
		    });
			$("#onlinediv-" + item.attr('dbid')).unbind('click');
            $("#onlinediv-" + item.attr('dbid')).click(function(e) {
                e.preventDefault();
                item.toggleonline();
            });
            $("#offlinediv-" + item.attr('dbid')).unbind('click');
            $("#offlinediv-" + item.attr('dbid')).click(function(e) {
                e.preventDefault();
                item.toggleonline();
            });
            $(".actions a[href='workflowstatus']", item).unbind('click');
			$(".actions a[href='workflowstatus']", item).click(function(e){
				e.preventDefault();
				var target = $(this).parents("li");
				item.changewrkstatus();
		    });
			$(".actions a[href='accessrightsstatus']", item).unbind('click');
			$(".actions a[href='accessrightsstatus']", item).click(function(e){
				e.preventDefault();
				var target = $(this).parents("li");
				item.changeaccessrightsstatus();
		    });
			// duplicate content
			$("#duplicatediv-" + item.attr('dbid')).unbind('click');
			$("#duplicatediv-" + item.attr('dbid')).click(function(e) {
                e.preventDefault();
                item.duplicate();
            });
			// share content
			$("#sharediv-" + item.attr('dbid')).unbind('click');
			$("#sharediv-" + item.attr('dbid')).click(function(e) {
				e.preventDefault();
				item.share();
			});

		});
	};
	
	/**
	 * Method: $.fn.getFriendlyName
	 * @constructor
	 */
	$.fn.saveInputEditAction = function(){
		$.post("/adminpages/services/updatelabel/format/json", { dbid: $(this).attr('dbid'), label: $('#inputEditAction-'+$(this).attr('dbid')).val() },
			function(data) {
				$('#ajaxbox').msgbox(data.ResultSet);
			});		
	};
	
	/**
	 * Method: $.fn.getFriendlyName
	 * @constructor
	 */
	$.fn.closeInputEditAction = function(){
		$('#labelEditAction-'+$(this).attr('dbid')).html($('#inputEditAction-'+$(this).attr('dbid')).val());		
	};	
	
	/**
	 * Method: $.fn.getFriendlyName
	 * @constructor
	 */
	$.fn.getFriendlyName = function(){
		o = $(this).eq(0);
		var editclass = o.attr("editclass");
		var type = o.attr("type");
		var friendlyName;

		if(i18n.txt.friendlyNames[editclass]){
			if(i18n.txt.friendlyNames[editclass][type]){
				friendlyName = i18n.txt.friendlyNames[editclass][type];
			}else{
				friendlyName = i18n.txt.friendlyNames[editclass];
			}
		}
		if(typeof friendlyName != "string") friendlyName = false;

		return friendlyName ? friendlyName : false;
	};
	/**
	 * Method: $.fn.deleteit
	 * @memberOf $.fn.makeEditable
	 * @constructor
	 */
	$.fn.deleteit = function(){
//		$.log('makeEditable deleteit');
		return this.each(function(){
			// Delete item
			var item = $(this);
			var contentEditor = item.parents(".contentEditor");
		 	item.remove();
		   	contentEditor.buildAddHere();
		   	
			if (item[0].attributes['dbid']) var dbid = item[0].attributes['dbid'].nodeValue; else var dbid = 0;
			$.post('/adminpages/services/deletediv/format/json/emodule/'+$('#script-eModule').val(), {
											'id': dbid,
											'pagstructureid' : $('#script-pageId').val()
										},
				function(data) {
	    			$('#ajaxbox').msgbox(data.ResultSet);
				}
			);

		});
	};
	
	
	/**
	 * @memberOf $.fn.makeEditable
	 * @constructor
	 */
	$.fn.rollback = function(){
//		$.log('makeEditable rollback');
		return this.each(function(){
			// rollback item
			var item = $(this);
			if (item[0].attributes['dbid']) var dbid = item[0].attributes['dbid'].nodeValue; else var dbid = 0;
			$.post('/adminpages/services/rollbackdiv/format/json/emodule/'+emodule, { 'id': dbid, 'pagstructureid' : $('#script-pageId').val() },
				function(data) {
				    $.get("/adminpages/services/getdivwitheditor/", {'dbid': data.ResultSet.dbid}, function(data){
				    	item.replaceWith(data);
				    	$("li[dbid="+item.attr('dbid')+"]").makeEditable();
				    });
	    			$('#ajaxbox').msgbox(data.ResultSet);
				},
                'json'
			);
		});
	};
	/**
	 * Publish a draft div
	 * @constructor
	 */
	$.fn.publishdivit = function() {
//		$.log('makeEditable publishdivit');
		return this.each(function(){
			var item = $(this);
			if (item[0].attributes['dbid']) var dbid = item[0].attributes['dbid'].nodeValue; else var dbid = 0;
			$.post('/adminpages/services/publishdiv/format/json/emodule/'+$('#script-eModule').val(), { 'id': dbid, 'pagstructureid' : $('#script-pageId').val() },
				function(data) {
				$.get("/adminpages/services/getdivwitheditor/", {'dbid': data.ResultSet.dbid}, function(data){
				    	item.replaceWith(data);
				    	$("li[dbid="+item.attr('dbid')+"]").makeEditable();
			    });
	    			$('#ajaxbox').msgbox(data.ResultSet);
				},
                'json'
			);
		});
	};
	/**
	 * Unpublish (set as draft) a div
	 * @constructor
	 */
	$.fn.unpublishdivit = function() {
//		$.log('makeEditable unpublishdivit');
		return this.each(function(){
			var item = $(this);
			if (item[0].attributes['dbid']) var dbid = item[0].attributes['dbid'].nodeValue; else var dbid = 0;
			$.post('/adminpages/services/unpublishdiv/format/json/emodule/'+$('#script-eModule').val(), { 'id': dbid, 'pagstructureid' : $('#script-pageId').val() },
				function(data) {
                    $.get("/adminpages/services/getdivwitheditor/", {'dbid': data.ResultSet.dbid}, function(data){
                            item.replaceWith(data);
                            $("li[dbid="+item.attr('dbid')+"]").makeEditable();
                    });
                    $('#ajaxbox').msgbox(data.ResultSet);
				},
                'json'
			);
		});
		
	};
    /**
     * Toggle the online flag for the div
     *
     */
    $.fn.toggleonline = function() {
        //$.log('makeEditable toggleonline');
        return this.each(function(){
            var item = $(this);
            if (item[0].attributes['dbid']) var dbid = item[0].attributes['dbid'].nodeValue; else var dbid = 0;
            $.post('/adminpages/services/toggleonline/format/json/emodule/'+$('#script-eModule').val(), { 'id': dbid, 'pagstructureid' : $('#script-pageId').val() },
                function(data) {
                    $.get("/adminpages/services/getdivwitheditor", {'dbid': data.ResultSet.dbid},
                        function(data) {
                            item.replaceWith(data);
                            $("li[dbid="+item.attr('dbid')+"]").makeEditable();
                        }
                    );
                    $('#ajaxbox').msgbox(data.ResultSet);
                },
                'json'
            );
        });
    };
    
    /**
     * Toggle the online flag for the div
     *
     */
    $.fn.duplicate = function() {
//        $.log('makeEditable duplicate');
        return this.each(function(){
            var item = $(this);
            if (item[0].attributes['dbid']) var dbid = item[0].attributes['dbid'].nodeValue; else var dbid = 0;
            $.post('/adminpages/services/duplicate/format/json/emodule/'+$('#script-eModule').val(), { 'id': dbid, 'pagstructureid' : $('#script-pageId').val() },
                function(data) {
            		var new_dbid	= data.ResultSet.dbid;
                    $.get("/adminpages/services/getdivwitheditor", {'dbid': data.ResultSet.dbid},
                        function(data) {
                            item.after(data);
                            $("li[dbid="+new_dbid+"]").makeEditable();
                        }
                    );
                    $('#ajaxbox').msgbox(data.ResultSet);
                },
                'json'
            );
        });
    };

	/**
	 * Method: $.fn.edit
	 * @memberOf $.fn.makeEditable
	 * @constructor
	 */
	$.fn.edit = function(options) {

		return this.each(function(){
			// Edit item
			var item = $(this);
			var type = item.attr("type");
			var editclass = item.attr("editclass");
			item.insertEditor();
		});
	};
	/**
	 * Method: $.fn.insertEditor
	 * @memberOf $.fn.makeEditable
	 * @constructor
	 */
	$.fn.insertEditor = function(options) {
		return this.each(function(){
			var item = $(this);
			var type = item.attr("type");

            item.data("originalType", type);
            var editclass = item.attr("editclass");
            item.addClass("editing panel panel-content");
            // Hide content
            $(".content", item).css("display", "none");
            // Copy editor from library
            var editor = $("." + editclass, $(".ceUILibrary")).clone(false);
            item.append(editor);
            ceEditors[editclass].setupEditor.apply(item);

		   	
		});
	};
	/**
	 * Method: $.fn.removeEditor
	 * @memberOf $.fn.makeEditable
	 * @constructor
	 */
	$.fn.removeEditor = function(options) {
		var defaults = {};
		var options = $.extend(defaults, options);
		return this.each(function(){
			// Edit item
			var item = $(this);
			item.removeClass("editing");
			item.parents(".contentEditor").enable();
			$(".content", item).css("display", "");
			$(".editor", item).remove();
		});
	};
	/**
	 * Method: $.fn.save
	 * @memberOf $.fn.makeEditable
	 * @constructor
	 */
	$.fn.save = function(options) {
		//$.log('makeEditable save');
		var defaults = {};
		var options = $.extend(defaults, options);

		return this.each(function(){
			// Edit item
			var item = $(this);
			var editclass = item.attr("editclass");
			ceEditors[editclass].save.apply(item);
			if(item){
				item.effect("highlight", {color: "#fffbba"}, 1000);
				item.parents(".contentEditor").buildAddHere();
			}
		});
	};
	/**
	 * Method: $.fn.cancel
	 * @memberOf $.fn.makeEditable
	 * @constructor
	 */
	$.fn.cancel = function(options) {
		var defaults = {};
		var options = $.extend(defaults, options);

		return this.each(function(){
			// Edit item
			var item = $(this);
			item.removeEditor();
			if(item.data("new")){
				item.deleteit();
				return true;
			}
			item.attr("type", item.data("originalType"));
			$(".content", item).show();
		});
	};

})(jQuery);
