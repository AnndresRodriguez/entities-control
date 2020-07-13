<template>
	<div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Gestor de Permisos
                <small>Solicitar permisos</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Gestor de Permisos</router-link></li>
                <li class="active">Solicitar permisos</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
					<!-- DIV BOX INCIO -->
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">SOLICITAR PERMISOS</h3>
						</div>

						<div class="box-body">
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

	                        <div class="col-xs-12"></div>

	                        <!--- SEGUNDA LINEA -->

							<div class="col-xs-12" id="listado-permisos-asignados">
								<div class="panel panel-primary">
									<div class="panel-heading flex">
										LISTADO DE PERMISOS ASIGNADOS
										<button class="btn btn-xs btn-warning" type="button" data-toggle="collapse" data-target="#panel-permisos-asignados">
											<i class="fa fa-plus"></i>
										</button>
									</div>
									<div id="panel-permisos-asignados" class="panel-body collapse in">
										<ul class="list-group">
											<template v-if="permisos_asignados.length">
												<permiso-asignado v-for="permiso in permisos_asignados" :key="permiso.id" :permiso="permiso">
												</permiso-asignado>
												
											</template>
											<template v-else>
												<li class="list-group-item">
													No se le ha asignado a ningun permiso a la fecha.
												</li>
											</template>
										</ul>
									</div>
									<div class="panel-footer">
										<button class="btn btn-primary" id="renovar-permisos" @click="renovarPermisos()" :disabled="usuario_retirado >= 1 || !permisos_asignados.length">
											<i class="fas fa-stopwatch"></i> Renovar permisos
										</button>
										<button class="btn btn-danger" id="solicitar-retiro" @click="solicitarRetiro()" :disabled="usuario_retirado >= 1 || !permisos_asignados.length">
											<i class="fas fa-user-slash"></i> Solicitar retiro
										</button>
										<button class="btn" id="imprimir-paz-salvo" @click="imprimirPazYSalvo()" :class="usuario_retirado ? 'btn-success' : 'btn-defualt'" :disabled="!(usuario_retirado == 2)">
											<i class="far fa-file-pdf"></i> Imprimir paz y salvo
										</button>
									</div>
								</div>
							</div>


							<div class="col-xs-12" id="listado-permisos-solicitar">
								<div class="panel panel-success">
									<div class="panel-heading flex">
										<p>LISTADO DE PERMISOS A SOLICITAR</p>
										<button class="btn btn-xs btn-warning" type="button" data-toggle="collapse" data-target="#panel-solicitar-permisos">
											<i class="fa fa-plus"></i>
										</button>
									</div>
									<div id="panel-solicitar-permisos" class="panel-body collapse in">
										<ul class="list-group">
											<template v-if="permisos_solicitados.length">
												<li v-for="proceso in permisos_solicitados" :key="proceso.id" class="list-group-item">
													<div class="flex">
														<div class="flex">
															{{ proceso.ruta_permiso }}
														</div>
														<div class="flex-buttons">
															<boton-permiso :proceso="proceso" llave="ver" nombre="Ver"></boton-permiso>
															<boton-permiso :proceso="proceso" llave="agregar" nombre="Agregar"></boton-permiso>
															<boton-permiso :proceso="proceso" llave="editar" nombre="Editar"></boton-permiso>
															<boton-permiso :proceso="proceso" llave="imprimir" nombre="Imprimir"></boton-permiso>
															<boton-permiso :proceso="proceso" llave="exportar" nombre="Exportar"></boton-permiso>
															<boton-permiso :proceso="proceso" llave="eliminar" nombre="Eliminar"></boton-permiso>
														</div>
													</div>
												</li>
											</template>
											<template v-else>
												<li class="list-group-item">
													No ah seleccionado ningun permiso.
												</li>
											</template>
										</ul>
									</div>
									<div class="panel-footer">
										<button class ="btn btn-primary" id="solicitar-permisos" @click="solicitarPermisos()" :disabled="usuario_retirado">
											<i class="fas fa-paper-plane"></i> Solcitar permisos
										</button>
									</div>
								</div>
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
	import EventBus from './../../EventBus';
	import PermisoAsignado from './components/solicitar_permisos/PermisoAsignado';
	import Software from './components/solicitar_permisos/Software';
	import BotonPermiso from './components/solicitar_permisos/BotonPermiso';

	export default {
		components: {
			PermisoAsignado,
			Software,
			BotonPermiso,
		},
		data: function() {
			return ({
				permisos_asignados: [],

				permisos_solicitados: [],

				softwares: [],

				solicitud_retiro: false,
			})
		},
		computed: {
			jefe_inmediato_nombre: function() {
				try {
					return `${this.currentUser.jefe_inmediato.empleado.nombres} ${this.currentUser.jefe_inmediato.empleado.apellidos}`
				}
				catch (error) {}

				return 'No asignado';
			},

			jefe_inmediato_correo: function() {
				try {
					return this.currentUser.jefe_inmediato.email || 'No asignado'
				}
				catch (error) {}

				return 'No asignado';
			},

			usuario_retirado: function() {
				try {
					return this.solicitud_retiro || this.currentUser.solicitud_retiro.estado;
				}
				catch (error) {}

				return false;
			},
		},
		created: function() {
			EventBus.$on('agregarProcesoConLosPermisosAlListado', proceso => this.agregarProcesoConLosPermisosAlListado(proceso));

			EventBus.$on('eliminarProcesoDelListadoDePermisos', proceso => this.eliminarProcesoDelListadoDePermisos(proceso));

			EventBus.$on('permisoEliminadoCorrectamente', () => this.getListadoDePermisosAsignados());
		},
		methods: {
			getListadosoftwares: function() {
                axios.get('/gesper_softwares')
                .then(response => {
                    this.softwares = response.data;
                })
                .catch(errors => {
					this.mostrarErroresHttpAxios(errors);
				})
			},
			
			agregarProcesoConLosPermisosAlListado: function(proceso) {
				//console.log('agregarProcesoConLosPermisosAlListado', proceso);

				if( this.permisos_solicitados.indexOf(proceso) === -1 ){
					this.permisos_solicitados.push(proceso);
				}
			},

			eliminarProcesoDelListadoDePermisos: function(proceso) {
				let index = this.permisos_solicitados.indexOf(proceso); 
				//console.log('index', index);

				if( index >= 0 ){
					this.permisos_solicitados.splice(index, 1);
				}
			},

			solicitarPermisos: function() {
				let permisos = this.permisos_solicitados;

				if( !this.validarDatos(permisos) ) {
					return false;
				}
				else {
					let interceptor = this.setInterceptorAxios('Registrando solicitud permisos, espere un momento.');

					axios.post('/gesper_permisos_usuario/store', permisos)
						.then(response => {
							this.permisos_solicitados = [];

							Swal.fire({
								type: 'success',
								width: '60rem',
								title: `Su solicitud de permisos sé registro correctamente.`,
							});

							this.getListadoDePermisosAsignados();
							this.deseleccionarPermisosSofwares();
						})
						.catch(errors => {
							this.mostrarErroresHttpAxios(errors);
						})

					axios.interceptors.request.eject(interceptor);
				}
			},

			validarDatos: function(permisos) {
				let mensaje  = '';

				if( this.jefe_inmediato === 'No asignado' ) {
					mensaje = 'No puede solicitar permisos debido a que no se le ah asignado un jefe inmediato.';
				}
				else if( !permisos.length ){
					mensaje = 'No ha seleccionado ningun permiso.';
				}

				if( mensaje ) {
					Swal.fire({
						type: 'error',
						width: '60rem',
						title: mensaje,
					});

					return false;
				}

				return true;
			},

			getListadoDePermisosAsignados: function() {
				axios.get('/gesper_permisos_usuarios')
                .then(response => {
                    this.permisos_asignados = response.data.sort((a, b) => {
						return a.proceso.ruta_permiso.localeCompare(b.proceso.ruta_permiso);
					});
                })
                .catch(errors => {
                	console.log(errors);

					this.mostrarErroresHttpAxios(errors);
				})
			},

			deseleccionarPermisosSofwares: function() {
				EventBus.$emit('deseleccionarPermisosSofware');
			},

			renovarPermisos: function() {
				let permisos = this.permisos_asignados.filter(permiso => permiso.selected);

				if( !this.validarDatos(permisos) ) {
					return false;
				} else {
					Swal.fire({
	                    title: `¿Está realmente seguro de querer renovar sus permisos?`,
	                    type: 'warning',
	                    width: 545,
	                    showCancelButton: true,
	                    confirmButtonColor: '#3085d6',
	                    cancelButtonColor: '#d33',
	                    confirmButtonText: 'Renovar permisos',
	                    cancelButtonText: 'Cancelar',
	                }).then((result) => {
	                    if (result.value) {
	                        axios.post(`/gesper_permisos_usuario/renovar`, permisos)
	                        .then(response => {
	                            Swal.fire({
	                                type: 'success',
	                                width: 550,
	                                title: 'Registro exitoso!',
	                                text: 'Su solicitud de renovación de permisos sé registro correctamente.',
	                            });

	                            this.getListadoDePermisosAsignados();
	                        })
	                        .catch(errors => { 
	                            this.mostrarErroresHttpAxios(errors);
	                        });
		                }
		            });
				}
			},

			solicitarRetiro: function() {
				Swal.fire({
                    title: `¿Está realmente seguro de solicitar el retiro de sus permisos?`,
                    type: 'warning',
                    width: 545,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Solicitar retiro',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        axios.post(`/gesper_solicitud_retiro`)
                        .then(response => {
                            this.solicitud_retiro = true;

	                        Swal.fire({
                                type: 'success',
                                width: 550,
                                title: 'Registro exitoso!',
                                text: 'Su solicitud de retiro de permisos sé registro correctamente.',
                            });
                        })
                        .catch(errors => { 
                            this.mostrarErroresHttpAxios(errors);
                        });
	                }
	            });
			},

			imprimirPazYSalvo: function() {
				let id = btoa(this.currentUser.solicitud_retiro.id);

				let widthW = window.innerWidth;
                let left   = parseInt(widthW * 5 / 100);
                let ancho  = parseInt(widthW - (left * 2));
                let alto   = parseInt(window.innerHeight);

                let url = `/gestor_permisos/solicitud_retiro/${id}/imprimir`;
                window.open( url, "_blank", "left="+ left +",width=" + ancho + ",height=" + alto );
				
				//Swal.fire('Generando PDF');
			},

		},
		mounted: function() {
			this.getListadoDePermisosAsignados();
			this.getListadosoftwares();

			//console.log(this.currentUser);
		},

		beforeDestroy: function() {
			EventBus.$off('agregarProcesoConLosPermisosAlListado');
			EventBus.$off('eliminarProcesoDelListadoDePermisos');
			EventBus.$off('permisoEliminadoCorrectamente');
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