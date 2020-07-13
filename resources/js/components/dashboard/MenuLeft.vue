<template>
    <div>
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <router-link tag="img" to="/perfil" :src="usuario.image_profile" class="img-circle" alt="User Image"></router-link>
                </div>
                <div class="pull-left info">
                    <router-link tag="p" to="/perfil"> {{ usuario.empleado.nombre_corto }} </router-link>
                    <router-link to="/perfil"><i class="fa fa-circle text-success"></i> Online</router-link>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" id="form-filtrar-modulos-menu-left" class="sidebar-form" 
                @submit.prevent="filtrarModulos">
                <div class="input-group">
                <input type="text" v-model="filtro_modulo" @keyup="filtrarModulos" class="form-control" placeholder="Filtrar modulo...">
                <span class="input-group-btn">
                        <button type="button" id="search-btn" class="btn btn-flat" @keyup="filtrarModulos">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">NAVEGACIÓN PRINCIPAL</li>
                <router-link tag="li" to="/" exact-active-class="active">
                    <a><i class="fa fa-tachometer-alt blue"></i> <span>Dashboard</span></a>
                </router-link>



                <router-link class="treeview" tag="li" to="/gestor_permisos" active-class="active" v-if="( validarRutasPermitidas(rutas_modulo_gestor_permisos) )">
                    <a>
                        <i class="fas fa-address-card"></i>
                        <span>GESTION PERMISOS</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <router-link tag="li" to="/gestor_permisos/solicitar_permisos" exact-active-class="active" 
                            v-if="( validarRutasPermitidas(['gestor_permisos.solicitar', 'gestor_permisos.administrador']) )">
                            <a><i class="fas fa-edit"></i> Solicitar Permisos</a>
                        </router-link>
                        <router-link tag="li" to="/gestor_permisos/validar_permisos" exact-active-class="active" 
                            v-if="( validarRutasPermitidas(['gestor_permisos.validar', 'gestor_permisos.administrador']) )">
                            <a><i class="fas fa-edit"></i> Validar Permisos</a>
                        </router-link>
                        <router-link tag="li" to="/gestor_permisos/asignar_permisos" exact-active-class="active" 
                            v-if="( validarRutasPermitidas(['gestor_permisos.asignar', 'gestor_permisos.administrador']) )">
                            <a><i class="fas fa-edit"></i> Asignar Permisos</a>
                        </router-link>
                        <router-link tag="li" to="/gestor_permisos/listado_softwares" exact-active-class="active" 
                            v-if="( validarRutasPermitidas(['gestor_permisos.listado_softwares', 'gestor_permisos.administrador']) )">
                            <a><i class="fas fa-chalkboard"></i>Listado Softwares</a>
                        </router-link>
                    </ul>
                </router-link>


                <router-link class="treeview" tag="li" to="/administrar" active-class="active" v-if="( validarRutasPermitidas(['administrar.all']) )">
                    <a>
                        <i class="fas fa-user-shield"></i>
                        <span>Autenticacion</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <router-link tag="li" to="/administrar/empleados" exact-active-class="active" 
                            v-if="( validarRutasPermitidas(['administrar.empleados']) )">
                            <a><i class="fas fa-user-tie"></i> Empleados </a>
                        </router-link>
                        <router-link tag="li" to="/administrar/usuarios" exact-active-class="active" 
                            v-if="( validarRutasPermitidas(['administrar.usuarios']) )">
                            <a><i class="fas fa-users"></i> Usuarios </a>
                        </router-link>
                        <router-link tag="li" to="/administrar/roles" exact-active-class="active" 
                            v-if="( validarRutasPermitidas(['administrar.roles']) )">
                            <a><i class="fas fa-user-tag"></i> Roles </a>
                        </router-link>
                        <router-link tag="li" to="/administrar/permisos" exact-active-class="active" 
                            v-if="( validarRutasPermitidas(['administrar.permisos']) )">
                            <a><i class="fas fa-scroll"></i> Permisos </a>
                        </router-link>
                    </ul>
                </router-link>


                <router-link class="treeview" tag="li" to="/generales/acciones" active-class="active" v-if="( validarRutasPermitidas(['administrador']) )">
                    <a>
                        <i class="fa fa-cog"></i>
                        <span>Generales</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <router-link tag="li" to="/generales/acciones" exact-active-class="active" 
                            v-if="( validarRutasPermitidas(['generales.acciones']) )">
                            <a><i class="fas fa-user-tie"></i> Acciones </a>
                        </router-link>
                        <router-link tag="li" to="/generales/sesiones" exact-active-class="active" 
                            v-if="( validarRutasPermitidas(['generales.sesiones']) )">
                            <a><i class="fas fa-users"></i> Sesiones </a>
                        </router-link>
                    </ul>
                </router-link>


                <li class="hidden">
                    <router-link to="/manual_de_usuario" v-if="(routesAuth.some(data => { return ['all'].includes(data) }))"> 
                        <i class="fa fa-book"></i> <span>Manual de usuario</span>
                    </router-link>
                </li>

                <li><router-link to="/" v-on:click.native="cerraSesion"><i class="fa fa-power-off red"></i> <span>Salir</span></router-link></li>
                <li class="header">LABELS</li>
                <li class="hidden"><router-link to="/"><i class="fa fa-circle-o text-red"></i> <span>Important</span></router-link></li>
                <li class="hidden"><router-link to="/"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></router-link></li>
                <li class="hidden"><router-link to="/"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></router-link></li>
            </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
    </div>
