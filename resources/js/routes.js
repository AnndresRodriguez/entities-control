const rutasBase = [
    { path: '/',        component: () => import(/* webpackChunkName: "Dashboard" */'./components/dashboard/Dashboard.vue'), },
    { path: '/perfil',  component: () => import(/* webpackChunkName: "Perfil" */'./components/Perfil.vue'), },
]

import administrar from './routes/administrar'
import generales from './routes/generales'
import gestor_permisos from './routes/gestor_permisos'
import entes_control from './routes/entes_control'


import wildcard from './routes/wildcard'

const routes = rutasBase
                .concat(administrar)
                .concat(generales)
                .concat(gestor_permisos)
                .concat(entes_control)
                .concat(wildcard)
                ;


export default routes;
