<template>
	<div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Entes de Control
                <small>Configuración General</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Entes de Control</router-link></li>
                <li class="active">Configuración general</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
					<!-- DIV BOX INCIO -->
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">CONFIGURACÍON GENERAL</h3>
						</div>

						<div class="box-body">

	                        <!--- CONFIG ENTES DE CONTROL -->

							<div class="col-xs-12" id="datos-entes-control" style="margin-top: 10px">
								<div class="panel panel-primary">
									<div class="panel-heading d-flex justify-between">
										CONFIGURACIÓN GENERAL ENTES DE CONTROL
										<!-- <button class="btn btn-xs btn-warning" type="button" data-toggle="collapse" data-target="#panel-permisos-asignados">
											<i class="fa fa-question" aria-hidden="true"></i>
										</button> -->
										<button class="btn btn-xs btn-primary" type="button" data-toggle="tooltip" data-placement="bottom" title="DEBE SELECCIONAR EL ENTE DE CONTROL ANTES DE EDITARLO">
											<i class="fa fa-question" aria-hidden="true"></i>
										</button>
									</div>
									<div id="datos-entes-control" class="panel-body collapse in">

                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <label>Seleccione un Ente de Control </label>
                                                <select class="form-control" id="selectEnte" required @change="getEnteSelected(enteSelect)" v-model="enteSelect">
                                                    <option selected="selected" value="" disabled="disabled">SELECCIONE UN ENTE DE CONTROL</option>
                                                    <option v-for="(ente, index) in entesControl" :key="index" :value="ente"> {{ ente.nombre }} </option>
                                                </select>
                                            </div>
	                                    </div>

                                        <!-- <div class="col-xs-12 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <label> Fecha de creación </label>
                                                <input type="text" class="form-control" v-model="fechaCreacionEnte" disabled>
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-xs-12 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <label> Fecha de ultima edición </label>
                                                <input type="text" class="form-control" v-model="fechaEdicionEnte"  disabled>
                                            </div>
                                        </div> -->

                                        <div class="col-xs-12 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label> Acciones Ente de control </label>
                                                <div class="d-flex justify-around">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoEnte"> Crear Nuevo ente</button>
                                                    <button type="button" class="btn btn-success" id="btn-editar-ente"  data-toggle="modal" data-target="#modalEditarEnte" disabled > Editar ente seleccionado</button>
                                                </div>
                                            </div>
                                        </div>

									</div>

								</div>
							</div>

                            <!-- CIERRE PANEL ENTES DE CONTROL -->

                            <!-- CONFIGURACIÓN DEPENDENCIAS HUEM -->

                            <div class="col-xs-12" id="datos-dependencias-huem" style="margin-top: 10px">
								<div class="panel panel-primary">
									<div class="panel-heading d-flex justify-between">
										CONFIGURACIÓN DEPENDENCIAS HUEM
										<button class="btn btn-xs btn-warning" type="button" data-toggle="collapse" data-target="#panel-permisos-asignados">
											<i class="fa fa-plus"></i>
										</button>
									</div>
									<div id="datos-dependencias-huem" class="panel-body collapse in">

                                         <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Nombre de la dependencia * </label>
                                                <select class="form-control" id="selectDependencia" required @change="getDependenciaSelected(dependenciaSelect)" v-model="dependenciaSelect">
                                                    <option selected="selected" value="" disabled="disabled">SELECCIONE UNA DEPENDENCIA</option>
                                                    <option v-for="(dependencia, index) in dependencias" :key="index" :value="dependencia" > {{ dependencia.nombre }} </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Nombre Responsable * </label>
                                                <input type="text" class="form-control" disabled v-model="responsableDependencia">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Correo Responsable * </label>
                                                <input type="text" class="form-control" disabled v-model="emailDependencia">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Acciones </label>
                                                <div class="d-flex justify-between">
                                                    <button type="button" class="btn btn-success" id="btn-editar-dependencia"  data-toggle="modal" data-target="#modalEditarDependencia" @click="createTempDataDependencia" disabled> Editar Datos </button>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNuevaDependencia"> Añadir nueva dependencia </button>

                                                </div>
                                            </div>
                                        </div>

									</div>

								</div>
							</div>

						</div>
					</div>
					<!-- DIV BOX CIERRE -->
                </div>
            </div>




        <!-- Modal Crear Ente -->
        <div class="modal fade" id="modalNuevoEnte" tabindex="-1" role="dialog" aria-labelledby="modalNuevoEnteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalNuevoEnteLabel">Añadir Nuevo Ente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label> <i class="fas fa-building"></i>
                        Ingrese el nombre ente de control
                        </label>
                        <input class="form-control" type="text" id="nuevoEnte"  v-model="nuevoEnte" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="limpiarInputEnte">Cancelar</button>
                        <button type="button" class="btn btn-primary" @click="aniadirNuevoEnte">Crear nuevo Ente</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Editar Ente -->
            <div class="modal fade" id="modalEditarEnte" tabindex="-1" role="dialog" aria-labelledby="modalEditarEnte" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarEnte">Editar nombre del Ente de control</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label> <i class="fas fa-edit"></i>
                        Ingrese el nuevo nombre del ente de Control
                        </label>
                        <input class="form-control" type="text" id="editEnte"  v-model="nombreEnteSelect">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="limpiarInputEnte">Cancelar</button>
                        <button type="button" class="btn btn-primary" @click="editarNombreEnte">Editar ente</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Modal nueva dependencia -->

              <div class="modal fade" id="modalNuevaDependencia" tabindex="-1" role="dialog" aria-labelledby="modalNuevaDependencia" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalNuevaDependencia">Añadir Nueva Dependencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <label> <i class="fas fa-building"></i>
                                    Nombre de la nueva dependencia
                                </label>
                                <input class="form-control" type="text" id="nuevaDependencia"  v-model="nuevaDependencia" required placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-md-4">
                                <label> <i class="fa fa-user"></i>
                                    Nombre del responsable
                                </label>
                                <input class="form-control" type="text" id="nuevoNombre"  v-model="nuevoResponsable" required placeholder="Nombre del responsable">
                            </div>
                            <div class="col-md-4">
                                <label> <i class="fa fa-envelope"></i>
                                    Correo (el/la) responsable
                                </label>
                                <input class="form-control" type="email" id="nuevoNombre"  v-model="nuevoEmail" required placeholder="Ingrese un correo electrónico">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="limpiarInputsDependencia">Cancelar</button>
                        <button type="button" class="btn btn-primary" @click="aniadirNuevaDependencia">Crear nueva dependencia</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal editar dependencia -->

            <div class="modal fade" id="modalEditarDependencia" tabindex="-1" role="dialog" aria-labelledby="modalEditarDependencia" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarDependencia">Editar datos de la Dependencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <label> <i class="fas fa-building"></i>
                                    Nuevo nombre de la nueva dependencia
                                </label>
                                <input class="form-control" type="text" id="nuevaDependencia"  v-model="nombreDependencia" required placeholder="Ingrese un nombre">
                            </div>
                            <div class="col-md-4">
                                <label> <i class="fa fa-user"></i>
                                    Nombre del responsable
                                </label>
                                <input class="form-control" type="text" id="nuevoNombre"  v-model="responsableDependencia" required placeholder="Nombre del responsable">
                            </div>
                            <div class="col-md-4">
                                <label> <i class="fa fa-envelope"></i>
                                    Correo (el/la) responsable
                                </label>
                                <input class="form-control" type="email" id="nuevoNombre"  v-model="emailDependencia" required placeholder="Ingrese un correo electrónico">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="restoreDataDependencia">Descartar Cambios</button>
                        <button type="button" class="btn btn-primary" @click="editarDatosDependencia">Guardar Cambios</button>
                    </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</template>

