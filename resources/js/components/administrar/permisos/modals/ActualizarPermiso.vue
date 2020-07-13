<template>
    <div id="mod-update-permiso" class="modal fade" tabindex="-1" permiso="dialog" aria-labelledbi="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="col-xs-10">
                        <h3 class="titulo_modal">ACTUALIZAR PERMISO</h3>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                </div>

                <div class="modal-body">
                    <div id="modal2" class="col-xs-12">

                        <form class="form-group" action="php/msproyectos.php" method="POST" id="form-add-permiso" @submit.prevent="updatePermiso">

                            <div class="mg-top-mod">
                            </div>

                            <label class="col-xs-12"> NOMBRE </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <input class="form-control" type="text" v-model="permiso.nombre" required>
                                </div>
                            </div>

                            <label class="col-xs-12"> DESCRIPCIÓN </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <textarea class="form-control" rows="5"
                                        v-model="permiso.descripcion">
                                    </textarea>
                                </div>
                            </div>

                            <label class="col-xs-12"> RUTA </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <input class="form-control" type="text" v-model="permiso.ruta" required>  
                                </div>
                            </div>

                            <div class="col-xs-12" id="msg-errors">
                                <b v-if="msgerror"> <img :src="msgerror.img" style="width: 25px"> {{ msgerror.mensaje }} </b>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success form-control">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> ACTUALIZAR PERMISO
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
            permiso: {
                nombre: '',
                descripcion : '',
                ruta: '',
            },

            msgerror: {}
        })
    },

    created: function() {
        console.log('Component created AgregarPermiso.vue.');
        EventBus.$on('cargarModalActualizarPermiso', (permiso) => this.cargarModalActualizarPermiso(permiso));
    },

    methods:{

        /**
         * Este metodo carga el formulario para un nuevo permiso
         * 
         * @return void
         */
        cargarModalActualizarPermiso: function(permiso) {
            $('div#mod-update-permiso').modal();

            this.permiso = permiso;
        },
        /**
         * Este metodo valida si los campos obligatorios del formulario estan completos.
         * 
         * @param String params
         * @return boolean
         * 
         */
        validarDatosPermiso: function(params) {
            let img           = '/img/error.jpg';
            let error         = '';

            let permiso = this.permiso;

            if(permiso.nombre === '') {
                error = 'El campo NOMBRE es obligatorio.';
            }

            if(permiso.descripcion === '') {
                error = 'El campo DESCRIPCION es obligatorio.';
            }

            if(permiso.ruta === '') {
                error = 'El campo RUTA es obligatorio.';
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
         * Este metodo guarda los datos del permiso y registra el nuevo permiso.
         * 
         * @return 
         */
        updatePermiso: function() {
            if( this.validarDatosPermiso() )
            {
                let interceptor = axios.interceptors.request.use((config) => {
                    this.msgerror = {
                        img:     '/img/Cargar.gif',
                        mensaje: 'Actualizando datos',
                    }
                    
                    return config;
                });

                let permiso = this.permiso;

                axios.post('/permiso/update', permiso)
                .then(response => {
                    if( response.data.success )
                    {
                        this.msgerror = {
                            img: '/img/exitoso.jpg',
                            mensaje: 'El permiso se actualizo correctamente',
                        };

                        setTimeout(() => {
                            $('div#mod-update-permiso').modal('hide');
                            this.vaciarFormulario();
                        }, 1000);

                        EventBus.$emit('recargarPanelPermisos');
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
         * Este metodo vacia el formulario de agregar permiso
         * 
         * @return Array
         */
        vaciarFormulario: function() {
            this.permiso = {
                nombre     : '',
                descripcion: '',
                ruta       : '',
            };

            this.msgerror     = {};
        },
        
        /**
         * Este metodo muestra errores http 
         * 
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
        console.log('Component mounted AgregarPermiso.vue.');
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

