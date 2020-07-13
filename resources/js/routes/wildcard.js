export default [
    /***  RUTA 404 */
    { path: '*', component: () => import(/* webpackChunkName: "404" */ '../components/dashboard/Dashboard.vue') },
]