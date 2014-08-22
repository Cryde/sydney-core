// Convert divs to queue widgets when the DOM is ready
$(function () {
    var inPeople = (typeof $('#script-source').val() != 'undefined' && $('#script-source').val() == 'adminpeople');

    var peopleid = 0;
    if(typeof $('#script-source').val() != 'undefined'
        && $('#script-source').val() == 'adminpeople'
        && typeof $('#script-peopleid').val() != 'undefined'){
            var peopleid = $('#script-peopleid').val();
    }
    var isPublicProfile = ($('#script-module').val() == 'publicms');
    var optionRemember = true;
    var jDialogRemember = false;
    var pluploadFilter = null;
    var urlSearchFile = "/adminfiles/services/searchfile/format/json";
    var urlUploadFile = '/adminfiles/services/uploadfile/';
    var urlFilteType = "/adminfiles/services/getftypes/format/json";
    var urlChangeAvatar = "/adminpeople/services/changeavatar/format/json";
    var urlThumb = "/adminfiles/file/thumb";
    if (isPublicProfile) {
        var urlSearchFile = "/publicms/profile/searchfile/format/json";
        var urlUploadFile = '/publicms/profile/uploadfile/';
        var urlFilteType = "/publicms/profile/getftypes/format/json";
        var urlChangeAvatar = "/publicms/profile/changeavatar/format/json";
        var urlThumb = "/publicms/profile/thumb";
        }
    /**
    *
    * @memberOf $.fn.fileUpload
    */
    function dialogbox(file, uploader) {
        var myuploader = uploader;
        var myfile = file;
        var filename = myfile.name;

        var optionRemember = false;
        var sOptionRemember = optionRemember ? '<p><input id="jDialogRemember" type="checkbox"> <label for="jDialogRemember">Remember decision</label></p>' : '';

        var jDialog = $('<div></div>')
        .html('<p>The file "' + filename + '" already exist on library. Please choose an action...</p>' + sOptionRemember)
        .dialog({
        autoOpen: false,
        title: 'File already existing !',
        buttons: {
        "Rename": function () {

        if ($('#jDialogRemember', this).is(':checked')) {
        jDialogRemember = 'rename';
        }

    myfile.name = renameFile(myfile.name);
    $('#' + myfile.id + ' span').html(myfile.name);
    $(this).dialog("close");
    },
    "Replace": function () {

        if ($('#jDialogRemember', this).is(':checked')) {
        jDialogRemember = 'replace';
        }

    $(this).dialog("close");
    //myuploader.removeFile(myfile);
    },
    "Skip": function () {

        if ($('#jDialogRemember', this).is(':checked')) {
        jDialogRemember = 'skip';
        }

    myuploader.removeFile(myfile);
    $(this).dialog("close");
    }
    },
    modal: true,
    resizable: false
    });
    jDialog.dialog('open');
    };
    /**
    *
    * @memberOf $.fn.fileUpload
    */
    function renameFile(fname) {
        var newDate = new Date;
        return fname.replace(new RegExp("[.](.{2,4})$", "g"), '.' + newDate.getTime() + '.$1');
    };
    /**
    * Checks if the file exist and change style according to that.
    * @memberOf $.fn.fileUpload
    */
    function isFileExists(filename) {
        var returnvalue = false;
        $.ajax({
        url: urlSearchFile,
        global: false,
        type: "POST",
        data: ({'filename': filename}),
    dataType: "json",
    async: false,
    success: function (jsond, r) {
        if (r == 'success') {
        if (jsond.file > 0) {
        returnvalue = jsond.file;
        }
    }
    }
    });
    return returnvalue;
    };
    /**
    *
    */
    $("#uploader").pluploadQueue({
        // General settings
        runtimes: 'html5,flash,html4,silverlight',
        url: urlUploadFile,
        max_file_size: $('#script-max-size').val(),
        chunk_size: '1mb',
        unique_names: true,
        multiple_queues: true,
        rename: true,
        // Resize images on clientside if we can
        // resize : {width : 640, height : 480, quality : 100},
    // Specify what files to browse for
    filters: [
            {title: "Image files", extensions: "jpg,gif,png"},
            {title: "Zip files", extensions: "zip"}
    ],
    // Flash settings
    flash_swf_url: $('#script-root-cdn').val + '/jslibs/jquery/plugins/plupload/Moxie.swf',
    // Silverlight settings
    silverlight_xap_url: $('#script-root-cdn').val + '/jslibs/jquery/plugins/plupload/Moxie.xap',
    /**
    * PreInit events, bound before any internal events
    */
    preinit: {
        Init: function (up, info) {
        var myup = up;
        $.ajax({
        url: urlFilteType,
        global: false,
        type: "POST",
        data: {},
    dataType: "json",
    async: false,
    success: function (jsond, r) {

        if (r == 'success') {
        pluploadFilter = jsond.ftypes;
        }
    }
    });
    var separator = '';
    var strExt = '';
    for (property in pluploadFilter) {
        if (property != 'unknown') {
        strExt = strExt + separator + property.toLowerCase();
        separator = ',';
        }
    //output += property + ': ' + object[property]+'; ';
    }
    pluploadFilter = strExt;
    up.settings.filters = [
                    {title: "Documents", extensions: pluploadFilter}
    ];
    },
    /**
    *
    */
    UploadFile: function (up, file) {

        console.log(up);
        var carids = '';
        $('.categoryPlaceholder input[type=checkbox]:checked').each(function () {
        carids += $(this).val() + ',';
        });
    up.settings.url = urlUploadFile + 'catids/' + carids;
    // You can override settings before the file is uploaded
    // up.settings.url = 'upload.php?id=' + file.id;
    // up.settings.multipart_params = {param1 : 'value1', param2 : 'value2'};
    up.settings.filters = [
                    {title: "Documents", extensions: pluploadFilter}
    ];
    }
    },
    /**
    * Post init events, bound after the internal events
    */
    init: {
    /**
     *
     */
        FilesAdded: function (up, files) {
        var myuploader = this;
        var queue = $('#uploader').pluploadQueue();
        if (inPeople) { // only one file to uplaod
        if (files.length > 1) {
        alert('You can choose only one file as Avatar');
        plupload.each(files, function (file) {
        myuploader.removeFile(file);
        });
    } else { // remove other files from the list, if any
        // queue.splice(0, myuploader.files.length);
        // add in the new choosen file
        // queue.files = files;
        }
    } else {
        // Called when files are added to queue
        jDialogRemember = false;
        plupload.each(files, function (file) {
        if (isFileExists(file.name)) {
        dialogbox(file, myuploader);
        }
    //parentObject.removeFile(file);
    //file.name = Math.random();
    });
    }
    },
    /**
    * Called when a file has finished uploading
    */
    FileUploaded: function (up, file, info) {
        var fileInfos = jQuery.parseJSON(info.response);
        if (inPeople) {
        // adding tag "people" to the avatar file
        $.getJSON(urlChangeAvatar, {'userid': peopleid, 'avatarid': fileInfos.id}, function (data) {
        $('#avatar-add img').attr('src', $('#script-root-cdn').val + '/sydneyassets/images/ui/bigbutton/icon_swap.png');
        $('#avatar-remove').fadeIn();
        $('#avatar').attr('src', urlThumb + '/id/' + fileInfos.id + '/ts/1/fn/' + fileInfos.id + '.png');
        $('#box-upload').fadeOut();
        });
    }
    },
    /**
    * Called when files where removed from queue
    */
    FilesRemoved: function (up, files) {
        },
    /**
    * Called when a file chunk has finished uploading
    */
    ChunkUploaded: function (up, file, info) {
        },
    /**
    * Called when a error has occured
    */
    Error: function (up, args) {
        },
    /**
    * Called when upload shim is moved
    */
    Refresh: function (up) {
        },
    /**
    * Called when the state of the queue is changed
    */
    StateChanged: function (up) {
        },
    /**
    * Called when the files in queue are changed by adding/removing files
    */
    QueueChanged: function (up) {
        },
    /**
    * Called while a file is being uploaded
    */
    UploadProgress: function (up, file) {
        }
    }
    });
    /**
    * Client side form validation
    */
    $('form').submit(function (e) {
        var uploader = $('#uploader').pluploadQueue();
        // Validate number of uploaded files
        if (uploader.total.uploaded == 0) {
        // Files in queue upload them first
        if (uploader.files.length > 0) {
        // When all files are uploaded submit form
        uploader.bind('UploadProgress', function () {
        if (uploader.total.uploaded == uploader.files.length) $('form').submit();
        });
    uploader.start();
    } else {
        alert('You must at least upload one file.');
        }
    e.preventDefault();
    }
    });

    /**
    * category toggle
    */
    $('div.categoryPlaceholder').hide();
    $('a[href=categoryButton]').click(function (e) {
        e.preventDefault();
        $('div.categoryPlaceholder').toggle();
        });

    });