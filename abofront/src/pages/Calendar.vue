<template>
<q-page class="q-pa-xs">
  <div class="row">
    <div class="col-12">
      <q-form @submit="misdatos" class="q-gutter-md">
        <div class="row " style="display: flex;  align-items: center;  justify-content: center">
          <div class="col-12 col-sm-1"></div>
          <div class="col-12 col-sm-5"><q-input dense outlined v-model="fecha1" type="date" label="Mes/anio" required/></div>
          <div class="col-12 col-sm-5 flex flex-center"><q-btn icon="search" label="Consultar" type="submit" color="primary"/> </div>
          <div class="col-12 col-sm-1"></div>
        </div>
      </q-form>
    </div>

  <div class="col-12 col-sm-1"></div>
  <div class="col-12 col-sm-10">
<!--    <div style="display: flex;  align-items: center;  justify-content: center">-->
      <FullCalendar class="full-height" :options="calendarOptions" />
<!--    </div>-->
  </div>
    <div class="col-12 col-sm-1"></div>
  </div>

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
              <q-btn dense label="Finalizar" color="positive"  icon="check" size="xs" v-if="agen.estado=='EN ESPERA'" @click="actualiza"/>
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
import timeGridPlugin from '@fullcalendar/timegrid'
import {date} from "quasar";
import esLocale from "@fullcalendar/core/locales/es";

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      fecha1:date.formatDate(new Date(),'YYYY-MM-DD'),
      events: [],
      despacho:{},
      agen:{},
      dialogdatos:false,
      calendarOptions: {
      selectable:true,
      plugins: [ dayGridPlugin, timeGridPlugin,interactionPlugin], headerToolbar: {
      left: 'prev,next',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay',
      },
        initialView: 'timeGridWeek',
        locale: esLocale,
        allDaySlot:false,
        editable: true,
        selectMirror: true,
        dayMaxEvents: true,
        // weekends: true,
        // select: this.handleDateSelect,
       // dateClick: this.handleDateClick,
        eventClick: this.eventTitleClick,
        dateClick:this.dateClick,
       // select:this.handleSelect,
        events: [
          // { title: 'event 1', date: '2022-02-01' },
          // { title: 'event 2', date: '2022-02-02' }
        ],

        weekends: true // initial value
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
        actualiza(){
      this.$q.dialog({
        title: 'Fin de Actividad',
        message: 'Esta Seguro de Finalizar?',
        cancel: true,
      }).onOk(() => {
      this.$axios.post(process.env.API+'/finalizar',{id:this.agen.id}).then(res=>{
        this.dialogdatos=false
        this.misdatos()
          this.$q.notify({
            message: 'Actualizado',
            caption: 'Agenda Actualizada',
            color: 'green',
            icon:'done'
          });
          this.misdatos()
      })
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })

    },
    misdatos(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/listagenda',{fecha:this.fecha1}).then(res=>{
          console.log(res.data)
        this.events=[]
        res.data.forEach(r=>{
          // console.log(r)
          if (r.userterminado_id==null){
            if(r.estado!='AGENDAR')
            this.events.push({ title: r.actividad, start: r.fechaini+' '+r.horaini,color:'#D32F2F',id:r.id })
                        else
            {this.events.push({ title: r.actividad, start: r.fechaini+' '+r.horaini,color:'#BD87BB',id:r.id })}
          }else{
            this.events.push({ title: r.actividad, start: r.fechaini+' '+r.horaini,color:'#388E3C',id:r.id })

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
     eventTitleClick: function(args) {
       console.log(args.event.id)
       this.$q.loading.show()
      this.$axios.post(process.env.API+'/evagenda/'+args.event.id).then(res=>{
         console.log(res.data)
        this.agen={}
        this.$q.loading.hide()
        this.despacho=res.data[0].despacho
        this.agen=res.data[0]
        //console.log(this.agen.estado)
        if(this.agen.estado!='AGENDAR')
        {this.dialogdatos=true;}
        else
        this.dialogdatos=false;
      })


     },
     dateClick: function(info){
       let fec= (date.formatDate(info.dateStr,'YYYY-MM-DD'))
       let hr=(date.formatDate(info.dateStr,'HH:mm:ss'))
      this.$q.dialog({
        title: 'AGENDAR',
        message: 'Actividad',
        prompt: {
          model: '',
          type: 'text' // optional
        },
        cancel: true,
        persistent: false
      }).onOk(data => {
        this.$axios.post(process.env.API+'/agendar',{'actividad':data,'fecha':fec,'hora':hr}).then(res=>{
          this.misdatos()
        })
        // console.log('>>>> OK, received', data)*
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })

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
