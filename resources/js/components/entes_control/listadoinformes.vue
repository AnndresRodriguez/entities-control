<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Entes de Control
                <small>Listado de Informes</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Entes de Control</router-link></li>
                <li class="active">Listado de Informes</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
					<!-- DIV BOX INCIO -->
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">LISTADO DE INFORMES</h3>
						</div>

						<div class="box-body">


	                        <!--- SEGUNDA LINEA -->

							<div class="col-xs-12" id="listado-permisos-asignados">
								<div class="panel panel-primary">
									<div class="panel-heading flex">
										INFORMES ACTUALES
										<button class="btn btn-xs btn-warning" type="button" data-toggle="collapse" data-target="#panel-permisos-asignados">
											<i class="fa fa-plus"></i>
										</button>
									</div>
									<div id="panel-permisos-asignados" class="panel-body collapse in">

                                        <!-- <div class="col-md-4"></div> -->
                                        <div class="col-md-8">

                                          <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nombreInforme">Filtrar por nombre</label>
                                                <input type="text" class="form-control" id="nombreInforme" placeholder="Ingrese el nombre del informe"
                                                v-model="searchName"
                                                :disabled="disabledOption"
                                                >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Filtrar por Dependencia</label>
                                                <select class="form-control" id="selectfrecuencia" required @change="getDependenciaSelected(dependenciaSelect)" v-model="dependenciaSelect"
                                                :disabled="disabledOption">
                                                        <option selected="selected" value="" disabled="disabled">ELIJA UNA OPCIÓN</option>
                                                        <option v-for="(dependencia, index) in dependencias" :key="index" :value="dependencia.id"> {{ dependencia.nombre }} </option>
                                                 </select>
                                            </div>
                                           </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label> Año </label>
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option>2020</option>
                                                    <option>2019</option>
                                                    <option>2018</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-md-12">
                                            <template v-if="filterInformes.length == 0">
                                                        <div class="dflex flex-row justify-center" style="height:100%">
                                                         <label for="">No hay informes Para este año <a href="/entes_control/crear_informe"> Crear Informe</a></label>
                                                            <!-- <div class="lds-dual-ring"></div> -->
                                                        </div>
                                            </template>
                                            <template v-else>
                                            <div class="form-group">
                                             <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Fecha de Creación</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Ente de Control</th>
                                                        <th scope="col">Dependencia</th>
                                                        <th scope="col">Fecha Entrega</th>
                                                        <th scope="col">Estado</th>
                                                        <th scope="col">Acciones Evidencias</th>
                                                    </tr>
                                                </thead>


                                                    <tbody>
                                                        <tr v-for="(informe, index) in filterInformes" :key="index">

                                                        <td>
                                                            <span class="fontsize16">
                                                            {{ informe.fecha_creacion.split(' ')[0] }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fontsize16">{{ informe.nombre_informe }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fontsize16">{{ informe.nombre_ente }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fontsize16">{{ informe.nombre_dependencia }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fontsize18" style="background-color: #FFFCBA ">{{ informe.fecha_entrega.split(' ')[0] }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge fontsize16" :class="informe.estado == 1 ? 'bg-success': 'bg-warning'">{{ informe.estado ? 'Completado' : 'Pendiente' }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="dflex justify-around">
                                                                <span @click="setIdInforme(informe.id)">
                                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCargar"
                                                                    :disabled="informe.estado != 0">
                                                                    <i class="fas fa-upload"></i>
                                                                    Cargar
                                                                </button>
                                                                </span>
                                                                <span
                                                                 @click="getEvidencias(informe.id)"

                                                                 >

                                                                    <button type="button" class="btn btn-primary"
                                                                    data-toggle="modal"
                                                                    data-target="#modalVerEvidencias">
                                                                        <i class="fas fa-eye"></i>
                                                                        Ver
                                                                    </button>

                                                                </span>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                            </div>
                                            </template>
                                        </div>




									</div>
									<div class="panel-footer">
										<!-- <button class="btn btn-primary" id="renovar-permisos" @click="renovarPermisos()">
											<i class="fas fa-stopwatch"></i> Crear Informe
										</button> -->
										<!-- <button class="btn btn-danger" id="solicitar-retiro" @click="solicitarRetiro()" :disabled="usuario_retirado >= 1 || !permisos_asignados.length">
											<i class="fas fa-user-slash"></i> Solicitar retiro
										</button> -->
										<!-- <button class="btn" id="imprimir-paz-salvo" @click="imprimirPazYSalvo()" :class="usuario_retirado ? 'btn-success' : 'btn-defualt'" :disabled="!(usuario_retirado == 2)">
											<i class="far fa-file-pdf"></i> Imprimir paz y salvo
										</button> -->
									</div>
								</div>
							</div>
                            <!-- Modal -->
<div class="modal fade" id="modalCargar" tabindex="-1" role="dialog" aria-labelledby="modalCargarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalCargarLabel">Carga de Evidencias</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



        <label> Evidencias de informe</label>
            <vue-dropzone ref="myVueDropzone" id="myVueDropzone" :options="dropzoneOptions"  :useCustomSlot=true @vdropzone-success-multiple="loadMulipleFiles">
                <h3 class="dropzone-custom-title">Arrastre y suba sus evidencias de Informe aquí <i class="fa fa-upload" aria-hidden="true"></i></h3>
                <div class="subtitle">...o un Click para seleccionar desde su computador</div>
            </vue-dropzone>
      </div>
      <div class="modal-footer">

        <div class="dflex flex-row justify-between  align-items-center">

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar Cambios</button>
            <button type="button" class="btn btn-success" @click="sendEvidencias">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalVerEvidencias" tabindex="-1" role="dialog" aria-labelledby="modalVerEvidenciaslabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalVerEvidenciaslabel">Listado de Evidencias</h4>
        <p class="fontsize16" >Si están completas marquelo oprima el botón " Confirmar Evidencias Completas"</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="panel panel-default" style="margin-top: 10px">
            <div class="panel-heading">Evidencias Subidas</div>
            <div class="panel-body">
                 <template v-if="evidenciasModal.length == 0">
                     <div style="height: 100%" >
                         <label> Este informe no tiene evidencias asociadas</label>
                     </div>
                 </template>
                 <template v-else>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha de Subida</th>
                                <th>Archivo de Evidencia</th>
                                <!-- <th>Email</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(evidencia, index) in evidenciasModal" :key="index">
                            <td>{{ evidencia.fecha_creacion }}</td>
                            <td> <a :href="evidencia.url_evidencia" target="_blank"> {{ evidencia.nombre }}  </a> </td>
                        </tr>
                        </tbody>
                    </table>
                 </template>

            </div>
        </div>

      </div>
      <div class="modal-footer">

        <div class="dflex flex-row justify-between  align-items-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" @click="setStatusInforme">Confirmar Evidencias Completadas</button>
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

        </section>

    </div>
</template>
<script>

import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import URL_HUEM from './utilities';
import $ from 'jquery';

export default {

    components: {
        vueDropzone: vue2Dropzone
    },

    mounted(){
       this.getAllDependencies();
       this.getAllInformes();
    },

    data() {
        return {
            searchName: '',
            informes: [],
            dependencias: [],
            dependenciaSelect: '',
            evidencias: [],
            evidenciasModal: [],
            disabledOption: true,
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
            },
            idInformeSelected: 0
        }
    },
    computed: {

        filterInformes(){

            return this.informes.filter(informe => {
                    return informe.nombre_ente.toLowerCase().includes(this.searchName.toLowerCase())
             })
        }

    },
    methods: {
        getDependenciaSelected(dependenciaSelected){

            console.log(dependenciaSelected)
            axios.post(`${URL_HUEM}/entes_control/get_informes_dependencia`, { id_dependencia: dependenciaSelected }, {  headers: {'Content-Type': 'application/json'} })
            .then(res => {
                console.log(res.data.dataInforme)
                this.informes = res.data.dataInforme;
                // console.log(this.informes);
                // this.getAllInformes();
            })
        },

        getAllDependencies(){
            axios.get(`${URL_HUEM}/entes_control/dependencias`)
            .then( res => {
                this.dependencias = res.data.dependencias;
            })
        },

        getAllInformes(){
            axios.get(`${URL_HUEM}/entes_control/get_informes`)
                .then( res => {
                console.log(res.data.informes.length)
                this.informes = res.data.informes
                this.disabledOption = this.informes.length == 0
            })
        },

        loadMulipleFiles(files, response){

            this.evidencias = files
            console.log(files);

        },

        sendEvidencias(){

            let formData = new FormData();

            formData.append('id_informe', this.idInformeSelected)
            formData.append('evidencias[]', this.evidencias)
                this.evidencias.map( evidencia => {
                    formData.append('evidencia[]', evidencia);
            });

            axios.post(`${URL_HUEM}/entes_control/anexar_evidencias`, formData, {  headers: {'Content-Type': 'multipart/form-data'} })
            .then(res => {

                if(!res.data.error){
                    $('#modalCargar').modal('hide');
                    Swal({ title: `${res.data.message}`, type: 'success', showConfirmButton: false, timer: 2500 });
                }else {
                    $('#modalCargar').modal('hide');
                    Swal({ title: `${res.data.message}`, type: 'error', showConfirmButton: false, timer: 2500 });

                }



                // console.log(res.data.evidencias)

            })




        },

        setIdInforme(idselected){
            this.idInformeSelected = idselected;
        },


        setStatusInforme(){

            Swal.fire({
                title: '¿Las Evidencias de este Informe están completas?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00a65a',
                cancelButtonColor: '#d33',
                cancelButtonText: 'CANCELAR',
                confirmButtonText: 'CONFIRMAR'
                }).then((result) => {
                if (result.value) {

                    $('#modalVerEvidencias').modal('hide');
                    axios.post(`${URL_HUEM}/entes_control/set_status_informe`, { id_informe: this.idInformeSelected } , {
                headers: { 'Content-Type': 'application/json' }
            })
            .then( res => {
                if(!res.data.error){

                    this.getToast('success', `${res.data.message}`, 'fa-check');
                    this.getAllInformes();
                }else {

                    $('#modalVerEvidencias').modal('hide');
                    this.getToast('error', `${res.data.message}`, 'fa-times');
                }
            })



                    Swal.fire(
                    'Estado de Informe Actualizado',
                    'Las evidencias están completas',
                    'success'
                    )
                } else {
                    $('#modalVerEvidencias').modal('hide');
                }
                })





        },

        getEvidencias(idinforme){

            this.idInformeSelected = idinforme;

            axios.post(`${URL_HUEM}/entes_control/get_evidencias`, { id_informe: idinforme } , {
                headers: { 'Content-Type': 'application/json' }
            })
            .then( res => {
                this.evidenciasModal = res.data.evidencias
            })
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



    }

}
</script>
<style lang="css" scoped>

.dflex{
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

	.flex {
        display: flex;
        justify-content: space-between;
    }

    .flex-buttons {
        display: flex;
        justify-content: space-around;
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

 /* Spinner  */

.lds-dual-ring {
  display: inline-block;
  width: 80px;
  height: 80px;

}
.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 8px;
  border-radius: 50%;
  border: 6px solid #337ab7;
  border-color: #337ab7 transparent #337ab7 transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

</style>
