<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Gestor de Permisos
                <small>Validar permisos</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Gestor de Permisos</router-link></li>
                <li class="active">Validar permisos</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
                    <!-- DIV BOX INCIO -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">VALIDAR PERMISOS DE LOS COLABORADORES</h3>
                        </div>

                        <div class="box-body">
                            <div class="col-xs-12" id="listado-colaboradores">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <p>COLABORADORES A CARGO</p>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <select class="form-control" id="listado-colaboradores" v-model="colaborador_id">
                                                <option></option>
                                                <option v-for="colaborador in listado_colaboradores" :key="colaborador.id" :value="colaborador.id">
                                                    {{ mostrarDatosColaborador(colaborador) }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="listado_permisos.length" class="col-xs-12" id="listado-permisos-colaborador">
                                <div class="panel panel-primary">
                                    <div class="panel-heading flex-jc-bw">
                                        <div>
                                            PERMISOS SOLICITADOS POR EL COLABORADOR
                                        </div>
                                        <div>
                                            <input type="date" class="form-control input-sm" id="fecha_global" v-model="fecha_global">
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <template v-if="listado_permisos.length">
                                                <permiso-solicitado v-for="permiso in listado_permisos" :key="permiso.id" :permiso="permiso">
                                                </permiso-solicitado>
                                            </template>
                                            <template v-else>
                                                <li class="list-group-item">
                                                    El colaborador seleccionado no ha solicitado a ningun permiso a la fecha.
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-primary" id="validar-permisos" @click="validarPermisosColaborador()">
                                            <i class="fas fa-paper-plane"></i> Validar permisos
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
    import PermisoSolicitado from './components/validar_permisos/PermisoSolicitado';

    export default {
        components: {
            PermisoSolicitado,
        },
        data: function() {
            return ({
                colaborador_id: null,

                listado_colaboradores: [],

                listado_permisos: [],

                fecha_global: '',
            })
        },
        created: function() {
            EventBus.$on('permisoEliminadoCorrectamente', () => this.getListadoColaboradores());
        },
        watch: {
            'fecha_global': function() {
                this.listado_permisos.forEach(permiso => permiso.fecha_vencimiento = this.fecha_global)
            },
            'listado_permisos': function() {
                this.listado_permisos.forEach(permiso => permiso.fecha_vencimiento = this.fecha_global)
            },
        },
        methods: {
            getListadoColaboradores: function() {
                axios.get('/gesper_permisos_usuario/subalternos')
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

                                me.listado_permisos = colaborador.permisos_solicitados.sort((a, b) => {
                                    return a.proceso.ruta_permiso.localeCompare(b.proceso.ruta_permiso);
                                });

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

            validarPermisosColaborador: function() {
                let permisos    = this.filtrarPermisosSelecccionados();

                if( !this.validarDatos(permisos) ){
                    return false;
                }
                else {
                    let interceptor = this.setInterceptorAxios('Registrando la validación de los permisos, espere un momento.');

                    axios.post('/gesper_permisos_usuario/validar', permisos)
                            .then(response => {
                                Swal.fire({
                                    type: 'success',
                                    width: '60rem',
                                    title: `La validación de los permisos se registro correctamente.`,
                                });

                                this.getListadoColaboradores();
                            })
                            .catch(errors => {
                                this.mostrarErroresHttpAxios(errors);
                            })

                        axios.interceptors.request.eject(interceptor);
                }   
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