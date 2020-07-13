<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Administrar
                <small>Empleados</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Administrar </router-link></li>
                <li class="active"> Empleados </li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listado de Empleados</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="tabla-empleados" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Documento</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Fecha nacimiento</th>
                                        <th>Genero</th>
                                        <th>Cargo</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="8"> <h4 class="text-center"><img :src="ruta_img_loading" width="40px" height="40px"> Cargando listado de empleados...</h4>  </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Documento</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Fecha nacimiento</th>
                                        <th>Genero</th>
                                        <th>Cargo</th>
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

        <agregar-empleado />

        <actualizar-empleado />

    </div>
</template> 


<script>

import EventBus from '../../../EventBus';

import AgregarEmpleado from './modals/AgregarEmpleado.vue';
import ActualizarEmpleado from './modals/ActualizarEmpleado.vue';

export default {
    components: {
        AgregarEmpleado,
        ActualizarEmpleado,
    },
    data: function() {
        return({
            empleados          : [],
            datatable_empleados: null,
            ruta_img_loading   : '/img/Cargar.gif',
        })
    },
    created: function(){
        EventBus.$on('recargarPanelEmpleados', () => { 
            this.datatable_empleados.draw(); console.log('datatable_empleados redraw');
        })
    },
    methods: {

        /**
         * Este metodo activa los botones de cambiar estado y ver informacion del empleado
         * 
         * @return void
         */
        activarBotonesDeAccion: function() { //alert('activarBotonesDeAccion');
            this.actualizarEmpleado();
            this.cambiarEstadoEmpleado();
        },
        
        /**
         * Este metodo obtiene los datos del empleado por id
         * 
         * @param int empleado_id
         * @return int
         */
        getDatosEmpleado: function(empleado_id) {
            let empleado = this.empleados.filter((valor, indice, array_old) => {
                //console.log(valor, indice, array_old);
                return valor.id === empleado_id;
            });

            return typeof(empleado[0]) === 'object' ? empleado[0] : {};
        },

        /**
         * Este metodo escucha el evento clic en los botones con clase .btn-actualizar-empleado 
         * y emite un evento para que proceda a realizar la actualizacion de los datos en una nueva ventana modal
         * 
         * @return void
         */
        actualizarEmpleado: function() { //alert('actualizarEmpleado');
            let me = this;

            $('button.btn-actualizar-empleado').click(function(){  //alert('click  actualizarEmpleado');
                let empleado_id = $(this).attr('data-id');
                let empleado    = me.getDatosEmpleado(empleado_id);

                EventBus.$emit('cargarDatosModalActualizarEmpleado', empleado);
            })
        },

        /**
         * Este metodo cambia el estado de un empleado
         * 
         * @param int id_producto
         * @param int estado
         * @return void
         */
        cambiarEstadoEmpleado: function(id_producto, estado) {
            let me = this;

            $('button.btn-update-estado').click(function(){ //alert('click ver trz');
                let empleado_id = $(this).attr('data-id');
                let empleado    = me.getDatosEmpleado(empleado_id);

                Swal.fire({
                    title: 'Esta seguro de cambiar el estado del empleado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        axios.post('/empleado/update/estado',{
                            id     : empleado_id,
                            estado : !empleado.estado,
                        })
                        .then(response => {
                            Swal.fire(
                                'Actualizado!',
                                'El estado del empleado se actualizo correctamente.',
                                'success'
                            );

                            me.datatable_empleados.draw();
                        })
                        .catch(errors => console.log(errors));
                        
                    }
                })
            });
        },
    },
    mounted: function() {
        let me = this;

        console.log('Componente Panel-Empleados');

        me.datatable_empleados = $('#tabla-empleados').DataTable({
            serverSide: true,
            ajax: {
                url: '/empleados',
                data: function(filtros) {
                    return filtros;
                },
                dataSrc: function(json) {
                    let datos = json.data;

                    for( let i in  datos ){
                        datos[i].ayudante = datos[i].ayudante || '';
                    }

                    me.empleados = datos;
                    return datos;
                },
            },
            columns: [
                {   data: 'id', name: 'id' },
                {   data: 'documento', name: 'documento' },
                {   data: 'nombres', name: 'nombres' },
                {   data: 'apellidos', name: 'apellidos' },
                {   data: 'fecha_nacimiento', name: 'fecha_nacimiento' },
                {   data: 'genero', name: 'genero', render: function(data) {
                        return data === 'M' ? 'Masculino' : 'Femenino';
                    } 
                }, 
                {   data: 'cargo', name: 'cargo' },
                {   data: 'estado', name: 'estado', render: function(data, type, row, meta) {
                        let estado     = data == 1 ? 'Activo': 'Inactivo';
                        let background = data == 1 ? 'btn-success': 'btn-danger';

                        return `<button type="button" class="btn btn-sm ${background} center-block btn-update-estado" data-id="${row.id}"> ${estado} </button>`;
                    } 
                },
                {   data: 'id', name: 'opciones', searchable: false, render: function(data) {
                        return `
                            <div class="btn-group text-center">
                                <button type="button" class="btn btn-sm btn-info btn-actualizar-empleado" aria-label="Left Align" data-id="${data}">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger btn-delete-empleado" aria-label="Right Align" data-data="${data}">
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

                $('table#tabla-egresos > tbody > tr > td.sorting_1').click(function(){
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
        


        let btn_nuevo_empleado = '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#mod-agregar-empleado"> <i class="fas fa-user-plus"></i> Nuevo </button>';
        
        $("div#tabla-empleados_filter label").append(btn_nuevo_empleado);


        //$("select#filtro-estado").change(function(){
        //    me.datatable_cirugias.draw();
        //});


    }
}

</script>


<style>

#tabla-empleados {
    width: 100% !important;
    zoom : 90%;
}

#tabla-empleados > tbody > tr {
    border-top: 5px solid #ffffff !important;
    border-bottom: 5px solid #ffffff !important;
}

#tabla-empleados > thead > tr > th {
    max-width: 200px !important;
}


</style>

  