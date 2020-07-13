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
            	<item-permiso-asignado v-for="item in items_permiso" :key="item.llave" :permiso="permiso" :llave="item.llave" :nombre="item.nombre">	
            	</item-permiso-asignado>
            </div>
            <div class="permiso-estado">
                <div>
                    <p class="mr-15" v-text="permiso.fecha_vencimiento || ''"></p>
                </div>
                <div>
                    <boton-estado-permiso :estado="permiso.estado"></boton-estado-permiso>
                    <boton-eliminar-permiso :permiso="permiso" :habilitado="1"></boton-eliminar-permiso>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
	import EventBus from './../../../../EventBus';
	import ItemPermisoAsignado from './permiso_asignado/ItemPermisoAsignado';
    import BotonEstadoPermiso from './../BotonEstadoPermiso';
    import BotonEliminarPermiso from './../BotonEliminarPermiso';

    export default {
    	components: {
    		ItemPermisoAsignado,
            BotonEstadoPermiso,
            BotonEliminarPermiso,
    	},
        props: {
            permiso: {
                type: Object,
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
            //
        },
        created: function() {
            this.$set(this.permiso, 'selected', false);
        },
        methods: {
            //getNombreRutaPermiso: function() {
            //	return `${this.permiso.proceso.modulo.software.nombre} >> ${this.permiso.proceso.modulo.nombre} >> ${this.permiso.proceso.nombre}`;
            //},
        },
        mounted: function() {
            //console.log('Soli - permiso_asignado');
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
	    justify-content: flex-end;
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