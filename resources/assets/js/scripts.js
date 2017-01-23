$(function () {
    'use strict';

    /*
     navigation toggle set cookies
     */
    $('#slidebar-toggle-button').click(function (e) {
        $.cookie('administration-navigation-collapsed', !$('body').hasClass('sidebar-collapse'), {
            expires: 777,
            path: "/"
        });
    });

    if (typeof window.tinymceConfig == 'undefined') {
        window.tinymceConfig = {}; //само на вътрешните страници се генерира конфигурацията на tinymce - в layouts.master
    }
    tinymce.init(window.tinymceConfig);

    /*
     jQuery confirm default settings
     */
    jconfirm.defaults = {
        theme: 'supervan',
        columnClass: 'col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',
    }

});