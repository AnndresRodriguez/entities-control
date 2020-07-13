export default [
    // { path: '/entes_control/', redirect: '/entes_control/panel' },

    { path: '/entes_control/crear_informe', component: () => import(
    	'../components/entes_control/crearinforme.vue')
	},
    { path: '/entes_control/cargar_evidencias', component: () => import(
        '../components/entes_control/cargarEvidencias.vue')
    },
    { path: '/entes_control/listado_informes', component: () => import(
        '../components/entes_control/listadoinformes.vue')
	},
    { path: '/entes_control/configuracion_general', component: () => import(
        '../components/entes_control/configuracionGeneral.vue')
	}

]
