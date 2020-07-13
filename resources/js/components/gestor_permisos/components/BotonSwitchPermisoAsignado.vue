<template>
	<label class="switch">
	  <input type="checkbox" class="check-asignar-permiso" 
	  	:checked="permiso.estado === 3" 
	  	:disabled="disabled"
	  	@change="cambiarEstadoPermisoAsignado()">
	  <span class="slider round"></span>
	</label>
</template>

<script>
	export default {
		props: {
            permiso: {
                type: Object,
            },
            disabled: {
            	type: Boolean,
            }
        },
        data: function() {
            return({
                //
            })
        },
		watch: {
			//
		},
		methods: {
			cambiarEstadoPermisoAsignado: function() {
				let estado = parseInt(this.permiso.estado) === 3 ? 2 : 3;

				console.log(estado, parseInt(this.permiso.estado));

				axios.patch(`/gesper_permisos_usuario/${this.permiso.id}`, {
					estado: estado,
				})
				.then((response) => {
					this.permiso.estado = response.data.estado;
				})
				.catch((errors) => {
					console.log(errors);

					this.mostrarErroresHttpAxios(errors);
				});
			}
		},
	}
</script>

<style scoped>
	.switch {
	  position: relative;
	  display: inline-block;
	  width: 60px;
	  height: 34px;
	}

	.switch input { 
	  opacity: 0;
	  width: 0;
	  height: 0;
	}

	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	.slider:before {
	  position: absolute;
	  content: "";
	  height: 26px;
	  width: 26px;
	  left: 4px;
	  bottom: 4px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	input:checked + .slider {
	  background-color: #019934;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #019934;
	}

	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}

	.slider.round:before {
	  border-radius: 50%;
	}
</style>