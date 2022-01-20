<template>
  <q-page class="q-pa-xs">
    <div class="row">
      <div class="col-12">
        <q-table dense title="Proformas realizadas" :rows="proformas" :columns="columns" :filter="filter">
          <template v-slot:body-cell-cliente="props">
            <q-td :props="props">
                {{ props.row.cliente.nombre }}
            </q-td>
          </template>
          <template v-slot:body-cell-detalleproformas="props">
            <q-td :props="props">
              <ul style="padding: 0px;margin: 0px;border: 0px;list-style: none">
                <li  style="padding: 0px;margin: 0px;border: 0px;font-size: 9px" v-for="d in props.row.detalleproformas" :key="d.id">{{d.nombre}} {{d.precio}}Bs.</li>
              </ul>
            </q-td>
          </template>
          <template v-slot:body-cell-opciones="props">
            <q-td :props="props">
              <q-btn color="primary" label="Imprimir" @click="imprimir(props.row)" icon="print" size="xs"/>
            </q-td>
          </template>
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
  </q-page>
</template>

<script>
export default {
  data(){
    return{
      filter:'',
      proformas:[],
      columns:[
        {label:'cliente',field:'cliente',name:'cliente'},
        {label:'fecha',field:'fecha',name:'fecha'},
        {label:'Detalle',field:'detalleproformas',name:'detalleproformas'},
        {label:'total',field:'total',name:'total'},
        {label:'opciones',field:'opciones',name:'opciones'},
      ],
    }
  },
  created() {
    this.$q.loading.show()
    this.$axios.get(process.env.API+'/proforma').then(res=>{
      // console.log(res.data)
      this.proformas=res.data
      this.$q.loading.hide()
    })
  },
  methods:{
    imprimir(proforma){
      this.$axios.get(process.env.API+'/proforma/'+proforma.id).then(res=>{
        let myWindow = window.open("", "Imprimir", "width=1000,height=500");
        myWindow.document.write(res.data);
        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
        myWindow.close();
      })
    }
  }
}
</script>

<style scoped>

</style>
