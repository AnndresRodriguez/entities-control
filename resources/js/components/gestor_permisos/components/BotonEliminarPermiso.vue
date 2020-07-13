<template>
	<button class="btn btn-sm btn-danger" title="Eliminar este permiso" @click="eliminarPermiso()" :disabled="disabled">
		<i class="fas fa-trash-alt"></i>
	</button>
</template>

<script>
	import EventBus from './../../../EventBus'; 

	export default {
		props: {
            permiso: {
            	type: Object,
            },
            habilitado: {
            	type: Number,
            }
        },
        data: function() {
            return({
                //datos: ''
            })
        },
        computed: {
        	disabled: function() {
        		//alert('Boton eliminar - disabled');
        		return parseInt(this.permiso.estado) > parseInt(this.habilitado);
        	}
        },
        watch: {
        	//'permiso.d'
        },
		methods: {
			eliminarPermiso: function() {
				let interceptor = this.setInterceptorAxios('Eliminado solicitud de permiso');

				axios.delete(`/gesper_permisos_usuario/${this.permiso.id}`)
				.then(() => {
					EventBus.$emit('permisoEliminadoCorrectamente');
				})
				.catch((errors) => {
					console.log(errors);

					this.mostrarErroresHttpAxios(errors);
				})
				.then(() => {
					Swal.close();
				});

				axios.interceptors.request.eject(interceptor);
			}
		},
	}
</script>