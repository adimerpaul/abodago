<template>
  <q-page class="q-pa-xs">
    <div class="row">
      <q-form
        @submit="misdatos"
        class="q-gutter-md"
      >

        <div class="row">
          <div class="col-6"><q-input v-model="fecha1" type="date" label="Mes/anio" required/></div>
          <div class="col-3"><q-btn label="Consultar" type="submit" color="primary"/> </div>
        </div>
      </q-form>
      <div class="col-12">
        <q-table dense title="MI AGENDA " :rows="agenda" :columns="columns" :filter="filter"  :rows-per-page-options="[10,20,50,0]">
          <template v-slot:body-cell-opciones="props">
            <q-tr :props="props">
              <q-td key="opciones" :props="props">
                  <q-btn dense label="Finalizar" color="positive"  icon="check" size="xs" v-if="props.row.estado=='EN ESPERA'" @click="actualiza(props.row)"/>
                  <q-btn dense label="Datos" color="info"  icon="list" size="xs" @click="verdato(props.row)"/>
              </q-td>
            </q-tr>
          </template>
          <template v-slot:top-right>
            <q-input outlined dense debounce="300" v-model="filter" placeholder="Buscar">
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
          <template v-slot:body-cell-estado="props">
              <q-td key="estado" :props="props">
                  <q-badge :color="props.row.estado=='EN ESPERA'?'yellow':'green'">
                    {{props.row.estado}}
                  </q-badge>
              </q-td>
          </template>

        </q-table>

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
      dialogdatos:false,
      despacho:{},
      fecha1:date.formatDate(Date.now(),'YYYY-MM-DD'),
      agenda:[],
      columns:[
        {field:'opciones',name:'opciones',label:'OPCIONES',align:'center'},
        {field:'fechaini',name:'fecha',label:'FECHA INICIO',align:'center'},
        {field:row=>row.etapa.nombre,name:'etapa',label:'ETAPA',align:'center'},
        {field:'actividad',name:'actividad',label:'ACTIVIDAD',align:'center'},
        {field:'proximopaso',name:'proximopaso',label:'PROXIMO PASO',align:'center'},
        {field:'fechafin',name:'fecha',label:'FECHA PP',align:'center'},
        {field:'estado',name:'estado',label:'ESTADO',align:'center'},
      ],

    }
  },
  created() {

    this.misdatos()
  },
  methods:{

    verdato(dato){
      console.log(dato)
      this.despacho=dato.despacho
      this.dialogdatos=true
    },
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
      this.$axios.post(process.env.API+'/listagenda',{fecha:this.fecha1}).then(res=>{
        console.log(res.data)
        this.$q.loading.hide()
        this.agenda=res.data
        this.mensaje()

      }).catch(err=>{
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error',
        })
        this.$q.loading.hide()
      })
    },
    mensaje(){
      console.log(this.agenda)
      this.agenda.forEach(element => {
        console.log(element)
        if(element.estado=='EN ESPERA')
        {
          this.$q.notify({
            message: 'Pendiente',
            caption: ''+element.etapa.nombre+' '+element.actividad,
            color: 'accent',
            icon:'done'
          });
        }
      });
    },
  },
  computed:{

  }

}
</script>

<style scoped>

</style>
