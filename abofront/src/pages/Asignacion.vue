<template>
  <q-page class="q-pa-xs">
    <div class="row">
      <div class="col-12 q-pa-xs">
        <q-form @submit="crearcliente">
          <div class="row">
            <div class="col-12 col-sm-2">
              <q-input dense outlined label="CI/NIT" v-model="cliente.ci"/>
            </div>
            <div class="col-12 col-sm-3">
              <q-input dense outlined label="Nombre completo" v-model="cliente.nombre" required/>
            </div>
            <div class="col-12 col-sm-2">
              <q-select dense outlined label="Tipo" v-model="cliente.tipo" :options="['PERSONA','EMPRESA']"/>
            </div>
            <div class="col-12 col-sm-3">
              <input type="file" dense outlined @change="getImage" ref="ima" accept="image/*"/>
            </div>
            <div class="col-12 col-sm-2 flex flex-center">
              <q-btn type="submit" color="primary" icon="send" label="Crear"/>
            </div>
          </div>
        </q-form>
      </div>
      <div class="col-12">
        <q-table dense title="Clientes " :rows="clientes" :columns="columns" :filter="filter"       :rows-per-page-options="[50,100,150,200,0]">
          <template v-slot:top-right>
            <q-input borderless dense debounce="300" v-model="filter" placeholder="Buscar">
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
          <template v-slot:body="props">
            <q-tr :props="props" @click="listdespacho(props.row)">
              <q-td key="ci" :props="props" @click="listdespacho(props.row)">
                {{ props.row.ci }}
              </q-td>
              <q-td key="nombre" :props="props" @click="listdespacho(props.row)">
                <!--            <q-badge color="green">-->
                {{ props.row.nombre }}
                <!--            </q-badge>-->
              </q-td>
              <q-td key="tipo" :props="props">
                <q-badge @click="listdespacho(props.row)" :color="props.row.tipo=='EMPRESA'?'purple':'teal'">
                  {{ props.row.tipo }}
                </q-badge>
              </q-td>
              <q-td key="imagen" :props="props">
                <!--            <q-badge color="purple">-->
<!--                {{ props.row.imagen }}-->
                <q-img
                  @click="listdespacho(props.row)"
                  v-if="props.row.imagen!='' && props.row.imagen!=null"
                  :src="url+'/../imagenes/'+props.row.imagen"
                  spinner-color="white"
                  style="height: 30px; width: 75px"
                />
                <!--            </q-badge>-->
              </q-td>
<!--              <q-td key="ref" :props="props">-->
<!--                &lt;!&ndash;            <q-badge color="orange">&ndash;&gt;-->
<!--&lt;!&ndash;                <q-badge color="info" v-if="props.row.ref!=''" @click="mostrar(props.row.ref)">&ndash;&gt;-->
<!--&lt;!&ndash;                  {{ props.row.ref.substring(0,10) }}&ndash;&gt;-->
<!--&lt;!&ndash;                </q-badge>&ndash;&gt;-->
<!--                &lt;!&ndash;            </q-badge>&ndash;&gt;-->
<!--              </q-td>-->
<!--              <q-td key="remitente" :props="props">-->
<!--                &lt;!&ndash;            <q-badge color="primary">&ndash;&gt;-->
<!--                {{ props.row.remitente }}-->
<!--                &lt;!&ndash;            </q-badge>&ndash;&gt;-->
<!--              </q-td>-->
              <!--          <q-td key="fecha" :props="props">-->
              <!--&lt;!&ndash;            <q-badge color="teal">&ndash;&gt;-->
              <!--              {{ props.row.fecha }}-->
              <!--&lt;!&ndash;            </q-badge>&ndash;&gt;-->
              <!--          </q-td>
              <q-td key="despachos" :props="props">
                           <q-badge color="teal">
                             {{ props.row.logs }}
                <ul style="font-size: 0.8em;padding: 0px;margin: 0px;border: 0px;    list-style: none;">
                  <li v-for="l in props.row.despachos" :key="l.id">J:{{l.juzgado}} N:{{l.nurej}} P:{{l.proceso}} F:{{l.fecha}}</li>
                </ul>
                           </q-badge>
              </q-td>-->
              <q-td key="dias" :props="props">
                <q-badge :color="props.row.dias==0?'positive':props.row.dias==1?'amber':'negative'">
                  {{ props.row.dias }}
                </q-badge>
              </q-td>
              <q-td key="estado" :props="props">
                <q-badge :color="props.row.estado=='EN PROCESO'?'amber':'negative'">
                  {{ props.row.estado }}
                </q-badge>
              </q-td>
              <q-td key="folio" :props="props">
                <!--            <q-badge color="amber">-->
                {{ props.row.folio }}
                <!--            </q-badge>-->
              </q-td>
              <q-td key="archivo" :props="props" @click="listdespacho(props.row)">
                <!--            <q-badge color="amber">-->
                <!--            {{ props.row.archivo }}-->
                <template v-if="props.row.archivo!=''" >
                  <q-btn label="Descargar" color="primary" size="xs" type="a" :href="url+'/../imagenes/'+props.row.archivo" target="__blank"/>
                </template>
                <!--            </q-badge>-->
              </q-td>
              <q-td key="opciones" :props="props">
                <!--            <q-badge color="amber">-->
