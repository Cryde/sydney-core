$(function () {
    // users form ajax setup
    var action = $('#users').attr('action');
    if (action && action.length <= 0) {
        action = '/adminpeople/services/processuser/format/json';
    }
    $('#users').formvalidator({'url': action, 'callbackfunc': function (j) {
        if (j.ResultSet.errors.length == 0 && j.ResultSet.entry.id != null) {
            $('#users #id').val(j.ResultSet.entry.id);
            $('#adcompanybuts').show();
            $('#containerAvatar').show();
            adtopostcompany = { 'users_id': $('#users #id').val() };
            if ($('#script-module').val() != 'publicms' &&  $('#script-controller').val() != 'profile') {
                location.href = '/adminpeople/index/editindex/id/' + j.ResultSet.entry.id;
                }
            }
            } });

            // adcompanybuts
            if ($('#users #id').val() == "") $('#adcompanybuts').hide();

            // launch uploader
            $("#fileUploadBox-adminpeople").fileUpload({'numberOfFiles': 1, 'calledBy': 'adminpeople', 'peopleId': $('#script-id').val()});

            // AVATAR events
            // add
            $('#avatar-add, a.avatar').click(function (event) {
                event.preventDefault()
                $('#box-upload').fadeIn();
                var uploader = $('#uploader').pluploadQueue();
                uploader.refresh();
                //$('#browseButton').click();
                });

            // remove
            $('#avatar-remove').click(function (event) {
                event.preventDefault();
                if (confirm('Are you sure you want to remove your avatar ?')) {
                $('#avatar').attr('src', $('#script-root-cdn').val());
                $.getJSON('/adminpeople/services/removeavatar/format/json', {'userid': $('#users #id').val()}, function (data) {
                $("#ajaxbox").msgbox({'message': data.ResultSet.message, 'showtime': data.ResultSet.showtime, 'modal': data.ResultSet.modal});

            //if (data.ResultSet.status == 1) {
                $('#avatar-add img').attr('src', $('#script-root-cdn').val() + '/sydneyassets/images/ui/bigbutton/icon_add.png');
                $('#avatar-remove').fadeOut();
                //}

            });
            }
            });

            // cancel action
            $('#fileCancel').click(function (event) {
                $('#box-upload').fadeOut();
                return false;
                });

            // pick server file
            $('#browseServerButton').click(function (event) {
                $('#box-upload').fadeOut();

                $('#dialogServerFile').load(
                "/adminfiles/index/index/", {
                'embed': 'yes',
                'context': 'pageeditor',
                'filter': 1,
                'mode': 'thumb'
                },
            function (e, a) {
                // Setup Cancel and Save buttons
                $("p.buttons a[href='save']").click(function (e) {

                    $('.itemselected').each(function () {
                        var elid = $(this).attr('href');

                        $.getJSON('/adminpeople/services/changeavatar/format/json', {'userid': $('#users #id').val(), 'avatarid': elid}, function (data) {
                $("#ajaxbox").msgbox({'message': data.ResultSet.message, 'showtime': data.ResultSet.showtime, 'modal': data.ResultSet.modal});

            //if (data.ResultSet.status == 1) {
                $('#avatar-add img').attr('src', $('#script-root-cdn').val() + '/sydneyassets/images/ui/bigbutton/icon_swap.png');
                $('#avatar-remove').fadeIn();
                $('#avatar').attr('src', '/adminfiles/file/thumb/id/' + elid + '/ts/1/fn/' + elid + '.png');
                $('#dialogServerFile').fadeOut();
                //}

            });
            });

            return false;
            });
            $("p.buttons a[href='save-draft']").hide();
            $("p.buttons a[href='cancel']").click(function (e) {
                $('#dialogServerFile').fadeOut();
                return false;
                });
            }
            );
            $('#dialogServerFile').fadeIn();

            return false;
            });

            });