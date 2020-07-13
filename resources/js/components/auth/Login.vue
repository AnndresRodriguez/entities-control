<template>
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

        <div class="panel panel-info" >
                
            <div class="panel-heading">
                <div class="panel-title">Iniciar sesión</div>
            </div>
                

            <div style="padding-top:30px" class="panel-body">
                    
                <form id="loginform" class="form-horizontal" role="form" @submit.prevent="iniciarSesion()">
                            
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" name="login-username" type="text" class="form-control" v-model="usuario" placeholder="username or email" required>                                        
                    </div>
                        
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" name="login-password" type="password" class="form-control" v-model="password" placeholder="password" required>
                    </div>

                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input id="login-remember" name="login-remember" type="checkbox" v-model="remember"> Recordarme
                            </label>
                        </div>
                    </div>

                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button type="submit" id="btn-login" class="btn btn-primary"> <span class="glyphicon glyphicon-user"></span> INGRESAR </button>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                Olvido su contraseña? 
                                <router-link to="/PasswordReset">
                                    Click aqui
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
        data: function(){
            return({
                token   : document.getElementsByName('_token')[0].value,
                usuario : '',
                password: '',
                remember: false,
            })  
        },
        methods: {
            iniciarSesion: function(){
                let interceptor = axios.interceptors.request.use((config) => {
                    Swal({ title: 'Comprobando credenciales', allowEscapeKey: false, allowOutsideClick: false,
                        onOpen: () => {
                            Swal.showLoading();
                        }
                    })
                    
                    return config;
                });

                axios.post('login', {
                    _token   : this.token,
                    usuario  : this.usuario,
                    password : this.password,
                    remember : this.remember,
                })
                .then( data => {
                    console.log('success:', data.data);

                    if( data.data.success == 1 )
                    {
                        Swal({ title: 'Ingresando', type: 'success', showConfirmButton: false });
                        location.href = '/';
                    }
                    else{
                        Swal({ title: data.data.msgerror, type: 'error' });
                    }
                })
                .catch( error => { 
                    console.log('error', error, error.response, error.response.code);

                    Swal({ 
                        title: 'Error desconocido al intentar iniciar session.', 
                        type: 'error',
                    })
                    .then(() => {
                        if( error.response ){
                            error.response.status === 419 ? window.location.reload() : false;
                        }
                    })
                })

                axios.interceptors.request.eject(interceptor);
            }
        }
    }
</script>
