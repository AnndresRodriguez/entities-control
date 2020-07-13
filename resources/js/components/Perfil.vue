<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header section-header">
            <h1>
                PERFIL
                <small>Usuario</small>
            </h1>
            <ol class="breadcrumb">
                <li><router-link to="/"><i class="fa fa-tachometer-alt blue"></i> Dashboard </router-link></li>
                <li class="active"> Perfil usuario </li>
            </ol>
        </section>

        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <div class="div-image-profile">
                <img class="profile-user-img img-responsive img-circle" :src="usuario.image_profile" :alt="usuario.nombre">
                <i class="fas fa-camera pull-right"></i>
              </div>

              <h3 class="profile-username text-center">{{ usuario.nombre }}</h3>

              <p class="text-muted text-center">{{ empleado.cargo }}</p>

              <ul class="list-group list-group-unbordered hidden">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block hidden"><b>Follow</b></a>
              <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#mod-cambiar-foto-perfil">
                <i class="fas fa-camera"></i>
                Cambiar foto de Perfil
              </button>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>

        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#datos-basicos" data-toggle="tab" aria-expanded="true">Datos basicos</a></li>
              <li class=""><a href="#datos-usuario" id="btn-ver-datos-usuario" data-toggle="tab" aria-expanded="false">Datos de usuario</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="datos-basicos">
                <form class="form-horizontal" @submit.prevent="actualizarDatosEmpleado">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Documento</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="empleado.documento" required disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nombres</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="empleado.nombres" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Apellidos</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="empleado.apellidos" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Fecha de nacimiento</label>

                    <div class="col-sm-10">
                      <input type="date" class="form-control" v-model="empleado.fecha_nacimiento">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Genero</label>

                    <div class="col-sm-10">
                      <select class="form-control" v-model="empleado.genero" required>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Cargo</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="empleado.cargo" required disabled>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Actualizar datos</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="datos-usuario">
                <form class="form-horizontal" @submit.prevent="actualizarDatosUsuario">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Usuario</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="usuario.username" required disabled>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Correo</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="usuario.email" required>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Contraseña</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <div class="input-group-addon btn_primary"> <i class="fas fa-lock"></i> </div>
                          <input class="form-control" :type="type_password" name="password" v-model="usuario.password" required>
                          <div class="input-group-addon btn_primary" :class="type_password == 'password' ? '' : 'disabled'" @click="changeTypeInputPassword"> 
                              <i class="fas fa-eye"></i> 
                          </div>
                        </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Confirmar contraseña</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <div class="input-group-addon btn_primary"> <i class="fas fa-lock"></i> </div>
                          <input class="form-control" :type="type_password" name="password" v-model="usuario.password_confirmation" required>
                          <div class="input-group-addon btn_primary" :class="type_password == 'password' ? '' : 'disabled'" @click="changeTypeInputPassword"> 
                              <i class="fas fa-eye"></i> 
                          </div>
                        </div>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Rol</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="usuario.rol" disabled>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Estado</label>
                    <div class="col-sm-10">
                      <select class="form-control" v-model="empleado.estado" disabled>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Actualizar datos</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>

        <div id="mod-cambiar-foto-perfil" class="modal fade" tabindex="-1" role="dialog" aria-labelledbi="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <div class="col-xs-10">
                            <h3 class="titulo_modal">CAMBIAR IMAGEN DE PERFIL &nbsp;</h3>
                        </div>
                        <div class="col-xs-2">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div id="modal2" class="col-xs-12">

                            <form class="form-group" id="form-load-image" enctype="multipart/form-data"
                                @submit.prevent="cambiarFotoDePerfil">

                                <div class="mg-top-mod">
                                </div>

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="div-modal-image-profile">
                                          <img class="profile-user-img-modal img-responsive img-circle" :src="usuario.image_profile" :alt="usuario.nombre">
                                          <i class="fas fa-camera pull-right"></i>
                                        </div>
                                    </div>
                                </div>

                                <label class="col-xs-12 labelpanel"> Seleccionar </label>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon btn_primary">IMG</div>
                                            <input class="form-control" type="file" accept="image/*" id="imagen-perfil" name="imagen-perfil"
                                                @change="processImageProfile($event)" 
                                                required>
                                        </div>
                                        <b class="danger" v-if="!extesion_img">* El archivo seleccionado no tiene tipo de imagen valido.</b>
                                    </div>
                                </div>

                                <div class="col-xs-12" id="msg-trazabilidad">
                                    <b v-if="msgerrors_img"><img :src="msgerrors_img.img" style="width: 25px"> {{ msgerrors_img.mensaje }}</b>
                                </div>

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control">
                                            <span class="glyphicon glyphicon-floppy-disk"></span> Cargar foto 
                                        </button>
                                    </div>
                                </div>     

                            </form>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-rigth" data-dismiss="modal">CERRAR</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return({
            usuario: USUARIO,

            msgerrors: [],
            
            type_password: 'password',
            image_profile: false,
            extesion_img : true,
            msgerrors_img: {},
        })
    },
    computed:{
      empleado: function() {
        return this.usuario.empleado;
      }
    },
    methods: {
      /**
       * Este metodo permite cambiar la contraseña del usuario
       * 
       * @return void
       */
      changeTypeInputPassword: function() {
          this.type_password = this.type_password == 'password' ? 'text' : 'password';
      },

      /**
       * Este metodo actualiza los cambios realizados a la informacion del empleado
       * 
       * @return void
       */
      actualizarDatosEmpleado: function() {
        if( this.validarDatosEmpleado() ) {
          let interceptor = axios.interceptors.request.use((config) => {
              Swal.fire({ width: '60rem', title: 'Actualizando datos, espere un momento', allowEscapeKey: false, allowOutsideClick: false,
                  //timer: 2000,
                  onOpen: () => {
                      Swal.showLoading();
                  }
              })
              
              return config;
          });

          let empleado = this.empleado;

          axios.post('/empleado/update', empleado)
          .then(response => {
            Swal.fire({
                width: '60rem',
                type: 'success',
                html: '<h4>Datos actualizados correctamente.</h4>',
            });
          })
          .catch(errors => {
            console.log(errors);
            typeof(errors.response) != 'undefined' ? this.mostrarErroresHTTP(errors.response.data) : true;
          });

          axios.interceptors.request.eject(interceptor);
        }
        else {
          this.mostrarErroresDeValidacion();
        }
      },

    /**
     * Este metodo permite validar que los datos de los empleados esten completos
     * 
     * @return boolean
     */
      validarDatosEmpleado: function() {
        let empleado = this.empleado;
        let errores  = [];

        if( empleado.documento === '' ) {
          errores.push('El campo <b>Documento</b> no puede estar vacio.');
        }

        if( empleado.nombres === '' ) {
          errores.push('El campo <b>Nombres</b> no puede estar vacio.');
        }

        if( empleado.apellidos === '' ) {
          errores.push('El campo <b>Apellidos</b> no puede estar vacio.');
        }

        if( empleado.cargo === '' ) {
          errores.push('El campo <b>Cargo</b> no puede estar vacio.');
        }



        if( !errores.length ){
          return true;
        }

        this.msgerrors = errores;
        return false;
      },

      /**
       * Este metodo actualiza la informacion del usuario
       * 
       * @return Object
       * 
       */
      actualizarDatosUsuario: function() {
        if( this.validarDatosUsuario() ) {
          let interceptor = axios.interceptors.request.use((config) => {
              Swal.fire({ width: '60rem', title: 'Actualizando datos del usuario, espere un momento', allowEscapeKey: false, allowOutsideClick: false,
                  //timer: 2000,
                  onOpen: () => {
                      Swal.showLoading();
                  }
              })
              
              return config;
          });

          let usuario = this.usuario;

          axios.post('/usuario/update', usuario)
          .then(response => {
            Swal.fire({
                width: '60rem',
                type: 'success',
                html: '<h4>Datos actualizados correctamente.</h4>',
            });
          })
          .catch(errors => {
            console.log(errors);
            typeof(errors.response) != 'undefined' ? this.mostrarErroresHTTP(errors.response.data) : true;
          });

          axios.interceptors.request.eject(interceptor);
        }
        else {
          this.mostrarErroresDeValidacion();
        }
      },

      /** 
       * Este metodo permite validar que los datos del usuario esten completos
       * 
       * @return boolean
       */
      validarDatosUsuario: function() {
        let usuario = this.usuario;
        let errores = [];

        if( usuario.username === '' ) {
          errores.push('El campo <b>Usuario</b> no puede estar vacio.');
        }

        if( usuario.email === '' ) {
          errores.push('El campo <b>Correo</b> no puede estar vacio.');
        }


        if( !errores.length ){
          return true;
        }

        this.msgerrors = errores;
        return false;
      },

      /**
       * Este metodo visualiza errores de validacion de informacion. 
       * 
       * 
       * @return void
       */
      mostrarErroresDeValidacion: function() {
        let errores     = '';
        let msgerrores  = this.msgerrors;

        for(let i in msgerrores) {
            errores += '<h4>'+ msgerrores[i] +'</h4>';
        }

        Swal.fire({
            width:  '60rem', type: 'error',
            title: '<strong>Errores de validación</strong>',
            html: errores,
            showCloseButton: false,
            showCancelButton: false,
            confirmButtonText: 'Cerrar',
        });
      },

      /**
       * Este metodo procesa la imagen de perfil para visualizarse
       * 
       * @return void
       */
      processImageProfile(event) {
            let name_file = event.target.files[0].name;  console.log(name_file);

            if( !this.validarExtensionDeArchivo(name_file, ['png', 'jpg', 'jpeg']) ) {
                $('input#soporte-trazabilidad').val('');

                this.soporte      = '';
                this.extesion_img = false;
            }
            else {
                this.image_profile = event.target.files[0].name;
                this.extesion_img  = true;
            }
      },

      /**
       * Este metodo valida la extension del archivo que esta recibiendo. 
       * 
       * @param String nombre
       * @param Array extensiones
       * @return boolean
       */
      validarExtensionDeArchivo: function(nombre, extesiones) {
            let ext_file = nombre.toString().toUpperCase().match(/\.([a-z]+)$/i)[1].toLowerCase(); console.log(ext_file);

            if( ext_file && extesiones.includes(ext_file) ) {
                return true;
            }

            return false;
      },

      /**
       * Este metodo permite cambiar la foto de perfil del usuario y/o empleado
       * 
       * @return void
       */
      cambiarFotoDePerfil: function() {
          let interceptor = axios.interceptors.request.use((config) => {
              this.msgerrors_img = {
                  img:     '/img/Cargar.gif',
                  mensaje: 'Actualizando imagen de perfil.',
              }
              
              return config;
          });

          if( this.image_profile != '' && this.extesion_img ) {
              let form_data = new FormData( $('form#form-load-image')[0] );

              axios.post('/usuario/image_profile', form_data)
              .then(response => {  console.log(response);
                  let respuesta = response.data;

                  if( respuesta.success ) {
                      this.usuario.image_profile = respuesta.image;

                      setTimeout(() => {
                          $('div#mod-cambiar-foto-perfil').modal('hide');
                          this.vaciarFormulario();
                      }, 2000);
                  }
                  
                  this.msgerrors_img = {
                      img:     respuesta.success == 1 ? '/img/exitoso.jpg': '/img/error.jpg',
                      mensaje: respuesta.msgerror
                  };
              })
              .catch(error => {
                  console.log(error);
                  this.msgerrors_img = {
                      img:     '/img/error.jpg',
                      mensaje: 'Ocurrio un error al intentar actualizar la imagen de perfil, intentelo nuevamente.',
                  }
              });
          }
          else {
              this.msgerrors_img = {
                  img:     '/img/error.jpg',
                  mensaje: 'Debe llenar todos los campos antes de guardar.',
              }
          }

          axios.interceptors.request.eject(interceptor);
      },

      /**
       * Este metodo borra los campos del formulario 
       * 
       * @return void
       */
      vaciarFormulario: function() {
        this.image_profile = false,
        this.extesion_img  = true,
        this.msgerrors_img = {};

        $('input#image-profile').val('');
      },

      /**
         * Este metodo muestra los errores HTTP de la ventana del formulario del segundo seguimiento
         * 
         * @param String error
         * @return void
         */
      mostrarErroresHTTP: function(error) {
            let errores  = error.errors;
            let errormsg = '';

            for( let e in errores ){
                errormsg = errores[e][0];
                break;
            }

            errormsg = errormsg ? errormsg : 
                            (error.message ? error.message : 'Ocurrio un error desconocido al intentar realizar la peticion, intentelo nuevamente.');

            Swal.fire({ width: '60rem', type: 'error', title: errormsg });
        },


    },
    mounted: function() {
      console.log(USUARIO);
    }
}
</script>

<style scoped>

.div-image-profile {
  margin: 30px auto;
  width: 100px;
  padding: 0px;
}

.div-modal-image-profile {
  margin: 30px auto;
  width: 150px;
  padding: 0px;
}

.profile-user-img-modal {
    margin: 0 auto;
    width: 150px;
    padding: 3px;
    border: 3px solid #d2d6de;
}

.btn_primary {
    color: #fff;
    background-color: #204d74 !important;
    border-color: #122b40 !important;
}

.disabled {
    color: #000;
    background-color: #7c8186 !important;
    border-color: #122b40 !important;
}

</style>

