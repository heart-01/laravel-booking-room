const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/front/main/jquery-3.3.1.slim.min.js', 'public/js/front/main')
    .js('resources/js/front/main/popper.min.js', 'public/js/front/main')
    .js('resources/js/front/main/bootstrap.min.js', 'public/js/front/main')
    .js('resources/js/front/main/main.js', 'public/js/front/main')

    .js('resources/js/front/books/index.js', 'public/js/front/books')
    .js('resources/js/front/books/page_room.js', 'public/js/front/books')
    .js('resources/js/front/books/page_info.js', 'public/js/front/books')
    .js('resources/js/front/books/page_detail.js', 'public/js/front/books')

    .js('resources/js/front/historyBook/index.js', 'public/js/front/historyBook')
    .js('resources/js/front/historyBook/displayUpdate.js', 'public/js/front/historyBook')

    .js('resources/js/admin/dashboard.js', 'public/js/admin')
    .js('resources/js/admin/historyBook/index.js', 'public/js/admin/historyBook')
    .js('resources/js/admin/historyBook/displayUpdate.js', 'public/js/admin/historyBook')

    .js('resources/js/admin/question/modal.js', 'public/js/admin/question')
    .js('resources/js/admin/questionPrototype/modal.js', 'public/js/admin/questionPrototype')

    .js('resources/js/admin/semesters/semesters.js', 'public/js/admin/semesters')
    .js('resources/js/admin/semesters/semesters_data-row.js', 'public/js/admin/semesters')
    .js('resources/js/admin/semesters/semesters_modal.js', 'public/js/admin/semesters')
    
    .js('resources/js/admin/classrooms/classrooms.js', 'public/js/admin/classrooms')
    .js('resources/js/admin/classrooms/classrooms_data-row.js', 'public/js/admin/classrooms')
    .js('resources/js/admin/classrooms/classrooms_modal.js', 'public/js/admin/classrooms')

    .js('resources/js/admin/classrooms_support/classrooms_support.js', 'public/js/admin/classrooms_support')
    .js('resources/js/admin/classrooms_support/classrooms_support_data-row.js', 'public/js/admin/classrooms_support')
    .js('resources/js/admin/classrooms_support/classrooms_support_modal.js', 'public/js/admin/classrooms_support')

    .js('resources/js/admin/softwares/softwares.js', 'public/js/admin/softwares')
    .js('resources/js/admin/softwares/softwares_data-row.js', 'public/js/admin/softwares')
    .js('resources/js/admin/softwares/softwares_modal.js', 'public/js/admin/softwares')
    
    .sass('resources/sass/app.scss', 'public/css');