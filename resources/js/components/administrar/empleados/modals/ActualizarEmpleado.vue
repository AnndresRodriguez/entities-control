<template>
    <div id="mod-actualizar-empleado" class="modal fade" tabindex="-1" role="dialog" aria-labelledbi="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="col-xs-10">
                        <h3 class="titulo_modal">ACTUALIZAR EMPLEADO</h3>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                </div>

                <div class="modal-body">
                    <div id="modal2" class="col-xs-12">

                        <form class="form-group" action="php/msproyectos.php" method="POST" id="form-add-empleado" @submit.prevent="updateEmpleado">

                            <div class="mg-top-mod">
                            </div>

                            <label class="col-xs-12 labelpanel"> DOCUMENTO </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <input class="form-control" type="text" v-model="empleado.documento" required>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> NOMBRES </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <input class="form-control" type="text" v-model="empleado.nombres" required>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> APELLIDOS </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <input class="form-control" type="text" v-model="empleado.apellidos" required>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> FECHA NACIMIENTO </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <input class="form-control" type="date" name="cama" v-model="empleado.fecha_nacimiento">
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> GENERO </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <select class="form-control" id="genero" v-model="empleado.genero" required>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                            </div>

                            <label class="col-xs-12 labelpanel"> CARGO </label>
                            <div class="col-xs-12" >
                                <div class="form-group">
                                    <input class="form-control" type="text" name="cama" v-model="empleado.cargo" required>
                                </div>
                            </div>

                            <div class="col-xs-12" id="msg-trazabilidad">
                                <b v-if="msgerror"> <img :src="msgerror.img" style="width: 25px"> {{ msgerror.mensaje }} </b>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success form-control">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> ACTUALIZAR EMPLEADO
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

export default {
    data: function() {
        return({
            empleado: {
                documento       : '',
                nombres         : '',
                apellidos       : '',
                fecha_nacimiento: null,
                genero          : '',
                cargo           : '',
            },

            msgerror: {}
        })
    },

    created: function() {
        EventBus.$on('cargarDatosModalActualizarEmpleado', empleado => { 
            this.cargarDatosModalActualizarEmpleado(empleado);
        });
    },

    methods: {
        /**
         * Este metodo se encaraga de abrir la ventana modal y asignar los datos recibidos 
         * a la propiedad empleado del objecto data
         * 
         * @param Object empleado
         * @return void
         */
        cargarDatosModalActualizarEmpleado: function(empleado) {
            this.vaciarFormulario();

            this.empleado = empleado;

            $('div#mod-actualizar-empleado').modal();
        },

        /**
         * Este metodo Verifica que los campos obligatorios del formulario esten completos
         * 
         * @return boolean
         */
        validarDatosEmpleado: function() {
            let img           = '/img/error.jpg';
            let error         = '';

            let empleado = this.empleado;

            if(empleado.documento === '') {
                error = 'El campo DOCUMENTO es obligatorio.';
            }

            if(empleado.nombres === '') {
                error = 'El campo NOMBRES es obligatorio.';
            }

            if(empleado.apellidos === '') {
                error = 'El campo APELLIDOS es obligatorio.';
            }

            if(empleado.genero === '') {
                error = 'El campo GENERO es obligatorio.';
            }

            if(empleado.cargo === '') {
                error = 'El campo CARGO es obligatorio.';
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
         * Este metodo actualiza los datos del empleado en la base de datos.
         * 
         * @return 
         */
        updateEmpleado: function() {
            if( this.validarDatosEmpleado() )
            {
                let interceptor = axios.interceptors.request.use((config) => {
                    this.msgerror = {
                        img:     '/img/Cargar.gif',
                        mensaje: 'Actualizando datos.',
                    }
                    
                    return config;
                });

                let empleado = this.empleado;

                axios.post('/empleado/update', empleado)
                .then(response => {
                    if( response.data.success )
                    {
                        this.msgerror = {
                            img: '/img/exitoso.jpg',
                            mensaje: 'El empleado se actualzo correctamente',
                        };

                        setTimeout(() => {
                            $('div#mod-actualizar-empleado').modal('hide');
                            this.vaciarFormulario();
                        }, 1000);

                        EventBus.$emit('recargarPanelEmpleados');
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
         * Este metodo vacia el formulario de agregar empleado
         * 
         * @return Array
         */
        vaciarFormulario: function() {
            this.empleado = {
                documento       : '',
                nombres         : '',
                apellidos       : '',
                fecha_nacimiento: null,
                genero          : '',
                cargo           : '',
            };

            this.msgerror     = {};
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
        console.log('Component mounted.')
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

</style>

