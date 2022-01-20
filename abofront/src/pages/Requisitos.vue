<template>
<q-page class="q-pa-xs">
  <div class="row">
    <div class="col-12">
      <q-form>
        
      </q-form>
    </div>
    <div class="col-12">
      <q-table title="Requisitos" dense :columns="columns" :rows="tramites">
        <template v-slot:body-cell-requisitos="props">
          <q-td :props="props">
            <ul style="list-style: none;padding: 0px;margin: 0px;border: 0px">
              <li style="padding: 0px;margin: 0px;border: 0px;font-size: 8px" v-for="r in props.row.requisitos" :key="r.id">
                {{r.nombre}}
              </li>
            </ul>
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
  </div>
</q-page>
</template>
<script>
export default {
  data(){
    return{
      filter:'',
      tramites:[],
      columns:[
        {name:'nombre',label:'nombre',field:'nombre'},
        {name:'tipo',label:'tipo',field:'tipo'},
        {name:'valor',label:'valor',field:'valor'},
        // {name:'procedimiento',label:'procedimiento',field:'procedimiento'},
        {name:'requisitos',label:'requisitos',field:'requisitos'},
        {name:'opciones',label:'opciones',field:'opciones'},
      ]
    }
  },
  mounted() {
    this.misdatos()
  },
  methods:{
    misdatos(){
      this.$axios.get(process.env.API+'/tramite').then(res=>{
        this.tramites=res.data
        // console.log(res.data)
      })
    }
  }
}
</script>
<style scoped>
</style>
