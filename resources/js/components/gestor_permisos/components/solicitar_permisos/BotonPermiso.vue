<template>
    <div class="flex mr-20">
        <template v-if="estado === true">
            <div>
                <button type="button" class="btn btn-xs btn-success" @click="cambiarEstadoPermiso">
                    &#10004
                </button>
            </div>
        </template>
        <template v-else>
            <div class="input-checkbox" @click="cambiarEstadoPermiso"></div>
        </template>
        
        <p class="ml-5" @click="cambiarEstadoPermiso">{{ nombre }}</p>
    </div>
</template>

<script>
    import EventBus from './../../../../EventBus';
    export default {
        props: {
            proceso: Object,
            llave: String,
            nombre: String,
        },
        data: function() {
            return({
                datos: [],
            })
        },
        computed: {
            estado: function(){
                return this.proceso[this.llave];
            },
        },
        watch: {
            'estado': function(newVal, oldVal){
                //console.log('btnEvents', this.proceso.btnEvents, 'newVal', newVal);

                if( this.proceso.btnEvents && newVal ){
                    //console.log(oldVal, newVal);

                    EventBus.$emit('agregarProcesoConLosPermisosAlListado', this.proceso);
                }
            }
        },
        created: function() {
            //created
        },
        methods: {
            cambiarEstadoPermiso: function() {
                this.proceso[this.llave] = !this.proceso[this.llave];
            }
        },
        mounted: function() {
            //mounted
            //console.log(this.proceso, this.llave, this.proceso[this.llave]);
        },
    }
</script>

<style scoped>
    .flex {
        display: flex;
        justify-content: space-between;
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