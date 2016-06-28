var elixir = require('laravel-elixir'),
    bowerDir  = 'resources/assets/vendor/',
    adminLess  = [
        bowerDir + 'admin-lte/build/less',
        bowerDir + 'bootstrap-datepicker/less',
        bowerDir + 'font-awesome/less'
    ],
    adminCss = [
        'bootstrap/dist/css/bootstrap.min.css',
        'nestable-fork/dist/jquery.nestable.min.css',
        'admin.css',
        'mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css',
        'datatables/media/css/dataTables.bootstrap.min.css',
        'morris.js/morris.css',
        'admin-lte/dist/css/skins/skin-yellow.min.css',
        'chosen/chosen.css',
        'pickadate/lib/themes/default.css',
        'pickadate/lib/themes/default.date.css',
        'pickadate/lib/themes/default.time.css',
        'pickadate/lib/themes/rtl.css'
    ],
    adminJs = [
        'jquery/dist/jquery.min.js',
        'nestable-fork/dist/jquery.nestable.min.js',
        'bootstrap/dist/js/bootstrap.min.js',
        'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        'mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js',
        'datatables/media/js/jquery.dataTables.min.js',
        'datatables/media/js/dataTables.bootstrap.min.js',
        'datatables-buttons/js/dataTables.buttons.js',
        'datatables-buttons/js/buttons.bootstrap.js',
        'morris.js/morris.js',
        'admin-lte/dist/js/app.min.js',
        'chosen/chosen.jquery.js',
        'moment/min/moment.min.js',
        'pickadate/lib/picker.js',
        'pickadate/lib/picker.date.js',
        'pickadate/lib/picker.time.js',
        'pickadate/lib/translations/ar.js'

    ],
    applicationLess  = [
        bowerDir + 'font-awesome/less',
    ],
    applicationCss = [
        'bootstrap/dist/css/bootstrap.min.css',
        'jquery-floating-social-share/dist/jquery.floating-social-share.min.css',
        'application.css',
        'pickadate/lib/themes/default.css',
        'pickadate/lib/themes/default.date.css',
        'pickadate/lib/themes/default.time.css',
        'pickadate/lib/themes/rtl.css',
    ],
    applicationJs = [
        'jquery/dist/jquery.min.js',
        'jquery-floating-social-share/dist/jquery.floating-social-share.min.js',
        'bootstrap/dist/js/bootstrap.min.js',
        'moment/min/moment.min.js',
        'pickadate/lib/picker.js',
        'pickadate/lib/picker.date.js',
        'pickadate/lib/picker.time.js',
        'pickadate/lib/translations/ar.js',
    ];

elixir(function(mix) {
    mix
        .less('admin.less', bowerDir + 'admin.css', { paths: adminLess })
        .styles(adminCss, 'public/css/admin.css', bowerDir)
        .scripts(adminJs, 'public/js/admin.js', bowerDir)
        .sass('admin-buttons.scss', 'public/css/admin-buttons.css')
        .copy('resources/assets/datatables/buttons.server-side.js', 'public/js/buttons.server-side.js')
        .copy('resources/assets/js/admin.js', 'public/js/admin-custom.js')
        .copy(bowerDir + 'raphael/raphael-min.js', 'public/js/raphael.js')
        .copy(bowerDir + 'chosen/chosen-sprite.png', 'public/build/img/chosen-sprite.png')
        .copy(bowerDir + 'chosen/chosen-sprite@2x.png', 'public/build/img/chosen-sprite@2x.png')
        .copy(bowerDir + 'tinymce', 'public/packages/tinymce')
        .copy(bowerDir + 'tinymce-localautosave/localautosave', 'public/packages/tinymce/plugins/localautosave')
        .copy(bowerDir + 'font-awesome/fonts', 'public/build/fonts')
        .copy(bowerDir + 'bootstrap/fonts', 'public/build/fonts')
        .copy(bowerDir + 'mjolnic-bootstrap-colorpicker/dist/img/*', 'public/build/img')
        .less('application.less', bowerDir + 'application.css', { paths: applicationLess })
        .styles(applicationCss, 'public/css/application.css', bowerDir)
        .styles('application.css', 'public/css/style.css')
        .scripts(applicationJs, 'public/js/application.js', bowerDir)
        .copy('resources/assets/js/application.js', 'public/js/script.js')
        .version(['css/admin.css', 'css/application.css', 'js/admin.js', 'js/application.js']);
});
