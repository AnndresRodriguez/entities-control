<template>
    <div id="mod-agregar-usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledbi="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="col-xs-10">
                        <h3 class="titulo_modal">AGREGAR USUARIO</h3>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                </div>

                <div class="modal-body">
                    <div id="modal2" class="col-xs-12">

                        <form class="form-group" action="php/msproyectos.php" method="POST" id="form-add-usuario" @submit.prevent="saveUsuario">

                            <div class="mg-top-mod">
                            </div>

                            <label class="col-xs-12 labelpanel"> EMPLEADO </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <select class="form-control" id="usuario-empleado" required></select>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> ROL </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <select class="form-control" id="usuario-role" required></select>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> USUARIO </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <input class="form-control" type="text" v-model="usuario.username" required>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> PASSWORD </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon btn_primary"> <i class="fas fa-lock"></i> </div>
                                        <input class="form-control" :type="type_password" name="password" v-model="usuario.password" required>
                                        <div class="input-group-addon btn_primary" :class="type_password == 'password' ? '' : 'disabled'" @click="changeTypeInputPassword"> 
                                            <i class="fas fa-eye"></i> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> JEFE INMEDIATO </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <select class="form-control" id="usuario-jefe-inmediato"></select>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> CORREO </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <input class="form-control" type="email" name="correo" v-model="usuario.email" required>
                                </div>
                            </div>

                            <div class="col-xs-12" id="msg-errors">
                                <b v-if="msgerror"> <img :src="msgerror.img" style="width: 25px"> {{ msgerror.mensaje }} </b>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> GUARDAR USUARIO
                                    </button>
                                </div>
                            </div>      

                        </form>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-rigth" data-dismiss="modal">CERRAR</button>
                </div>

            </div>
        </div>
    </div>
</template>


<script>

import EventBus from '../../../../EventBus';

/**** SCRIPT PARA LOGRAR EL FOCUS EN LA VENTANA MODAL ****/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};

