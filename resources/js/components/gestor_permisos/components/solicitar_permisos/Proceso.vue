<template>
    <li class="list-group-item">
        <div class="flex">
            <div class="flex">
                <template v-if="algun_permiso">
                    <div>
                        <button type="button" class="btn btn-xs btn-success" @click="seleccionarTodosLosPermisos()"> 
                            &#10004
                        </button>
                    </div>
                </template>
                <template v-else>
                    <div class="input-checkbox check-seleccionar-permisos" @click="seleccionarTodosLosPermisos()"></div>
                </template>
                <p class="nombre-proceso ml-5" @click="seleccionarTodosLosPermisos()">{{ proceso.nombre }}</p>
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

<script>
    import EventBus from './../../../../EventBus';
    import BotonPermiso from './BotonPermiso';

    export default {
        components: {
            BotonPermiso,
        },
        props: {
            software: {
                type: Object,
            },
            modulo: {
                type: Object,
            },
            proceso: {
                type: Object,
            },
        },
        data: function() {
            return({
                btn_events: true,
            })
        },
        computed: {
            algun_permiso: function() {
                return this.proceso.ver || this.proceso.agregar || this.proceso.editar || this.proceso.imprimir || this.proceso.exportar || this.proceso.eliminar;
            },

            ningun_permiso: function() {
                return !this.proceso.ver && !this.proceso.agregar && !this.proceso.editar && !this.proceso.imprimir && !this.proceso.exportar && !this.proceso.eliminar;
            },
        },
        watch: {
            'algun_permiso': function(newVal, oldVal){
                //console.log('algun_permiso', newVal, oldVal);

                if( newVal ){
                    EventBus.$emit('agregarProcesoConLosPermisosAlListado', this.proceso);
                } 
            },
            'ningun_permiso': function(newVal, oldVal){
                //console.log('ningun_permiso',newVal, oldVal);

                if( newVal ){
                    EventBus.$emit('eliminarProcesoDelListadoDePermisos', this.proceso);
                } 
            },
        },
        created: function() {
            this.$set(this.proceso, 'software', this.software.nombre);
            this.$set(this.proceso, 'modulo', this.modulo.nombre);
            this.$set(this.proceso, 'btnEvents', true);

            EventBus.$on('deseleccionarPermisosSofware', () => this.seleccionarTodosLosPermisos(false));
        },
        methods: {
            getIdentificador: function(indice){
                return `software-${this.software.id}-modulo-${this.modulo.id}-proceso-${this.proceso.id}`;
            },

            seleccionarTodosLosPermisos: function() {
                let valor = this.algun_permiso ? false : true;
                
                this.proceso.btnEvents = false;

                this.proceso.agregar  = valor;
                this.proceso.ver      = valor;
                this.proceso.editar   = valor;
                this.proceso.imprimir = valor;
                this.proceso.exportar = valor;
                this.proceso.eliminar = valor;

                setTimeout(() => this.proceso.btnEvents = true, 1000);
            },
        },
        mounted: function() {
            
        },
    }
</script>

<style scoped>
    .flex {
        display: flex;
        justify-content: space-between;
    }

    .flex-buttons {
        display: flex;
        justify-content: space-around;
    }

    .pd-right-5 {
        padding-right: 5px;
    }

    .mr-5 {
        padding-right: 5px;
    }

    .mr-15 {
        padding-right: 15px;
    }

    .mr-20 {
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