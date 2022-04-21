<template>
  <q-page class="q-pa-xs">
    <q-form @submit="misdatos" class="q-gutter-md" >
    <div class="row">

    <div class="col-3"> <q-input type="date" outlined v-model="datos.fecha1" label="Fecha Ini" /></div>
    <div class="col-3"> <q-input type="date" outlined v-model="datos.fecha2" label="Fecha Fin" /></div>

    <div class="col-3"> <q-btn label="Consultar" type="submit" color="info"/></div>
    </div>
    
    </q-form>
  

    <div class="row">
      <div class="col-12">
        <q-table dense title="Resumen Ingresos Egresos" :rows="reportes" :columns="columns" :filter="filter" >
 



          <template v-slot:top-right>
            <q-input outlined  dense debounce="300" v-model="filter" placeholder="Buscar">
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
        </q-table>
      </div>



    </div>
    <br>
          <div class="row">
      <div class="col-3"><b>INGRESOS: </b>{{totalingreso}}</div>
      <div class="col-3"><b>EGRESOS: </b>{{totalegreso}}</div>
      <div class="col-3"><b>EGR CLIENTE: </b>{{totalegotro}}</div>
      </div>
  </q-page>
</template>

<script>
import { jsPDF } from "jspdf"
import {date} from 'quasar'
export default {
  data(){
    return{
      filter:'',
      precio:{},
      reportes:[],
      precios:[],     
      proforma:{},
      cotizacion:[],
      dialog_mod:false,
      info:{},
      datos:{fecha1:date.formatDate(Date.now(),'YYYY-MM-DD'),fecha2:date.formatDate(Date.now(),'YYYY-MM-DD')},
      columns:[
        {label:'CLIENTE',field:'nombre',name:'nombre',align:'center'},
        {label:'INGRESOS',field:'ingreso',name:'ingreso'},
        {label:'EGRESOS',field:'egreso',name:'egreso'},
        {label:'EGR CLIENTE',field:'egotro',name:'egotro'},
      ],
    }
  },
  created() {

  },
  methods:{

    misdatos(){
        this.$q.loading.show()
          this.$axios.post(process.env.API+'/reporte',this.datos).then(res=>{
              this.reportes=[]
       console.log(res.data)
       res.data.forEach(r => {
                  if(r.ingreso>0 || r.egreso>0 ||  r.egotro>0)
            this.reportes.push(r);
       });

      this.$q.loading.hide()
    })
    },

    
  },
  computed: {
    totalingreso(){
      let t=0
      this.reportes.forEach(c=>{
          if(c.ingreso!=null)
        t+=parseFloat(c.ingreso)
      })
      return t
    },
        totalegreso(){
      let t=0
      this.reportes.forEach(c=>{
          if(c.egreso!=null)
        t+=parseFloat(c.egreso)
      })
      return t
    },
        totalegotro(){
      let t=0
      this.reportes.forEach(c=>{
          if(c.egotro!=null)
        t+=parseFloat(c.egotro)
      })
      return t
    }
  }
}
</script>

<style scoped>

</style>
