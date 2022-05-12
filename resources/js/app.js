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

//selziona tutti i button all'interno del form con la classe...
const buttons = document.querySelectorAll('.delete-form [type="submit"]');

buttons.forEach( el => {
    //aggiunge un listener al bottone ascoltando il click e passandogli una funzione con l'evento ascoltato
    el.addEventListener('click', function(e) {
        //disabilitiamo il comportamento di default dell'elemento che riceve questo evento
        e.preventDefault();

        //proprietà all'interno del evento che fa riferimento al elemento stesso
        const btn = e.target;
        //recupero del form
        const form = btn.closest('.delete-form');

        //confirm e tipo alert che apre una finestra di dialogo con l'utente e ritorna true o false
        if(form && confirm('Vuoi eliminare questo post?')){
            //invio del form
            form.submit();
        }
    })
})