<!--                              {{ props.row.estado }}-->
                <!--            </q-badge>-->
                <q-btn-group >
                  <q-btn dense @click="aceptar(props.row)" color="positive"  icon="add_circle" size="sm" />
                  <q-btn dense @click="mod(props.row)" color="yellow"  icon="edit" size="sm" />
                  <q-btn dense @click="modimg(props.row)" color="teal"  icon="image" size="sm" />
                  <q-btn dense @click="listdespacho(props.row)" color="accent"  icon="text_snippet" size="sm" />
                </q-btn-group >
<!--                <q-btn-group v-if="props.row.estado=='ACEPTADO'">-->
<!--&lt;!&ndash;                  <q-btn type="a"  target="__blank" dense :href="url+'/mail/'+props.row.id" color="primary" label="Imprimir" icon="timeline" size="xs" />&ndash;&gt;-->
<!--&lt;!&ndash;                  <q-btn dense @click="editar(props)" color="teal" label="Editar" icon="edit" size="xs" />&ndash;&gt;-->
<!--                  <q-btn dense @click="dialogcliente=true;mail=props.row" color="positive" label="Remitir" icon="code" size="xs" />-->
<!--&lt;!&ndash;                  <q-btn dense @click="anular(props.row)" color="negative" label="Anular" icon="delete" size="xs" />&ndash;&gt;-->
<!--                  <q-btn dense @click="archivar(props.row)" color="accent" label="Terminar" icon="list" size="xs" />-->
<!--&lt;!&ndash;                  <q-btn dense @click="archivo(props.row)" color="amber" label="Archivo" icon="upload" size="xs" />&ndash;&gt;-->
<!--&lt;!&ndash;                  <q-btn dense @click="dividir(props.row)" color="red" label="Dividir" icon="content_cut" size="xs" />&ndash;&gt;-->
<!--                </q-btn-group>-->
              </q-td>
            </q-tr>
          </template>
        </q-table>
        <q-dialog full-width v-model="dialogcliente">
          <q-card >
            <q-card-section>
              <div class="text-h6"> <q-icon name="code"/> {{cliente2.nombre}} </div>
            </q-card-section>
            <q-card-section class="q-pt-none">
              <q-form @submit.prevent="registrarlog">