<script>

import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import $ from 'jquery';
import { validateEmail, removeBlankSpaces } from './utilities'

export default {

  components: {
        vueDropzone: vue2Dropzone
  },

  mounted: function() {

            this.getAllEntes();
            this.getAllDependencias();

        },

		data: function() {
			return ({

                evidencias : [],
                nombreInforme: '',
                idDependencia: '', nombreDependencia: '', responsableDependencia: '', emailDependencia: '',
                tempnombreDependencia: '', tempresponsableDependencia: '', tempemailDependencia: '',
                nuevoEnte: '',
                entesControl: [],
                dependencias: [],
                enteSelect: '',
                nombreEnteSelect: '', idEnteSelect: '', fechaCreacionEnte: '', fechaEdicionEnte: '',
                nuevaDependencia: '', nuevoResponsable: '', nuevoEmail: '',
                dependenciaSelect: '',
			})
		},
		computed: {},

		methods: {


            getAllEntes: function(){

                $(function (){ $('[data-toggle="tooltip"]').tooltip()})

                axios.get('http://localhost:3000/entes_control/entes')
                .then( res => {

                    this.entesControl = res.data.entes
                })

            },

            getAllDependencias: function(){

                axios.get('http://localhost:3000/entes_control/dependencias')
                .then( res => {
                    this.dependencias = res.data.dependencias
                     })
            },


            getEnteSelected: function(enteSelected){

                this.nombreEnteSelect = enteSelected.nombre;
                this.idEnteSelect = enteSelected.id;
                this.fechaCreacionEnte = enteSelected.fecha_creacion;
                this.fechaEdicionEnte = enteSelected.fecha_edicion;

                document.getElementById('btn-editar-ente').disabled = false;


            },

            getDependenciaSelected: function(dependenciaSelected){

                this.idDependencia = dependenciaSelected.id;
                this.nombreDependencia = dependenciaSelected.nombre;
                this.responsableDependencia = dependenciaSelected.responsable;
                this.emailDependencia = dependenciaSelected.correo_responsable;
                document.getElementById('btn-editar-dependencia').disabled = false;

            },

            aniadirNuevoEnte: function(){

                if(removeBlankSpaces(this.nuevoEnte) == ''){
                    this.getToast('info', 'El campo del nombre del ente no puede quedar vacío', 'fa-exclamation-circle', 'top-right')
                    this.nuevoEnte = '';

                }else {

                    axios.post('http://localhost:3000/entes_control/crear_ente',
                           { nombre: this.nuevoEnte },
                           { headers: {'Content-Type': 'application/json'}})
                .then( res => {
                    // fa-exclamation fa-exclamation-circle
                    if(!res.data.error){
                        $('#modalNuevoEnte').modal('hide');
                        this.getToast('success', 'Nuevo Ente de Control Creado con éxito', 'fa-check', 'bottom-right');
                        this.limpiarInputEnte();
                        this.getAllEntes();
                    } else {
                        $('#modalNuevoEnte').modal('hide');
                        this.getToast('error', 'Ocurrio un error intente nuevamente', 'fa-times', 'bottom-right');
                        this.limpiarInputEnte();
                    }
                })

                }



            },

            createTempDataDependencia: function(){

                this.tempnombreDependencia = this.nombreDependencia;
                this.tempresponsableDependencia = this.responsableDependencia;
                this.tempemailDependencia = this.emailDependencia;

            },

            restoreDataDependencia: function(){
                this.nombreDependencia = this.tempnombreDependencia;
                this.responsableDependencia = this.tempresponsableDependencia;
                this.emailDependencia = this.tempemailDependencia;

            },
            editarNombreEnte: function() {

                if(removeBlankSpaces(this.nombreEnteSelect) == ''){

                    this.getToast('info', 'El campo del nombre del ente no puede quedar vacío', 'fa-exclamation-circle', 'top-right')
                    this.nombreEnteSelect = ''

                }else{

                    axios.post('http://localhost:3000/entes_control/editar_ente', { id: this.idEnteSelect,nuevoNombre: this.nombreEnteSelect }, { headers: {'Content-Type': 'application/json'} })
                    .then(res => {
                    console.log(res)
                    if(!res.data.error){
                        $('#modalEditarEnte').modal('hide');
                        this.getToast('success', `${res.data.message}`, 'fa-check', 'bottom-right');
                        this.limpiarInputEnte();
                        this.getAllEntes();
                    } else {
                        $('#modalEditarEnte').modal('hide');
                        this.getToast('error', 'Ocurrio un error intente nuevamente', 'fa-times', 'bottom-right');
                        this.limpiarInputEnte();
                    }
                })

                }

            },

            limpiarInputEnte: function(){
                this.nuevoEnte = ''
                this.nombreEnteSelect = ''
                this.idEnteSelect = ''
                document.getElementById('btn-editar-ente').disabled = true;
            },

            aniadirNuevaDependencia: function(){

                if(removeBlankSpaces(this.nuevaDependencia) == '' || removeBlankSpaces(this.nuevoResponsable)  == '' || removeBlankSpaces(this.nuevoEmail) == ''){
                    this.getToast('info', 'Los campos no pueden quedat vacíos', 'fa-times', 'top-right');
                }else if (!validateEmail(this.nuevoEmail)) {
                    this.getToast('info', 'formato de correo inválido', 'fa-times', 'top-right');
                }else {


                axios.post('http://localhost:3000/entes_control/crear_dependencia',
                {
                    nombre: this.nuevaDependencia,
                    correo: this.nuevoResponsable,
                    responsable: this.nuevoEmail
                },
                {
                    headers: {'Content-Type': 'application/json'}
                })
                .then(res => {

                    if(!res.data.error){
                        $('#modalNuevaDependencia').modal('hide');
                        this.getToast('success', `${res.data.message}`, 'fa-check', 'bottom-right');
                        this.cleanInputsNuevaDependencia();
                        this.getAllDependencias();
                    } else {
                        $('#modalNuevaDependencia').modal('hide');
                        this.getToast('error', 'Ocurrio un error intente nuevamente', 'fa-times', 'bottom-right');
                        this.cleanInputsNuevaDependencia();
                    }
                })

                }



            },

            editarDatosDependencia: function (){

                console.log(this.idDependencia, this.nombreDependencia, this.responsableDependencia, this.emailDependencia  )

                  if(removeBlankSpaces(this.nombreDependencia) == '' || removeBlankSpaces(this.responsableDependencia) == '' || removeBlankSpaces(this.emailDependencia) == ''){

                    this.getToast('info', 'Ninguno de los campos puede quedar vacío', 'fa-exclamation-circle', 'top-right')
                    this.restoreDataDependencia();

                }else{

                    axios.post('http://localhost:3000/entes_control/editar_dependencia', { id: this.idDependencia, nombre: this.nombreDependencia, responsable: this.responsableDependencia, correo: this.emailDependencia }, { headers: {'Content-Type': 'application/json'} })
                    .then(res => {
                    console.log(res)
                    if(!res.data.error){
                        $('#modalEditarDependencia').modal('hide');
                        this.getToast('success', `${res.data.message}`, 'fa-check', 'bottom-right');
                        this.limpiarInputsDependencia();
                        this.getAllDependencias();
                    } else {
                        $('#modalEditarDependencia').modal('hide');
                        this.getToast('error', 'Ocurrio un error intente nuevamente', 'fa-times', 'bottom-right');
                        this.limpiarInputsDependencia();
                    }
                })

                }

            },

            cleanInputsNuevaDependencia: function(){

                this.emailDependencia = '';
                this.nuevaDependencia = '';
                this.nuevoResponsable = '';

            },

            limpiarInputsDependencia: function(){
                this.nombreDependencia = '';
                this.responsableDependencia = '';
                this.emailDependencia = '';
                document.getElementById('btn-editar-dependencia').disabled = true;
            },

            getToast: function( type, message, iconFontAwesome, positionToast ){

                this.$toasted.show(`${message}`,
                        {
                            icon: { name: `${iconFontAwesome}` },
                            type: `${type}`,
	                        position: `${positionToast}`,
                            duration : 3000,
                            keepOnHover: true
                        }).goAway(2000);
            }
		}
	}
