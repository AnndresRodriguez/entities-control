<template>
	<div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Gestor de Permisos
                <small>Listado de softwares</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Gestor de Permisos</router-link></li>
                <li class="active">Listado de softwares</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
					<!-- DIV BOX INCIO -->
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">LISTADO DE SOFTWARES REGISTRADOS</h3>
						</div>

						<div class="box-body">
							<div class="col-xs-12" id="listado-permisos-solicitar">
                                <form action="/backend" method="POST" id="form-store-software" @submit.prevent="storeSoftware">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">REGISTRAR NUEVO SOFTWARE</div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label for="software-nombre">Nombre:</label>
                                                <input type="text" class="form-control" id="software-nombre" v-model="software.nombre" required>
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <button class="btn btn-primary" id="registrar-software">
                                                <i class="fas fa-paper-plane"></i> Registrar Software
                                            </button>
                                        </div>
                                    </div>
                                </form>
							</div>

							<div class="col-xs-12" id="listado-de-softwares">
								<div>
                                    <software v-for="software in softwares" :key="software.id" :software="software">
									</software>

                                    
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
	import Software from './components/registrar_softwares/Software';

	export default {
		components: {
			Software,
		},
		data: function() {
			return ({
                software: {
                    nombre: '',
                },

				softwares: [],
			})
        },
        methods: {
            storeSoftware: function() {
                if( !this.validarDatosDelFormulario() ){
                    return false;
                }

                axios.post('/gesper_software/store', this.software)
                .then(response => {
                    this.softwares.push(response.data);
                })
                .catch(error => {
                    console.log(error, error.errors);
                    this.mostrarErroresHttpAxios(error);
                })
            },

            validarDatosDelFormulario: function() {
                let software = this.software;

                if( software.nombre.length < 4 ){
                    Swal.fire({type: 'error', width: '60rem', title: 'Debe diligenciar un nombre de software con almenos 4 caracteres.'});
                    
                    return false;
                }

                return true;
            },

            getListadosoftwares: function() {
                axios.get('/gesper_softwares')
                .then(response => {
                    this.softwares = response.data;
                })
            },
        },
        mounted: function() {
            this.getListadosoftwares();
        },
	}
</script>

<style scoped>
	
	#listado-permisos-solicitar .panel-success {
        border-color: #d6e9c6 !important;
    }

</style>