<!--                <q-input type="textarea" outlined label="Mi acccion" v-model="miaccion" required/>-->
<!--                <q-select :options="usuarios" label="Seleccionar personal" v-model="usuario" outlined required/>-->
                <q-select use-input :options="tramites" label="Seleccionar Tramite / Proceso" @update:model-value="lrequisito" v-model="tramite" @filter="filterFn" outlined >
                  <template v-slot:no-option>
                    <q-item>
                      <q-item-section class="text-grey">
                        Sin resultados
                      </q-item-section>
                    </q-item>
                  </template>
                </q-select>
                <div class="row">
                  <div class="col-4">
                    <div class="text-h6">REQUISITOS</div>
                    <span v-for="(r,i) in requisitos" :key="i"> -){{r.nombre}}<br></span>
                  </div>
                  <div class="col-8">


                <div class="row">
                  <div class="col-6"><q-input type="date" label="Fecha" outlined  v-model="despacho.fecha"/></div>
                  <div class="col-6"><q-input type="time" label="Hora" outlined  v-model="despacho.hora"/></div>
                </div>
                <div v-if="tramite.tipo!='TRAMITE'">
                <q-input label="Juzgado" outlined  v-model="despacho.juzgado"/>
                <div class="row">
                  <div class="col-6"><q-input label="WebId" outlined  v-model="despacho.webid"/></div>
                  <div class="col-6"><q-input label="NuRej" outlined  v-model="despacho.nurej"/></div>

                </div>

                <q-input label="Proceso" outlined  v-model="despacho.proceso"/>
                <q-input label="demandante" outlined  v-model="despacho.demandante"/>
                <q-input label="demandados" outlined  v-model="despacho.demandados"/>
                </div>
                <q-btn label="Remitir" color="teal" icon="send" class="full-width" type="submit"/>
                                  </div>
                </div>
              </q-form>
            </q-card-section>
            <q-card-section align="right">
              <q-btn flat label="Cancelar" color="primary" icon="delete" v-close-popup />
            </q-card-section>
          </q-card>
        </q-dialog>

        <q-dialog full-width v-model="dialog_despacho">
          <q-card >
            <q-card-section>
              <div class="text-h6"> <q-icon name="code"/> {{cliente2.nombre}} </div>
            </q-card-section>
            <q-card-section class="q-pt-none">
             <q-table
                   title="LISTA DE DESPACHO"
              :rows="infodespacho"
              :columns="descol"
              row-key="name"
             >

            <template v-slot:body-cell-tipo="props">
              <q-tr :props="props">
              <q-td key="estado" :props="props">
                <q-badge :color="props.row.tipo=='TRAMITE'?'accent':'teal'">
                  {{ props.row.tipo }}
                </q-badge>
              </q-td>
              </q-tr>
            </template>

            <template v-slot:body-cell-opcion="props">
              <q-tr :props="props">
              <q-td key="opcion" :props="props">
                <q-btn dense round flat color="yellow" @click="addRow(props.row)" icon="add"></q-btn>
                <q-btn dense round flat color="red" @click="removeRow(props.row)" icon="remove"></q-btn>
                <q-btn dense round flat color="green" @click="listRow(props.row)" icon="list"></q-btn>
              </q-td>
              </q-tr>
             </template>
             </q-table>
            </q-card-section>
            <q-card-section align="right">
              <q-btn flat label="Cancelar" color="primary" icon="delete" v-close-popup />
            </q-card-section>
          </q-card>
        </q-dialog>

        <q-dialog v-model="dialogarchivo">
          <q-card style="width: 300px;min-width: 40vh">
            <q-card-section>
              <div class="text-h6"> <q-icon name="list"/> {{mail.ref}} Subir archivo</div>
            </q-card-section>
            <q-card-section class="q-pt-none">
              <q-uploader
                class="full-width"
                label="Subir archivo"
                :factory="uploadFile"
                max-files="1"
              />
            </q-card-section>
            <q-card-section align="right">
              <q-btn flat label="Cancelar" color="primary" icon="delete" v-close-popup />
            </q-card-section>
          </q-card>
        </q-dialog>

        <q-dialog v-model="dialog_add">
          <q-card style="width: 300px;min-width: 40vh">

            <q-card-section class="q-pt-none">
            <div class="text-h6">INGRESO</div>
              <q-form @submit.prevent="regingreso">
                <div class="row">
                <div class="col-6"><q-input outlined label="Num Recibo" v-model="ingreso.recibo"/></div>
                <div class="col-6"><q-input outlined label="Monto" type="number" v-model="ingreso.monto"/></div>
                </div>
              <q-card-section align="right" class="row">
                <div class="col-6"><q-btn flat label="Registrar" type="submit" color="primary" icon="send" /></div>
                <div class="col-6"><q-btn flat label="Cancelar" color="primary" icon="delete" v-close-popup /></div>
            </q-card-section>

              </q-form>
            </q-card-section>

          </q-card>
        </q-dialog>

        <q-dialog v-model="dialog_remove">
          <q-card style="width: 300px;min-width: 40vh">

            <q-card-section class="q-pt-none">
            <div class="text-h6">EGRESO</div>
              <q-form @submit.prevent="regegreso">
                <div class="row">
                <div class="col-6"><q-input outlined label="Concepto" v-model="egreso.concepto"/></div>
                <div class="col-6"><q-input outlined label="Monto" type="number" v-model="egreso.monto"/></div>
                </div>
            <q-card-section align="right" class="row">
                <div class="col-6"><q-btn flat label="Registrar" type="submit" color="primary" icon="send" /></div>
                <div class="col-6"><q-btn flat label="Cancelar" color="primary" icon="delete" v-close-popup /></div>


            </q-card-section>

              </q-form>
            </q-card-section>
          </q-card>
        </q-dialog>

        <q-dialog maximized v-model="dialog_gastos">
          <q-card style="width: 1200px;min-width: 40vh">

            <q-card-section class="q-pt-none">
            <div class="text-h6">Ingresos Egresos</div>
            <div class="row">
              <div class="col-6">
                <q-table
                  title="LISTA DE INGRESOS"
                  :rows="tabingreso"
                  :columns="ingresocol"
                  row-key="name"
                />
              </div>
              <div class="col-6">
                <q-table
                  title="LISTA EGRESOS"
                  :rows="tabegreso"
                  :columns="egresocol"
                  row-key="name"
                />
              </div>
            </div>
            <div>
              <span>Total Ingreso: {{totaling}}</span> <br>
              <span>Total Egreso: {{totaleg}}</span> <br>
              <span>Total Adeudado: {{totaling - totaleg}}</span>
            </div>

            </q-card-section>
            <q-card-section align="right">
              <q-btn flat label="Imprimir" color="primary" icon="print" @click="imprimir"/>
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
      imagen : null,
      miaccion:'',
      filter:'',
      usuario:'',
      dialogcliente:false,
      dialogarchivo:false,
      dialog_despacho:false,
      dialog_add:false,
      dialog_remove:false,
      dialog_list:false,
      dialog_gastos:false,
      url:process.env.API,
      requisitos:[],
      tramite:{},
      despacho:{fecha:date.formatDate(Date.now(),'YYYY-MM-DD'),hora:date.formatDate(Date.now(),'HH:mm')},
      tramites:[],
      tramites2:[],
      dato:{tipo:'INTERNO',fecha:date.formatDate(Date.now(),'YYYY-MM-DD'),folio:1},
      folios:[],
      usuarios:[],
      usuarios2:[],
      clientes:[],
      cliente:{tipo:'PERSONA'},
      cliente2:'',
      mail:{},
      remitentes:[],
      remitentes2:[],
      datodespacho:{},
      remitente:'',
      infodespacho:{},
      cargo:'',
      institucion:'',
      ingreso:{},
      egreso:{},

      tabingreso:[],
      tabegreso:[],
      gastos:[],
      columns:[
        {field:'ci',name:'ci',label:'CI',align:'right'},
        {field:'nombre',name:'nombre',label:'NOMBRE',align:'right'},
        {field:'tipo',name:'tipo',label:'TIPO',align:'right'},
        {field:'imagen',name:'imagen',label:'IMAGEN',align:'right'},
       // {field:'despachos',name:'despachos',label:'despachos',align:'right'},
        // {field:'ref',name:'ref',label:'ref',align:'right'},
        // {field:'remitente',name:'remitente',label:'remitente',align:'right'},
        // // {field:'cargo',name:'cargo',label:'cargo',align:'right'},
        // // {field:'institucion',name:'institucion',label:'institucion',align:'right'},
        // // {field:'fecha',name:'fecha',label:'fecha',align:'right'},
        // {field:'logs',name:'logs',label:'logs',align:'left'},
        // {field:'dias',name:'dias',label:'dias',align:'right'},
        // // {field:'estado',name:'estado',label:'estado',align:'right'},
        // {field:'folio',name:'folio',label:'folio',align:'right'},
        // {field:'archivo',name:'archivo',label:'archivo',align:'right'},
        {field:'opciones',name:'opciones',label:'OPCIONES',align:'right'},
      ],

      descol:[
        {field:'fecha',name:'fecha',label:'FECHA',align:'right'},
        {field:'hora',name:'hora',label:'HORA',align:'right'},
        {field:'tipo',name:'tipo',label:'TIPO',align:'right'},
        {field:'juzgado',name:'juzgado',label:'JUZGADO',align:'right'},
         {field:'webid',name:'webid',label:'WEBID',align:'left'},
         {field:'nurej',name:'nurej',label:'NUREJ',align:'left'},
         {field:'proceso',name:'proceso',label:'PROCESO',align:'left'},
         {field:'demandante',name:'demandante',label:'DEMANDANTE',align:'right'},
         {field:'demandados',name:'demandados',label:'DEMANDADOS',align:'right'},
          {field:'opcion',name:'opcion',label:'OPCION',align:'center'}
      ],
            ingresocol:[
        {field:'fecha',name:'fecha',label:'fecha',align:'right'},
        {field:'hora',name:'hora',label:'hora',align:'right'},
        {field:'monto',name:'monto',label:'monto',align:'right'},
        {field:'recibo',name:'recibo',label:'recibo',align:'right'},
      ],
                  egresocol:[
        {field:'fecha',name:'fecha',label:'fecha',align:'right'},
        {field:'hora',name:'hora',label:'hora',align:'right'},
        {field:'monto',name:'monto',label:'monto',align:'right'},
         {field:'concepto',name:'concepto',label:'concepto',align:'left'},
      ]
    }
  },
  created() {

    // console.log()
    this.misdatos(process.env.API)
    // for (let i=1;i<=1000;i++){
    //   this.folios.push(i)
    // }
    // this.misremitentes()

    this.$axios.get(process.env.API+'/tramite').then(res=>{
      // console.log(res.data)
      // return false
      res.data.forEach(r=>{
        // this.usuarios.push({
        //   id:r.id,
        //   name:r.name,
        //   unit_id:r.unit_id,
        //   label:r.unit.nombre+'-'+r.name
        // })
        let d=r
        d.label=r.tipo+' '+r.nombre
        this.tramites.push(d)
      })
      this.tramite=this.tramites[0];
      this.requisitos=this.tramites[0].requisitos;
      this.tramites2=this.tramites
    })
    this.resetdespacho();
  },
  methods:{
    lrequisito(){
      this.requisitos=this.tramite.requisitos;
    },
    getImage(event){
      //Asignamos la imagen a  nuestra data
      // console.log(event.target)
      this.imagen = event.target.files[0];
    },
    regingreso(){
      this.ingreso.despacho_id=this.datodespacho.id;
      this.ingreso.fecha=date.formatDate(Date.now(),'YYYY-MM-DD');
      this.ingreso.hora=date.formatDate(Date.now(),'HH:mm');
      this.$axios.post(process.env.API+'/ingreso',this.ingreso).then(res=>{
          this.$q.notify({
          message:"Agregado",
          color:'green',
          icon:'done'
        })
        this.dialog_add=false;
        this.ingreso={};
        this.misdatos();
      });
    },
        regegreso(){
      this.egreso.despacho_id=this.datodespacho.id;
      this.egreso.fecha=date.formatDate(Date.now(),'YYYY-MM-DD');
      this.egreso.hora=date.formatDate(Date.now(),'HH:mm');
      this.$axios.post(process.env.API+'/egreso',this.egreso).then(res=>{
          this.$q.notify({
          message:"Agregado",
          color:'green',
          icon:'done'
        })
        this.dialog_remove=false;
        this.egreso={};
        this.misdatos();
      });
    },
    addRow(prop){
      this.datodespacho=prop;
      this.dialog_add=true;
    },
    removeRow(prop){
      this.datodespacho=prop;
      this.dialog_remove=true;

    },
    listRow(prop){
            this.datodespacho=prop;
      this.$axios.post(process.env.API+'/ringreso/'+this.datodespacho.id).then(res=>{
              this.tabingreso=res.data;
      });
            this.$axios.post(process.env.API+'/regreso/'+this.datodespacho.id).then(res=>{
              this.tabegreso=res.data;
      });
             this.dialog_gastos=true;
    },
    imprimir(){
            this.$axios.post(process.env.API+'/impresion/'+this.datodespacho.id).then(res=>{
              let myWindow = window.open("", "Imprimir", "width=200,height=100");
              myWindow.document.write(res.data);
              myWindow.document.close();
              myWindow.focus();
              setTimeout(function(){
                myWindow.print();
                myWindow.close();
              },500);
            })

    },
    listdespacho(prop){
      this.cliente2=prop

      this.infodespacho=prop.despachos;
      this.dialog_despacho=true;
    },
    crearcliente(){
      this.$q.loading.show()
      var data = new  FormData();
      //Añadimos la imagen seleccionada
      data.append('imagen', this.imagen);
      data.append('ci', this.cliente.ci);
      data.append('nombre', this.cliente.nombre);
      data.append('tipo', this.cliente.tipo);
      // this.cliente.imagen=this.imagen

      this.$axios.post(process.env.API+'/cliente',data).then(res=>{
        // console.log(res.data)
        // this.dato={tipo:'INTERNO',fecha:date.formatDate(Date.now(),'YYYY-MM-DD'),folio:1};
        // this.remitente=''
        // this.cargo=''
        // this.institucion=''
        this.$refs.ima.value=''
        this.misdatos()
        this.cliente={tipo:'PERSONA'}
        this.$q.notify({
          message:"Creado exitosamente",
          color:'green',
          icon:'done'
        })
        // this.misremitentes()
        // this.$q.loading.hide()
      })
      //   .catch(err=>{
      //   this.$q.loading.hide()
      //   this.$q.notify({
      //     message:err.response.data.message,
      //     color:'red',
      //     icon:'error'
      //   })
      // })
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
    uploadFile(files) {
      this.file_path = files[0]
      const fileData = new FormData()
      fileData.append('imagen', this.file_path)
      fileData.append('mail_id', this.mail.id)
      // console.log(fileData);
      //Replace http://localhost:8000 with your API URL
      this.$q.loading.show()
      const uploadFile = this.$axios.post(process.env.API+'/upload', fileData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then((response) => {
        this.misdatos()
        this.$q.loading.hide()
        // console.log(response.data);
        // this.dato.imagen=response.data;
        this.dialogarchivo=false
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Imagen subido correctamente!'
        });
      });
    },
    registrarlog(){
      this.despacho.tipo=this.tramite.tipo;
      this.despacho.tramite_id=this.tramite.id;
      this.despacho.cliente_id=this.cliente2.id;
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/despacho',this.despacho).then(res=>{
        // console.log(res.data)
        this.misdatos()
        this.$q.loading.hide()
        this.despacho={fecha:date.formatDate(Date.now(),'YYYY-MM-DD'),hora:date.formatDate(Date.now(),'HH:mm')};
        this.resetdespacho();
        this.dialogcliente=false
        this.$q.notify({
          message:'Despacho registrado!!',
          color:'green',
          icon:'done'
        })
      }).catch(err=>{
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error'
        })
        this.$q.loading.hide()
      })
    },
    misremitentes(){
      this.$axios.get(process.env.API+'/mail/create').then(res=>{
        // console.log(res.data)
        this.remitentes=res.data
        // this.remitentes2=res.data
      })
    },
    cambio(){
      this.cargo=''
      this.institucion=''
      // console.log(this.remitente)
      this.remitentes.find(r=>{
        if (r.remitente===this.remitente){
          // console.log(r.cargo)
          this.cargo=r.cargo
          this.institucion=r.institucion
          return false
        }else{
          // this.cargo=''
          // this.institucion=''
        }
      })
    },
    // remitir(){},
    aceptar(cliente){
      this.cliente2=cliente
      this.dialogcliente=true
      // this.$q.dialog({
      //   title:'Seguro de Aceptar?',
      //   message:'Seguro de aceptar',
      //   // prompt:{
      //   //   model:'',
      //   //   type:'text'
      //   // },
      //   cancel:true,
      // }).onOk(()=>{
      //   // console.log(data)
      //   this.$q.loading.show()
      //   this.$axios.post(process.env.API+'/aceptar',{mail_id:mail.id}).then(res=>{
      //     this.misdatos();
      //     this.$q.notify({
      //       message: 'Aceptado',
      //       caption: 'Registro aceptado',
      //       color: 'green',
      //       icon:'done'
      //     });
      //   })
      // })
    },
    mostrar(ref){
      this.$q.dialog({
        title:'Referencia',
        message:ref
      })
    },
    archivar(mail){
      this.$q.dialog({
        title:'Seguro de archivar?',
        message:'Motivo de archivar',
        prompt:{
          model:'',
          type:'text'
        },
        cancel:true,
      }).onOk(data=>{
        // console.log(data)
        this.$q.loading.show()
        this.$axios.post(process.env.API+'/anulado',{mail_id:mail.id,accion:data,estado:'ARCHIVAR'}).then(res=>{
          this.misdatos();
          this.$q.notify({
            message: 'Archivado',
            caption: 'Registro archivado',
            color: 'green',
            icon:'done'
          });
        })
      })
    },
    archivo(mail){
      this.mail=mail
      this.dialogarchivo=true
    },
    dividir(mail){
      this.$q.dialog({
        title:'En cuantos deseas dividir?',
        message:'Cantidad de divicion',
        prompt:{
          model:'',
          type:'number'
        },
        cancel:true,
      }).onOk(data=>{
        // console.log(data)
        this.$q.loading.show()
        this.$axios.post(process.env.API+'/dividir',{cantidad:data,mail_id:mail.id}).then(res=>{
          this.misdatos();
          this.$q.notify({
            message: 'Dividido',
            caption: 'Registro dividido',
            color: 'green',
            icon:'done'
          });
        })
      })
    },
    editar(props){
      // console.log(props.row);
      this.dato=props.row;
      this.remitente=props.row.remitente
      this.cargo=props.row.cargo
      this.institucion=props.row.institucion
    },
    // imprimir(){
    //   let cm=this;
    //   function header(fecha){
    //     // var img = new Image()
    //     // img.src = 'logo.jpg'
    //     // doc.addImage(img, 'jpg', 0.5, 0.5, 2, 2)
    //     doc.setFont(undefined,'bold')
    //     doc.text(5, 1, 'RESUMEN DIARIO DE INGRESOS')
    //     doc.text(5, 1.5, ' '+fecha)
    //     doc.text(1, 3, 'Nº COMPROBANTE')
    //     doc.text(4, 3, 'Nº TRAMITE')
    //     doc.text(7, 3, 'CONTRIBUYENTE')
    //     doc.text(13.5, 3, 'CI/RUN/RUC')
    //     doc.text(16, 3, 'MONTO BS.')
    //     doc.text(18, 3, 'CAJERO')
    //     doc.setFont(undefined,'normal')
    //   }
    //   var doc = new jsPDF('p','cm','letter')
    //   // console.log(dat);
    //   doc.setFont("courier");
    //   doc.setFontSize(9);
    //   // var x=0,y=
    //   header(Date.now())
    //   // let xx=x
    //   // let yy=y
    //   let y=0
    //   // this.pagos.forEach(r=>{
    //   //   // xx+=0.5
    //   //   y+=0.5
    //   //   doc.text(1, y+3, r.nrocomprobante)
    //   //   doc.text(4, y+3, r.nrotramite)
    //   //   doc.text(7, y+3, r.cliente)
    //   //   doc.text(13.5, y+3, r.ci)
    //   //   doc.text(16, y+3, r.total)
    //   //   doc.text(18, y+3, r.cajero )
    //   //   if (y+3>25){
    //   //     doc.addPage();
    //   //     header(this.fecha)
    //   //     y=0
    //   //   }
    //   // })
    //   doc.text(12, y+4, 'TOTAL RECAUDADCION: ')
    //   doc.text(18, y+4, '1000 Bs')
    //   // doc.save("Pago"+date.formatDate(Date.now(),'DD-MM-YYYY')+".pdf");
    //   window.open(doc.output('bloburl'), '_blank');
    // },
    // filterFn (val, update) {
    //   // console.log(val)
    //   if (val === '') {
    //     update(() => {
    //       this.remitentes = this.remitentes2
    //       this.remitente=''
    //       // here you have access to "ref" which
    //       // is the Vue reference of the QSelect
    //     })
    //     return false
    //   }
    //
    //   update(() => {
    //     const needle = val.toLowerCase()
    //     this.remitentes = this.remitentes2.filter(v => v.remitente.toLowerCase().indexOf(needle) > -1)
    //   })
    // },
    misdatos(){
      this.$q.loading.show()
      this.$axios.get(process.env.API+'/cliente').then(res=>{
        // console.log(res.data)
        this.$q.loading.hide()
        // return false;
        this.clientes=res.data
        // this.clientes=[]
        // res.data.forEach(r=>{
        //   const date1 = new Date()
        //   const date2 = date.extractDate(r.fecha, 'YYYY-MM-DD')
        //   const dias = date.getDateDiff(date1, date2, 'days')
        //
        //   this.clientes.push({
        //     id:r.id,
        //     codigo:r.codigo,
        //     tipo:r.tipo,
        //     tipo2:r.tipo2,
        //     ref:r.ref,
        //     remitente:r.remitente,
        //     cargo:r.cargo,
        //     institucion:r.institucion,
        //     fecha:r.fecha,
        //     fechacarta:r.fechacarta,
        //     estado:r.estado,
        //     folio:r.folio,
        //     archivo:r.archivo,
        //     codinterno:r.codinterno,
        //     codexterno:r.codexterno,
        //     logs:r.logs,
        //     dias:dias,
        //   })
        // })

      }).catch(err=>{
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error',
        })
        this.$q.loading.hide()
      })
    },
    anular(mail){
      this.$q.dialog({
        title:'Seguro de anular?',
        message:'Motivo de anular',
        prompt:{
          model:'',
          type:'text'
        },
        cancel:true,
      }).onOk(data=>{
        // console.log(data)
        this.$q.loading.show()
        this.$axios.post(process.env.API+'/anulado',{mail_id:mail.id,accion:data,estado:'ANULADO'}).then(res=>{
          this.misdatos();
          this.$q.notify({
            message: 'Anulado',
            caption: 'Registro anulado',
            color: 'green',
            icon:'done'
          });
        })
      })
    },
    resetdespacho(){
      this.despacho.webid=' ';
      this.despacho.nurej=' ';
      this.despacho.proceso=' ';
      this.despacho.demandante=' ';
      this.despacho.demandados=' ';
    },
    guardar(){
      if (!confirm("seguro de registrar?")){
        return false
      }
      // console.log(this.remitente)
      // return false
      this.dato.remitente=this.remitente
      this.dato.cargo=this.cargo
      this.dato.institucion=this.institucion
      if(this.dato.id==undefined || this.dato.id==''){
        // console.log('new')
        this.$q.loading.show()
        this.$axios.post(process.env.API+'/mail',this.dato).then(res=>{
          console.log(res.data)
          this.dato={tipo:'INTERNO',fecha:date.formatDate(Date.now(),'YYYY-MM-DD'),folio:1};
          this.remitente=''
          this.cargo=''
          this.institucion=''
          this.misdatos()
          this.misremitentes()

          // this.$q.loading.hide()
        }).catch(err=>{
          this.$q.loading.hide()
          this.$q.notify({
            message:err.response.data.message,
            color:'red',
            icon:'error'
          })
        })
      }
      else{
        this.$q.loading.show()
        this.$axios.post(process.env.API+'/updatemail',this.dato).then(res=>{
          this.dato={tipo:'INTERNO',fecha:date.formatDate(Date.now(),'YYYY-MM-DD'),folio:1};
          this.remitente=''
          this.cargo=''
          this.institucion=''
          // console.log(res.data)
          this.misdatos()
          this.misremitentes()

          // this.$q.loading.hide()
        }).catch(err=>{
          this.$q.loading.hide()
          this.$q.notify({
            message:err.response.data.message,
            color:'red',
            icon:'error'
          })
        })
      }
    }
  },
  computed:{
      totaleg:function (){
      let t=0;
      this.tabegreso.forEach(r=>{
        t+= parseFloat(r.monto);
      })
      return t.toFixed(2);
    },
     totaling:function (){
      let t=0;
      this.tabingreso.forEach(r=>{
        t+= parseFloat(r.monto);
      })
      return t.toFixed(2);
    }

  }

}
</script>

<style scoped>

</style>
