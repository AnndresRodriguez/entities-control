export default [
    { path: '/gestor_permisos/', redirect: '/gestor_permisos/panel' },

    { path: '/gestor_permisos/solicitar_permisos', component: () => import(/* webpackChunkName: "GestorPermisos.SolicitarPermisos" */ '../components/gestor_permisos/SolicitarPermisos.vue') },

    { path: '/gestor_permisos/listado_softwares', component: () => import(/* webpackChunkName: "GestorPermisos.ListadoSoftware" */ '../components/gestor_permisos/ListadoSoftwares.vue') },

    { path: '/gestor_permisos/validar_permisos', component: () => import(/* webpackChunkName: "GestorPermisos.ValidarPermisos" */ '../components/gestor_permisos/ValidarPermisos.vue') },

    { path: '/gestor_permisos/validar_permisos/:empleado/jefe_inmediato/:jefe', component: () => import(/* webpackChunkName: "GestorPermisos.ValidarPermisos" */ '../components/gestor_permisos/ValidarPermisos.vue') },

    { path: '/gestor_permisos/asignar_permisos', component: () => import(/* webpackChunkName: "GestorPermisos.ValidarPermisos" */ '../components/gestor_permisos/AsignarPermisos.vue') },

    { path: '/gestor_permisos/asignar_permisos/:empleado', component: () => import(/* webpackChunkName: "GestorPermisos.ValidarPermisos" */ '../components/gestor_permisos/AsignarPermisos.vue') },

    { path: '/gestor_permisos/asignar_permisos/empleado/:empleado', component: () => import(/* webpackChunkName: "GestorPermisos.ValidarPermisos" */ '../components/gestor_permisos/AsignarPermisos.vue') },
]