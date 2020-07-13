<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Dashboard
                <small class="hidden">Panel de control</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i>Home</router-link></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">

                    <div id="jump-search">
                        <input type="text" class="form-control" placeholder="Encuentre funciones rápidamente escribiéndolas aquí."
                            v-model="filtro_funciones">

                        <select class="form-control hidden" id="filtro-modulos" v-model="filtro_modulos" multiple>
                            <option v-for="(modulo, indice) in listado_modulos" :key="indice" :value="modulo">
                                {{modulo}}
                            </option>
                        </select>
                    </div>


                    <div class="panel panel-widget" id="item_2">
                        <div class="head-menu-group-x panel-heading widget-heading">
                            <span> ENTES DE CONTROL </span>
                            <span class="group-header-indicator pull-right fas fa-minus" data-close="0"></span>
                        </div>
                        <div class="panel-body">
                            <div class="icon-container-body">

                                <div class="item">
                                    <router-link class="icon-file_manager" to="/entes_control/listado_informes"> <img :src="iconos.gestor_permisos.solicitar_permisos" class="img-item-panel"> </router-link>
                                    <router-link class="itemTextWrapper" to="/entes_control/listado_informes"> LISTADO DE INFORMES </router-link>
                                </div>
                                <div class="item">
                                    <router-link class="icon-file_manager" to="/entes_control/crear_informe"> <img :src="iconos.gestor_permisos.asignar_permisos" class="img-item-panel"> </router-link>
                                    <router-link class="itemTextWrapper" to="/entes_control/crear_informe"> CREAR INFORME </router-link>
                                </div>
                                <div class="item">
                                    <router-link class="icon-file_manager" to="/entes_control/cargar_evidencias/"> <img :src="iconos.gestor_permisos.validar_permisos" class="img-item-panel"> </router-link>
                                    <router-link class="itemTextWrapper" to="/entes_control/cargar_evidencias/"> CARGAR EVIDENCIAS </router-link>
                                </div>
                                <div class="item">
                                    <router-link class="icon-file_manager" to="/entes_control/configuracion_general/"> <img :src="iconos.gestor_permisos.configuracion_entes_dependencias" class="img-item-panel"> </router-link>
                                    <router-link class="itemTextWrapper" to="/entes_control/configuracion_general/"> CONFIGURACIÓN GENERAL </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</template>


<script>

import EventBus from '../../EventBus';

