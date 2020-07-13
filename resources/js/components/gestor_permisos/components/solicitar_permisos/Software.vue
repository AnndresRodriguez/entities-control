<template>
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{ software.nombre }}
            <button class="btn btn-xs btn-warning btn-open-modulos" type="button" data-toggle="collapse" :data-target="'#' + getIdentificador()">
                <i class="fa fa-plus"></i>
            </button>
        </div>
        <div class="panel-body collapse" :id="getIdentificador()">
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
                //a: 1,
            })
        },
        methods: {
            getIdentificador: function() {
                return `software-${this.software.id}`;
            },
        },
    }
</script>

<style>
    #listado-de-softwares .panel-primary {
        border-color: #337ab7 !important;
    }
</style>