
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('lightbox2/dist/js/lightbox.js');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('like-button', require('./components/LikeButton.vue').default);
Vue.component('photo-upload', require('./components/PhotoUpload.vue').default);

const app = new Vue({
    el: '#app'
});



$(function(){

    $('.bootstrap-tabs .nav-link').on('click', function(e){
        var target = $(this).attr('href');
        $(this).parent('li').siblings('li').children('a').removeClass('active');
        $(this).addClass('active');

        $(target).siblings('.card-body').addClass('collapse');
        $(target).removeClass('collapse');
    });

});
