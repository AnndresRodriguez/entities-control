<template>
<div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Entes de Control
                <small>Cargar Evidencia</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Cargar Evidencia</router-link></li>
                <li class="active">Cargar Evidencia</li>
        </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
					<!-- DIV BOX INCIO -->
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">CARGAR EVIDENCIA</h3>
						</div>

						<div class="box-body">
							<div class="col-xs-6">
	                            <div class="form-group">
	                                <label> Nombre del Informe * </label>
	                                <input type="text" class="form-control" required>
	                            </div>
	                        </div>

	                        <div class="col-xs-6">
	                            <div class="form-group">
	                                <label> Ente de Control * </label>
	                                <select class="form-control" id="exampleFormControlSelect1">
                                        <option>Ministerio de Salud</option>
                                        <option>Contraloría General de la República</option>
                                        <option>Procuraduría General de la Nación</option>
                                        <option>Fiscalía General de la Nación</option>
                                        <option>Congreso de la República</option>
                                        <option>Contaduría General de la Nación</option>
                                    </select>
	                            </div>
	                        </div>

                            <div class="col-xs-6">
	                            <div class="form-group">
	                                <label> Seleccione el Informe correspondiente </label>
	                                <select class="form-control" id="exampleFormControlSelect1">
                                        <option>Informe 1</option>
                                        <option>Informe 2</option>
                                        <option>Informe 3</option>
                                        <option>Informe 4</option>
                                    </select>
	                            </div>
	                        </div>
                            <div class="col-xs-6">
	                            <div class="form-group">
	                                <label> Dependencia Responsable * </label>
	                                <select class="form-control" id="exampleFormControlSelect1">
                                        <option>SIAU</option>
                                        <option>SISTEMAS</option>
                                        <option>RECURSOS HUMANOS</option>
                                        <option>DOCENCIA</option>
                                    </select>
	                            </div>
	                        </div>



	                        <div class="col-xs-12"></div>

	                        <!--- SEGUNDA LINEA -->

							<div class="col-xs-12" id="listado-permisos-asignados">
								<div class="panel panel-primary">
									<div class="panel-heading flex">
										EVIDENCIAS SUBIDAS
										<button class="btn btn-xs btn-warning" type="button" data-toggle="collapse" data-target="#panel-permisos-asignados">
											<i class="fa fa-plus"></i>
										</button>
									</div>
									<div id="panel-permisos-asignados" class="panel-body collapse in">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                             <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">Fecha de Creación</th>
                                                    <th scope="col">Estado de evidencia</th>
                                                    <th scope="col">Fecha de Carga</th>
                                                    <th scope="col">Evidencias</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <th scope="row">06/06/2020</th>
                                                        <td>
                                                            <span class="badge bg-warning fontsize16">Pendiente</span>
                                                        </td>
                                                        <td>
                                                            <span class="fontsize16">06/06/2020</span> </td>
                                                        <td>
                                                            <div class="dflex justify-around">
                                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                                                    <i class="fas fa-upload"></i>
                                                                    Cargar
                                                                </button>

                                                                <button class="btn btn-primary">
                                                                    <i class="fas fa-eye"></i>
                                                                    Visualizar

                                                                </button>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    <th scope="row">03/06/2020</th>
                                                        <td>
                                                            <span class="badge bg-success fontsize16">Completado</span>
                                                        </td>
                                                        <td><span class="fontsize16">03/06/2020</span> </td>
                                                        <td>
                                                            <div class="dflex justify-around">
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" disabled>
                                                                    <i class="fas fa-upload"></i>
                                                                    Cargar
                                                                </button>

                                                            <button class="btn btn-primary">
                                                                    <i class="fas fa-eye"></i>
                                                                    Visualizar

                                                            </button>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    <th scope="row">03/06/2020</th>
                                                        <td>
                                                            <span class="badge bg-success fontsize16">Completado</span>
                                                        </td>
                                                        <td><span class="fontsize16">03/06/2020</span> </td>
                                                        <td>
                                                            <div class="dflex justify-around">
                                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" disabled>
                                                                        <i class="fas fa-upload"></i>
                                                                        Cargar
                                                                    </button>

                                                                    <button class="btn btn-primary">
                                                                        <i class="fas fa-eye"></i>
                                                                        Visualizar

                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </div>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Carga de Evidencias</h4>
        <p class="fontsize16" >Si las evidencias están completas marquelo en el check "Evidencias Completas"</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" :useCustomSlot=true>
            <h3 class="dropzone-custom-title">Arrastre y suba sus evidencias de Informe aquí</h3>
            <div class="subtitle">...o un Click para seleccionar desde su computador</div>
        </vue-dropzone>
      </div>
      <div class="modal-footer">

        <div class="dflex flex-row justify-between  align-items-center">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="evidencias">
                <label class="form-check-label fontsize16" for="exampleCheck1">Evidencias Completas</label>
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar Cambios</button>
            <button type="button" class="btn btn-success">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>
</div>


							<!-- <div class="col-xs-12" id="listado-de-softwares">
								<div>
									<software v-for="software in softwares" :key="software.id" :software="software">
									</software>
								</div>
							</div> -->
						</div>
					</div>
					<!-- DIV BOX CIERRE -->


                </div>
            </div>

        </section>
    </div>
</template>
<script>

import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {

    components: {
        vueDropzone: vue2Dropzone
    },

    data: function() {
			return ({
				permisos_asignados: [],
				permisos_solicitados: [],
				softwares: [],
                solicitud_retiro: false,
                personalizado: false,
                esSemanal: true,
                cantidad: 1,
                tipopersonalizado: '',
                periodo: '',
                dropzoneOptions: {
                    url: 'https://httpbin.org/post',
                    thumbnailWidth: 150,
                    maxFilesize: 0.5,
                    // headers: { "My-Awesome-Header": "header value" }
                }

			})
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

</style>
