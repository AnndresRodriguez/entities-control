<template>
    <ul class="list-group">
        <li class="list-group-item">
            {{ modulo.nombre }}
            <button class="btn btn-xs btn-info" type="button" data-toggle="collapse" :data-target="'#' + getIdentificador()">
                <i class="fa fa-plus"></i>
            </button>
            <ul class="list-group" style="margin-top: 15px;">
                <form action="/backend" method="POST" @submit.prevent="storeProceso">
                    <div class="input-group">
                        <input type="text" class="form-control" :id="'add-proceso-in-' + modulo.id" v-model="proceso.nombre" required>
                        <span class="input-group-btn">
                            <button class="btn btn-primary registrar-proceso" type="submit">
                                <i class="fas fa-paper-plane"></i> Registrar proceso
                            </button>
                        </span>
                    </div>
                </form>
            </ul>
            <ul class="list-group collapse in" :id="getIdentificador()">
                <proceso v-for="proceso in modulo.procesos" :key="proceso.id" :software="software" :modulo="modulo" :proceso="proceso">
                </proceso>
            </ul>
        </li>
    </ul>
</template>

<script>
    import Proceso from './Proceso'

    export default {
        components: {
            Proceso,
        },
        props: {
            software: {
                type: Object,
            },
            modulo: {
                type: Object,
            },
        },
        data: function() {
            return({
                proceso: {
                    nombre: '',
                },
            })
        },
        methods: {
            getIdentificador: function() {
                return `${this.modulo.slug}`;
            },

            storeProceso: function() {
                if( !this.validarDatosDelFormulario() ){
                    return false;
                }

                this.proceso.gesper_modulo_id = this.modulo.id;

                axios.post('/gesper_proceso/store', this.proceso)
                .then(response => {
                    this.modulo.procesos.push(response.data);
                    this.proceso.nombre = '';
                })
                .catch(error => {
                    console.log(error, error.errors);
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

</style>