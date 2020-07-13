<template>
    <div id="mod-update-role" class="modal fade" tabindex="-1" role="dialog" aria-labelledbi="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="col-xs-10">
                        <h3 class="titulo_modal">ACTUALIZAR ROL</h3>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                </div>

                <div class="modal-body">
                    <div id="modal2" class="col-xs-12">

                        <form class="form-group" action="php/msproyectos.php" method="POST" id="form-add-role" @submit.prevent="updateRole">

                            <div class="mg-top-mod">
                            </div>

                            <label class="col-xs-12 labelpanel"> NOMBRE </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <input class="form-control" type="text" v-model="role.nombre" required>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> DESCRIPCIÓN </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <textarea class="form-control" rows="5"
                                        v-model="role.descripcion">
                                    </textarea>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> PERMISOS </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <select class="form-control" id="role-update-permisos" multiple required>
                                        <option v-for="permiso in listado_permisos" :key="permiso.id" :value="permiso.id">
                                            {{ permiso.nombre }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12" id="msg-errors">
                                <b v-if="msgerror"> <img :src="msgerror.img" style="width: 25px"> {{ msgerror.mensaje }} </b>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> GUARDAR ROL
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
            role: {
                nombre: '',
                descripcion : '',
                permisos: [],
            },

            listado_permisos: [],

            msgerror: {}
        })
    },

    created: function() {
        EventBus.$on('cargarModalActualizarRole', (role) => this.cargarModalActualizarRole(role));
    },

    methods:{

         /**
         * Este metodo carga el formulario para un nuevo Role
         * 
         * @return void
         */
        cargarModalActualizarRole: function(role) {
            $('div#mod-update-role').modal();

            this.role = role;

            let permisos = this.role.permisos.map((permiso) => { return permiso.id });

            this.role.permisos = permisos;

            $('select#role-update-permisos').val(permisos).trigger('change');   console.log('permisos', permisos);
        },

        /**
         * Este metodo permite agregar varios permisos al agregar un nuevo role.
         * 
         * @return Array
         */
        cargarListadoDePermisos: function() {
            axios.get('/permisos')
            .then((response) => {
                let me = this;
                me.listado_permisos = response.data.data;

                $('select#role-update-permisos').select2({ 
                    theme: 'bootstrap', 
                    closeOnSelect: false,
                    templateSelection: function (data){  console.log(data);
                        if( typeof data.id !== 'undefined' && data.id !== '' ) {
                            if( ! me.role.permisos.includes(data.id) ) {
                                me.role.permisos.push(data.id); 
                            }

                            return data.text;
                        }
                        else{
                            me.role.role_id = '';

                            return 'Seleccione los permisos correspondientes';
                        }
                    },
                });

                $('select#role-update-permisos').on('select2:unselect', function (e) {
                    var id = e.params.data.id;

                    me.role.permisos.splice(me.role.permisos.indexOf(id), 1);
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
         * 
         */
        validarDatosRole: function() {
            let img           = '/img/error.jpg';
            let error         = '';

            let role = this.role;

            if(role.nombre === '') {
                error = 'El campo NOMBRE es obligatorio.';
            }

            if(role.descripcion === '') {
                error = 'El campo DESCRIPCION es obligatorio.';
            }

            if( ! role.permisos.length ) {
                error = 'El campo PERMISOS es obligatorio.';
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
         * Este metodo guarda los datos del role y registra el nuevo role.
         * 
         * @return 
         */
        updateRole: function() {
            if( this.validarDatosRole() )
            {
                let interceptor = axios.interceptors.request.use((config) => {
                    this.msgerror = {
                        img:     '/img/Cargar.gif',
                        mensaje: 'Actualizando datos.',
                    }
                    
                    return config;
                });

                let role = this.role;

                axios.post('/role/update', role)
                .then(response => {
                    if( response.data.success )
                    {
                        this.msgerror = {
                            img: '/img/exitoso.jpg',
                            mensaje: 'El role se registro correctamente',
                        };

                        setTimeout(() => {
                            $('div#mod-update-role').modal('hide');
                            this.vaciarFormulario();
                        }, 1000);

                        EventBus.$emit('recargarPanelRoles');
                    }
                })
                .catch(errors => {
                    console.log(errors);

                    typeof(errors.response) != 'undefined' ? this.mostrarErroresHTTP(errors.response.data) : true;
                })

                axios.interceptors.request.eject(interceptor);
            }
        },
        /**
         * Este metodo vacia el formulario de agregar role
         * 
         * @return Array
         */
        vaciarFormulario: function() {
            this.role = {
                nombre     : '',
                descripcion: '',
                permisos   : [],
            };

            this.msgerror     = {};

            $('select#role-update-permisos').val(null).trigger('change');
        },


        /**
         * Este metodo muestra errores http 
         * 
         * @param Object error
         * @return void
         */
        mostrarErroresHTTP: function(error) {
            let errores  = error.errors;
            let errormsg = '';

            for( let e in errores ){
                errormsg = errores[e][0];
                break;
            }

            errormsg = errormsg ? errormsg : 
                            (error.message ? error.message : 'Ocurrio un error desconocido al intentar realizar la peticion, intentelo nuevamente.');

            this.msgerror = {
                img: '/img/error.jpg',
                mensaje: errormsg,
            }
        },

    },
    mounted() {
        console.log('Component mounted AgregarRole.vue.');

        this.cargarListadoDePermisos();
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

