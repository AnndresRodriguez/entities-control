<template>
    <div>
        <section class="content-header section-header">
            <h1>
                Generales
                <small>Acciones</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Generales</router-link></li>
                <li class="active">Acciones</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- <div class="panel panel-widget" id="item_1"> -->
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Panel de acciones de usuarios</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="tabla-acciones-users" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>MODULO</th>
                                        <th>TABLA</th>
                                        <th>ACCIÓN</th>
                                        <th>ID REGISTRO</th>
                                        <th>OBSERVACION</th>
                                        <th>USUARIO_RESPONSABLE</th>
                                        <th>FECHA_REGISTRO</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="9"> <h4 class="text-center"><img :src="ruta_img_loading" width="40px" height="40px"> Cargando registros..</h4>  </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>MODULO</th>
                                        <th>TABLA</th>
                                        <th>ACCIÓN</th>
                                        <th>ID REGISTRO</th>
                                        <th>OBSERVACION</th>
                                        <th>USUARIO_RESPONSABLE</th>
                                        <th>FECHA_REGISTRO</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>
</template> 


<script>

export default {
    data: function() {
        return({
            acciones_usuario  : [],
            datatable_acicones: null,

            ruta_img_loading      : '/img/Cargar.gif',
        })
    },
    created: function(){
        //EventBus.$on('recargarPanelPlanesDeMejoramiento', () => { 
        //    this.datatable_acicones.draw(); console.log('datatable_acicones draw');
        //})
    },
    methods: {
        /**
         * Este metodo habilita los botones para poder ver y actualizar un pdm, ver y agregar un seguimiento.
         * 
         * @return void
         */
        activarBotonesDeAccion: function() { //alert('activarBotonesDeAccion');
            this.verPlanDeMejoramiento();
            this.updatePlanDeMejoramiento();

            this.verSeguimientos();
            this.agregarSeguimiento();

        },

        /**
         * Este metodo visualiza los planes de seguimiento
         * 
         * @return void
         */
        verPlanDeMejoramiento: function() { //alert('verTrazabilidades');
            let me = this;

            $('button.btn-ver-plan-de-mejoramiento').click(function(){ //alert('click ver trz');
                let pdm_id = $(this).attr('data-id');
                let pdm    = me.getDatosPlanDeMejoramiento(pdm_id);

                EventBus.$emit('cargarDatosModalVerDatosPlanDeMejoramiento', pdm);
            })
        },

        /**
         * Este metodo modifica un plan de seguimiento correspondiente.
         * 
         * @return void
         */
        updatePlanDeMejoramiento: function() { //alert('verTrazabilidades');
            let me = this;

            $('button.btn-update-plan-de-mejoramiento').click(function(){ //alert('click ver trz');
                let pdm_id = $(this).attr('data-id');
                me.$router.push(`/acreditacion/${pdm_id}/update`);
            })
        },

        /**
         * Este metodo visualiza los seguimientos del pdm
         * 
         * @return void
         */
        verSeguimientos: function() {
            let me = this;

            $('button.btn-view-seguimientos').click(function(){ //alert('click ver seguimientos');
                let pdm_id = $(this).attr('data-id');
                let pdm    = me.getDatosPlanDeMejoramiento(pdm_id); //console.log('panel - agregarSeguimiento', pdm);

                EventBus.$emit('cargarDatosModalVerSeguimientos', pdm);
            })
        },
        
        /**
         * Este metodo permite agregar un seguimiento a un plan de mejora
         * 
         * @return void
         */
        agregarSeguimiento: function() { //alert('verTrazabilidades');
            let me = this;

            $('button.btn-add-seguimiento').click(function(){ //alert('click ver trz');
                let pdm_id = $(this).attr('data-id');
                let pdm    = me.getDatosPlanDeMejoramiento(pdm_id); //console.log('panel - agregarSeguimiento', pdm);

                EventBus.$emit('cargarDatosModalAgregarSeguimiento', pdm);
            })
        },

        /**
         * Este metodo obtiene un plan de mejoramiento a partir del id de una cirugia
         * 
         * @param int cirugia_id
         * @return int
         */
        getDatosPlanDeMejoramiento: function(cirugia_id) {
            let pdm = this.acciones_usuario.filter((valor, indice, array_old) => {
                return valor.id === cirugia_id;
            });

            return typeof(pdm[0]) === 'object' ? pdm[0] : {};
        },

        /**
         * Este metodo obtiene la clase de estado de un seguimeinto
         * 
         * @param Array seguimientos
         * @return String
         */
        getClassForEstateSeguimiento: function(seguimientos) {
            if( seguimientos.length )
            {
                let seguimiento = seguimientos[(seguimientos.length -1)];  console.log(seguimiento.estado_seguimiento);

                if( seguimiento.estado_seguimiento === 'Pendiente' ) {
                    return 'pdm_pendiente';
                }
                else if( seguimiento.estado_seguimiento === 'Cumplida parcialmente' ) {
                    return 'pdm_cumplida_parcialmente';
                }
                else {
                    return 'pdm_cumplida';
                }
            }

            return 'pdm_ok';
        },

        /**
         * Este metodo carga los distintos modulos para filtrar los valores de la tabla de acciones de usuarios
         * 
         * @return void
         */
        cargarListadoDeModulos: function() 
        {
            let me = this;

            axios.get('/acciones/modulos')
            .then((response) => {
                if( response.data.modulos )
                {
                    let modulos = response.data.modulos;
                    let options   = '<option value="TODOS">MODULOS - TODOS</option>';

                    for(let i in modulos) {
                        options += `<option value="${modulos[i].modulo}">${modulos[i].modulo}</option>`;
                    }

                    $('select#filtro-modulo').html(options);
                }
            })
            .catch((error) => {
                console.log(error);
            });
        },

    },
    mounted: function() {
        let me = this;

        console.log('Componente Cirugias-Panel');

        me.datatable_acicones = $('#tabla-acciones-users').DataTable({
            'serverSide': true,
            ajax: {
                url: '/acciones',
                data: function(filtros) {
                    filtros.modulo = $('select#filtro-modulo').val() || 'TODOS';

                    return filtros;
                },
                dataSrc: function(json) {
                    let datos = json.data;
                    me.acciones_usuario = datos;
                    return datos;
                },
            },
            columns: [
                { data: 'id' },
                { data: 'modulo' },
                { data: 'tabla' },
                { data: 'accion', searchable: false, },
                { data: 'id_registro', searchable: false, },
                { data: 'observacion', searchable: false, },
                { data: 'user.empleado.nombres', render: function(data, type, row){
                    let empleado = row.user.empleado;

                    return `${empleado.nombres} ${empleado.apellidos}`
                } },
                { data: 'fecha', render: function(data, type, row) {
                    return `${row.fecha} ${row.hora}`;
                } },
                { data: 'id',
                    render: function(data){
                        return `
                            <div class="text-center">
                                <div class="btn-group min-width-100" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-sm btn-success btn-ver-plan-de-mejoramiento" data-id="${data}"> 
                                        <i class="fas fa-eye"></i> 
                                    </button>
                                    <button class="btn btn-sm btn-primary btn-update-plan-de-mejoramiento" data-id="${data}"> 
                                        <i class="fas fa-edit"></i> 
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-id="${data}"> 
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                    }
                },
            ],

            columnDefs: [
                { "target": "5", "className": 'text-center', },
            ],

            createdRow: function( row, data, dataIndex ) {
                //let clase = me.getClassForEstateSeguimiento(data.seguimientos);
                //$(row).addClass(clase);
                //console.log(clase);
            },

            fnDrawCallback: function(settings, json) {
                /* ACTIVAR BOTONES DE ACCION */
                setTimeout(() => {
                    me.activarBotonesDeAccion();
                }, 300);

                $('table#tabla-acciones-users > tbody > tr > td:first-child').click(function(){
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

        let filtro_modulo = `
            <select id="filtro-modulo" class="form-control input-sm">
                <option value="TODOS">MODULO - TODOS</option> 
            </select>
        `;

        let btn_export_xlsx = `
            <a class="btn btn-sm btn-primary" href="/planes_mejoramiento/reporte/excel" target="_blank" title="Descargar registros en Excel">
                <span class="glyphicon glyphicon-export"></span> Exportar a Excel
            </a>
        `;

        $("div#tabla-acciones-users_filter label").append(filtro_modulo);
        $("div#tabla-acciones-users_filter label").append(btn_export_xlsx);

        me.cargarListadoDeModulos();

        $('select#filtro-modulo').change(function(){
            me.datatable_acicones.draw();
        });

        if( typeof(me.$route.params.id) === 'string' ) {  console.log('me.$route.params.id != undefined');
            setTimeout(() => {
                me.datatable_acicones.search(me.$route.params.id).draw();
            }, 1000);
        }

    }
}

</script>


<style>

#tabla-acciones-users {
    width: 100% !important;
    zoom : 80%;
}

#tabla-acciones-users > tbody > tr {
    border-top: 5px solid #ffffff !important;
    border-bottom: 5px solid #ffffff !important;
}

#tabla-acciones-users > thead > tr > th {
    max-width: 200px !important;
}

.min-width-100 {
    min-width: 100px;
}

.pdm_ok {
    background-color: transparent !important;
	box-shadow: inset 0px  3px 2px -3px #000000, inset 0px -3px 2px -3px #000000; /* Negro */
	color: #000;
}

.pdm_pendiente {
    box-shadow: inset 0px  7px 2px 0px #ff0000, inset 0px -7px 2px 0px #ff0000; /* Verde */
  	color: #000000;
}

.pdm_cumplida_parcialmente {
    box-shadow: inset 0px  7px 2px 0px #ff6a00, inset 0px -7px 2px 0px #ff6a00; /* Naranja */
  	color: #000000;
}

.pdm_cumplida {
    box-shadow: inset 0px  7px 2px 0px #028000, inset 0px -7px 2px 0px #028000; /* Verde */
	color: #000000;
}


</style>