export default {
    data: function() {
        return({
            usuario: {
                empleado_id: '',
                role_id    : '',
                username   : '',
                password   : '',
                email      : '@gmail.com',

                jefe_inmediato_id: null,
            },

            type_password: 'password',

            select2_empleados: true,

            select2_roles: true,

            select2_jefes: true,

            msgerror: {}
        })
    },

    methods:{

        /**
         * Este metodo permite cargar los empleados por medio de dos palabras
         * 
         * @return Array
         */
        cargarSelect2Empleados: function() {
            if( this.select2_empleados )
            {
                let me = this;

                setTimeout(() => {
                    $('select#usuario-empleado').select2({
                        theme: 'bootstrap',
                        language: "es",
                        ajax: {
                            url: '/empleados/select2',
                            dataType: 'JSON',
                            delay: 50,
                            data: function (params) {
                                return {
                                    search: params.term, // search term
                                };
                            },
                            processResults: function (response) {  //console.log(response.codigos);
                                return {
                                    results: response.empleados
                                };
                            },
                            cache: true
                        },
                        minimumInputLength: 2,
                        templateResult: function (data){
                            if( typeof data.id !== 'undefined' && data.id !== '' ) {
                                var markup = `${data.documento} - ${data.nombres} ${data.apellidos}`;
                                return markup;
                            }
                            else{
                                return 'Buscando...';
                            }
                        }, // omitted for brevity, see the source of this page
                        templateSelection: function (data){
                            if( typeof data.id !== 'undefined' && data.id !== '' ) {
                                me.usuario.empleado_id = data.id;
                                me.usuario.username    = data.documento;

                                return `${data.documento} - ${data.nombres} ${data.apellidos}`;
                            }
                            else{
                                me.usuario.empleado_id = '';

                                return 'Seleccione un empleado';
                            }
                        } // omitted for brevity, see the source of this page
                    })

                    me.select2_empleados = false;  
                }, 500);
            }   
        },

        /**
         * Este metodo permite cargar los roles por medio de dos palabras para un usuario
         * 
         * @return Array
         */
        cargarSelect2Roles: function() {
            if( this.select2_roles )
            {
                let me = this;

                setTimeout(() => {
                    $('select#usuario-role').select2({
                        theme: 'bootstrap',
                        language: "es",
                        ajax: {
                            url: '/roles/select2',
                            dataType: 'JSON',
                            delay: 50,
                            data: function (params) {
                                return {
                                    search: params.term, // search term
                                };
                            },
                            processResults: function (response) {  //console.log(response.codigos);
                                return {
                                    results: response.roles
                                };
                            },
                            cache: true
                        },
                        minimumInputLength: 2,
                        templateResult: function (data){
                            if( typeof data.id !== 'undefined' && data.id !== '' ) {
                                var markup = data.nombre;
                                return markup;
                            }
                            else{
                                return 'Buscando...';
                            }
                        }, // omitted for brevity, see the source of this page
                        templateSelection: function (data){
                            if( typeof data.id !== 'undefined' && data.id !== '' ) {
                                me.usuario.role_id = data.id;

                                return data.nombre;
                            }
                            else{
                                me.usuario.role_id = '';

                                return 'Seleccione un rol';
                            }
                        } // omitted for brevity, see the source of this page
                    })

                    me.select2_roles = false;  
                }, 500);
            }   
        },

        /**
         * Este metodo permite cargar los usuarios por medio de dos palabras
         * 
         * @return Array
         */
        cargarSelect2Jefes: function() {
            if( this.select2_jefes )
            {
                let me = this;

                setTimeout(() => {
                    $('select#usuario-jefe-inmediato').select2({
                        theme: 'bootstrap',
                        language: "es",
                        ajax: {
                            url: '/usuarios/select2',
                            dataType: 'JSON',
                            delay: 50,
                            data: function (params) {
                                return {
                                    search: params.term, // search term
                                };
                            },
                            processResults: function (response) {  //console.log(response.codigos);
                                return {
                                    results: response.empleados
                                };
                            },
                            cache: true
                        },
                        minimumInputLength: 2,
                        templateResult: function (data){
                            if( typeof data.id !== 'undefined' && data.id !== '' ) {
                                var markup = `${data.empleado.documento} - ${data.empleado.nombres} ${data.empleado.apellidos}`;
                                return markup;
                            }
                            else{
                                return 'Buscando...';
                            }
                        }, // omitted for brevity, see the source of this page
                        templateSelection: function (data){
                            if( typeof data.id !== 'undefined' && data.id !== '' ) {
                                me.usuario.jefe_inmediato_id = data.id;

                                return `${data.empleado.documento} - ${data.empleado.nombres} ${data.empleado.apellidos}`
                            }
                            else{
                                me.usuario.jefe_inmediato_id = null;

                                return 'Seleccione un jefe inmediato';
                            }
                        } // omitted for brevity, see the source of this page
                    })

                    me.select2_jefes = false;  
                }, 500);
            }   
        },

        changeTypeInputPassword: function() {
            this.type_password = this.type_password == 'password' ? 'text' : 'password';
        },

        /**
         * Este metodo valida si los campos obligatorios del formulario estan completos.
         * 
         * @return boolean
         */
        validarDatosUsuario: function() {
            let img           = '/img/error.jpg';
            let error         = '';

            let usuario = this.usuario;

            if(usuario.empleado_id === '') {
                error = 'El campo EMPLEADO es obligatorio.';
            }

            if(usuario.role_id === '') {
                error = 'El campo ROLE es obligatorio.';
            }

            if(usuario.username === '') {
                error = 'El campo USUARIO es obligatorio.';
            }

            if(usuario.password === '') {
                error = 'El campo PASSWORD es obligatorio.';
            }

            if(usuario.email === '') {
                error = 'El campo CORREO es obligatorio.';
            }

            if( error ) {
                this.msgerror = {
                    img: img,
                    mensaje: error,
                }

                return false;
            }

            return true;
        },

        /**
         * Este metodo guarda los datos del usuario y registra el nuevo usuario.
         * 
         * @return 
         */
        saveUsuario: function() {
            if( this.validarDatosUsuario() )
            {
                let interceptor = this.setInterceptorInObject('Guardando datos del usuario, espere un momento.', this.msgerror);
                let usuario     = this.usuario;

                axios.post('/usuario/store', usuario)
                .then(response => {
                    if( response.data.success )
                    {
                        this.msgerror = {
                            img: '/img/exitoso.jpg',
                            mensaje: 'El usuario se registro correctamente',
                        };

                        setTimeout(() => {
                            $('div#mod-agregar-usuario').modal('hide');
                            this.vaciarFormulario();
                        }, 2000);

                        EventBus.$emit('recargarPanelUsuarios');
                    }
                })
                .catch(errors => {
                    console.log(errors);

                    this.mostrarErroresHttpAxios(errors);
                })

                axios.interceptors.request.eject(interceptor);
            }
        },

        /**
         * Este metodo vacia el formulario de agregar usuario
         * 
         * @return void
         */
        vaciarFormulario: function() {
            this.usuario = {
                empleado_id: '',
                role_id    : '',
                username   : '',
                password   : '',
                email      : '@gmail.com',
                jefe_inmediato_id: null,
            };

            this.msgerror     = {};

            $('select#usuario-empleado').val(null).trigger('change');
            $('select#usuario-role').val(null).trigger('change');
            $('select#usuario-jefe-inmediato').val(null).trigger('change');
        },

    },
    mounted() {
        console.log('Component mounted.');

        this.cargarSelect2Empleados();

        this.cargarSelect2Roles();

        this.cargarSelect2Jefes();
    }
}
</script>

<style scoped>

.modal-header {
  border-bottom-color: #e5e5e5 !important;
}

.titulo_modal {
    font-weight: bold;
    text-shadow: 1px 1px 1px #bba1a1;
    margin-bottom: 0px;
}

div#msg-trazabilidad {
    margin: 0px 0px 10px 0px;
}

.btn_primary {
    color: #fff;
    background-color: #204d74 !important;
    border-color: #122b40 !important;
}

.disabled {
    color: #000;
    background-color: #7c8186 !important;
    border-color: #122b40 !important;
}

</style>

