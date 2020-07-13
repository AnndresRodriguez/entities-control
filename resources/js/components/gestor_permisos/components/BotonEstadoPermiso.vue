<template>
	<button :class="clase" :title="title">
		<i :class="icono"></i>
	</button>
</template>

<script>
	export default {
		props: {
            estado: {
                type: Number,
            },
        },
        data: function() {
            return({
                clase: '',
                title: '',
                icono: '',
            })
        },
		watch: {
			'estado': function() {
				this.asignarPropiedadesBoton();
			}
		},
		methods: {
			asignarPropiedadesBoton: function() {
				if( this.estado == 1 ){
					this.clase = 'btn btn-sm btn-warning';
					this.title = 'Permiso pendiente por aprobación del jefe inmediato';
					this.icono = 'fas fa-history';
				}
				else if( this.estado == 2 ){
					this.clase = 'btn btn-sm btn-primary';
					this.title = 'Permiso pendiente por asignación del administrador de sistemas';
					this.icono = 'fas fa-history';
				}
				else if( this.estado == 3 ){
					this.clase = 'btn btn-sm btn-success';
					this.title = 'Permiso asignado';
					this.icono = 'fas fa-check';
				}
			}
		},
		mounted: function() {
			this.asignarPropiedadesBoton();
		}
	}
</script>