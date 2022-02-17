<template>
<q-page class="q-pa-xs">
  <q-form @submit="misdatos" class="q-gutter-md">
    <div class="row col-10" style="display: flex;  align-items: center;  justify-content: center">
      <div class="col-5"><q-input dense outlined v-model="fecha1" type="date" label="Mes/anio" required/></div>
      <div class="col-5 flex flex-center"><q-btn icon="search" label="Consultar" type="submit" color="primary"/> </div>
    </div>
  </q-form>
  <div style="display: flex;  align-items: center;  justify-content: center"><div style="width:90%;"><FullCalendar :options="calendarOptions" /></div></div>
          <q-dialog v-model="dialogdatos">
          <q-card >
            <q-card-section>
              <div class="text-h6"> <q-icon name="code"/> {{despacho.cliente.nombre}} </div>
            </q-card-section>
            <q-card-section class="q-pt-none">
                <q-input dense label="Tramite / Proceso" v-model="despacho.tramite.nombre" outlined />
                  <div class="col-12">
                <div class="row">
                  <div class="col-6"><q-input dense type="date" label="Fecha" outlined  v-model="despacho.fecha"/></div>
                  <div class="col-6"><q-input dense label="Hora" outlined  v-model="despacho.hora"/></div>
                </div>
                <div >
                <q-input label="Juzgado" outlined dense v-model="despacho.juzgado"/>
                <q-input label="Juez" outlined dense v-model="despacho.juez"/>
                <div class="row">
                  <div class="col-6"><q-input dense label="NuRej" outlined  v-model="despacho.nurej"/></div>
                  <div class="col-6"><q-input dense label="WebId" outlined  v-model="despacho.webid"/></div>

                </div>

                <q-input label="Proceso" outlined dense v-model="despacho.proceso"/>
                </div>
                <q-input label="ci" outlined dense v-model="despacho.ci"/>
                <q-input label="demandante" outlined dense v-model="despacho.demandante"/>
                <div>
                <q-input label="representante" outlined dense v-model="despacho.representante"/>
                </div>
                </div>
            </q-card-section>
            <q-card-section align="right">
              <q-btn flat label="Cancelar" color="primary" icon="delete" v-close-popup />
            </q-card-section>
          </q-card>
        </q-dialog>


</q-page>
</template>

<script>
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar, {formatDate} from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import {date} from "quasar";
export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      fecha1:date.formatDate(new Date(),'YYYY-MM-DD'),
      events: [],
      despacho:{},
      dialogdatos:false,
      calendarOptions: {
        selectable:true,
        plugins: [ dayGridPlugin, interactionPlugin ],
        initialView: 'dayGridMonth',
        dateClick: this.handleDateClick,
        eventClick: this.eventTitleClick,
        events: [
          // { title: 'event 1', date: '2022-02-01' },
          // { title: 'event 2', date: '2022-02-02' }
        ],

        weekends: false // initial value
      },

    }
  },
  created() {
    this.misdatos()
    let str = formatDate(new Date(), {
      month: 'long',
      year: 'numeric',
      day: 'numeric'
    });

    // console.log(str);
  },
  methods: {
    misdatos(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/listagenda',{fecha:this.fecha1}).then(res=>{
        // console.log(res.data)
        this.events=[]
        res.data.forEach(r=>{
          // console.log(r)
          if (r.userterminado_id==null){
            this.events.push({ title: r.proximopaso, date: r.fechafin,color:'#D32F2F',r },)
          }else{
            this.events.push({ title: r.proximopaso, date: r.fechafin,color:'#388E3C',r },)
          }

        })
        console.log(this.events)
        this.$q.loading.hide()
        this.calendarOptions.events=this.events
        // this.agenda=res.data
        // this.mensaje()
      }).catch(err=>{
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error',
        })
        this.$q.loading.hide()
      })
    },
     eventTitleClick: function(info) {
      console.log(info)

     },
    handleDateClick: function(arg) {
      //this.despacho=arg.r.despacho;
      console.log(arg)
      //this.dialogdatos=true;

      //alert('date click! ' + arg.dateStr)
    },
    toggleWeekends: function() {
      this.calendarOptions.weekends = !this.calendarOptions.weekends // toggle the boolean!
    }
  }
}
</script>

<style scoped>

</style>
