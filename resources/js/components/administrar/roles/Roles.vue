<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Administrar
                <small>Roles</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Administrar </router-link></li>
                <li class="active"> Roles </li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listado de Roles</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="tabla-roles" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Permisos</th>
                                        <th>Fecha registro</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7"> <h4 class="text-center"><img :src="ruta_img_loading" width="40px" height="40px"> Cargando listado de roles...</h4>  </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Permisos</th>
                                        <th>Fecha registro</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <agregar-role />
        <actualizar-role />

    </div>
</template> 


<script>

import EventBus from '../../../EventBus';

import AgregarRole from './modals/AgregarRole.vue';
import ActualizarRole from './modals/ActualizarRole.vue';

export default {
    components: {
        AgregarRole,
        ActualizarRole,
    },
    data: function() {
        return({
            roles          : [],
            datatable_roles: null,
            ruta_img_loading   : '/img/Cargar.gif',
        })
    },
    created: function(){
        EventBus.$on('recargarPanelRoles', () => { 
            this.datatable_roles.draw(); console.log('datatable_roles redraw');
        })
    },
    methods: {

         /**
         * Este metodo activa los botones de cambiar estado y ver informacion del role
         * 
         * @return void
         */
        activarBotonesDeAccion: function() { //alert('activarBotonesDeAccion');
            this.agregarNuevoRole();
            this.actualizarRole();
            this.cambiarEstadoRole();
        },

        /**
         *Este metodo permite visualizar el formulario para agregar un role.
         *  
         * @return void
         */
        agregarNuevoRole: function() { //alert('verTrazabilidades');
            let me = this;

            $('button.btn-new-role').click(function(){
                EventBus.$emit('cargarModalAgregarNuevoRole');
            });
        },

        /**
         *Este metodo permite visualizar el formulario para actualizar un role.
         *  
         * @return void
         */
        actualizarRole: function() { //alert('verTrazabilidades');
            let me = this;

            $('button.btn-update-role').click(function(){
                let role_id = $(this).attr('data-id');
                let role    = me.getDatosRole(role_id);

                EventBus.$emit('cargarModalActualizarRole', role);
            });
        },

        /**
         * Este metodo obtiene los datos del role por id
         * 
         * @param int role_id
         * @return int
         */
        getDatosRole: function(role_id) {
            let role = this.roles.filter((valor, indice, array_old) => {
                //console.log(valor, indice, array_old);
                return valor.id === role_id;
            });

            return typeof(role[0]) === 'object' ? role[0] : {};
        },

        /**
         * Este metodo cambia el estado de un role
         * 
         * @param int estado
         * @return void
         */
        cambiarEstadoRole: function(estado) {
            let me = this;

            $('button.btn-update-estado').click(function(){ //alert('click ver trz');
                let role_id = $(this).attr('data-id');
                let role   = me.getDatosRole(role_id);

                Swal.fire({
                    title: 'Esta seguro de cambiar el estado del role?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        axios.post('/role/update/estado',{
                            id     : role_id,
                            estado : !role.estado,
                        })
                        .then(response => {
                            Swal.fire(
                                'Actualizado!',
                                'El estado del role se actualizo correctamente.',
                                'success'
                            );

                            me.datatable_roles.draw();
                        })
                        .catch(errors => console.log(errors));
                        
                    }
                })
            });
        },
    },
    mounted: function() {
        let me = this;

        console.log('Componente Panel-Roles');

        me.datatable_roles = $('#tabla-roles').DataTable({
            serverSide: true,
            ajax: {
                url: '/roles',
                data: function(filtros) {
                    return filtros;
                },
                dataSrc: function(json) {
                    let datos = json.data;

                    for( let i in  datos ){
                        datos[i].ayudante = datos[i].ayudante || '';
                    }

                    me.roles = datos;
                    return datos;
                },
            },
            columns: [
                {   data: 'id', name: 'id' },
                {   data: 'nombre', name: 'nombre' },
                {   data: 'descripcion', name: 'descripcion' },

                {   data: 'permisos', searchable: false, orderable: false, render: function(data) {
                        let permisos = '';

                        for( let i in data ) {
                            permisos += `${data[i].nombre}, `;
                        }

                        return permisos;
                    } 
                },

                {   data: 'created_at', name: 'fecha_registro', searchable: false, },
                {   data: 'estado', name: 'estado', render: function(data, type, row, meta) {
                        let estado     = data == 1 ? 'Activo': 'Inactivo';
                        let background = data == 1 ? 'btn-success': 'btn-danger';

                        return `<button type="button" class="btn btn-sm ${background} center-block btn-update-estado" data-id="${row.id}"> ${estado} </button>`;
                    } 
                },
                {   data: 'id', name: 'opciones', searchable: false, render: function(data) {
                        return `
                            <div class="btn-group text-center">
                                <button type="button" class="btn btn-sm btn-info btn-update-role" aria-label="Left Align" data-id="${data}">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger btn-delete-role" aria-label="Right Align" data-data="${data}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        `;
                    }
                },
            ],

            fnDrawCallback: function(settings, json) {
                setTimeout(() => {
                    me.activarBotonesDeAccion();
                }, 300);

                $('table#tabla-roles > tbody > tr > td.sorting_1').click(function(){
                    setTimeout(() => {
                        me.activarBotonesDeAccion();
                    }, 300);
                });
            },

            order: [[ 0, "desc" ]],

            responsive: {
                orthogonal: 'responsive'
            },

        });
        


        let btn_nuevo_role = `
            <button type="button" class="btn btn-sm btn-primary btn-new-role"> 
                <i class="fas fa-user-plus"></i> Nuevo 
            </button>
        `;
        
        $("div#tabla-roles_filter label").append(btn_nuevo_role);


        //$("select#filtro-estado").change(function(){
        //    me.datatable_cirugias.draw();
        //});


    }
}

</script>


<style>

#tabla-roles {
    width: 100% !important;
    zoom : 100%;
}

#tabla-roles > tbody > tr {
    border-top: 5px solid #ffffff !important;
    border-bottom: 5px solid #ffffff !important;
}

#tabla-roles > thead > tr > th {
    max-width: 200px !important;
}

.img-panel {
    width: 50px;
    height: 50x;
}


</style>

