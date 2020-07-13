<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                MANUAL DE USUARIO
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Dashboard </router-link></li>
                <li class="active"> Manual de usuario </li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-3 col-lg-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Filtrar paginas"
                                    v-model="filtro_paginas">
                                <span class="input-group-addon"> <i class="fas fa-search"></i> </span>
                            </div>

                            <h3>Contenido</h3>
                            <ul class="menu-contenido">
                                <li @click="visualizarPagina(5)">
                                    <b>OBJETIVOS</b>
                                </li>
                                <li @click="visualizarPagina(5)">
                                    <b>ALCANCE</b>
                                </li>
                                <li @click="visualizarPagina(5)">
                                    <b>CAMPO DE APLICACION</b>
                                </li>
                                <li @click="visualizarPagina(5)">
                                    <b>ACTUALIZACION</b>
                                </li>
                                <li @click="visualizarPagina(5)">
                                    <b>DEFINICIONES</b>
                                </li>
                                <li @click="visualizarPagina(6)">
                                    <b>CONTENIDO GENERAL</b>
                                </li>
                                 <li >
                                    <b @click="visualizarPagina(6)">MODULO LOGIN</b>
                                    <ul>
                                        <li @click="visualizarPagina(6)">PANTALLA DE AUTENTICACION</li>
                                        <li @click="visualizarPagina(7)">PANTALLA DE RECUPERACION DE CONTRASEÑA</li>
                                    </ul>
                                </li>
                              
                                <li @click="visualizarPagina(10)">
                                    <b>MENU IZQUIERDO MODULOS</b>
                                </li>
                                <li >
                                    <b @click="visualizarPagina(11)">MODULO PERFIL</b>
                                    <ul>
                                        <li @click="visualizarPagina(11)">PANTALLA PERFIL BASICA</li>
                                        <li @click="visualizarPagina(12)">PANTALLA PERFIL USUARIO</li>
                                    </ul>
                                </li>
                                <li >
                                    <b @click="visualizarPagina(14)">MODULO DASHBOARD</b>
                                </li>
                                  <li>
                                    <b @click="visualizarPagina(16)">MODULO DE REFERENCIAS</b>
                                    <ul>
                                        <li @click="visualizarPagina(16)">PANTALLA REGISTRO</li>
                                        <ul>
                                          <li @click="visualizarPagina(16)">PANEL DE DATOS DE PACIENTE</li>
                                          <li @click="visualizarPagina(17)">PANEL DE DATOS DE REFERENCIA</li>
                                        </ul>
                                        <li @click="visualizarPagina(18)">PANTALLA PANEL</li>
                                         <ul>
                                          <li  @click="visualizarPagina(19)">PANEL TABLA DE DATOS REFERENCIAS</li>
                                          <li @click="visualizarPagina(20)">PANEL TABLA DE ESTADOS REFERENCIAS</li>
                                        </ul>
                                        <li  @click="visualizarPagina(21)">PANTALLA REPORTES REFERENCIAS</li>
                                    </ul>
                                </li>
                                 <li  >
                                    <b @click="visualizarPagina(22)">MODULO DE CONTRARREFERENCIA</b>
                                    <ul>
                                        <li  @click="visualizarPagina(22)">PANTALLA REGISTRO</li>
                                        <ul>
                                          <li @click="visualizarPagina(22)">PANEL DE DATOS DE PACIENTE</li>
                                          <li @click="visualizarPagina(23)">PANEL DE DATOS DE CONTRARREFERENCIA</li>
                                          <li @click="visualizarPagina(24)">PANEL ACEPTACION/NEGACION</li>
                                        </ul>
                                        <li @click="visualizarPagina(25)">PANTALLA PANEL</li>
                                         <ul>
                                          <li @click="visualizarPagina(25)">PANEL TABLA DE DATOS CONTRARREFERENCIAS</li>
        
                                        </ul>
                                        <li @click="visualizarPagina(26)">PANTALLA REPORTES CONTRARREFERENCIAS</li>
                                    </ul>
                                </li>
                                    <li >
                                    <b @click="visualizarPagina(27)">MODULO DE CIRUGIAS</b>
                                    <ul>
                                        <li @click="visualizarPagina(27)">PANTALLA REGISTRO</li>
                                        <ul>
                                          <li @click="visualizarPagina(27)">PANEL DE DATOS PACIENTE</li>
                                          <li @click="visualizarPagina(28)">PANEL DE DATOS CIRUGIA</li>
                            
                                        </ul>
                                        <li @click="visualizarPagina(29)">PANTALLA PANEL</li>
                                         <ul>
                                          <li @click="visualizarPagina(29)">PANEL TABLA DE DATOS CIRUGIAS</li>       
                                        </ul>
                                        <li @click="visualizarPagina(30)">PANTALLA REPORTES CIRUGIAS</li>
                                    </ul>
                                </li>
                                 <li  >
                                    <b @click="visualizarPagina(31)">MODULO SEGUIMINETO POST EGRESOS</b>
                                    <ul>
                                        <li  @click="visualizarPagina(31)">PANTALLA PANEL</li>
                                        <ul>
                                          <li  @click="visualizarPagina(32)">PANEL TABLA DE DATOS SEGUIMINETO</li>
                                          <li @click="visualizarPagina(33)">PANEL DE TABLA DE ESTADOS SEGUIMIENTOS</li>
                            
                                        </ul>
                                        <li  @click="visualizarPagina(34)">PANTALLA REPORTES</li>
                                        <li @click="visualizarPagina(34)">PANTALLA ACCIONES</li>
                                        <ul>
                                          <li @click="visualizarPagina(35)">PANEL GRAFICA TOTAL EGRESOS</li>
                                          <li @click="visualizarPagina(35)">PANEL TABLA DE ACCIONES</li>
                                        </ul>
                                    </ul>
                                </li>
                                <li >
                                    <b @click="visualizarPagina(37)">MODULO ACREDITACION</b>
                                    <ul>
                                        <li @click="visualizarPagina(37)">PANTALLA REGISTRO</li>
                                        <ul>
                                          <li @click="visualizarPagina(37)">PANEL DE INFORMACION</li>
                                          <li @click="visualizarPagina(38)">FORMULARIO ¿QUE?</li>
                                          
                                          <li @click="visualizarPagina(38)">FORMULARIO ¿CUMPLIMIENTO?</li>
                                          <li @click="visualizarPagina(39)">FORMULARIO ¿QUIEN?</li>
                            
                                        </ul>
                                        <li @click="visualizarPagina(39)">PANTALLA GESTIONAR</li>
                                        <ul>
                                          <li @click="visualizarPagina(40)">PANEL TABLA DE DATOS ACREDITACION</li>
                                        </ul>
                                        <li @click="visualizarPagina(41)">PANTALLA REPORTES ACREDITACION</li>
                                        
                                    </ul>
                                </li>
                                 <li >
                                    <b @click="visualizarPagina(42)">MODULO BIOMEDICINA</b>
                                    <ul>
                                        <li @click="visualizarPagina(42)">PANTALLA REGISTRO EQUIPO</li>
                                        <ul>
                                          <li @click="visualizarPagina(42)">PANEL DATOS DE EQUIPO</li>
                                          <li @click="visualizarPagina(44)">PANEL UBICACION</li>
                    
                                        </ul>
                                        <li @click="visualizarPagina(44)">PANTALLA INVENTARIO DE EQUIPO</li>
                                        <ul>
                                          <li @click="visualizarPagina(45)">PANEL TABLA DE DATOS EQUIPOS</li>
                    
                                        </ul>
                                        <li @click="visualizarPagina(46)">PANTALLA CRONOGRAMA MANTENIMIENTO EQUIPOS</li>
                                        <ul>
                                          <li @click="visualizarPagina(46)">PANEL TABLA CRONOGRAMA DE MANTENIMIENTO DE EQUIPOS</li>
                    
                                        </ul>
                                    </ul>
                                </li>
                                   <li >
                                    <b @click="visualizarPagina(47)">MODULO CUMPLEAÑOS</b>
                                   
                                </li>
                                 <li >
                                    <b @click="visualizarPagina(48)">MODULO AUTENTICACION</b>
                                    <ul>
                                        <li @click="visualizarPagina(48)">PANTALLA EMPLEADOS</li>
                               
                                        <li @click="visualizarPagina(49)">PANTALLA USUARIOS</li>
                                       
                                        <li @click="visualizarPagina(50)">PANTALLA ROLES</li>
                                        <li @click="visualizarPagina(50)">PANTALLA PERMISOS</li>
                                       
                                    </ul>
                                </li>
                                <li @click="visualizarPagina(51)">
                                    <b>ANEXOS</b>
                                </li>
                                <li @click="visualizarPagina(52)">
                                    <b>CONTROL DE CAMBIOS</b>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>

                <div class="col-md-9 col-lg-9">
                    <div class="box box-primary">
                        <div class="box-body text-center">
                            <div class="col-xs-1" style="display: flex; height: 1058px; align-items: center;">
                                <button type="button" class="btn btn-primary" @click="cambiarAnteriosPagina()"> 
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            </div>
                            <div class="col-xs-10">
                                <canvas id="canvas-manual-usuario">
                                    Manual de usuario
                                </canvas>
                            </div>
                            <div class="col-xs-1" style="display: flex; height: 1058px; align-items: center;">
                                <button type="button" class="btn btn-primary" @click="cambiarSiguientePagina()"> 
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>

                            <div class="embed-responsive hidden" style="height: 1125px;">
                                <object data='/soportes/documentacion/Manual de Usuario HUEM.pdf' type='application/pdf' width='100%' height='100%'></object>
                            </div>

                            <div>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" @click="cambiarAnteriosPagina()"> 
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="btn btn-default"> 
                                        {{ documento.pagina_actual }} / {{ documento.total_paginas }}
                                    </button>
                                    <button type="button" class="btn btn-primary" @click="cambiarSiguientePagina()"> 
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

                
    </div>
