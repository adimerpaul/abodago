<template>
<q-page class="q-pa-xs">
  <div class="row">
    <div class="col-12">
      <q-form @submit="misdatos" class="q-gutter-md">
        <div class="row " style="display: flex;  align-items: center;  justify-content: center">
          <div class="col-12 col-sm-1"></div>
          <!--<div class="col-12 col-sm-5"><q-input dense outlined v-model="fecha1" type="date" label="Mes/anio" required/></div>
          <div class="col-12 col-sm-5 flex flex-center"><q-btn icon="search" label="Consultar" type="submit" color="primary"/> </div>-->
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
  </div>

          <q-dialog v-model="dialogdatos">
          <q-card >
            <q-card-section>
              <div class="text-h6"> <q-icon name="code"/> {{despacho.cliente.nombre}} </div>
            </q-card-section>
            <q-card-section>
              <q-form >
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <q-input disable dense outlined label="Cliente" :model-value="despacho.cliente.nombre " />
                  </div>
                  <div class="col-12 col-sm-12">
                    <q-input disable dense outlined label="tramite" :model-value="despacho.tramite.nombre" />
                  </div>
                  <div class="col-12 col-sm-4">
                    <q-input disable dense outlined label="fechafin" v-model="agen.fechafin" type="date" />
                  </div>
                  <div class="col-12 col-sm-4">
                    <q-input disable dense outlined label="horafin" v-model="agen.horafin" type="time"/>
                  </div>
                  <div class="col-12 col-sm-4">
                    <q-input disable dense outlined required label="actividad" v-model="agen.actividad" />
                  </div>
                  <div class="col-12 col-sm-4">
                    <q-input disable dense outlined required label="proximopaso" v-model="agen.proximopaso" />
                  </div>
                  <div class="col-12 col-sm-4">
                    <q-input disable dense outlined label="etapa" :model-value="agen.etapa.numero+' '+agen.etapa.nombre" />
<!--                    <pre>{{agen}}</pre>-->
                  </div>
                   <div class="col-12 ">
                    <div class="">DEMANDADOS</div>
                    <ul>
                      <li v-for="r in agen.despacho.demandados" :key="r">{{r.ci}} {{r.nombre}}</li>
                    </ul>
                  </div>
                  <div class="col-12 col-sm-12">
                    <input v-if="agen.estado=='EN ESPERA'" type="file" dense outlined @change="getImage" ref="ima" accept="image/*"/>

                    <q-btn v-if="agen.estado=='EN ESPERA'" @click="actualiza" class="full-width" color="positive" label="FINALIZAR" icon="check"></q-btn>
                  </div>
                </div>
              </q-form>
              <q-table :rows="despacho.agendas" :columns="columnsAgenda" :rows-per-page-options="[10,20,50,0]">
                <template v-slot:body-cell-estado="props">
                  <q-td :props="props">
                    <q-badge :color="props.row.estado=='EN ESPERA'?'warning':'positive'">{{props.row.estado}}</q-badge>
                  </q-td>
                </template>
                <template v-slot:body-cell-usuario="props">
                  <q-td :props="props">
                    {{props.row.user.name}}
                  </q-td>
                </template>
              <template v-slot:body-cell-archivo="props">
                  <q-td :props="props" >
                    <q-btn v-if="props.row.archivo!='' && props.row.archivo!=null" color="info"  :label="props.row.archivo" icon="print" @click="descargar(props.row)" size="xs" />
                  </q-td>
                </template>
              </q-table>
            </q-card-section>
            <q-card-actions align="right">
              <!--          <q-btn flat label="Eliminar" color="deep-orange" @click="onDel" />-->
              <q-btn flat label="Cancelar" color="negative" icon="delete" v-close-popup />
            </q-card-actions>
