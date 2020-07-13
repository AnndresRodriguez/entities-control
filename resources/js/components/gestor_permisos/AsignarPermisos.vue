<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Gestor de Permisos
                <small>Asignar permisos</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Gestor de Permisos</router-link></li>
                <li class="active">Asignar permisos</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
                    <!-- DIV BOX INCIO -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">ASIGNAR PERMISOS DE LOS COLABORADORES</h3>
                        </div>

                        <div class="box-body">
                            <div class="col-xs-12" id="listado-colaboradores">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <p>LISTADO COLABORADORES</p>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Colaborador</label>
                                                <select class="form-control" id="listado-colaboradores" v-model="colaborador_id">
                                                    <option></option>
                                                    <option v-for="colaborador in listado_colaboradores" :key="colaborador.id" :value="colaborador.id">
                                                        {{ mostrarDatosColaborador(colaborador) }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label> Jefe inmediato * </label>
                                                <input type="text" class="form-control" id="jefe-inmediato-nombre" 
                                                    :value="jefe_inmediato_nombre" 
                                                    disabled="true" 
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label> Correo * </label>
                                                <input type="text" class="form-control" id="jefe-inmediato-correo" 
                                                    :value="jefe_inmediato_correo" 
                                                    disabled="true" 
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="colaborador_id >= 1" class="col-xs-12" id="listado-permisos-colaborador">
                                <div class="panel panel-primary">
                                    <div class="panel-heading flex-jc-bw">
                                        <div>
                                            PERMISOS SOLICITADOS POR EL COLABORADOR
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="alert alert-danger" v-if="solicitud_retiro == 1">
                                            El usuario ah solicitado que se le retiren todos los permisos.
                                        </div>
                                        <ul class="list-group">
                                            <template v-if="listado_permisos.length">
                                                <permiso-solicitado v-for="permiso in listado_permisos" :key="permiso.id" :permiso="permiso">
                                                </permiso-solicitado>
                                            </template>
                                            <template v-else>
                                                <li class="list-group-item">
                                                    El colaborador seleccionado no ha solicitado ningún permiso a la fecha.
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-primary" id="notificar-colaborador-permisos" @click="notificarColaboradorPermisosAsignados()">
                                            <i class="fas fa-bell"></i> Notificar permisos
                                        </button>
                                        <button class="btn btn-danger" id="dar-de-baja-colaborador" v-if="solicitud_retiro == 1" @click="darDeBajaColaborador()">
                                            <i class="fas fa-user-slash"></i> Dar de baja
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DIV BOX CIERRE -->
                </div>
            </div>
            
        </section>
    </div>
</template>

<script>
    import EventBus from './../../EventBus';
    import PermisoSolicitado from './components/asignar_permisos/PermisoSolicitado';

    export default {
        components: {
            PermisoSolicitado,
        },
        data: function() {
            return ({
                colaborador_id: null,

                listado_colaboradores: [],

                listado_permisos: [],

                jefe_inmediato: {},
            })
        },
        computed: {
            jefe_inmediato_nombre: function() {
                try {
                    return `${this.jefe_inmediato.empleado.nombres} ${this.jefe_inmediato.empleado.apellidos}`
                }
                catch (error) {}

                return 'No asignado';
            },

            jefe_inmediato_correo: function() {
                try {
                    return this.jefe_inmediato.email || 'No asignado'
                }
                catch (error) {}

                return 'No asignado';
            },

            solicitud_retiro: function(){
                try {
                    return this.filtrarColaboradorPorId(this.colaborador_id).solicitud_retiro.estado;
                }catch(e) {
                    //
                }

                return false;
            },
        },
        created: function() {
            EventBus.$on('permisoEliminadoCorrectamente', () => this.getListadoColaboradores());
        },
        methods: {
            getListadoColaboradores: function() {
                axios.get('/gesper_permisos_usuario/administrador/colaboradores')
                .then(response => {
                    this.listado_colaboradores = response.data;

                    this.cargarSelect2Colaboradores();
                })
                .catch(errors => {
                    this.mostrarErroresHttpAxios(errors);
                })
                .then(() => {
                    try {
                        let colaborador_id = atob(this.$route.params.empleado);

                        if( parseInt(colaborador_id) >= 1 ){
                            $('select#listado-colaboradores').val(colaborador_id).trigger('change');
                        }
                    }
                    catch(error) {
                        //
                    }
                })
            }, 

            cargarSelect2Colaboradores: function() {
                let me = this;

                $('select#listado-colaboradores').select2({ 
                    theme: 'bootstrap',
                    placeholder: "Seleccione un colaborador",
                    templateSelection: function (data){
                            if( typeof data.id !== 'undefined' && data.id !== '' ) {
                                let colaborador = me.filtrarColaboradorPorId(data.id);

                                me.colaborador_id   = colaborador.id;
                                me.jefe_inmediato   = colaborador.jefe_inmediato;
                                me.listado_permisos = colaborador.permisos_solicitados;

                                return `${colaborador.empleado.documento} - ${colaborador.empleado.nombres} ${colaborador.empleado.apellidos}`;
                            }
                            else{
                                me.colaborador_id = '';

                                return 'Seleccione un colaborador';
                            }
                        }
                });
            },

            filtrarColaboradorPorId: function(id) {
                let colaborador = this.listado_colaboradores.filter((colaborador) => {
                    return colaborador.id == id;
                })

                return typeof(colaborador[0]) === 'object' ? colaborador[0] : {};
            },

            mostrarDatosColaborador: function(colaborador) {
                let empleado = colaborador.empleado;

                return ` ${empleado.documento} - ${empleado.nombres}  ${empleado.apellidos}`;
            },

            filtrarPermisosSelecccionados: function(){
                return this.listado_permisos.filter(permiso => permiso.selected === true);
            },

            validarDatos: function(permisos) {
                let mensaje  = '';

                if( !permisos.length ) {
                    mensaje = 'No ah seleccionado ningun permiso a validar.';
                }
                else {
                    for( let i in permisos ){
                        if( !permisos[i].fecha_vencimiento || permisos[i].fecha_vencimiento <= '1990-01-01' ) {
                            console.log(permisos[i], permisos[i].fecha_vencimiento);

                            mensaje = 'Uno de los permisos seleccionados no tiene una fecha valida, verifiquelo y vuelva a intentarlo.'; 
                        }
                    }
                }

                if( mensaje ) {
                    Swal.fire({ type: 'error', width: '60rem', title: mensaje });

                    return false;
                }

                return true;
            },

            getNombreJefeInmediatoDelUsuario: function() {
                try {
                    return `${this.jefe_inmediato.empleado.nombres} ${this.jefe_inmediato.empleado.apellidos}`
                }
                catch(errors) {
                    return 'No asignado';
                }
            },

            getCorreoJefeInmediatoDelUsuario: function() {
                try {
                    return `${this.jefe_inmediato.email}`
                }
                catch(errors) {
                    return 'No asignado';
                }
            },

            notificarColaboradorPermisosAsignados: function() {
                let interceptor = this.setInterceptorAxios('Enviado notificación de los permisos asignados por correo al Colaborador');

                axios.post('/gesper_permisos_usuario/permisos_asignados/notificacion', {
                    id: this.colaborador_id
                })
                        .then(response => {
                            Swal.fire({
                                type: 'success',
                                width: '60rem',
                                title: `Se envío la notificación con los permisos asignados al usuario.`,
                            });

                            this.getListadoColaboradores();
                        })
                        .catch(errors => {
                            this.mostrarErroresHttpAxios(errors);
                        })

                    axios.interceptors.request.eject(interceptor); 
            },

            darDeBajaColaborador: function() {
                Swal.fire({
                    title: `¿Está realmente seguro de dar de baja los permisos del colaborador?`,
                    type: 'warning',
                    width: 545,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Dar de baja',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        axios.post(`/gesper_solicitud_retiro/registrar_baja`, {
                            user_id: this.colaborador_id
                        })
                        .then(response => {
                            Swal.fire({
                                type: 'success',
                                width: 550,
                                title: 'Registro exitoso!',
                                text: 'El retiro de los permisos del colaborador sé realizo correctamente.',
                            });

                            this.getListadoColaboradores();
                        })
                        .catch(errors => { 
                            this.mostrarErroresHttpAxios(errors);
                        });
                    }
                });
            },

        },
        mounted: function() {
            this.getListadoColaboradores();
        },
    }
</script>

<style scoped>
    
    #listado-colaboradores .panel-success {
        border-color: #d6e9c6 !important;
    }

    #listado-colaboradores .panel-success div p {
        color: #000000;
        margin: 0;
    }

    #listado-permisos-colaborador .panel-primary {
        border-color: #337ab7 !important;
    }

    .flex-jc-bw {
        display: flex;
        justify-content: space-between;
    }

</style>