</script>

<style scoped>

    #listado-permisos-asignados .panel-primary {
        border-color: #337ab7 !important;
    }

	#listado-permisos-solicitar .panel-success {
		color: #000000;
        border-color: #4c9112 !important;
    }

    #listado-permisos-solicitar .panel-success div p {
        color: #000000;
        margin: 0;
    }

	.d-flex{
    display: flex;
}

.flex-row{
    flex-direction: row;
    flex-wrap: nowrap;
}

.flex-column{
    flex-direction: column;
    flex-wrap: nowrap;
}

.justify-center{
    justify-content: center;
}

.justify-between{
    justify-content: space-between;
}

.justify-around{
    justify-content: space-around;
}

.align-items-center{
    align-items: center;
}

.align-content-center{
    align-content: center;
}

.bg-warning{
   background-color: orange;
}

.bg-success{
    background-color: green;
}

.fontsize18{
    font-size: 18px;
}

.fontsize16{
    font-size: 16px;
}

.fontsize14{
    font-size: 14px;
}

    .mr-20 {
        padding-right: 20px;
    }

    .ml-5 {
        padding-left: 5px;
    }

    div.input-checkbox {
        border: 1px solid #a9a9a9;
        border-radius: 0.25em;
        width: 1.3em;
        height: 1.4em;
    }

</style>
