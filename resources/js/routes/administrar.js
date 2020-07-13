export default [
    { path: '/administrar/', redirect: '/administrar/empleados' },

    { path: '/administrar/empleados', component: () => import(/* webpackChunkName: "Empleados" */'../components/administrar/empleados/Empleados.vue'), },

    { path: '/administrar/usuarios', component: () => import(/* webpackChunkName: "Usuarios" */'../components/administrar/usuarios/Usuarios.vue'), },

    { path: '/administrar/roles', component: () => import(/* webpackChunkName: "Roles" */'../components/administrar/roles/Roles.vue'), },

    { path: '/administrar/permisos', component: () => import(/* webpackChunkName: "Permisos" */'../components/administrar/permisos/Permisos.vue'), },
]