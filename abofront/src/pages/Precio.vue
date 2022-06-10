<template>
<q-page>
<div class="row">
  <div class="col-12">
    <q-badge color="primary" class="full-width text-center" >Cotizacion de precios</q-badge>
  </div>
  <div class="col-12 col-sm-6">
    <q-card>
      <div class="row">
        <div class="col-12 q-pa-xs">
          <q-form @submit.prevent="crear">
            <div class="row">
              <div class="col-5"><q-input dense outlined label="Nombre" v-model="precio.nombre" required/></div>
              <div class="col-5"><q-input dense outlined label="Precio" type="number" v-model="precio.precio" required/></div>
              <div class="col-2 flex flex-center"><q-btn size="xs" icon="add_circle" label="crear" color="positive" type="submit"/></div>
            </div>
          </q-form>
        </div>
        <div class="col-12">
          <q-table dense  :rows="precios" :columns="columns" :rows-per-page-options="[50,100,200,0]" :filter="filter">
            <template v-slot:top-right>
              <q-input borderless outlined dense v-model="filter" placeholder="Buscar">
                <template v-slot:append>
                  <q-icon name="search" />
                </template>
              </q-input>
            </template>
            <template v-slot:body="props">
              <q-tr :props="props">
                <q-td key="nombre" :props="props">
                  <input type="text" v-model="props.row.nombre" style="width: 150%">
                </q-td>
                <q-td key="nombre" :props="props" >
                  <div style="text-align: right">
                    <input type="text" v-model="props.row.precio" style="width: 30%"> Bs.
                  </div>
                </q-td>
                <q-td key="nombre" :props="props">
                  <q-btn color="info" icon="add_circle" @click="addcotizar(props.row)" size="xs" label="cotizar"/>
                  <q-btn color="negative" @click="eliminar(props.row)" label="eliminar" icon="remove_circle" size="xs"/>
                </q-td>
              </q-tr>
            </template>
          </q-table>
        </div>
      </div>
    </q-card>
  </div>
  
  <div class="col-12 col-sm-6">
    <div class="row">
      <div class="col-12 q-pa-xs">
        <q-select outlined dense  label="Cliente/Empresa" :options="opcions2" v-model="cliente" use-input @filter="filterFn2">
                <template v-slot:no-option>
          <q-item>
            <q-item-section class="text-grey">
              No results
            </q-item-section>
          </q-item>
        </template>
      </q-select>
        <q-select outlined dense  label="Tramite/Proceso" :options="opcions" v-model="tramite" use-input @filter="filterFn" >        
        <template v-slot:no-option>
          <q-item>
            <q-item-section class="text-grey">
              No results
            </q-item-section>
          </q-item>
        </template>
      </q-select>
      </div>
      <div class="col-12">
        <q-table title="Mi cotizacion" dense  :rows="cotizacion" :columns="columns" :rows-per-page-options="[10,100,200,0]" :filter="filter">
          <template v-slot:top-right>
            <q-input borderless outlined dense v-model="filter" placeholder="Buscar">
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
          <template v-slot:body="props">
            <q-tr :props="props">
              <q-td key="nombre" :props="props">
<!--                <input type="text" v-model="props.row.nombre" style="width: 150%">-->
                {{props.row.nombre}}
              </q-td>
              <q-td key="nombre" :props="props" >
                <div style="text-align: right">
<!--                  <input type="text" v-model="props.row.precio" style="width: 30%"> Bs.-->
                  {{props.row.precio}}
                </div>
              </q-td>
              <q-td key="nombre" :props="props">
