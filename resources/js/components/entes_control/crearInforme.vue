<template>
	<div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Entes de Control
                <small>Crear Informe</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Entes de Control</router-link></li>
                <li class="active">Crear Informe</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
					<!-- DIV BOX INCIO -->
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">CREAR INFORME</h3>
						</div>

						<div class="box-body">

                            <!-- <div class="col-md-12">
                                <label> Evidencias de informe</label>
                                    <vue-dropzone ref="myVueDropzone" id="myVueDropzone" :options="dropzoneOptions"  :useCustomSlot=true @vdropzone-success-multiple="loadMulipleFiles">
                                    <h3 class="dropzone-custom-title">Arrastre y suba sus evidencias de Informe aquí <i class="fa fa-upload" aria-hidden="true"></i></h3>
                                    <div class="subtitle">...o un Click para seleccionar desde su computador</div>
                                    </vue-dropzone>

                            </div> -->



                            <div class="col-xs-12" id="datos-informe" style="margin-top: 10px">
								<div class="panel panel-primary">
									<div class="panel-heading d-flex justify-between">
										DATOS DE CREACIÓN Y RESPONSABLE DEL INFORME (PASO 1)
										<button class="btn btn-xs btn-warning" type="button" data-toggle="collapse" data-target="#panel-datos-informe">
											<i class="fa fa-plus"></i>
										</button>
									</div>
									<div id="panel-datos-informe" class="panel-body collapse in">

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="form-group" :class="emptyNombre" >
                                                    <label> Nombre del Informe * </label>

                                                        <input type="text"
                                                        class="form-control"
                                                        required v-model="nombreInforme">

                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="form-group" :class="emptyEnte">
                                                    <label> Seleccione un Ente de Control * </label>
                                                    <select class="form-control" id="selectEnte" required @change="getEnteSelected(enteSelect)" v-model="enteSelect">
                                                        <option selected="selected" value="" disabled="disabled">SELECCIONE UN ENTE DE CONTROL</option>
                                                        <option v-for="(ente, index) in entesControl" :key="index" :value="ente"> {{ ente.nombre }} </option>
                                                    </select>
                                                </div>
                                            </div>

                                        <!-- <div class="col-xs-12 col-sm-2 col-md-2">
                                            <label> Acciones Ente de control </label>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoEnte"> Crear Nuevo</button>
                                            <button type="button" class="btn btn-success" id="btn-editar-ente"  data-toggle="modal" data-target="#modalEditarEnte" disabled> Editar ente</button>
                                        </div> -->


                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="form-group" :class="emptyFile">
                                                    <label> Normativa * </label>
                                                    <input type="file" id="file" ref="file" @change="handleFileUpload()"  class="form-control-file" :class="inputError">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="form-group" :class="emptyDependencia">
                                                    <label> Dependencia Responsable * </label>
                                                    <select class="form-control" id="selectDependencia" required @change="getDependenciaSelected(dependenciaSelect)" v-model="dependenciaSelect">
                                                        <option selected="selected" value="" disabled="disabled">SELECCIONE UNA DEPENDENCIA</option>
                                                        <option v-for="(dependencia, index) in dependencias" :key="index" :value="dependencia" > {{ dependencia.nombre }} </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label> Nombre Responsable * </label>
                                                    <input type="text" class="form-control" disabled v-model="responsableDependencia">
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label> Correo Responsable * </label>
                                                    <input type="text" class="form-control" disabled v-model="emailDependencia">
                                                </div>
                                            </div>

                                        </div>

									</div>
								</div>
							</div>

	                        <!--- SEGUNDA LINEA -->

							<div class="col-xs-12" id="datos-periodicidad" style="margin-top: 10px">
								<div class="panel panel-primary">
									<div class="panel-heading d-flex justify-between ">
										DATOS DE PERIODICIDAD DEL INFORME (PASO 2)
										<button class="btn btn-xs btn-warning" type="button" data-toggle="collapse" data-target="#panel-datos-periodicidad">
											<i class="fa fa-plus"></i>
										</button>
									</div>
									<div id="panel-datos-periodicidad" class="panel-body collapse in">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group" :class="emptyFechaEntrega" >
                                                    <label> Seleccione la Fecha y Hora límite para la entrega del informe *</label>
                                                     <datetime
                                                        type="datetime" input-class="form-control"
                                                        use12-hour
                                                        :min-datetime="dataInitialCalendar"
                                                        :phrases="{ok: 'Seleccionar', cancel: 'Cancelar'}"
                                                        title="Fecha y hora de entrega"
                                                        v-model="dataEntrega">
                                                    </datetime>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" :class="emptyPeriodoSelect">
                                                    <label> Periodo de repetición del Informe * </label>
                                                    <select class="form-control" id="selectfrecuencia" required @change="getPeriodoRepeticion(periodoSelect)" v-model="periodoSelect">
                                                        <option selected="selected" value="" disabled="disabled">SELECCIONE UNA OPCIÓN</option>
                                                        <option value="D">DIARIO</option>
                                                        <option value="Q">QUINCENAL</option>
                                                        <option value="M">MENSUAL</option>
                                                        <option value="B">BIMESTRAL</option>
                                                        <option value="T">TRIMESTRAL</option>
                                                        <option value="C">CUATRIMESTRAL</option>
                                                        <option value="S">SEMESTRAL</option>
                                                        <option value="A">ANUAL</option>
                                                        <option value="4">PERSONALIZADO</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-4">


                                            </div> -->

                                            <div class="col-md-4">
                                                <label> Finalizara despues de cuantas entregas</label>
                                                <input type="number" class="form-control" id="cantidadFinalizacion" v-model="cantidadFinalizacion"
                                                aria-describedby="cantidadFinalizacion" min="1" placeholder="Seleccione o digite la Cantidad">
                                            </div>
                                            <!-- <div class="col-md-2">
                                                <div class="form-group" :class="emptyDataFinalizacion" >
                                                    <div class="form-group">
                                                    <label> El informe dejará de entregarse en la fecha *</label>

                                                        <datetime
                                                        input-id="data-finalizacion"
                                                        input-class="form-control"
                                                        :disabled="enabledDateLimit"
                                                        :min-datetime="initializeMinDateLimit"
                                                        :phrases="{ok: 'Seleccionar', cancel: 'Cancelar'}"
                                                        v-model="dataFinalizacion">
                                                        </datetime>

                                                </div>
                                                </div>

                                            </div> -->

                                        </div>

                                        <template v-if="personalizado">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label> <i class="fas fa-sync-alt"></i>  Se repite cada cuanto (Cantidad) </label>
                                                    <input class="form-control" type="number" value="1" id="cantidad" min="1"  v-model="repeticion">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label> Periodo personalizado </label>
                                                <select class="form-control" id="selectfrecuencia" required @change="getPersonalizado(tipopersonalizado)" v-model="tipopersonalizado">
                                                    <option selected="selected" value="" disabled="disabled">SELECCIONE UNA OPCIÓN</option>
                                                    <option value="DIAS">DÍAS</option>
                                                    <option value="MESES">MESES</option>
                                                    <option value="AÑOS">AÑOS</option>
                                                </select>
                                            </div>
                                        </div>
                                        </template>

									</div>
								</div>
							</div>

							<div class="col-xs-12" id="datos-alarma" style="margin-top: 10px">
								<div class="panel panel-primary">
									<div class="panel-heading d-flex justify-between">
										CONFIGURACIÓN DE ALARMAS (PASO 3)
										<button class="btn btn-xs btn-warning" type="button" data-toggle="collapse" data-target="#panel-alarma">
											<i class="fa fa-plus"></i>
										</button>
									</div>
									<div id="panel-alarma" class="panel-body collapse in">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group" :class="emptyAlarma">
                                                    <label> Seleccione y agregue la Fecha y Hora de Alarma *</label>
                                                    <span @click="disabledBtnCreateAlarma">
                                                        <datetime
                                                        type="datetime" input-class="form-control"
                                                        use12-hour
                                                        v-model="dataAlarma"
                                                        title='Alarma de previo aviso'
                                                        :phrases="{ok: 'Seleccionar', cancel: 'Cancelar'}"

                                                        >
                                                        </datetime>
                                                        <!-- :max-datetime="initializeMaxTimeAlarm" -->
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="d-flex flex-column">
                                                     <label>Acciones</label>
                                                    <button id="btn-aniadir-alarma" class="btn btn-primary" type="button" @click="aniadirAlarma" disabled>Añadir Alarma</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <template v-if="alarmas.length > 0">
                                                    <div class="d-flex flex-column">
                                                    <label>Alarmas creadas para avisarme previamente
                                                    </label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div v-for="(alarma, index) in alarmas" :key="index" class="badge fontsize16 bg-primary" style="padding: 7px;margin-right: 10px" >
                                                             {{alarma}} <i class="fas fa-times"></i>
                                                        </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                </template>
                                            </div>
                                        </div>


									</div>
									<div class="panel-footer">

										<button class="btn btn-primary" id="crear-informe" @click="crearInforme">
											<i class="fas fa-stopwatch"></i> Crear Informe
										</button>
										<!-- <button class="btn btn-danger" id="solicitar-retiro" @click="solicitarRetiro()" :disabled="usuario_retirado >= 1 || !permisos_asignados.length">
											<i class="fas fa-user-slash"></i> Solicitar retiro
										</button> -->
										<!-- <button class="btn" id="imprimir-paz-salvo" @click="imprimirPazYSalvo()" :class="usuario_retirado ? 'btn-success' : 'btn-defualt'" :disabled="!(usuario_retirado == 2)">
											<i class="far fa-file-pdf"></i> Imprimir paz y salvo
										</button> -->
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

        </section>
    </div>
