<template>
    <li class="list-group-item">
        <div class="flex">
            <div class="permiso-ruta">
                <div v-if="permiso.selected">
                    <button type="button" class="btn btn-xs btn-success" @click="permiso.selected = !permiso.selected"> 
                        &#10004;
                    </button>
                </div>
                <div v-else class="input-checkbox" @click="permiso.selected = !permiso.selected">
                </div>

                <p class="nombre-proceso ml-5">{{ permiso.proceso.ruta_permiso }}</p>
            </div>
            <div class="permiso-permisos">
            	<item-permiso-solicitado v-for="item in items_permiso" :key="item.llave" :permiso="permiso" :llave="item.llave" :nombre="item.nombre">	
            	</item-permiso-solicitado>
            </div>
            <div class="permiso-estado">
                <div>
                    <input type="date" class="form-control input-sm" v-model="permiso.fecha_vencimiento">
                </div>
                <div>
                    <boton-estado-permiso :estado="permiso.estado"></boton-estado-permiso>
                    <boton-eliminar-permiso :permiso="permiso" :habilitado="2"></boton-eliminar-permiso>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    import EventBus from './../../../../EventBus';
	import ItemPermisoSolicitado from './ItemPermisoSolicitado';
    import BotonEstadoPermiso from './../BotonEstadoPermiso';
    import BotonEliminarPermiso from './../BotonEliminarPermiso';

    export default {
    	components: {
    		ItemPermisoSolicitado,
            BotonEstadoPermiso,
            BotonEliminarPermiso,
    	},
        props: {
            permiso: {
                type: Object,
                required: true,
            },
        },
        data: function() {
            return({
                items_permiso: [
                	{ nombre: 'Ver',       llave: 'ver' },
                    { nombre: 'Agregar',   llave: 'agregar' },
                    { nombre: 'Editar',    llave: 'editar' },
                    { nombre: 'Imprimir',  llave: 'imprimir' },
                    { nombre: 'Exportar',  llave: 'exportar' },
                    { nombre: 'Eliminar',  llave: 'eliminar' },
                ],
            })
        },
        computed: {
        	//
        },
        watch: {
            'permiso': function(newVal) {
                this.inicializarPropiedades();
            },
        },
        methods: {
            inicializarPropiedades: function() {
                this.$set(this.permiso, 'selected', true);
            }
        },
        mounted: function() {
            this.inicializarPropiedades();
        },
    }
</script>

<style scoped>
    .flex {
        display: flex;
        justify-content: space-between;
    }

    .permiso-ruta {
    	width: 40%;
	    display: flex;
	    justify-content: flex-start;
    }

    .permiso-permisos {
    	width: 40%;
	    display: flex;
	    justify-content: center;
    }

    .permiso-estado {
    	width: 20%;
	    display: flex;
	    justify-content: space-around;
    }

    .mr-15 {
        padding-right: 15px;
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