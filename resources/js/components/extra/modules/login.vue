<template>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card-login">
                <img class="mb4 text-center logo-login" src="/images/logo-vertical.svg" >
                <div class="bienvenida">
                    <span style="max-width: 400px">Bienvenido, inicia tu sesión.</span>
                </div>
                <div class="card-body">
                    <form>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <input id="username" type="text" class="input-login" name="username" required autocomplete="username" placeholder="Usuario">

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <input id="password" type="password" class="input-login" name="password" value="" required autocomplete="password" placeholder="Contraseña">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 offset-md-4 col-xs-12 text-center">
                                <button type="submit" class="btn btn-entrar-login">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <label class="recovery-password">¿Olvidaste tu contraseña?</label>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