export default {
    data: function(){
        return({
            iconos: {

                gestor_permisos: {
                    solicitar_permisos: '/images/dashboard/gestor_permisos/solicitar_permisos.png',
                    validar_permisos: '/images/dashboard/gestor_permisos/validar_permisos_colaborador.png',
                    asignar_permisos: '/images/dashboard/gestor_permisos/asignar_permisos_colaboradores.png',
                    registrar_software: '/images/dashboard/gestor_permisos/agregar_software.png',
                    configuracion_entes_dependencias: '/images/dashboard/gestor_permisos/configuracion-entes.png'
                },

                generales: {
                    acciones: '/images/dashboard/generales/acciones.png',
                    sesiones: '/images/dashboard/generales/sesiones.png',
                },

            },

            filtro_funciones: '',
            filtro_modulos  : [],
            listado_modulos : [],
        })
    },

    watch: {
        'filtro_funciones': function(filtro){
            let filtro_modulos = filtro.toLowerCase().trim().split(',');

            let modulos = document.querySelectorAll('.panel.panel-widget'); //console.log(modulos);

            modulos.forEach((modulo) => {
                let title = modulo.querySelector('span').innerText.toLowerCase(); ////console.log(title, filtro);

                if( this.validarValorDentroDeUnArray(filtro_modulos, title) ) {
                    modulo.classList.remove('hidden');

                    modulo.querySelectorAll('.item').forEach((funcion) => {
                        funcion.classList.remove('hidden');
                    });
                    //console.log('if validarValorDentroDeUnArray: ', title, filtro_modulos, this.validarValorDentroDeUnArray(filtro_modulos, title));
                }
                else {
                    let fn_filtradas = 0;
                    let funciones    = modulo.querySelectorAll('.item');

                    funciones.forEach((funcion) => {
                        let nombre = funcion.querySelector('.itemTextWrapper').innerText.toLowerCase();

                        if( this.validarValorDentroDeUnArray(filtro_modulos, nombre) ) {
                            fn_filtradas += 1;
                            funcion.classList.remove('hidden');
                        }
                        else {
                            funcion.classList.add('hidden');
                        }

                        ////console.log(fn_filtradas, filtro_modulos, nombre, filtro_modulos.includes(nombre));
                    });

                    fn_filtradas === 0 ? modulo.classList.add('hidden') : modulo.classList.remove('hidden');

                    ////console.log('else validarValorDentroDeUnArray: ', title, filtro_modulos, this.validarValorDentroDeUnArray(filtro_modulos, title));
                }

                if( filtro === '' ) {
                    modulo.classList.remove('hidden');

                    modulo.querySelectorAll('.item').forEach((funcion) => {
                        funcion.classList.remove('hidden');
                    });
                }

                EventBus.$emit('asignarValorInputFiltroModuloDelMenuLeft', filtro);
            });

            localStorage.setItem('filtro_funciones', filtro);
            //console.log(filtro_modulos);
        },

        'filtro_modulos': function(modulos) {
            console.log(modulos);
        },
    },

    methods: {


        escucharBotonesOcultarMostrarPanel: function() {
            let me = this;

            document.querySelectorAll('.group-header-indicator')
            .forEach((e) => {
                e.addEventListener('click', function(){
                    close = parseInt(this.dataset.close);  console.log(close);

                    if( close ) {
                        this.parentNode.parentNode.childNodes[2].classList.remove('hidden');
                        this.classList.remove('fa-plus');
                        this.classList.add('fa-minus');
                    }
                    else {
                        this.parentNode.parentNode.childNodes[2].classList.add('hidden');
                        this.classList.remove('fa-minus');
                        this.classList.add('fa-plus');
                    }

                    this.dataset.close = close ? '0' : '1';

                    me.guardarDatosVisibilidadModulos();
                }, false);
            });
        },

        setDatosVisibilidadModulos: function() {
            let me    = this;
            let datos = localStorage.getItem('modulos_dashboard');

            datos = datos ? datos.split(',') : {};  //console.log(typeof(datos), datos);

            if( datos.length ){
                document.querySelectorAll('.group-header-indicator')
                .forEach((e, i) => {
                    let close = parseInt(datos[i]);

                    if( close ) {
                        e.parentNode.parentNode.childNodes[2].classList.add('hidden');
                        e.classList.remove('fa-minus');
                        e.classList.add('fa-plus');
                    }

                    e.dataset.close = close;
                });
            }
        },

        guardarDatosVisibilidadModulos: function() {
            let me    = this;
            let datos = [];

            document.querySelectorAll('.group-header-indicator')
            .forEach((e) => {
                datos.push(e.dataset.close);
            });

            localStorage.setItem('modulos_dashboard', datos);  console.log(datos);
        },

        validarValorDentroDeUnArray: function(array, valor) {

            if( valor === 'cumpleaños' ){ console.log(array, valor); }

            let validacion = array.some(data => {
                data = data.trim();

                if( data !== '' && valor.includes(data) ){
                    return true;
                }
            });

            //console.log(validacion);
            return validacion;
        },
    },
    mounted: function(){
        this.escucharBotonesOcultarMostrarPanel();
        this.setDatosVisibilidadModulos();

        this.filtro_funciones = localStorage.getItem('filtro_funciones') || '';
    }
}
</script>


<style>
.section-header{
    padding: 20px 15px 10px 15px;
}

.group-header-indicator {
    cursor: pointer;
    padding: 13px 20px;
    margin-top: -11px;
    margin-left: -16;
}

#jump-search {
    margin-bottom: 15px;
}

</style>
