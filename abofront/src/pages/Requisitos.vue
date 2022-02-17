<template>
<q-page class="q-pa-xs">
  <q-btn color="positive" icon="check" label="Agregar" @click="dialog_req=true" />
      <q-dialog v-model="dialog_req" >
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">AGREGAR TRAMITE / PROCESO</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-form @submit="agrtramite">
            <div class="col-12 q-pa-xs col-sm-2">
              <q-input dense outlined label="Nombre" v-model="regtramite.nombre" required/>
            </div>
            <div class="col-12 q-pa-xs col-sm-3">
              <q-select dense v-model="regtramite.tipo" :options="['TRAMITE','PROCESO JUDICIAL']" label="TIPO" outlined required/>
            </div>
            <div class="col-12 q-pa-xs col-sm-2 ">
              <q-btn type="submit" color="positive" icon="send" label="Crear"/>
            </div>
        </q-form>
        </q-card-section>

        <q-card-actions align="right" class="text-primary">
          <q-btn flat label="Cancelar" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
  <div class="row">

    <div class="col-12">
      <q-table title="Requisitos" dense :columns="columns" :rows="tramites">
        <template v-slot:body-cell-requisitos="props">
          <q-td :props="props">
            <ul style="list-style: none;padding: 0px;margin: 0px;border: 0px">
              <li style="padding: 0px;margin: 0px;border: 0px;font-size: 8px" v-for="r in props.row.requisitos" :key="r.id">
                {{r.nombre}} <q-btn style="padding: 0px;margin: 0px;border: 0px" icon="delete" color="negative" flat size="xs" @click="eliminarrequisito(r.id)"/>
              </li>
            </ul>
          </q-td>
        </template>
        <template v-slot:body-cell-opciones="props">
          <q-td :props="props">
<!--            {{props.row}}-->
            <q-btn color="positive" size="xs" @click="modalcrear=true;tramite=props.row" icon="add_circle" label="agregar"/>
          </q-td>
        </template>
        <template v-slot:top-right>
          <q-input outlined dense debounce="300" v-model="filter" placeholder="Buscar..">
            <template v-slot:append>
              <q-icon name="search" />
            </template>
          </q-input>
        </template>
      </q-table>
    </div>
    <q-dialog v-model="modalcrear">
      <q-card>
        <q-card-section>
          <div class="text-h6">Crear requisito</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-form @submit="crearrequisito">
            <div class="row">
              <div class="col-6">
                <q-input dense outlined label="Requisito" v-model="requisito.nombre" required/>
              </div>
              <div class="col-6">
                <q-btn  label="crear" color="positive" type="submit" icon="add_circle"  />
              </div>
            </div>
          </q-form>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="OK" color="negative" icon="delete" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </div>
</q-page>
</template>
<script>
export default {
  data(){
    return{
      filter:'',
      requisito:{},
      dialog_req:false,
      modalcrear:false,
      regtramite:{},
      tramites:[],
      tramite:{},
      columns:[
        {name:'opciones',label:'opciones',field:'opciones'},
        {name:'nombre',label:'nombre',field:'nombre'},
        {name:'tipo',label:'tipo',field:'tipo'},
        {name:'valor',label:'valor',field:'valor'},
        // {name:'procedimiento',label:'procedimiento',field:'procedimiento'},
        {name:'requisitos',label:'requisitos',field:'requisitos'},
      ]
    }
  },
  mounted() {
    this.misdatos()
  },
  methods:{
    agrtramite(){
      this.$axios.post(process.env.API+'/tramite',this.regtramite).then(res=>{
        this.dialog_req=false
        this.regtramite={}
        this.misdatos()
      })

    },
    crearrequisito(){
      this.requisito.tramite_id=this.tramite.id
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/requisito',this.requisito).then(res=>{
        // this.tramites=res.data
        // console.log(res.data)
        this.misdatos()
        this.modalcrear=false
      })
    },
    eliminarrequisito(id){
      if (confirm("Seguro de eliminar?")){
        this.$q.loading.show()
        this.$axios.delete(process.env.API+'/requisito/'+id).then(res=>{
          this.misdatos()
        })
      }
    },
    misdatos(){
      this.$q.loading.show()
      this.$axios.get(process.env.API+'/tramite').then(res=>{
        this.tramites=res.data
        this.$q.loading.hide()
        // console.log(res.data)
      })
    }
  }
}
</script>
<style scoped>
</style>
