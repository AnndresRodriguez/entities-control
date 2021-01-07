
require('./bootstrap');


// Vue
import Vue from 'vue';


// Vue Router
import VueRouter from 'vue-router';
import Toasted from 'vue-toasted';
import { Datetime } from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'

Vue.use(VueRouter);
Vue.use(Datetime);
Vue.use(Toasted, { iconPack: 'fontawesome'});

import routes from './routes'

const router = new VueRouter({ mode: 'history', routes });


Vue.component('menu-left', require('./components/dashboard/MenuLeft.vue').default);

Vue.component('button-scroll-top-cero', require('./components/ButtonScrollTopCero.vue').default);


// EventBus
import EventBus from './EventBus';


// Store Vuex
import store from './state';


// Mixins
import auth from './mixins/auth';
Vue.mixin(auth);

import axiosMixins from './mixins/axiosMixins';
Vue.mixin(axiosMixins);


const app = new Vue({
    el: '#app',
    router,
    data: {
        token: document.getElementsByName('_token')[0].value,
    },
    created: function(){
        EventBus.$on('cerrarSesion', () => { this.logout() })
    },
    methods: {
        verificarSiExisteUnaSessionActiva: function() {
            let self = this;

            setInterval(function(){
                self.validarSesionActivaUsuario();
            }, 300000);

            window.addEventListener('focus', function(){
                self.validarSesionActivaUsuario();
            });
        },

        validarSesionActivaUsuario: function() {
            axios.get('/usuario/sesion')
            .then(response => {
                if( !response.data.success && typeof(USUARIO) === 'object' ) this.logout();
            })
            .catch(errors => {
                console.log(errors);
                //window.location = '/login';
            });
        },

        logout: function(){
            Swal({
                title: 'Cerrando sesión',
                allowEscapeKey: false,
                allowOutsideClick: false,
                timer: 2000,
                onOpen: () => {
                    Swal.showLoading();
                }
            });

            $('form#logout-app').submit();
        }
    },
    mounted: function() {
        this.verificarSiExisteUnaSessionActiva();
        store.commit('increment');
    }

});