<!--                <q-btn color="info" icon="add_circle" @click="addcotizar(props.row)" size="xs" label="cotizar"/>-->
                <q-btn color="negative" @click="quitar(props.row)" label="quitar" icon="delete" size="xs"/>
              </q-td>
            </q-tr>
          </template>
        </q-table>
      </div>
      <div class="col-12 flex flex-center">
        <q-btn :label="'Imprimir TOTAL: '+total+'Bs'" @click="impresioncot" class="full-width" icon="print" color="accent"/>
        <ul>
          <li v-for="r in tramite.requisitos" :key="r.id">{{r.nombre}}</li>
        </ul>
      </div>

    </div>
  </div>
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
      precios:[],
      precio:{},
      cotizacion:[],
      cliente:{},
      clientes:[],
      tramites:[],
      tramite:{},
      opcions:[],
      opcions2:[],
      fec :date.formatDate(Date.now(),'DD-MM-YYYY'),
      columns:[
        {field:'nombre',name:'nombre',label:'Nombre',align:'left'},
        {field:'precio',name:'precio',label:'Precio',align:'right'},
        {field:'option',name:'option',label:'Opciones',align:'right'},
      ]

    }
  },
  created() {
    this.misprecios()
  },
  methods: {
    filterFn (val, update) {
      if (val === '') {
        update(() => {
          this.tramite={label:'',requisitos:[]}
          this.opcions = this.tramites

          // here you have access to "ref" which
          // is the Vue reference of the QSelect
        })
        return
      }

      update(() => {
        const needle = val.toLowerCase()
        this.opcions = this.tramites.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },
        filterFn2 (val, update) {
      if (val === '') {
        update(() => {
          this.opcions2 = this.clientes

          // here you have access to "ref" which
          // is the Vue reference of the QSelect
        })
        return
      }

      update(() => {
        const needle = val.toLowerCase()
        this.opcions2 = this.clientes.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },
        impresioncot(){
                if (this.cotizacion.length==0){
        this.$q.notify({
          color:'red',
          caption:'Debe tener cotizaciones'
        })
        return false
      }

      this.$axios.post(process.env.API+'/impcosto',{
        datos:this.cotizacion,
        cliente_id:this.cliente.id,
        tramite_id:this.tramite.id,
        total:this.total
      }).then(res=>{
          console.log(this.cotizacion)
      let mc=this

      function header(){
        var img = new Image()
        var img2 = new Image()
        img.src = 'img/logocastillogonzales2.png'
        img2.src = 'img/fondo2.png'
        doc.setFontSize(12);

        doc.addImage(img, 'jpg', 0.5, 0.5, 5, 3)
        doc.setFont(undefined,'bold')
        doc.text(10, 2.5, 'ESTIMACION DE COSTOS ')
        doc.text(18, 1.5,  'Oruro, '+mc.fec)
        doc.text(2, 4, 'Cliente: ')
        doc.setFont(undefined,'normal')
        doc.setFontSize(8);
        doc.text(6, 3, ''+ mc.tramite.tipo+' : '+mc.tramite.nombre)
        doc.setFontSize(12);
        doc.text(5, 4, ''+ mc.cliente.nombre)

        doc.addImage(img2, 'jpg', 0.5, 12,20,10)
        doc.setFontSize(7);
      }
      function footer(){
                var img3 = new Image()
        var img4 = new Image()
        var img5 = new Image()
        var img6 = new Image()
                img3.src = 'img/ubicacion.jpg'
        img4.src = 'img/correo.jpg'
        img5.src = 'img/telf.jpg'
        img6.src = 'img/linea.png'
        doc.setFontSize(7);
        doc.addImage(img3, 'jpg', 0.5, 30.8,0.3,0.3)
        doc.text(1, 31, 'La Plata No. 6254 entre Sucre y Murguia' )
        doc.text(1, 31.3, '(Frente Cine Hollywood)' )
        doc.addImage(img4, 'jpg', 0.5, 31.4,0.3,0.3)
        doc.text(1, 31.6, 'gonzalesdelcastillomarcelo@hotmail.com')
        doc.addImage(img5, 'jpg', 0.5, 31.8,0.3,0.3)
        doc.text(1, 32, 'Cel: 78611101')
        doc.addImage(img6, 'jpg', 0, 29,21,5)
      doc.setFontSize(9);

      }
      var doc = new jsPDF('p','cm','legal')
      // console.log(dat);
      doc.addFont('bromellonavidadregular', 'bromellonavidadregular', 'normal');
      doc.setFont("bromellonavidadregular");
      //doc.setFont("courier");
      doc.setFontSize(9);
      // var x=0,y=
      header()
      footer()
      let y=0
      let sum1=0
        y+=0.5

        if (y+5>34){
          doc.addPage();
          header()
          footer()
          y=0
        }
        doc.setFont(undefined,'bold')
        doc.setLineWidth(0.05);
        doc.line(0.5,4.2,21,4.2)
        doc.text(1, 4.5,'CONCEPTO' )
        doc.text(15, 4.5,'MONTO Bs' )
        doc.line(0.5,4.8,21,4.8)
        doc.setFont(undefined,'normal')

        mc.cotizacion.forEach(ing => {
          sum1+=parseFloat(ing.precio)
          y+=0.5
        doc.text(1, y+4.5,ing.nombre+'' )
        doc.text(15, y+4.5,ing.precio+'' )
        });
          y+=0.5
        doc.line(0.5,y+4.6,21,y+4.6)

        doc.setFont(undefined,'bold')
        doc.text(1, y+4.5,'TOTAL BS' )
        doc.text(15, y+4.5,sum1+'' )
        doc.setFont(undefined,'normal')
          y+=0.5
        doc.setFont(undefined,'bold')

        doc.text(1, y+4.5,'REQUISITOS' )
        doc.line(0.5,y+4.8,21,y+4.8)
          y+=0.5
        doc.setFont(undefined,'normal')
        mc.tramite.requisitos.forEach(r => {
          y+=0.5
          doc.text(2, y+4.5,''+r.nombre )

        });

      window.open(doc.output('bloburl'), '_blank');})
    },

    misprecios(){
      this.$q.loading.show()
      this.$axios.get(process.env.API+'/precio').then(res=>{
        this.precios=res.data
        this.$q.loading.hide()
      })
      this.$axios.get(process.env.API+'/cliente').then(res=>{
        this.clientes=[]
        res.data.forEach(r=>{
          let d=r
          d.label=r.nombre
          this.clientes.push(d)
        })
        //this.cliente=this.clientes[0]
        this.cliente={label:''}
        this.opcions2=this.clientes
      })
      this.$axios.get(process.env.API+'/tramite').then(res=>{
        this.tramites=[]
        res.data.forEach(r=>{
          let d=r
          // console.log(r)
          d.label=r.nombre
          this.tramites.push(d)
        })
        this.tramite={label:'',requisitos:[]}
        this.opcions=this.tramites
      })
    },
    crear(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/precio',this.precio).then(res=>{
        this.precio={}
        this.misprecios()
        // this.$q.loading.hide()
      })
    },
    eliminar(precio){
      this.$q.loading.show()
      this.$axios.delete(process.env.API+'/precio/'+precio.id).then(res=>{
        this.misprecios()
        // this.$q.loading.hide()
      })
    },
    addcotizar(precio){
      this.cotizacion.push(precio)
    },
    quitar(precio){
      let index =this.cotizacion.findIndex(c=>c.id===precio.id)
      this.cotizacion.splice(index,1)
    },
    imprimir(){
      // console.log(this.cotizacion.length)
      if (this.cotizacion.length==0){
        this.$q.notify({
          color:'red',
          caption:'Debe tener cotizaciones'
        })
        return false
      }

      this.$axios.post(process.env.API+'/impcosto',{
        datos:this.cotizacion,
        cliente_id:this.cliente.id,
        tramite_id:this.tramite.id,
        total:this.total
      }).then(res=>{
        // console.log(res.data)
        // return false
        let myWindow = window.open("", "Imprimir", "width=1000,height=500");
        myWindow.document.write(res.data);
        myWindow.document.close();
        myWindow.focus();
        setTimeout(function(){
          myWindow.print();
          myWindow.close();
        },500);
      })
        // return false;
        // function header(fecha){
        //   // var img = new Image()
        //   // img.src = 'logo.jpg'
        //   // doc.addImage(img, 'jpg', 0.5, 0.5, 2, 2)
        //   doc.setFont(undefined,'bold')
        //   doc.text(5, 1, 'RESUMEN DIARIO DE INGRESOS')
        //   doc.text(5, 1.5, ' '+fecha)
        //   doc.text(1, 3, 'Nº COMPROBANTE')
        //   doc.text(4, 3, 'Nº TRAMITE')
        //   doc.text(7, 3, 'CONTRIBUYENTE')
        //   doc.text(13.5, 3, 'CI/RUN/RUC')
        //   doc.text(16, 3, 'MONTO BS.')
        //   doc.text(18, 3, 'CAJERO')
        //   doc.setFont(undefined,'normal')
        // }
        //
        // var doc = new jsPDF('p','cm','letter')
        // // console.log(dat);
        // doc.setFont("courier");
        // doc.setFontSize(9);
        // // var x=0,y=
        // header(Date.now())
        // // let xx=x
        // // let yy=y
        // let y=0
        // // this.pagos.forEach(r=>{
        // //   // xx+=0.5
        // //   y+=0.5
        // //   doc.text(1, y+3, r.nrocomprobante)
        // //   doc.text(4, y+3, r.nrotramite)
        // //   doc.text(7, y+3, r.cliente)
        // //   doc.text(13.5, y+3, r.ci)
        // //   doc.text(16, y+3, r.total)
        // //   doc.text(18, y+3, r.cajero )
        // //   if (y+3>25){
        // //     doc.addPage();
        // //     header(this.fecha)
        // //     y=0
        // //   }
        // // })
        // doc.text(12, y+4, 'TOTAL RECAUDADCION: ')
        // doc.text(18, y+4, '1000 Bs')
        // // doc.save("Pago"+date.formatDate(Date.now(),'DD-MM-YYYY')+".pdf");
        // window.open(doc.output('bloburl'), '_blank');
    }
  },
  computed: {
    total(){
      let t=0
      this.cotizacion.forEach(c=>{
        t+=c.precio
      })
      return t
    }
  }
}
</script>

<style scoped>

</style>
