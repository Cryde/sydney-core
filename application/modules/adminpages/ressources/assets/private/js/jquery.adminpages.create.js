/**
 * Created by mael on 26/08/14.
 */
$(function () {

    var lastValLabelUrl = ''; // Pour connaitre la derniere valeur du champs url
    if ($('input#url').length > 0) {

        /*
         Permet de gérer le cas si l'url est vide.
         Dans ce cas on autocomplete l'url en se basant sur
         le label de la page (titre de la page)
         */
        $('input#label').keyup(function () {
            // on met à jour l'url
            var $this = $(this),
                value = $this.val();

            $.ajax({
                dataType: "json",
                url: '/adminpages/services/getcleanlabelpage/',
                data: {label: value},
                success: function (data) {
                    if (lastValLabelUrl == $('input#url').val() || $.trim($('input#url').val()) == '') {
                        $('input#url').val(data.cleanLabel);
                    }
                    lastValLabelUrl = data.cleanLabel;
                }
            });

        });
        /*
         Lorsqu'on quitte le input de l'url
         on recalcule pour être sur qu'il n'y pas
         de caractères non autorisé
         */
        $('input#url').blur(function () {
            var $this = $(this),
                value = $this.val();
            if ($.trim(value) == '') {
                value = $.trim($('input#label').val());
            }
            $.ajax({
                dataType: "json",
                url: '/adminpages/services/getcleanlabelpage/',
                data: {label: value},
                success: function (data) {
                    $('input#url').val(data.cleanLabel);
                }
            });
        });
    }
});