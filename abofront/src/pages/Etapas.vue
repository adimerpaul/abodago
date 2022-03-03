<template>
<q-page class="q-pa-xs">
  <q-btn color="positive" icon="check" label="Agregar" @click="dialog_req=true" />

      <q-dialog v-model="dialog_req" >
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">AGREGAR ETAPA</div>
        </q-card-section>
        <q-card-section class="q-pt-none">
          <q-form @submit="agretapa">
            <div class="col-12 q-pa-xs col-sm-2">
              <q-input dense outlined label="Numero" v-model="regetapa.numero" required/>
            </div>
            <div class="col-12 q-pa-xs col-sm-3">
              <q-input dense outlined label="Nombre" v-model="regetapa.nombre" required/>
            </div>
            <div class="col-12 q-pa-xs col-sm-2 ">
              <q-btn type="submit" color="positive" icon="send" label="Agregar"/>
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
      <q-table title="ETAPAS" dense :columns="columns" :rows="etapas">
        <template v-slot:body-cell-opciones="props">
          <q-td :props="props">
            <q-btn color="warning" size="xs" @click="dialog_modreq=true;modetapa=props.row" icon="check" label="Modificar"/>
            <q-btn color="red" size="xs" @click="deltramite(props.row)" icon="delete" label="Eliminar"/>
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


          <q-dialog v-model="dialog_modreq" >
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">MODIFICAR ETAPA</div>
        </q-card-section>
        <q-card-section class="q-pt-none">
          <q-form @submit="modificar">
            <div class="col-12 q-pa-xs col-sm-2">
              <q-input dense outlined label="Numero" v-model="modetapa.numero" required/>
            </div>
            <div class="col-12 q-pa-xs col-sm-3">
              <q-input dense outlined label="Nombre" v-model="modetapa.nombre" required/>
            </div>
            <div class="col-12 q-pa-xs col-sm-2 ">
              <q-btn type="submit" color="warning" icon="send" label="Modificar"/>
            </div>
        </q-form>
        </q-card-section>
        <q-card-actions align="right" class="text-primary">
          <q-btn flat label="Cancelar" v-close-popup />
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
      modalmod:false,
      dialog_modreq:false,
      modetapa:{},
      regetapa:{},
      etapas:[],
      etapa:{},
      columns:[
        {name:'opciones',label:'OPCIONES',field:'opciones',align:'center'},
        {name:'numero',label:'NUMERO',field:'numero',align:'center'},
        {name:'nombre',label:'NOMBRE',field:'nombre',align:'left'},
      ]
    }
  },
  mounted() {
    this.misdatos()
  },
  methods:{
    deltramite(etapa){
      this.$q.dialog({
        title: 'Confirmar',
        message: 'Seguro Eliminar?',
        cancel: true,
        persistent: false
      }).onOk(() => {
                   this.$axios.delete(process.env.API+'/etapa/'+etapa.id).then(res=>{
                     this.misdatos()
           })
      }).onOk(() => {
        // console.log('>>>> second OK catcher')
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })


    },
    modificar(){
           this.$axios.put(process.env.API+'/etapa/'+this.modetapa.id,this.modetapa).then(res=>{
        this.dialog_modreq=false
        this.misdatos()
      }) 
    },
    agretapa(){
      this.$axios.post(process.env.API+'/etapa',this.regetapa).then(res=>{
        this.dialog_req=false
        this.regetapa={}
        this.misdatos()
      })

    },

    misdatos(){
      this.$q.loading.show()
      this.$axios.get(process.env.API+'/etapa').then(res=>{
        this.etapas=res.data
        this.$q.loading.hide()
        // console.log(res.data)
      })
    }
  }
}
</script>
<style scoped>
</style>
