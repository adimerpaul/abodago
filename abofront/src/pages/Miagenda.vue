<template>
  <q-page class="q-pa-xs">
    <div class="row">
      <div class="col-12">
        <q-table dense title="MI AGENDA " :rows="agenda" :columns="columns" :filter="filter"  >
          <template v-slot:top-right>
            <q-input outlined dense debounce="300" v-model="filter" placeholder="Buscar">
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
          <template v-slot:body-cell-opciones="props">
            <q-tr :props="props">
              <q-td key="opciones" :props="props">
                <q-btn-group >
                  <q-btn dense label="agregar" color="positive"  icon="add_circle" size="xs" />
                </q-btn-group >
              </q-td>
            </q-tr>
          </template>
        </q-table>






      </div>
    </div>
  </q-page>
</template>

<script>
// import $ from 'jquery'
// import { jsPDF } from "jspdf";
import {date} from 'quasar'
export default {
  data(){
    return {
      filter:'',
      usuario:'',
      dialog_gastos:false,
      url:process.env.API,
      tramite:{},
      agenda:[],
      despacho:{fecha:date.formatDate(Date.now(),'YYYY-MM-DD'),hora:date.formatDate(Date.now(),'HH:mm')},
      tramites:[],
      columns:[
        {field:'fecha',name:'fecha',label:'Fecha',align:'right'},
        {field:'etapa',name:'etapa',label:'etapa',align:'right'},
        {field:'actividad',name:'actividad',label:'actividad',align:'right'},
        {field:'estado',name:'estado',label:'estado',align:'right'},
        {field:'opciones',name:'opciones',label:'OPCIONES',align:'right'},
      ],

    }
  },
  created() {

    this.misdatos(process.env.API)
  },
  methods:{
    filterFn (val, update) {
      if (val === '') {
        update(() => {
          this.tramites = this.tramites2

          // here you have access to "ref" which
          // is the Vue reference of the QSelect
        })
        return
      }

      update(() => {
        const needle = val.toLowerCase()
        this.tramites = this.tramites2.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },
    misdatos(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/listagenda').then(res=>{
        this.$q.loading.hide()
        this.agenda=res.data

      }).catch(err=>{
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error',
        })
        this.$q.loading.hide()
      })
    },
  },
  computed:{

  }

}
</script>

<style scoped>

</style>