<!--            <q-card-section class="q-pt-none">-->
<!--                <q-input dense label="Tramite / Proceso" v-model="despacho.tramite.nombre" outlined />-->
<!--                  <div class="col-12">-->
<!--                <div class="row">-->
<!--                  <div class="col-6"><q-input dense type="date" label="Fecha" outlined  v-model="despacho.fecha"/></div>-->
<!--                  <div class="col-6"><q-input dense label="Hora" outlined  v-model="despacho.hora"/></div>-->
<!--                </div>-->
<!--                <div >-->
<!--                <q-input label="Juzgado" outlined dense v-model="despacho.juzgado"/>-->
<!--                <q-input label="Juez" outlined dense v-model="despacho.juez"/>-->
<!--                <div class="row">-->
<!--                  <div class="col-6"><q-input dense label="NuRej" outlined  v-model="despacho.nurej"/></div>-->
<!--                  <div class="col-6"><q-input dense label="WebId" outlined  v-model="despacho.webid"/></div>-->

<!--                </div>-->

<!--                <q-input label="Proceso" outlined dense v-model="despacho.proceso"/>-->
<!--                </div>-->
<!--                <q-input label="ci" outlined dense v-model="despacho.ci"/>-->
<!--                <q-input label="demandante" outlined dense v-model="despacho.demandante"/>-->
<!--                <div>-->
<!--                <q-input label="representante" outlined dense v-model="despacho.representante"/>-->
<!--                </div>-->
<!--                </div>-->
<!--            </q-card-section>-->
<!--            <q-card-section align="right">-->
<!--              <q-btn dense label="Finalizar" color="positive"  icon="check" size="xs" v-if="agen.estado=='EN ESPERA'" @click="actualiza"/>-->
<!--              <q-btn flat label="Cancelar" color="primary" icon="delete" v-close-popup />-->
<!--            </q-card-section>-->
          </q-card>
        </q-dialog>

        <q-dialog v-model="dialogagenda1">
          <q-card >
            <q-card-section>
              AGENDAR
            </q-card-section>
            <q-card-section class="q-pt-none">
                <q-input label="ACTIVIDAD" outlined dense v-model="actividad"/>
                <q-select outlined v-model="user" :options="usuarios" label="Usuarios" />
            </q-card-section>
            <q-card-section align="right">
              <q-btn dense label="Registrar" color="positive"  icon="add" size="xs" @click="agendar"/>
            </q-card-section>
          </q-card>
        </q-dialog>

        <q-dialog v-model="dialogagenda">
          <q-card >
            <q-card-section>
            MODIFICAR
            </q-card-section>
            <q-card-section class="q-pt-none">
                <q-input label="ACTIVIDAD" outlined dense v-model="agen.actividad"/>
                <q-select outlined v-model="user" :options="usuarios" label="Usuarios" />
            </q-card-section>
            <q-card-section align="right">
              <q-btn dense label="Modificar" color="positive"  icon="check" size="xs" @click="actualizaagenda"/>
              <q-btn dense label="Eliminar" color="red"  icon="delete" size="xs" @click="eliminaagenda"/>
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
      columnsAgenda:[
        {field:'estado',label:'estado',name:'estado'},
        {field:'actividad',label:'actividad',name:'actividad'},
        {field:'proximopaso',label:'proximopaso',name:'proximopaso'},
        {field:'archivo',label:'archivo',name:'archivo'},

        {field:'user',label:'Usuario',name:'usuario'},
      ],
      dialogagenda1:false,
      fecha1:date.formatDate(new Date(),'YYYY-MM-DD'),
      events: [],
      fec:'',
      hr:'',
      actividad:'',
      despacho:{},
      url:process.env.API,
      imagen : null,
      agen:{},
      dialogdatos:false,
      dialogagenda:false,
      usuarios:[],
      user:{},
      pendiente:[],
      calendarOptions: {
        slotMinTime: "08:00:00",
        slotMaxTime: "22:00:00",
      selectable:true,
      plugins: [ dayGridPlugin, timeGridPlugin,interactionPlugin], headerToolbar: {
      left: 'prev,next',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,dayGridDay',
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
        height: "auto",
        weekends: true // initial value
      },

    }
  },
  created() {
    
    this.misdatos()
    this.misusuarios()
    let str = formatDate(new Date(), {
      month: 'long',
      year: 'numeric',
      day: 'numeric'
    });

    // console.log(str);
  },
  methods: {
            descargar(agenda){
              console.log(agenda) 
              var fileName=this.url+'/../archivos/'+agenda.archivo; 
              window.open(fileName, 'Download');
        },
    misusuarios(){
      this.usuarios=[]
      this.$axios.post(process.env.API+'/listuser').then(res=>{
        // console.log(res.data)
        this.usuarios=[]
        res.data.forEach(r => {
          let d =r
          d.label=r.name
          this.usuarios.push(d);
        });
        this.user=this.usuarios[0]
      })

    },
        actualiza(){
      this.$q.dialog({
        title: 'Fin de Actividad',
        message: 'Esta Seguro de Finalizar?',
        cancel: true,
      }).onOk(() => {
              var data = new  FormData();
      data.append('archivo', this.imagen);
      data.append('id', this.agen.id);
      this.$axios.post(process.env.API+'/finalizar',data).then(res=>{
        this.dialogdatos=false
        this.misdatos()
          this.$q.notify({
            message: 'Actualizado',
            caption: 'Agenda Actualizada',
            color: 'green',
            icon:'done'
          });
          // this.misdatos()
      })
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })

    },
         actualizaagenda(){
           this.agen.usuario_id=this.user.id;
            this.$axios.post(process.env.API+'/updagenda',this.agen).then(res=>{
              this.dialogagenda=false
              this.misdatos()
            })

         },
         eliminaagenda(){
            this.$axios.post(process.env.API+'/delagenda',this.agen).then(res=>{
              this.dialogagenda=false
              this.misdatos()

            })

         },
         agendar(){
           if(this.user.label==''){
             this.user.id=0
           }
          this.$axios.post(process.env.API+'/agendar',{'actividad':this.actividad,'usuario_id':this.user.id,'fecha':this.fec,'hora':this.hr}).then(res=>{
            console.log(res.data)
            this.actividad=''
            this.dialogagenda1=false
            this.misdatos()
            this.misusuarios()
        })
         },
    verpendiente(){

    },
    misdatos(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/listagenda',{fecha:this.fecha1}).then(res=>{
           console.log(res.data)
        this.events=[]
        this.pendiente=[]
        res.data.forEach(r=>{
          // console.log(r)
          if(r.estado=='EN ESPERA' && Date.parse(r.fechafin)<=Date.parse(date.formatDate(new Date(),'YYYY-MM-DD')))
            this.pendiente.push(r);

          if (r.userterminado_id==null){
            if(r.estado!='AGENDAR')
            this.events.push({ title: r.proximopaso, start: r.fechafin+' '+r.horafin,color:'#D32F2F',id:r.id })
            else
            {this.events.push({ title: r.proximopaso, start: r.fechafin+' '+r.horafin,color:'#BD87BB',id:r.id })}
          }else{
            this.events.push({ title: r.proximopaso, start: r.fechafin+' '+r.horafin,color:'#388E3C',id:r.id })
          }
        })
         console.log(this.pendiente)
                this.pendiente.forEach(element => {
          this.$q.notify({
            message: 'Pendiente',
            caption: ''+element.fechafin+' '+element.proximopaso,
            color: 'negative',
            icon:'info'
          });
      });

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
        getImage(event){
      //Asignamos la imagen a  nuestra data
      // console.log(event.target)
      this.imagen = event.target.files[0];
    },
     eventTitleClick: function(args) {
       // console.log(args.event.id)
       this.$q.loading.show()
      this.$axios.post(process.env.API+'/evagenda/'+args.event.id).then(res=>{
         console.log(res.data)
        this.agen={}
        this.$q.loading.hide()
        this.despacho=res.data[0].despacho
        this.agen=res.data[0]
        this.user={label:this.agen.user.name,r:this.agen.user}
        //console.log(this.agen.estado)
        if(this.agen.estado!='AGENDAR') {
          this.dialogdatos=true
        }else{
          this.dialogdatos=false
          this.dialogagenda=true
        }
      })


     },
     dateClick: function(info){
        this.fec= (date.formatDate(info.dateStr,'YYYY-MM-DD'))
        this.hr=(date.formatDate(info.dateStr,'HH:mm:ss'))
        this.dialogagenda1=true;

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
