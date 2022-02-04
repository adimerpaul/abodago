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
                  <q-btn dense label="Finalizar" color="positive"  icon="check" size="xs" v-if="props.row.estado=='EN ESPERA'" @click="actualiza(props.row)"/>
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
      agenda:[],
      columns:[
        {field:'fechaini',name:'fecha',label:'FECHA INICIO',align:'center'},
        {field:row=>row.etapa.nombre,name:'etapa',label:'ETAPA',align:'center'},
        {field:'actividad',name:'actividad',label:'ACTIVIDAD',align:'center'},
        {field:'fechafin',name:'fecha',label:'FECHA FIN',align:'center'},
        {field:'proximopaso',name:'proximopaso',label:'PROXIMO PASO',align:'center'},
        {field:'estado',name:'estado',label:'ESTADO',align:'center'},
        {field:'opciones',name:'opciones',label:'OPCIONES',align:'center'},
      ],

    }
  },
  created() {

    this.misdatos()
  },
  methods:{
    actualiza(agenda){
      this.$q.dialog({
        title: 'Fin de Actividad',
        message: 'Esta Seguro de Finalizar?',
        cancel: true,
      }).onOk(() => {
        // console.log('>>>> OK')
      this.$axios.post(process.env.API+'/finalizar',agenda).then(res=>{
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
        console.log(res.data)
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
