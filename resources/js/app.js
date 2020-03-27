require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
});


$(document).ready(function() {
    $('#eula').summernote({
        height: 400,
    });
});
