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
                                                <input type="text" class="form-control" id="nombreInforme" placeholder="Ingrese el nombre del informe">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Filtrar por Dependencia</label>
                                                <select class="form-control" id="selectfrecuencia" required @change="getDependenciaSelected(dependenciaSelect)" v-model="dependenciaSelect">
                                                        <option selected="selected" value="" disabled="disabled">ELIJA UNA OPCIÓN</option>
                                                        <option v-for="(dependencia, index) in dependencias" :key="index" :value="index"> {{ dependencia.nombre }} </option>
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
                                            <div class="form-group">
                                             <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Fecha de Creación</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Ente de Control</th>
                                                        <th scope="col">Responsable</th>
                                                        <th scope="col">Dependencia</th>
                                                        <th scope="col">Estado</th>
                                                        <th scope="col">Evidencias</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(informe, index) in informes" :key="index">
                                                        <th scope="row">{{ informe.fechaCreacion }}</th>
                                                        <td>
                                                            <span class="fontsize16">{{ informe.nombre }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fontsize16">{{ informe.enteControl }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fontsize16">{{ informe.responsable }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="fontsize16">{{ informe.dependencia }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge fontsize16" :class="informe.estado ? 'bg-success': 'bg-warning'">{{ informe.estado ? 'Completado' : 'Pendiente' }}</span>
                                                        </td>
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
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet animi? Hic expedita possimus harum repellendus. Blanditiis error necessitatibus dignissimos?
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
						</div>
					</div>
					<!-- DIV BOX CIERRE -->


                </div>
            </div>

        </section>

    </div>
</template>
<script>

import util from './utilities'

export default {

    mounted(){
       axios.get('http://localhost:3000/entes_control/dependencias')
       .then( res => {
           this.dependencias = res.data.dependencias;
       })
    },

    data() {
        return {
            informes: util.informes,
            dependencias: [],
            dependenciaSelect: ''
        }
    },
    methods: {
        getDependenciaSelected(dependenciaSelected){
            console.log(dependenciaSelected)
        }
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