</template>

<script>

window.pdfjsLib = require('pdfjs-dist');

export default {
    data: function() {
        return({
            usuario: USUARIO,

            url_manual: '/soportes/documentacion/Manual de Usuario HUEM.pdf',

            documento: {
                pagina_actual: 1,
                total_paginas: 1,
            },

            filtro_paginas: '',
        })
    },
    computed:{
      empleado: function() {
        return this.usuario.empleado;
      }
    },

    watch: {
        'documento.pagina_actualx': function() {
            this.visualizarPagina(this.documento.pagina_actual);
        },

        'filtro_paginas': function(filtro) {
            filtro = filtro.toLowerCase();

            let elementos = document.querySelectorAll('ul.menu-contenido > li');

            elementos.forEach((el) => {
                //el.innerText.toLowerCase().includes(filtro) 
                //? el.classList.remove('hidden') 
                //: el.classList.add('hidden');

                if( el.innerText.toLowerCase().includes(filtro) ) {
                    el.classList.remove('hidden');

                    el.querySelectorAll('li').forEach((hijo) => {
                        hijo.classList.remove('hidden');
                    });
                }
                else {
                    let children = 0;

                    el.querySelectorAll('li').forEach((hijo) => {
                        if( hijo.innerText.toLowerCase().includes(filtro) ) {
                            hijo.classList.remove('hidden');
                            children += 1;
                        }
                        else {
                            hijo.classList.add('hidden');
                        }
                    });

                    children ? el.classList.remove('hidden') : el.classList.add('hidden');
                }

                return true;
            })
        }
    },

    methods: {
        visualizarPagina: function(numero_pagina){
            let me = this;

            pdfjsLib.getDocument(this.url_manual).then((documento) => {
                //console.log('documento', documento);

                documento.getPage(numero_pagina).then((pagina) => {
                    //console.log('pagina', pagina);

                    let viewport = pagina.getViewport(3);
                    
                    // Prepare canvas using PDF page dimensions
                    let canvas  = document.getElementById('canvas-manual-usuario');
                    let context = canvas.getContext('2d');

                    canvas.height = viewport.height;
                    canvas.width  = viewport.width;

                    console.log('viewport.width:', viewport.width, 'viewport.height', viewport.height);

                    pagina.render({
                        canvasContext: context,
                        viewport: viewport,
                    });

                    me.documento.pagina_actual = numero_pagina;
                });

                me.documento.total_paginas = documento._pdfInfo.numPages;
            });
        },

        cambiarAnteriosPagina: function() {
            let pagina = this.documento.pagina_actual;

            if( this.documento.pagina_actual > 1  ) {
                pagina = this.documento.pagina_actual - 1;
            }

            this.documento.pagina_actual = pagina;
            this.visualizarPagina(pagina);
        },

        cambiarSiguientePagina: function() {
            let pagina = this.documento.pagina_actual;

            if( this.documento.pagina_actual < this.documento.total_paginas ) {
                pagina = this.documento.pagina_actual + 1;
            }

            this.documento.pagina_actual = pagina;  console.log(pagina);
            this.visualizarPagina(pagina);
        },
    },
    mounted: function() {
        console.log(USUARIO, pdfjsLib);

        this.visualizarPagina(1);

        /*
        pdfjsLib.getDocument(this.url_manual).then((documento) => {
            console.log('documento', documento);

            documento.getPage(1).then((pagina) => {
                console.log('pagina', pagina);

                let viewport = pagina.getViewport(1.5);

                // Prepare canvas using PDF page dimensions
                var canvas  = document.getElementById('canvas-manual-usuario');
                var context = canvas.getContext('2d');

                canvas.height = viewport.height;
                canvas.width  = viewport.width;

                console.log('viewport.width:', viewport.width, 'viewport.height', viewport.height);

                pagina.render({
                    canvasContext: context,
                    viewport: viewport,
                });

                me.documento.pagina_actual = 1;
            });

            me.documento.total_paginas = documento._pdfInfo.numPages;
        });
        */
    }
}
</script>

<style scoped>

ul > li {
    cursor: pointer;
}

#canvas-manual-usuario {
    max-width: 816px; 
    height: 1058px; 
    border: 1px solid #666666
}

@media (max-width: 1400px) {
    #canvas-manual-usuario {
        max-width: 652px; 
        height: 846px; 
        border: 1px solid #666666
    }
}

</style>

