import Login from "pages/Login";
import Recepcion from "pages/Recepcion";
import User from "pages/User";
import Asignacion from "pages/Asignacion";
import Demandado from "pages/Demandado";
import Misrecepciones from "pages/Misrecepciones";
import Precio from "pages/Precio";
import Requisitos from "pages/Requisitos";
import Micotizacion from "pages/Micotizacion";
import Clientes from "pages/Clientes";
import Miagenda from "pages/Miagenda";
import Calendar from "pages/Calendar";
import Etapas from "pages/Etapas";
import Reporte from "pages/Reporte";

const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '/login', component: Login },
      { path: '/recepcion', component: Recepcion,meta: {requiresAuth: true,} },
      { path: '/user', component: User,meta: {requiresAuth: true,} },
      { path: '/requisitos', component: Requisitos,meta: {requiresAuth: true,} },
      { path: '/demandado', component: Demandado,meta: {requiresAuth: true,} },
      { path: '/asignacion', component: Asignacion,meta: {requiresAuth: true,} },
      { path: '/precio', component: Precio,meta: {requiresAuth: true,} },
      { path: '/misrecepciones', component: Misrecepciones,meta: {requiresAuth: true,} },
      { path: '/micotizacion', component: Micotizacion,meta: {requiresAuth: true,} },
      { path: '/clientes', component: Clientes,meta: {requiresAuth: true,} },
      { path: '/Etapas', component: Etapas,meta: {requiresAuth: true,} },
      { path: '/Reporte', component: Reporte,meta: {requiresAuth: true,} },
      { path: '', component: Calendar,meta: {requiresAuth: true,} },
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
