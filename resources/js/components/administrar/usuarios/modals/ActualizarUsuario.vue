<template>
    <div id="mod-actualizar-usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledbi="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="col-xs-10">
                        <h3 class="titulo_modal">ACTUALIZAR USUARIO</h3>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                </div>

                <div class="modal-body">
                    <div id="modal2" class="col-xs-12">

                        <form class="form-group" action="php/msproyectos.php" method="POST" id="form-actualizar-usuario" @submit.prevent="updateUsuario">

                            <div class="mg-top-mod">
                            </div>

                            <label class="col-xs-12 labelpanel"> EMPLEADO </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <select class="form-control" id="usuario-update-empleado" required>
                                        <option v-for="empleado in listado_empleados" :key="empleado.id" :value="empleado.id">
                                            {{ empleado.documento }} - {{ empleado.nombres }} {{ empleado.apellidos }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> ROL </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <select class="form-control" id="usuario-update-role" required>
                                        <option v-for="role in listado_roles" :key="role.id" :value="role.id">
                                            {{ role.nombre }}
                                        </option>
                                    </select>
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
                                        <input class="form-control" :type="type_password" name="password" v-model="usuario.password">
                                        <div class="input-group-addon btn_primary" :class="type_password == 'password' ? '' : 'disabled'" @click="changeTypeInputPassword"> 
                                            <i class="fas fa-eye"></i> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> JEFE INMEDIATO </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <select class="form-control" id="usuario-update-jefe-inmediato">
                                        <option v-for="jefe in listado_jefes" :key="jefe.id" :value="jefe.id">
                                            {{ jefe.empleado.documento }} - {{ jefe.empleado.nombres }} {{ jefe.empleado.apellidos }}
                                        </option>
                                    </select>
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
                                    <button type="submit" class="btn btn-success form-control">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> ACTUALIZAR USUARIO
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

            listado_empleados: [],

            listado_roles: [],

            listado_jefes: [],

            msgerror: {}
        })
    },

    created: function() {
        EventBus.$on('cargarDatosModalActualizarUsuario', usuario => { 
            this.cargarDatosModalActualizarUsuario(usuario);
        });
    },

    methods:{
        /**
         * Este metodo se encaraga de abrir la ventana modal y asignar los datos recibidos 
         * a la propiedad usuario del objecto data
         * 
         * @param Object usuario
         * @return void
         */
        cargarDatosModalActualizarUsuario: function(usuario) {
            this.vaciarFormulario();

            $('div#mod-actualizar-usuario').modal();
            
            this.usuario = usuario;

            let empleado_id       = this.usuario.empleado_id;
            let role_id           = this.usuario.role_id;
            let jefe_inmediato_id = this.usuario.jefe_inmediato_id;

            $('select#usuario-update-empleado').val(empleado_id).trigger('change'); console.log('empleado_id', empleado_id);
            $('select#usuario-update-role').val(role_id).trigger('change'); console.log('role_id', role_id);
            $('select#usuario-update-jefe-inmediato').val(jefe_inmediato_id).trigger('change'); console.log('jefe_inmediato_id', jefe_inmediato_id);
        },

        /**
         * Este metodo permite cargar los empleados por medio de dos palabras
         * 
         * @return Array
         */
        cargarListadoDeEmpleados: function() {
            axios.get('/empleados')
            .then((response) => {
                let me = this;
                me.listado_empleados = response.data.data;

                $('select#usuario-update-empleado').select2({ 
                    theme: 'bootstrap',
                    templateSelection: function (data){
                        if( typeof data.id !== 'undefined' && data.id !== '' ) {
                            me.usuario.empleado_id = data.id;
                            
                            return data.text;
                        }
                        else{
                            me.usuario.empleado_id = '';

                            return 'Seleccione un empleado';
                        }
                    },
                });
            });
        },

        /**
         * Este metodo permite cargar los roles por medio de dos palabras para un usuario
         * 
         * @return Array
         */
        cargarListadoDeRoles: function() {
            axios.get('/roles')
            .then((response) => {
                let me = this;
                me.listado_roles = response.data.data;

                $('select#usuario-update-role').select2({ 
                    theme: 'bootstrap', 
                    templateSelection: function (data){
                        if( typeof data.id !== 'undefined' && data.id !== '' ) {
                            me.usuario.role_id = data.id;
                            
                            return data.text;
                        }
                        else{
                            me.usuario.role_id = '';

                            return 'Seleccione un role';
                        }
                    },
                });
            });  
        },

        /**
         * Este metodo permite cargar el listado de todos los usuarios en el campo jefe inmediato.
         * 
         * @return Array
         */
        cargarListadoDeJefes: function() {
            axios.get('/usuarios')
            .then((response) => {
                let me = this;
                me.listado_jefes = response.data.data;

                $('select#usuario-update-jefe-inmediato').select2({ 
                    theme: 'bootstrap',
                    templateSelection: function (data){
                        if( typeof data.id !== 'undefined' && data.id !== '' ) {
                            me.usuario.jefe_inmediato_id = data.id;
                            
                            return data.text;
                        }
                        else{
                            me.usuario.jefe_inmediato_id = null;

                            return 'Seleccione un jefe inmediato';
                        }
                    },
                });
            });
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
        updateUsuario: function() {
            if( this.validarDatosUsuario() )
            {
                let interceptor = this.setInterceptorInObject('Actualizando datos del usuario, espere un momento.', this.msgerror);

                let usuario = this.usuario;

                axios.post('/usuario/update_all', usuario)
                .then(response => {
                    if( response.data.success )
                    {
                        this.msgerror = {
                            img: '/img/exitoso.jpg',
                            mensaje: 'El usuario se actualizo correctamente',
                        };

                        setTimeout(() => {
                            $('div#mod-actualizar-usuario').modal('hide');
                            this.vaciarFormulario();
                        }, 1000);

                        EventBus.$emit('recargarPanelUsuarios');
                    }
                })
                .catch(errors => {
                    console.log(errors);

                    typeof(errors.response) != 'undefined' ? this.mostrarErroresHTTP(errors.response.data) : true;
                })

                this.mostrarErroresHttpAxios(errors);
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

            $('select#usuario-update-empleado').val(null).trigger('change');
            $('select#usuario-update-role').val(null).trigger('change');
            $('select#usuario-update-jefe-inmediato').val(null).trigger('change');
        },

    },
    mounted() {
        console.log('Component mounted.');

        this.cargarListadoDeEmpleados();

        this.cargarListadoDeRoles();

        this.cargarListadoDeJefes();
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

