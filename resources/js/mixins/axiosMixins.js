let user = document.head.querySelector('meta[name="user"]');

export default {
    methods:{
        /**
         * Este metodo configura un interceptor el cual se mostrara al ejecutar una petición http con axios.
         * 
         * @param {string} mensaje
         * 
         * @return {object}
         */
        setInterceptorAxios: function(mensaje='Actualizando datos, espere un momento') {
            return axios.interceptors.request.use((config) => {
                Swal.fire({ 
                    width: '60rem', 
                    title: mensaje, 
                    allowEscapeKey: false, 
                    allowOutsideClick: false,
                    //timer: 2000,
                    onOpen: () => {
                        Swal.showLoading();
                    }
                })
                
                return config;
            });
        },

        /**
         * Este metodo configura un interceptor dentro de un objecto al ejecutar una llamada http con axios.
         * 
         * @param {string} mensaje
         * @param {object} objecto
         * 
         * @return {object}
         */
        setInterceptorInObject: function(mensaje='Actualizando datos, espere un momento', objecto) {
            return axios.interceptors.request.use((config) => {
                objecto = {
                            img:     '/img/Cargar.gif',
                            mensaje: mensaje,
                        }
                
                return config;
            });
        },

        /**
         * Este metodo visualiza los errores HTTP de la peticion axios, el cual se mostrara en una ventana de sweetaleert.
         * 
         * @return void
         * 
         */
        mostrarErroresHttpAxios: function(error) {
            let errores  =  typeof(error.response.data.errors) != 'undefined' ? error.response.data.errors : false;
            let errormsg = 'Ocurrio un error desconocido al intentar realizar la peticion, intentelo nuevamente.';

            for( let e in errores ){
                errormsg = errores[e][0];
                break;
            }

            errormsg = errormsg;  //console.log('error.response.data', error.response.data.message);

            Swal.fire({ width: '60rem', type: 'error', title: errormsg });
        },
    }
};