</template>

<script>

import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css';
import $ from 'jquery';
import { formatDate, removeBlankSpaces, formatISO8601, addDays, addMonths, addYear } from './utilities';
import URL_HUEM from './utilities';

export default {

  components: {
        vueDropzone: vue2Dropzone,
        datetime: Datetime
  },

  mounted: function() {

            this.getAllEntes();
            this.getAllDependencias();
            this.initizalizeCalendar();
        },

		data: function() {
			return ({
                file: '',
                fechaEntrega: '', fechaLimite: '', dataEntrega: '', dataAlarma: '', dataEntrega: '', dataFinalizacion: '', evidencias : [], rawDataAlarmas: [], alarmas: [], horaLimite: '',
                nombreInforme: '', idDependencia: '', responsableDependencia: '', emailDependencia: '',
                nuevoEnte: '', cantidadFinalizacion: 1,
                entesControl: [],
                dependencias: [],
                personalizado: false,
                esSemanal: true,
                cantidad: 1,
                repeticion: 1,
                tipopersonalizado: '',
                enteSelect: {},
                nombreEnteSelect: '', idEnteSelect: '', periodoSelect: '',
                dependenciaSelect: '',
                alarmaSelect: '',
                validatedata: false,
                maxTimeAlarm: '',
                minTimeDataLimit: '',
                dataInitialCalendar:'',
                periodoRepeticion: '',
                periodo: 'D', agregarCantidad: 0,
                entregas: [],
                dropzoneOptions: {
                    url: 'https://httpbin.org/post',
                    thumbnailWidth: 200,
                    thumbnailHeight: 200,
                    maxFilesize: 10,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Borrar',
                    uploadMultiple: true,
                    maxFiles: 10,
                    parallelUploads: 10
                }


			})
		},
		computed: {

            enabledDateLimit: function(){

                return this.dataEntrega == ''

            },

            initializeMinDateLimit(){

                if(this.dataEntrega != ''){

                    this.minTimeDataLimit = formatISO8601(new Date(this.dataEntrega));
                    console.log(this.minTimeDataLimit);
                    return this.minTimeDataLimit;

                }

            },

            initializeMaxTimeAlarm(){

                if(this.dataEntrega != ''){

                    this.maxTimeAlarm = formatISO8601(new Date(this.dataEntrega));
                    console.log(this.maxTimeAlarm)
                    return this.maxTimeAlarm

                }

                return this.dataInitialCalendar;

            },

            emptyNombre: function(){
                if(this.validatedata){
                    return removeBlankSpaces(this.nombreInforme) == '' ? ' has-error' : ''
                }
                return ''
            },

            emptyEnte: function(){
                if(this.validatedata){
                    return this.idEnteSelect == '' ? ' has-error' : ''
                }
                return ''
            },

            emptyFile: function(){
                if(this.validatedata){
                    return this.file == '' ? ' has-error' : ''
                }
                return ''
            },
            inputError: function(){
                if(this.validatedata){
                    return this.file == '' ? ' has-error-input' : ''
                }
                return ''
            },
            emptyDependencia: function(){
                if(this.validatedata){
                    return this.idDependencia == '' ? ' has-error' : ''
                }
                return ''
            },
            emptyFechaEntrega: function(){
                if(this.validatedata){
                    return this.dataEntrega == '' ? ' has-error' : ''
                }
                return ''
            },
            emptyPeriodoSelect: function(){
                if(this.validatedata){
                    return this.periodoSelect == '' ? ' has-error' : ''
                }
                return ''
            },

            emptyDataFinalizacion: function(){
                if(this.validatedata){
                    return this.dataFinalizacion == '' ? ' has-error' : ''
                }
                return ''
            },

            emptyAlarma: function(){
                if(this.validatedata){
                    return this.dataAlarma == '' ? ' has-error' : ''
                }
                return ''
            }


        },

		methods: {

            disabledBtnCreateAlarma: function(){
                if(this.dataAlarma != ''){
                    document.getElementById('btn-aniadir-alarma').disabled = false
                }
            },

            enabledFechaFinalizacion: function(){
                 document.getElementById('data-finalizacion').disabled = false
            },

            initizalizeCalendar(){

                this.dataInitialCalendar = formatISO8601(new Date());

            },

            getAllEntes: function(){

                axios.get(`${URL_HUEM}/entes_control/entes`)
                .then( res => {

                    this.entesControl = res.data.entes
                    })
            },

            getAllDependencias: function(){

                axios.get(`${URL_HUEM}/entes_control/dependencias`)
                .then( res => {
                    this.dependencias = res.data.dependencias
                     })
            },

            getPeriodoRepeticion: function(periodoselected){
                this.personalizado = periodoselected == 4

                if (periodoselected != 'D' || periodoselected != 'Q'){
                    if (periodoselected != 'A'){
                        this.periodo = 'M'
                    } else {
                        this.periodo = 'A'
                    }
                }

                if(periodoselected == 'D' || periodoselected == 'M' || periodoselected == 'A'){
                    this.agregarCantidad = 1
                } else if(periodoselected == 'Q'){
                    this.agregarCantidad = 15
                } else if(periodoselected == 'B'){
                    this.agregarCantidad = 2
                } else if(periodoselected == 'T'){
                    this.agregarCantidad = 3
                } else if(periodoselected == 'C'){
                    this.agregarCantidad = 4
                } else if(periodoselected == 'S'){
                    this.agregarCantidad = 6
                }



            },

            getPeriodoAlarma: function(selected){

            },

            getPersonalizado: function( textpersonalizado ){
                console.log(textpersonalizado)
                console.log(this.cantidad)
            },

            getEnteSelected: function(enteSelected){

                this.nombreEnteSelect = enteSelected.nombre;
                this.idEnteSelect = enteSelected.id;
                // document.getElementById('btn-editar-ente').disabled = false;


            },

            getDependenciaSelected: function(dependenciaSelected){

                this.idDependencia = dependenciaSelected.id
                this.responsableDependencia = dependenciaSelected.responsable
                this.emailDependencia = dependenciaSelected.correo_responsable


            },

            handleFileUpload(){
                this.file = this.$refs.file.files[0];

            },

            aniadirNuevoEnte: function(){

                axios.post('http://localhost:3000/entes_control/crear_ente',
                           { nombre: this.nuevoEnte },
                           { headers: {'Content-Type': 'application/json'}})
                .then( res => {
                    // fa-exclamation fa-exclamation-circle
                    if(!res.data.error){
                        $('#modalNuevoEnte').modal('hide');
                        this.getToast('success', 'Nuevo Ente de Control Creado con éxito', 'fa-check');
                        this.limpiarInputEnte();
                        this.getAllEntes();
                    } else {
                        $('#modalNuevoEnte').modal('hide');
                        this.getToast('error', 'Ocurrio un error intente nuevamente', 'fa-times');
                        this.limpiarInputEnte();
                    }
                })

            },

            editarNombreEnte: function() {

                axios.post(`${URL_HUEM}/entes_control/editar_ente`, { id: this.idEnteSelect,nuevoNombre: this.nombreEnteSelect }, { headers: {'Content-Type': 'application/json'} })
                .then(res => {
                    console.log(res)
                    if(!res.data.error){
                        $('#modalEditarEnte').modal('hide');
                        this.getToast('success', `${res.data.message}`, 'fa-check');
                        this.limpiarInputEnte();
                        this.getAllEntes();
                    } else {
                        $('#modalEditarEnte').modal('hide');
                        this.getToast('error', 'Ocurrio un error intente nuevamente', 'fa-times');
                        this.limpiarInputEnte();
                    }
                })

            },

            limpiarInputEnte: function(){
                this.nuevoEnte = ''
                this.nombreEnteSelect = ''
                this.idEnteSelect = ''
            },

            aniadirAlarma: function(){

                 this.alarmas.push(formatDate(new Date(this.dataAlarma)));
                 this.rawDataAlarmas.push(new Date(this.dataAlarma));

                 console.log(this.rawDataAlarmas);

            },

            crearInforme(){



                // this.crearFechasEntregas();

                this.validatedata = true
                if(removeBlankSpaces(this.nombreInforme) == ''){

                    this.getToast('info', 'Debe asignar un nombre al informe', 'fa-times')
                    // document.getElementById('divnombre').classList.add('has-error')

                } else if(this.idEnteSelect == ''){

                    this.getToast('info', 'Debe seleccionar el ente al que se realiza el informe', 'fa-times')

                } else if(this.file == ''){

                    this.getToast('info', 'Debe seleccionar el archivo correspondiente a la normativa del informe', 'fa-times')

                } else if(this.idDependencia == ''){

                    this.getToast('info', 'Debe seleccionar la dependencia responsable', 'fa-times')


                } else if(this.dataEntrega == ''){
                    this.getToast('info', 'Debe seleccionar la fecha de entrega del informe', 'fa-times')
                }
                  else if(this.periodoSelect == ''){
                    this.getToast('info', 'Debe seleccionar el periodo de repetición de informe', 'fa-times')
                }

                //   else if(this.dataFinalizacion == ''){

                //     this.getToast('info', 'Debe seleccionar hasta que fecha se entregará este informe', 'fa-times')

                // }

                else if(this.dataAlarma == ''){


                    this.getToast('info', 'Debe crear mínimo una alarma para el informe ', 'fa-times')

                } else if(this.rawDataAlarmas.length < 1) {

                    this.getToast('info', 'Debe crear mínimo una alarma para el informe ', 'fa-times')

                } else {

                    let formData = new FormData();
                    formData.append('nombre', this.nombreInforme);
                    formData.append('id_ente_control', this.idEnteSelect);
                    formData.append('id_dependencia', this.idDependencia);
                    formData.append('normativa', this.file);
                    formData.append('fecha_entrega', new Date(this.dataEntrega));
                    formData.append('fecha_final_entregas', new Date(this.dataFinalizacion));
                    // formData.append('alarmas', JSON.stringify(this.rawDataAlarmas))
                    this.rawDataAlarmas.map( alarma => {
                        formData.append('alarmas[]', new Date(alarma));
                    });

                    axios.post(`${URL_HUEM}/entes_control/crear_informe`,
                    formData,
                    { headers: {'Content-Type':'multipart/form-data'} })
                    .then( res => {
                        if(!res.data.error){
                            // this.getToast('success', `${res.data.message}`, 'fa-check')
                            Swal({ title: 'Informe creado exitosamente', type: 'success', showConfirmButton: false, timer: 3000 });

                        }else {

                            Swal({ title: 'Informe creado exitosamente', type: 'error', showConfirmButton: false, timer: 3000 });

                            // console.log(res.data.errorMessage)
                            // this.getToast('error', `${res.data.message}`, 'fa-times')
                        }

                    })

                }



            },

            loadMulipleFiles(files, response){

                this.evidencias = files
                console.log(files)

            },

            getToast: function( type, message, iconFontAwesome ){

                this.$toasted.show(`${message}`,
                        {
                            icon: { name: `${iconFontAwesome}` },
                            type: `${type}`,
	                        position: "bottom-right",
                            duration : 5000
                        }).goAway(2000);
            },

            cleanInputs: function(){

                this.nombreInforme = '';
                this.idEnteSelect = '';
                this.file = '';
                this.idDependencia = '';
                this.dataEntrega = '';
                this.periodoSelect = '';
                this.dataFinalizacion = '';
                this.dataAlarma = '';
                this.rawDataAlarmas = [];
                this.validatedata = false;

            },

            crearFechasEntregas: function(){

                console.log(this.dataEntrega)
                console.log(this.agregarCantidad)
                console.log(this.periodoSelect)

                if(this.periodoSelect == 'Q' || this.periodoSelect == 'D'){

                    let tempCurrentFecha = ''
                    for (let index = 0; index < this.cantidadFinalizacion; index++) {
                        if(tempCurrentFecha == ''){
                            tempCurrentFecha = addDays(new Date(this.dataEntrega), this.agregarCantidad);
                            this.entregas.push(tempCurrentFecha)
                        }
                        else {
                            tempCurrentFecha = addDays(new Date(tempCurrentFecha), this.agregarCantidad)
                            this.entregas.push(tempCurrentFecha);
                        }
                    }

                    console.log('diariamente', this.entregas)


                } else if (this.periodoSelect == 'A') {

                    let tempCurrentFecha = ''
                    for (let index = 0; index < this.cantidadFinalizacion; index++) {
                        if(tempCurrentFecha == ''){
                            tempCurrentFecha = addYear(new Date(this.dataEntrega), this.agregarCantidad);
                            this.entregas.push(tempCurrentFecha)
                        }
                        else {
                            tempCurrentFecha = addYear(new Date(tempCurrentFecha), this.agregarCantidad)
                            this.entregas.push(tempCurrentFecha);
                        }
                    }
                    console.log('anuales', this.entregas)
                } else {

                    let tempCurrentFecha = ''
                    for (let index = 0; index < this.cantidadFinalizacion; index++) {
                        if(tempCurrentFecha == ''){
                            tempCurrentFecha = addMonths(new Date(this.dataEntrega), this.agregarCantidad);
                            this.entregas.push(tempCurrentFecha)
                        }
                        else {
                            tempCurrentFecha = addMonths(new Date(tempCurrentFecha), this.agregarCantidad)
                            this.entregas.push(tempCurrentFecha);
                        }
                    }
                    console.log('mensuales',this.entregas)

                }


                // periodo: 'D', agregarCantidad: 0,
                // cantidadFinalizacion

                // for (let index = 0; index < array.length; index++) {
                //     const element = array[index];

                // }

            }
		}
	}
</script>

<style scoped>

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

    .bg-primary{
        background-color: #337ab7;
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

    .has-error-input{
        border: solid red 0.5px;
    }

</style>
