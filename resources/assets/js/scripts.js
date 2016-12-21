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

    tinymce.init(window.tinymceConfig);

});