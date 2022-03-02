<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />
        <q-toolbar-title>
          {{$store.state.login.user.name}}
        </q-toolbar-title>

        <div>
        <q-btn v-if="$store.getters['login/isLoggedIn']" label="Salir" @click="logout"  color="negative" icon="logout" size="xs" />
        </div>
      </q-toolbar>
      <div class="q-px-lg q-pt-xs q-mb-md" >
        <div class="text-h5 text-bold">
<!--          <template v-if="!$store.getters['login/isLoggedIn']">-->
          Del Castillo y Gonzales
<!--          </template>-->
<!--          <template v-else>-->
<!--            Unidad: {{$store.state.login.user.unit.nombre}}-->
<!--          </template>-->
        </div>
        <div class="text-subtitle1">{{ now }}</div>
      </div>
      <q-img src="img/banner.jpg" class="header-image absolute-top" style="height:100%"/>
    </q-header>
    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      :width="250"
      :breakpoint="600"
    >
      <q-scroll-area style="height: calc(100% - 130px); margin-top: 130px; border-right: 1px solid #ddd">
        <q-list padding>
          <q-item
            clickable
            exact
            to="/login"
            v-if="!$store.getters['login/isLoggedIn']"
          >
            <q-item-section
              avatar
            >
              <q-icon name="login" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Ingresar</q-item-label>
              <q-item-label caption>
                Ingreso al sistema
              </q-item-label>
            </q-item-section>
          </q-item>

          <q-item
            v-if="$store.state.login.boolagenda"
            clickable
            to="/"
          >
            <q-item-section
              avatar
            >
              <q-icon name="event" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Agenda</q-item-label>
              <q-item-label caption>
                Actividades en Fecha
              </q-item-label>
            </q-item-section>
          </q-item>

          <q-item
            v-if="$store.state.login.boolusuarios"
            clickable
            to="/user"
          >
            <q-item-section
              avatar
            >
              <q-icon name="people" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Usuarios</q-item-label>
              <q-item-label caption>
                Control de usuarios
              </q-item-label>
            </q-item-section>
          </q-item>

<!--          <q-item-->
<!--            v-if="$store.state.login.boolrecepcion"-->
<!--            clickable-->
<!--            to="/recepcion"-->
<!--          >-->
<!--            <q-item-section-->
<!--              avatar-->
<!--            >-->
<!--              <q-icon name="article" />-->
<!--            </q-item-section>-->

<!--            <q-item-section>-->
<!--              <q-item-label>Registro de correspondencia</q-item-label>-->
<!--              <q-item-label caption>-->
<!--                Recepciones de correspondencia-->
<!--              </q-item-label>-->
<!--            </q-item-section>-->
<!--          </q-item>-->
          <q-item
            v-if="$store.state.login.booltramite"
            clickable
            to="/requisitos"
          >
            <q-item-section
              avatar
            >
              <q-icon name="pending_actions" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Requisitos</q-item-label>
              <q-item-label caption>
                Requisitos
              </q-item-label>
            </q-item-section>
          </q-item>

          <q-item
            v-if="$store.state.login.booljuridico"
            clickable
            to="/asignacion"
          >
            <q-item-section
              avatar
            >
              <q-icon name="verified_user" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Personas Juridicas</q-item-label>
              <q-item-label caption>
                Juridicas
              </q-item-label>
            </q-item-section>
          </q-item>

          <q-item
            v-if="$store.state.login.boolnatural"
            clickable
            to="/clientes"
          >
            <q-item-section
              avatar
            >
              <q-icon name="supervised_user_circle" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Personas Naturales</q-item-label>
              <q-item-label caption>
                Naturales
              </q-item-label>
            </q-item-section>
          </q-item>

          <q-item
            v-if="$store.state.login.booldemandado"

            clickable
            to="/demandado"
          >
            <q-item-section
              avatar
            >
              <q-icon name="list" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Demandado</q-item-label>
              <q-item-label caption>
                Demandado y procesos
              </q-item-label>
            </q-item-section>
          </q-item>



          <q-item
                        v-if="$store.state.login.boolcotizacion"
            clickable
            to="/precio"
          >
            <q-item-section avatar>
              <q-icon name="code" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Cotizaciones</q-item-label>
              <q-item-label caption>
                creacion de cotizaciones
              </q-item-label>
            </q-item-section>
          </q-item>

          <q-item
              v-if="$store.state.login.boolmicotizacion"

            clickable
            to="/micotizacion"
          >
            <q-item-section avatar>
              <q-icon name="recent_actors" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Mis cotizacion</q-item-label>
              <q-item-label caption>
                Mis cotizacion
              </q-item-label>
            </q-item-section>
          </q-item>

          <q-item
            v-if="$store.getters['login/isLoggedIn']"
            clickable
            @click="logout"
          >
            <q-item-section
              avatar
            >
              <q-icon name="logout" />
            </q-item-section>

            <q-item-section>
              <q-item-label>Salir</q-item-label>
              <q-item-label caption>
                Salir del sistema
              </q-item-label>
            </q-item-section>
          </q-item>

        </q-list>
      </q-scroll-area>

      <q-img class="absolute-top" src="img/logocastillogonzales2.png" style="height: 130px">
        <div class="absolute-bottom bg-transparent ">
          <!--          <q-avatar size="56px" class="q-mb-sm">-->
          <!--            <img src="https://cdn.quasar.dev/img/boy-avatar.png">-->
          <!--          </q-avatar>-->
          <div class="text-weight-bold"> </div>
          <div></div>
        </div>
      </q-img>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import {date} from 'quasar'
export default {
  data(){
    return{
      leftDrawerOpen : false,
      now :date.formatDate(Date.now(), 'dddd D  MMMM', {
        days: ['Domingo', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado' /* and all the rest of days - remember starting with Sunday */],
        daysShort: ['Dum', 'Lun', /* and all the rest of days - remember starting with Sunday */],
        months: ['Enero', 'Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre' /* and all the rest of months */],
        monthsShort: ['Ian', 'Feb', /* and all the rest of months */]
      }),
      unidad:'aa'
    }
  },
  created() {
    // console.log(this.$store.getters['login/user'])
    // this.unidad=this.$store.getters['login/user'];
  },
  methods:{
    toggleLeftDrawer () {
      this.leftDrawerOpen = !this.leftDrawerOpen
    },
    logout () {
      this.$q.loading.show()
      this.$store.dispatch('login/logout')
        .then(() => {
          this.$q.loading.hide()
          this.$router.push('/login')
        })
    },
  }
}
</script>
<style lang="scss">
.header-image{
  height: 100%;
  z-index: -1;
  opacity: 6;
  filter: grayscale(10%);
}
</style>
