<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Administrar
                <small>Permisos</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Administrar </router-link></li>
                <li class="active"> Permisos </li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listado de Permisos</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="tabla-permisos" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Ruta</th>
                                        <th>Roles</th>
                                        <th>Fecha registro</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7"> <h4 class="text-center"><img :src="ruta_img_loading" width="40px" height="40px"> Cargando listado de permisos...</h4>  </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Ruta</th>
                                        <th>Roles</th>
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

        <agregar-permiso />
        <actualizar-permiso />

    </div>
</template> 


<script>

import EventBus from '../../../EventBus';

import AgregarPermiso    from './modals/AgregarPermiso.vue';
import ActualizarPermiso from './modals/ActualizarPermiso.vue';

export default {
    components: {
        AgregarPermiso,
        ActualizarPermiso,
    },
    data: function() {
        return({
            permisos          : [],
            datatable_permisos: null,
            ruta_img_loading   : '/img/Cargar.gif',
        })
    },
    created: function(){
        EventBus.$on('recargarPanelPermisos', () => { 
            this.datatable_permisos.draw(); console.log('datatable_permisos redraw');
        })
    },
    methods: {

        /**
         * Este metodo activa los botones de cambiar estado y ver informacion del permiso
         * 
         * @return void
         */
        activarBotonesDeAccion: function() { //alert('activarBotonesDeAccion');
            this.agregarNuevoPermiso();
            this.actualizarPermiso();
            this.cambiarEstadoPermiso();
        },

        /**
         *Este metodo permite visualizar el formulario para agregar un permiso.
         *  
         * @return void
         */
        agregarNuevoPermiso: function() { //alert('verTrazabilidades');
            let me = this;

            $('button.btn-new-permiso').click(function(){
                EventBus.$emit('cargarModalAgregarNuevoPermiso');
            });
        },

        /**
         *Este metodo permite visualizar el formulario para actualizar un permiso.
         *  
         * @return void
         */
        actualizarPermiso: function() { //alert('verTrazabilidades');
            let me = this;

            $('button.btn-update-permiso').click(function(){
                let permiso_id = $(this).attr('data-id');
                let permiso    = me.getDatosPermiso(permiso_id);

                EventBus.$emit('cargarModalActualizarPermiso', permiso);
            });
        },

        /**
         * Este metodo obtiene los datos del permiso por id
         * 
         * @param int permiso_id
         * @return int
         */
        getDatosPermiso: function(permiso_id) {
            let permiso = this.permisos.filter((valor, indice, array_old) => {
                //console.log(valor, indice, array_old);
                return valor.id === permiso_id;
            });

            return typeof(permiso[0]) === 'object' ? permiso[0] : {};
        },

        /**
         * Este metodo cambia el estado de un permiso
         * 
         * @param int id_producto
         * @param int estado
         * @return void
         */

        cambiarEstadoPermiso: function(id_producto, estado) {
            let me = this;

            $('button.btn-update-estado').click(function(){ //alert('click ver trz');
                let permiso_id = $(this).attr('data-id');
                let permiso   = me.getDatosPermiso(permiso_id);

                Swal.fire({
                    title: 'Esta seguro de cambiar el estado del permiso?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        axios.post('/permiso/update/estado',{
                            id     : permiso_id,
                            estado : !permiso.estado,
                        })
                        .then(response => {
                            Swal.fire(
                                'Actualizado!',
                                'El estado del permiso se actualizo correctamente.',
                                'success'
                            );

                            me.datatable_permisos.draw();
                        })
                        .catch(errors => console.log(errors));
                        
                    }
                })
            });
        },
    },
    mounted: function() {
        let me = this;

        console.log('Componente Panel-Permisos');

        me.datatable_permisos = $('#tabla-permisos').DataTable({
            serverSide: true,
            ajax: {
                url: '/permisos',
                data: function(filtros) {
                    return filtros;
                },
                dataSrc: function(json) {
                    let datos = json.data;

                    for( let i in  datos ){
                        datos[i].ayudante = datos[i].ayudante || '';
                    }

                    me.permisos = datos;
                    return datos;
                },
            },
            columns: [
                {   data: 'id', name: 'id' },
                {   data: 'nombre', name: 'nombre' },
                {   data: 'descripcion', name: 'descripcion' },
                {   data: 'ruta', name: 'ruta' },

                {   data: 'roles', searchable: false, orderable: false, render: function(data) {
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
                                <button type="button" class="btn btn-sm btn-info btn-update-permiso" aria-label="Left Align" data-id="${data}">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger btn-delete-permiso" aria-label="Right Align" data-data="${data}">
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

                $('table#tabla-permisos > tbody > tr > td.sorting_1').click(function(){
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
        


        let btn_nuevo_permiso = `
            <button type="button" class="btn btn-sm btn-primary btn-new-permiso"> 
                <i class="fas fa-user-plus"></i> Nuevo 
            </button>
        `;
        
        $("div#tabla-permisos_filter label").append(btn_nuevo_permiso);


        //$("select#filtro-estado").change(function(){
        //    me.datatable_cirugias.draw();
        //});


    }
}

</script>


<style>

#tabla-permisos {
    width: 100% !important;
    zoom : 100%;
}

#tabla-permisos > tbody > tr {
    border-top: 5px solid #ffffff !important;
    border-bottom: 5px solid #ffffff !important;
}

#tabla-permisos > thead > tr > th {
    max-width: 200px !important;
}

.img-panel {
    width: 50px;
    height: 50x;
}


</style>

