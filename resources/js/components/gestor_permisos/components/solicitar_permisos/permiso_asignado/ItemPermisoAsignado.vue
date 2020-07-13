<template>
    <div class="flex mr-15" >
    	<span v-if="permisoAsignado" class="success">&#10004;</span>
    	<span v-else class="danger">&#x2718;</span> 
    	<p :class="permisoAsignado ? '' : 'tachado text-secondary'">{{ nombre }}</p>
	</div>
</template>

<script>
    export default {
        props: {
            permiso: Object,
            nombre: String,
            llave: String,
        },
        computed: {
        	permisoAsignado: function() {
        		return this.permiso[this.llave];
        	},
        }
    }
</script>

<style scoped>
    .flex {
        display: flex;
        justify-content: space-between;
    }

    .pr-15 {
        padding-right: 15px;
    }

    span.success {
    	color: green;
    	padding-right: 5px;
    }

    span.danger {
    	color: red;
    	padding-right: 5px;
    }

    .tachado {
    	text-decoration:line-through;
    }


</style>