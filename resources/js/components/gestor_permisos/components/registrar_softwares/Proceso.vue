<template>
    <li class="list-group-item">
        {{ proceso.nombre }}
    </li>
</template>

<script>
    export default {
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
                a: 1,
            })
        },
        methods: {
            getIdentificador: function(indice){
                return `${this.proceso.slug}`;
            }
        }
    }
</script>

<style scoped>
    
</style>