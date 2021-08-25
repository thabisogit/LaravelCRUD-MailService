/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
const wrap = $('.wrap');
$( document ).ready(function() {
    wrap.hide();
    let emptyInputs = false;

    $('#createUser').on('click', function () {
        emptyInputs = false;
        $('#errors-div').hide();
        $("#userForm").submit();
    });



        $("#userForm").submit(function(e){

            $('#errors').empty();
            wrap.show();

            $('input[type="text"]').each(function() {
                if ($(this).val() == "") {
                    emptyInputs = true;
                    $('#errors-div').show();
                    $('#errors').append('<li>'+$(this).attr('id')+' field is required</li>');
                    wrap.hide();
                }
            });

            if($("#language").val() === ""){
                emptyInputs = true;
                $('#errors-div').show();
                $('#errors').append('<li>Language field is required</li>');
                wrap.hide();
            }

            if($('#interestsId').val() == 0){
                emptyInputs = true;
                $('#errors-div').show();
                $('#errors').append('<li>Interest field is required</li>');
                wrap.hide();
            }

            if (emptyInputs){
                e.preventDefault();
            }

        });



    $('#dismissModal, .btn-close').on('click', function () {
        $('#interestsModal').modal('hide');
    })
});


