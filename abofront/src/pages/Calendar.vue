<template>
<q-page class="q-pa-xs">
  <q-form @submit="misdatos" class="q-gutter-md">
    <div class="row">
      <div class="col-6"><q-input dense outlined v-model="fecha1" type="date" label="Mes/anio" required/></div>
      <div class="col-6 flex flex-center"><q-btn icon="search" label="Consultar" type="submit" color="primary"/> </div>
    </div>
  </q-form>
  <FullCalendar :options="calendarOptions" />
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
      calendarOptions: {
        plugins: [ dayGridPlugin, interactionPlugin ],
        initialView: 'dayGridMonth',
        dateClick: this.handleDateClick,
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
          console.log(r)
          if (r.userterminado_id==null){
            this.events.push({ title: r.proximopaso, date: r.fechafin,color:'#D32F2F' },)
          }else{
            this.events.push({ title: r.proximopaso, date: r.fechafin,color:'#388E3C' },)
          }

        })
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
    handleDateClick: function(arg) {
      alert('date click! ' + arg.dateStr)
    },
    toggleWeekends: function() {
      this.calendarOptions.weekends = !this.calendarOptions.weekends // toggle the boolean!
    }
  }
}
</script>

<style scoped>

</style>
