export default [
    { path: '/generales/acciones', component: () => import(/* webpackChunkName: "Acciones" */ '../components/generales/Acciones.vue') },

    { path: '/generales/sesiones', component: () => import(/* webpackChunkName: "Sesiones" */ '../components/generales/Sesiones.vue') },
]