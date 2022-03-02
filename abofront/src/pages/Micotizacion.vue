<template>
  <q-page class="q-pa-xs">
    <div class="row">
      <div class="col-12">
        <q-table dense title="Proformas realizadas" :rows="proformas" :columns="columns" :filter="filter">
                  <template v-slot:body-cell-opciones="props">
            <q-td :props="props">
              <q-btn color="primary" label="Imprimir" @click="impresioncot(props.row)" icon="print" size="xs"/>
            </q-td>
          </template>
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
import { jsPDF } from "jspdf"
import {date} from 'quasar'
export default {
  data(){
    return{
      filter:'',
      proformas:[],
      proforma:{},
      fec :date.formatDate(Date.now(),'DD-MM-YYYY'),
      columns:[
        {label:'OPCIONES',field:'opciones',name:'opciones'},
        {label:'CLIENTE',field:'cliente',name:'cliente'},
        {label:'FECHA',field:'fecha',name:'fecha'},
        {label:'TRMITE',field:row=>row.tramite.nombre,name:'tramite'},
        {label:'DETALLE',field:'detalleproformas',name:'detalleproformas'},
        {label:'TOTAL',field:'total',name:'total'},
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
      console.log(proforma)
      this.$axios.get(process.env.API+'/proforma/'+proforma.id).then(res=>{
        let myWindow = window.open("", "Imprimir", "width=1000,height=500");
        myWindow.document.write(res.data);
        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
        myWindow.close();
      })
    },
            impresioncot(proforma){
              console.log(proforma)
              this.proforma=proforma
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
        doc.text(18, 1.5,  'Oruro, '+mc.proforma.fecha)
        doc.text(2, 4, 'Cliente: ')
        doc.setFont(undefined,'normal')
        doc.text(5, 4, ''+ mc.proforma.cliente.nombre)

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

        mc.proforma.detalleproformas.forEach(ing => {
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
        mc.proforma.tramite.requisitos.forEach(r => {
          y+=0.5
          doc.text(2, y+4.5,''+r.nombre )

        });

      window.open(doc.output('bloburl'), '_blank');
    },
  }
}
</script>

<style scoped>

</style>
