<template>
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

        <div class="panel panel-info" >
                
            <div class="panel-heading">
                <div class="panel-title">Restablecer la contraseña</div>
            </div>
                

            <div style="padding-top:30px" class="panel-body">
                    
                <form id="passwordResetForm" class="form-horizontal" role="form" @submit.prevent="restablecerContrasena()">
                            
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon">@</span>
                        <input id="passwordReset-email" type="text" class="form-control" name="email" v-model="email" placeholder="Ingrese su correo" required>
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon">*</span>
                        <input id="passwordReset-password" type="password" class="form-control" name="password" v-model="password" placeholder="Ingrese su nueva contraseña" required autocomplete="false">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon">*</span>
                        <input id="passwordReset-password-confirmation" type="password" class="form-control" name="password_confirmation" v-model="password_confirmation" placeholder="Confirme su nueva contraseña" required autocomplete="false">
                    </div>
                            

                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <button type="submit" id="btn-login" class="btn btn-primary"> <span class="glyphicon glyphicon-user"></span> RESTABLECER CONTRASEÑA </button>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                Ya tienes una cuenta? 
                                <router-link to="/">
                                    Iniciar sesión
                                </router-link>
                            </div>
                        </div>
                    </div>

                </form>     

            </div>                     
        </div>  
    </div>
</template>

<script>
    export default {
        //el: '#loginbox',
        data() {
            return({
                token1  : document.getElementsByName('_token')[0].value,
                token   : this.$route.params.token,
                email   : this.$route.params.email,
                password: '',
                password_confirmation: '',
            })
        },
        methods: {
            restablecerContrasena: function(){
                let interceptor = axios.interceptors.request.use((config) => {
                    Swal({ title: 'Restableciendo contraseña', allowEscapeKey: false, allowOutsideClick: false,
                        onOpen: () => {
                            Swal.showLoading();
                        }
                    })

                    return config;
                });

                axios.post('/password/reset', {
                    _token  : this.token1,
                    token   : this.token,
                    email   : this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
                .then( response => {
                    console.log('success', response);

                    if( response.data.success == 1 )
                    {
                        Swal({ type: 'success', title: 'Su contraseña se restablecio correctamente', })
                        .then(data => {
                            window.location.reload(true);
                        });
                    }
                    else{
                        Swal({ 
                            type: 'error', 
                            title: response.data.status || 'Ocurrio un error inesperado al intentar reestablecer tu contraseña.'
                        });
                    }
                })
                .catch( error => {
                    console.log('error', error);
                    typeof(error.response) != 'undefined' ? this.mostrarErroresHTTP(error.response.data) : true;
                })

                axios.interceptors.request.eject(interceptor);
            },

            getEmailPasswordReset: function() {
                axios.post('/password/reset/email', {
                    token: this.token,
                })
                .then(response => {
                    console.log('success', response);
                })
                .catch( error => {
                    console.log('error', error);
                });
            },

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
        mounted() {
            //axios.post('logout', { _token: this.token });
            console.log('Component mounted Password reset forgot.');

            //this.getEmailPasswordReset();
        }
    }
</script>