</template>


<script>

import EventBus from '../../EventBus';

export default {
    data: function() {
        return ({
            usuario   : USUARIO,
            routesAuth: USUARIO.rutas,
   
            rutas_modulo_gestor_permisos: [
                'gestor_permisos.administrador',
                'gestor_permisos.solicitar', 
                'gestor_permisos.validar', 
                'gestor_permisos.asignar',
                'gestor_permisos.listado_softwares',
            ],

            filtro_modulo: '',
        })
    },

    watch: {
        'filtro_modulo': function(filtro){
            let filtro_modulos = filtro.toLowerCase().trim().split(',');

            let modulos = document.querySelectorAll('ul.sidebar-menu>li.treeview'); //console.log('modulos:', modulos);

            modulos.forEach((modulo) => {
                let title = modulo.querySelector('a>span').innerText.toLowerCase().trim();  //console.log(title);

                if( this.validarValorDentroDeUnArray(filtro_modulos, title) ) {
                    modulo.classList.remove('hidden');

                    //console.log('if validarValorDentroDeUnArray: ', title, filtro_modulos, this.validarValorDentroDeUnArray(filtro_modulos, title));
                }
                else {
                    modulo.classList.add('hidden');

                    //console.log('else validarValorDentroDeUnArray: ', title, filtro_modulos, this.validarValorDentroDeUnArray(filtro_modulos, title));
                }

                if( filtro === '' ) {
                    modulo.classList.remove('hidden');
                }
            });

            localStorage.setItem('filtro_funciones', filtro);
            //console.log(filtro_modulos);
        },

        'filtro_modulos': function(modulos) {
            console.log(modulos);
        },
    },

    methods: {
        /**
         * Este metodo recibira un parametro de tipo array el cual contendra las rutas permitidas, 
         * esta rutas se validaran si existe al menos una en el array routesAuth, 
         * el cual contiene todas las rutas autorizadas para el usuario.
         * 
         * @param Array rutas_permitidas
         * @return Boolean
         */
        validarRutasPermitidas: function (rutas_permitidas) {
            let rutas = ['all'];
            rutas = rutas.concat(rutas_permitidas);

            if( this.routesAuth.some(ruta => { return rutas.includes(ruta) }) ) {
                return true;
            }

            return false;
        },

        /**
         * Este metodo emite el evento 'cerrarSesion' el cual sera escuchado por el componente padre.
         * 
         * @return void
         */
        cerraSesion: function(){
            EventBus.$emit('cerrarSesion');
        },

        /** 
        Este metodo filtra los modulos por busqueda en el menu desplegable izquierdo
        
        @return void
        */
        filtrarModulos: function() {
            return true;
        },

        validarValorDentroDeUnArray: function(array, valor) {
            //array.includes('dashboard') ? null : array.push('dashboard');
            //array.includes('salir')     ? null : array.push('salir');

            let validacion = array.some(data => {
                data = data.trim();

                if( data !== '' && valor.includes(data) ){
                    return true;
                }
            });

            return validacion;
        },
    },
    mounted: function() {
        console.log('Componente menu-left mounted');
        console.log(USUARIO.rutas);

        this.filtro_modulo = localStorage.getItem('filtro_funciones') || '';

        EventBus.$on('asignarValorInputFiltroModuloDelMenuLeft', valor => {
            this.filtro_modulo = valor
        });

        //document.getElementById('form-filtrar-modulos-menu-left').addEventListener('submit', function(e){ e.preventDefault() }, false);
    }
}
</script>


<style>

ul.sidebar-menu > li.active > a, 
ul.sidebar-menu > li > a:hover,
ul.treeview-menu > li.active > a,
ul.treeview-menu > li > a:hover {
  background-color: #010066 !important;
}


ul.treeview-menu > li {
    overflow: hidden;
}

</style>
