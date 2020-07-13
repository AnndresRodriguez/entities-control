<template>
    <ul class="list-group">
        <li class="list-group-item">
            {{ modulo.nombre }}
            <button class="btn btn-xs btn-info btn-open-procesos" type="button" data-toggle="collapse" :data-target="'#' + getIdentificador()">
                <i class="fa fa-plus"></i>
            </button>
            <ul class="list-group collapse mt-10" :id="getIdentificador()">
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
                a: 1,
            })
        },
        methods: {
            getIdentificador: function() {
                return `software-${this.software.id}-modulo-${this.modulo.id}`;
            },
        },
    }
</script>

<style>

</style>