<template>
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{ software.nombre }}
            <button class="btn btn-xs btn-warning btn-open-modulos" type="button" data-toggle="collapse" :data-target="'#' + getIdentificador()">
                <i class="fa fa-plus"></i>
            </button>
        </div>
        <div class="panel-body collapse in" :id="getIdentificador()">
            <ul class="list-group">
                <form action="/backend" method="POST" @submit.prevent="storeModulo">
                    <div class="input-group">
                        <input type="text" class="form-control" :id="'add-modulo-in-' + software.id" v-model="modulo.nombre" required>
                        <span class="input-group-btn">
                            <button class="btn btn-primary registrar-modulo" type="submit">
                                <i class="fas fa-paper-plane"></i> Registrar modulo
                            </button>
                        </span>
                    </div>
                </form>
            </ul>
                
            <modulo v-for="modulo in software.modulos" :key="modulo.id" :software="software" :modulo="modulo">
            </modulo>
        </div>
    </div>
</template>

<script>
    import Modulo from './Modulo';

    export default {
        components: {
            Modulo,
        },
        props: {
            software: {
                type: Object,
            },
        },
        data: function() {
            return({
                modulo: {
                    nombre: '',
                }
            })
        },
        methods: {
            getIdentificador: function() {
                return `software-${this.software.slug}`;
            },

            storeModulo: function() {
                if( !this.validarDatosDelFormulario() ){
                    return false;
                }

                this.modulo.gesper_software_id = this.software.id;

                axios.post('/gesper_modulo/store', this.modulo)
                .then(response => {
                    this.software.modulos.push(response.data);
                    this.modulo.nombre = '';
                })
                .catch(error => {
                    console.log(error, error.response.data);
                    this.mostrarErroresHttpAxios(error);
                })
            },

            validarDatosDelFormulario: function() {
                let modulo = this.modulo;

                if( modulo.nombre.length < 4 ){
                    Swal.fire({type: 'error', width: '60rem', title: 'Debe diligenciar un nombre de modulo con almenos 4 caracteres.'});
                    
                    return false;
                }

                return true;
            },
        },
    }
</script>

<style>
    #listado-de-softwares .panel-primary {
        border-color: #337ab7 !important;
    }
</style>