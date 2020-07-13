<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                Administrar
                <small>Usuarios</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Administrar </router-link></li>
                <li class="active"> Usuarios </li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listado de Usuarios</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="tabla-usuarios" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Imagen de Perfil</th>
                                        <th>Empleado</th>
                                        <th>Empleado Apellidos</th>
                                        <th>Rol</th>
                                        <th>Usuario</th>
                                        <th>Correo</th>
                                        <th>Jefe inmediato</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="8"> <h4 class="text-center"><img :src="ruta_img_loading" width="40px" height="40px"> Cargando listado de usuarios...</h4>  </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Imagen de Perfil</th>
                                        <th>Empleado</th>
                                        <th>Empleado Apellidos</th>
                                        <th>Rol</th>
                                        <th>Usuario</th>
                                        <th>Correo</th>
                                        <th>Jefe inmediato</th>
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

        <agregar-usuario />

        <actualizar-usuario />

    </div>
</template> 


<script>

import EventBus from '../../../EventBus';

import AgregarUsuario from './modals/AgregarUsuario.vue';
import ActualizarUsuario from './modals/ActualizarUsuario.vue';

export default {
    components: {
        AgregarUsuario,
        ActualizarUsuario,
    },
    data: function() {
        return({
            usuarios          : [],
            datatable_usuarios: null,
            ruta_img_loading   : '/img/Cargar.gif',
        })
    },
    created: function(){
        EventBus.$on('recargarPanelUsuarios', () => { 
            this.datatable_usuarios.draw(); console.log('datatable_usuarios redraw');
        })
    },
    methods: {

           /**
         * Este metodo activa los botones de cambiar estado de un usuario
         * 
         * @return void
         */
        activarBotonesDeAccion: function() { //alert('activarBotonesDeAccion');
            this.actualizarUsuario();
            this.cambiarEstadoUsuario();
        },

        /**
         * Este metodo obtiene los datos del usuario por id
         * 
         * @param int usuario_id
         * @return int
         */
        getDatosUsuario: function(usuario_id) {
            let usuario = this.usuarios.filter((valor, indice, array_old) => {
                //console.log(valor, indice, array_old);
                return valor.id === usuario_id;
            });

            return typeof(usuario[0]) === 'object' ? usuario[0] : {};
        },

        /**
         * Este metodo escucha el evento clic en los botones con clase .btn-actualizar-usuario 
         * y emite un evento para que proceda a realizar la actualizacion de los datos en una nueva ventana modal
         * 
         * @return void
         */
        actualizarUsuario: function() { //alert('actualizarEmpleado');
            let me = this;

            $('button.btn-actualizar-usuario').click(function(){  //alert('click  actualizarEmpleado');
                let usuario_id = $(this).attr('data-id');
                let usuario    = me.getDatosUsuario(usuario_id);

                EventBus.$emit('cargarDatosModalActualizarUsuario', usuario);
            })
        },

        /**
         * Este metodo cambia el estado de un usuario
         * 
         * @return void
         */
        cambiarEstadoUsuario: function() {
            let me = this;

            $('button.btn-update-estado').click(function(){ //alert('click ver trz');
                let usuario_id = $(this).attr('data-id');
                let usuario   = me.getDatosUsuario(usuario_id);

                Swal.fire({
                    title: 'Esta seguro de cambiar el estado del usuario?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        axios.post('/usuario/update/estado',{
                            id     : usuario_id,
                            estado : !usuario.estado,
                        })
                        .then(response => {
                            Swal.fire(
                                'Actualizado!',
                                'El estado del usuario se actualizo correctamente.',
                                'success'
                            );

                            me.datatable_usuarios.draw();
                        })
                        .catch(errors => console.log(errors));
                        
                    }
                })
            });
        },
    },
    mounted: function() {
        let me = this;

        console.log('Componente Panel-Usuarios');

        me.datatable_usuarios = $('#tabla-usuarios').DataTable({
            serverSide: true,
            ajax: {
                url: '/usuarios',
                data: function(filtros) {
                    return filtros;
                },
                dataSrc: function(json) {
                    let datos = json.data;

                    for( let i in  datos ){
                        datos[i].ayudante = datos[i].ayudante || '';
                    }

                    me.usuarios = datos;
                    return datos;
                },
            },
            columns: [
                {   data: 'id', name: 'id' },
                {   data: 'image_profile', searchable: false, render: function(data){
                        return `<img src="${data}" alt="imagen de perfil" class="img-responsive img-circle center-block img-panel" />`;
                    } 
                },
                {   data: 'empleado', name: 'empleado.nombres', render: function(data){
                        return `${data.nombres} ${data.apellidos}`;
                    } 
                },
                {   data: 'empleado.apellidos', visible: false, },
                {   data: 'role.nombre', name: 'role.nombre' },
                {   data: 'username', name: 'username' },
                {   data: 'email', name: 'email' },
                {   data: 'jefe_inmediato', name: 'jefe_inmediato_id', render: function(data, type, row){
                    if(row.jefe_inmediato){
                        return `${row.jefe_inmediato.empleado.nombres} ${row.jefe_inmediato.empleado.apellidos}`;
                    }

                    return '';
                } },
                {   data: 'estado', name: 'estado', render: function(data, type, row, meta) {
                        let estado     = data == 1 ? 'Activo': 'Inactivo';
                        let background = data == 1 ? 'btn-success': 'btn-danger';

                        return `<button type="button" class="btn btn-sm ${background} center-block btn-update-estado" data-id="${row.id}"> ${estado} </button>`;
                    } 
                },
                {   data: 'id', name: 'opciones', searchable: false, render: function(data) {
                        return `
                            <div class="btn-group text-center">
                                <button type="button" class="btn btn-sm btn-info btn-actualizar-usuario" aria-label="Left Align" data-id="${data}">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger btn-delete-usuario" aria-label="Right Align" data-data="${data}">
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
        


        let btn_nuevo_empleado = '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#mod-agregar-usuario"> <i class="fas fa-user-plus"></i> Nuevo </button>';
        
        $("div#tabla-usuarios_filter label").append(btn_nuevo_empleado);


        //$("select#filtro-estado").change(function(){
        //    me.datatable_cirugias.draw();
        //});


    }
}

</script>


<style>

#tabla-usuarios {
    width: 100% !important;
    zoom : 100%;
}

#tabla-usuarios > tbody > tr {
    border-top: 5px solid #ffffff !important;
    border-bottom: 5px solid #ffffff !important;
}

#tabla-usuarios > thead > tr > th {
    max-width: 200px !important;
}

.img-panel {
    width: 50px;
    height: 50x;
}


</style>

