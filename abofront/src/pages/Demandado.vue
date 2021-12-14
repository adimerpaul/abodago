<template>
<q-page class="q-pa-xs">
  <div class="row">
    <div class="col-12">
      <q-form @submit.prevent="buscar">
        <div class="row">
          <div class="col-12 col-md-10 q-pa-xs">
            <q-input v-model="cedula" type="text" label="Numero de Cedula de Identidad" required/>
          </div>
          <div class="col-12 col-md-2 q-pa-xs flex flex-center">
            <q-btn label="Buscar" color="primary" icon="search" type="submit" />
          </div>
        </div>
      </q-form>
    </div>

    <div class="col-12 col-md-8">
      <q-banner dense class="bg-primary text-white">
        Procesos del Demandado {{demandado.nombre}}
      </q-banner>
      <q-table
          title="Lista de Proceso"
          :rows="procesos"
          :columns="columns"
          row-key="name"
      />

    </div>
  </div>
</q-page>
</template>

<script>
export default {
  data(){
    return{
      url:process.env.API,
      demandado:{},
      procesos:[],
      codigo:'',
      cedula:'',
      columns : [
  {
    name: 'fecha',
    required: true,
    label: 'Fecha',
    align: 'left',
    field: 'fecha',
    sortable: true
  },
  { name: 'tipo', align: 'center', label: 'Tipo', field: 'tipo', sortable: true },
  { name: 'juzgado', label: 'Juzgado', field: 'juzgado', sortable: true },
]
    }
  },
  created() {

  },
  methods:{
    buscar(){
      this.$q.loading.show()
      this.demandado={}
      this.$axios.post(process.env.API+'/listdemandado/'+this.cedula).then(res=>{
        console.log(res.data);
         if(res.data.length >0){
        this.demandado=res.data[0];
        this.procesos=this.demandado.despachos;
        console.log(this.demandado)
        }
        this.$q.loading.hide()
      })
    },
  }
}
</script>

<style scoped>

</style>
