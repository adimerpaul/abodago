import Login from "pages/Login";
import Recepcion from "pages/Recepcion";
import User from "pages/User";
import Asignacion from "pages/Asignacion";
import Demandado from "pages/Demandado";
import Misrecepciones from "pages/Misrecepciones";
import Precio from "pages/Precio";

const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: Login },
      { path: '/recepcion', component: Recepcion,meta: {requiresAuth: true,} },
      { path: '/user', component: User,meta: {requiresAuth: true,} },
      { path: '/demandado', component: Demandado,meta: {requiresAuth: true,} },
      { path: '/asignacion', component: Asignacion,meta: {requiresAuth: true,} },
      { path: '/precio', component: Precio,meta: {requiresAuth: true,} },
      { path: '/misrecepciones', component: Misrecepciones,meta: {requiresAuth: true,} },
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
