<template>
  <q-page class="q-pa-xs">
    <div class="row">
      <div class="col-12 q-pa-xs">
        <q-form @submit="crearcliente">
          <div class="row">
            <div class="col-12 q-pa-xs col-sm-2">
              <q-input dense outlined label="CI/NIT" v-model="cliente.ci"/>
            </div>
            <div class="col-12 q-pa-xs col-sm-3">
              <q-input dense outlined label="Nombre completo" v-model="cliente.nombre" required/>
            </div>
            <div class="col-12 q-pa-xs col-sm-2">
              <q-input dense outlined label="Telefono" v-model="cliente.telefono" />
            </div>
            <div class="col-12 q-pa-xs col-sm-3 flex flex-center">
              <input type="file" dense outlined @change="getImage" ref="ima" accept="image/*"/>
            </div>
            <div class="col-12 q-pa-xs col-sm-2 flex flex-center">
              <q-btn @click="modcliente" color="yellow" icon="edit" label="Modificar" v-if="boolmod"/>
              <q-btn type="submit" color="primary" icon="send" label="Crear" v-else/>
            </div>
          </div>
        </q-form>
      </div>
      <div class="col-12">
        <q-table dense title="Personas Naturales" :rows="clientes" :columns="columns" :filter="filter"  :rows-per-page-options="[10,20,50,0]">
          <template v-slot:top-right>
            <q-input outlined dense debounce="300" v-model="filter" placeholder="Buscar">
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
          <template v-slot:body="props">
            <q-tr :props="props">
             <q-td key="opciones" :props="props">
                <q-btn-group >
                  <q-btn dense label="modificar" @click="mod(props.row)" color="orange"  icon="edit" size="xs" />
                  <q-btn dense label="foto" @click="modimg(props.row)" color="teal"  icon="image" size="xs" />
                  <q-btn dense label="lista" @click="listdespacho(props.row)" color="accent"  icon="text_snippet" size="xs" />
                  <q-btn dense label="Eliminar" @click="delcliente(props.row)" color="red"  icon="delete" size="xs" />
                </q-btn-group >
              </q-td>
              <q-td key="ci" :props="props" @click="listdespacho(props.row)">
                {{ props.row.ci }}
              </q-td>
              <q-td key="nombre" :props="props" @click="listdespacho(props.row)">
                <!--            <q-badge color="green">-->
                {{ props.row.nombre }}
                <!--            </q-badge>-->
              </q-td>
                            <q-td key="telefono" :props="props" @click="listdespacho(props.row)">
                <!--            <q-badge color="green">-->
                {{ props.row.telefono }}
                <!--            </q-badge>-->
              </q-td>
              <q-td key="tipo" :props="props">
                <q-badge @click="listdespacho(props.row)" :color="props.row.tipo=='EMPRESA'?'purple':'teal'">
                  {{ props.row.tipo }}
                </q-badge>
              </q-td>
              <q-td key="imagen" :props="props" style="  display: flex; height: 80px;
  justify-content: center;">
                <!--            <q-badge color="purple">-->
<!--                {{ props.row.imagen }}-->
                <div style="text-align: center;height: 80px; width: 80px;  display: block;">
                <q-img
                  @click="listdespacho(props.row)"
                  v-if="props.row.imagen!='' && props.row.imagen!=null"
                  :src="url+'/../imagenes/'+props.row.imagen"
                  spinner-color="white"
                  style=""
                /></div>
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

            </q-tr>
          </template>
        </q-table>
        <q-dialog  v-model="dialog_modimg">
          <q-card style="width: 1200px;min-width: 40vh">

            <q-card-section class="q-pt-none">
            <div class="text-h6">Imagen / logo Cliente</div>

            </q-card-section>
              <input type="file" dense outlined @change="getImage" ref="ima" accept="image/*"/>

            <q-card-section align="right">
              <q-btn flat label="Modificar" color="primary" icon="image" @click="onmodimg"/>
              <q-btn flat label="Cancelar" color="primary" icon="delete" v-close-popup />
            </q-card-section>
          </q-card>
        </q-dialog>

        <q-dialog full-width v-model="dialogcliente">
          <q-card >
            <q-card-section>
              <div class="text-h6"> <q-icon name="code"/> {{cliente2.nombre}} </div>
            </q-card-section>
            <q-card-section class="q-pt-none">
              <q-form @submit.prevent="registrarlog">
                <q-select use-input dense :options="tramites" label="Seleccionar Tramite / Proceso"  v-model="tramite" @filter="filterFn" outlined >
                  <template v-slot:no-option>
                    <q-item>
                      <q-item-section class="text-grey">
                        Sin resultados
                      </q-item-section>
                    </q-item>
                  </template>
                </q-select>
<!--                <div class="row">-->
<!--                  <div class="col-12">-->
<!--                    <pre>{{tramite}}</pre>-->
<!--                  </div>-->
<!--                </div>-->
                <div class="row">
                  <div class="col-12 col-md-6">
                    <div class="text-h6">REQUISITOS</div>
                     <q-checkbox size="xl" dense rigth-label v-model="r.estado" :label="r.nombre" v-for="(r,i) in tramite.requisitos" :key="i" class="full-width" />
                  </div>
                  <div class="col-12 col-md-6">
                <div class="row">
                  <div class="col-6"><q-input dense type="date" label="Fecha" outlined  v-model="despacho.fecha"/></div>
                  <div class="col-6"><q-input dense type="time" label="Hora" outlined  v-model="despacho.hora"/></div>
                </div>
                <div v-if="tramite.tipo!='TRAMITE'">
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
                <div v-if="tramite.tipo!='TRAMITE'">
                <q-input label="representante" outlined dense v-model="despacho.representante"/>
                <div class="text-h6">DEMANDADOS</div>
                <div class="responsive">
                <table class="table table-sm " >
                <thead>
                  <tr>
                  <th>ID</th>
                  <th>CI</th>
                  <th>NOMBRE</th>
                  <th>OPCIONES</th>
                  </tr>
                </thead>
                <tbody>
                <tr v-for="(i,index) in demandados" :key="index">
                    <th scope="row">{{index+1}}</th>
                    <td><input type="text" class="form-control" :name="i.ci" v-model="i.ci" @keyup="buscar(i,index)"></td>
                    <td><input type="text" class="form-control" :name="i.nombre" v-model="i.nombre"></td>
                    <td>
                         <q-btn dense color="green" @click="mas" icon="add"/>
                         <q-btn dense color="red" icon="remove" @click="menos(index)"/>
                    </td>
                </tr>
                </tbody>
                </table>
                </div>
                </div>
                <q-btn label="CREAR" color="teal" icon="send" class="full-width" type="submit"/>
                </div>
                </div>
              </q-form>
            </q-card-section>
            <q-card-section align="right">
              <q-btn flat label="Cancelar" color="primary" icon="delete" v-close-popup />
            </q-card-section>
          </q-card>
        </q-dialog>

        <q-dialog v-model="dialogdatos" full-width>
          <q-card >
            <q-card-section>
              <div class="text-h6"> <q-icon name="code"/> {{cliente2.nombre}} </div>
            </q-card-section>
            <q-card-section class="q-pt-none">
<!--                <q-input type="textarea" outlined label="Mi acccion" v-model="miaccion" required/>-->
<!--                <q-select :options="usuarios" label="Seleccionar personal" v-model="usuario" outlined required/>-->
                <div>Tramite / Proceso: {{cliente3.tramite.nombre}}</div>
                <q-input dense label="Tramite / Proceso" v-model="cliente3.tramite.nombre" outlined />

                  <div class="col-12">
                <div class="row">
                  <div class="col-6"><q-input dense type="date" label="Fecha" outlined  v-model="cliente3.fecha"/></div>
                  <div class="col-6"><q-input dense label="Hora" outlined  v-model="cliente3.hora"/></div>
                </div>
                <div >
                </div>
                <q-input label="ci" outlined dense v-model="cliente3.ci"/>
                <q-input label="demandante" outlined dense v-model="cliente3.demandante"/>
                <div>
                <div v-if="cliente3.tramite.tipo!='TRAMITE'">
                <q-input label="Juzgado" outlined dense v-model="cliente3.juzgado"/>
                <q-input label="Juez" outlined dense v-model="cliente3.juez"/>
                <div class="row">
                  <div class="col-6"><q-input dense label="NuRej" outlined  v-model="cliente3.nurej"/></div>
                  <div class="col-6"><q-input dense label="WebId" outlined  v-model="cliente3.webid"/></div>

                </div>

                <q-input label="Proceso" outlined dense v-model="cliente3.proceso"/>

                <q-input label="representante" outlined dense v-model="cliente3.representante"/>
                <q-btn full-width color="positive"  label="Modificar Datos" @click="moddespacho"/>
                <div class="text-h6">DEMANDADOS</div>
                <table style="width:100%;  border: 1px solid black;" >
               <thead>
                 <tr>
                 <th>ID</th>
                 <th>CI</th>
                <th>NOMBRE</th>
                <th>OPCION</th>
                  </tr>
                </thead>
                <tbody>
                    <tr v-for="(i,index) in cliente3.demandados" :key="index">
                    <th scope="row">{{index+1}}</th>
                    <td><input type="text" class="form-control" :name="i.ci" v-model="i.ci" @keyup="buscar2(i,index)"></td>
                    <td><input type="text" class="form-control" :name="i.nombre" v-model="i.nombre"></td>
                                        <td>
                         <q-btn dense color="green" @click="mas2" icon="add"/>
                         <q-btn dense color="red" icon="remove" @click="menos2(index)"/>
                    </td>
                </tr>
                </tbody>
               </table>
                </div>
                <q-btn full-width color="positive"  label="Modificar Dem" @click="moddema"/>

                  <q-card>
                    <q-tabs
                      v-model="tab"
                      dense
                      class="text-grey"
                      active-color="primary"
                      indicator-color="primary"
                      align="justify"
                      narrow-indicator
                    >
                      <q-tab name="requisitos" label="Requisitos" />
                      <q-tab name="agenda" label="Agenda" />
                      <q-tab name="cotizacion" label="Cotizacion" />
                    </q-tabs>

                    <q-separator />

                    <q-tab-panels v-model="tab" animated>
                      <q-tab-panel name="requisitos">
                        <div class="text-h6"></div>
<!--                        <pre>{{despacho}}</pre>-->
                        <q-list dense bordered padding class="rounded-borders">
                          <q-item clickable v-ripple v-for="r in despacho.requisitos" :key="r.id">
                            <q-item-section >
                              {{ r.nombre }}
                            </q-item-section>
                          </q-item>
                        </q-list>
                      </q-tab-panel>

                      <q-tab-panel name="agenda">
<!--                        <div class="text-h6">Alarms</div>-->
<!--                        lorem-->
                        <q-table :columns="columnsagenda" dense :rows="agendas" :filter="filteragenda" :rows-per-page-options="[10,20,50,0]">
                          <template v-slot:body-cell-etapa="props">
                            <q-td :props="props">
                              {{props.row.etapa.numero}}. {{props.row.etapa.nombre}}
                            </q-td>
                          </template>
                          <template v-slot:body-cell-usuario="props">
                            <q-td :props="props" v-if="props.row.userterminado!=null">
                              {{props.row.userterminado.name}}
                            </q-td>
                            <q-td :prop="props" v-else>
                            </q-td>
                          </template>
                          <template v-slot:body-cell-archivo="props">
                            <q-td :props="props" >
                              <q-btn v-if="props.row.archivo!='' && props.row.archivo!=null" color="info"  :label="props.row.archivo" icon="print" @click="descargar(props.row)" size="xs" />
                            </q-td>
                          </template>
                          <template v-slot:body-cell-fechafini="props">
                            <q-td :props="props">
                              {{props.row.fechaini}} {{props.row.horaini}}
                            </q-td>
                          </template>
                          <template v-slot:body-cell-estado="props">
                            <q-td :props="props">
                              <q-badge :color="props.row.estado=='EN ESPERA'?'warning':'positive'">{{props.row.estado}}</q-badge>
                            </q-td>
                          </template>
                          <template v-slot:top-right>
                            <q-btn label="Crear agenda" @click="nuevaagenda" icon="add_circle" color="positive"/>
                            <q-input dense outlined v-model="filteragenda" placeholder="Buscar.." >
                              <template v-slot:append>
                                <q-icon name="search"/>
                              </template>
                            </q-input>
                          </template>
                        </q-table>
                      </q-tab-panel>

                      <q-tab-panel name="cotizacion">
                        <div class="text-h6">Cotizacion</div>
                        <div class="row">
                          <div class="col-12 col-md-6">
                          <div class="col12 col-md-4"> <q-select v-model="proforma" :options="proformas" label="Cotizaciones" outlined v-if="proformas!=[]"/></div>
                            <div><q-btn color="primary" icon="check" label="Agregar" @click="enlazar" v-if="proformas!=[]"/></div>
                          </div>
                          <div class="col-12 col-md-6" v-if="cliente3.proforma!== null">
                            <div> PROFORMA</div>
                            tramite: {{cliente3.proforma.tramite.nombre}}<br>
                            Total: {{cliente3.proforma.total}} <br>
                            fecha: {{cliente3.proforma.fecha}} <br>
                            <div> DETALLE</div>
                            <div v-for="(v,index) in cliente3.proforma.detalleproformas" :key="index">
                              {{v.nombre}} {{v.precio}}
                            </div>
                          </div>
                        </div>
                      </q-tab-panel>
                    </q-tab-panels>
                  </q-card>
                </div>
                </div>
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
               dense
               title="LISTA DE DESPACHO"
              :rows="infodespacho"
              :columns="descol"
              row-key="name"
              :rows-per-page-options="[10,20,50,0]"
             >
             <template v-slot:body-cell-tramite="props">
               <q-td :props="props" @click="detalle(props.row)">
                 {{props.row.tramite.nombre}}
               </q-td>
             </template>
             <template v-slot:body-cell-demandados="props">
               <q-td :props="props" @click="detalle(props.row)">
                 <ul >
                   <li v-for="(d,index) in props.row.demandados" :key="index">{{d.nombre}}</li>

                 </ul>
               </q-td>
             </template>
            <template v-slot:body-cell-tipo="props">
              <q-td :props="props" @click="detalle(props.row)">
                <q-badge :color="props.row.tipo=='TRAMITE'?'accent':'teal'">
                  {{ props.row.tipo }}
                </q-badge>
              </q-td>
            </template>
               <template v-slot:body-cell-requisitos="props">
                 <q-td :props="props" @click="detalle(props.row)">
                   <ul style="padding: 0px;margin: 0px;border: 0px;list-style: none">
                     <li  style="padding: 0px;margin: 0px;border: 0px;font-size: 8px" v-for="r in props.row.requisitos" :key="r.id">{{r.nombre}}</li>
                   </ul>
                 </q-td>
               </template>
            <template v-slot:body-cell-opcion="props">
              <q-td key="opcion" :props="props">
                <q-btn-group >
                <q-btn dense  size="xs" label="pagos" flat color="green" @click="listRow(props.row)" icon="list"></q-btn>
                <q-btn dense  size="xs" label="actualizar" flat color="teal" @click="faltante(props.row)" icon="checklist"></q-btn>
                <q-btn dense  size="xs" label="dato" flat color="accent" @click="detalle(props.row)" icon="description"></q-btn>
                <q-btn dense  size="xs" label="imprimir" flat color="teal" @click="imprimir2(props.row)" icon="print"></q-btn>
                <q-btn dense  size="xs" label="Eliminar" flat color="red" @click="deldespacho(props.row)" icon="delete"></q-btn>
                </q-btn-group >
              </q-td>
             </template>
<!--               <template v-slot:top-left>-->
<!--                 <q-btn dense label="agregar" @click="aceptar(props.row)" color="positive"  icon="add_circle" size="xs" />-->
<!--               </template>-->
               <template v-slot:top-right>
                 <q-btn label="agregar" @click="aceptar(cliente2)" color="positive"  icon="add_circle" />
<!--                 <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">-->
<!--                   <template v-slot:append>-->
<!--                     <q-icon name="search" />-->
<!--                   </template>-->
<!--                 </q-input>-->
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
          <q-card style="width: 700px; max-width: 80vw;">
            <q-card-section class="q-pt-none">
            <div class="text-h6">INGRESO</div>
              <q-form @submit.prevent="regingreso">
                <div class="row">

                <div class="col-6"><q-input dense outlined label="Motivo" v-model="ingreso.motivo"/></div>
                <div class="col-6"><q-input dense outlined label="Monto" type="number" v-model="ingreso.monto" step="0.01"/></div>
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
          <q-card style="width: 700px; max-width: 80vw;">
            <q-card-section class="q-pt-none">
            <div class="text-h6">EGRESO</div>
              <q-form @submit.prevent="regegreso">
                <div class="row">
                <div class="col-6"><q-input dense outlined label="Concepto" v-model="egreso.concepto"/></div>
                <div class="col-6"><q-input dense outlined label="Monto" type="number" v-model="egreso.monto" step="0.01"/></div>
                </div>
                <q-card-section align="right" class="row">
                    <div class="col-6"><q-btn flat label="Registrar" type="submit" color="primary" icon="send" /></div>
                    <div class="col-6"><q-btn flat label="Cancelar" color="primary" icon="delete" v-close-popup /></div>
                </q-card-section>
              </q-form>
            </q-card-section>
          </q-card>
        </q-dialog>

        <q-dialog v-model="dialog_remcl">
          <q-card style="width: 700px; max-width: 80vw;">
            <q-card-section class="q-pt-none">
            <div class="text-h6">EGRESO CLIENTE</div>
              <q-form @submit.prevent="regegrcliente">
                <div class="row">
                <div class="col-6"><q-input dense outlined label="Concepto" v-model="egrcl.concepto"/></div>
                <div class="col-6"><q-input dense outlined label="Monto" type="number" step="0.01" v-model="egrcl.monto"/></div>
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
              <div class="col-md-4 col-sm-12">
                <q-btn dense round label="Ingreso" flat color="green" @click="addRow()" icon="add" v-if="$store.state.login.boolregingreso"></q-btn>
                <q-table dense
                  title="LISTA DE INGRESOS"
                  :rows="tabingreso"
                  :columns="ingresocol"
                  row-key="name"
                  :rows-per-page-options="[10,20,50,0]"
                               >
                            <template v-slot:body-cell-opcion="props">
              <q-td key="opcion" :props="props">
                  <q-btn dense  size="xs" flat color="info" @click="imprec(props.row)" icon="print"></q-btn>
                  <q-btn dense  size="xs" flat color="orange" @click="updatemonto(props.row)" icon="edit" v-if="$store.state.login.boolelingreso"></q-btn>
                  <q-btn dense  size="xs" flat color="red" @click="deling(props.row)" icon="delete" v-if="$store.state.login.boolelingreso"></q-btn>
              </q-td>
             </template>
                </q-table>
              </div>
              <div class="col-md-4 col-sm-12">
                <q-btn dense round flat label="Egreso" color="red" @click="removeRow()" icon="remove" v-if="$store.state.login.boolregingreso"></q-btn>
                <q-table dense
                  title="LISTA EGRESOS"
                  :rows="tabegreso"
                  :columns="egresocol"
                  row-key="name"
                  :rows-per-page-options="[10,20,50,0]"
                            >
                            <template v-slot:body-cell-opcion="props">
              <q-td key="opcion" :props="props">
                  <q-btn dense  size="xs" flat color="red" @click="deleg(props.row)" icon="delete" v-if="$store.state.login.boolelingreso"></q-btn>
              </q-td>
             </template>
                </q-table>
              </div>
              <div class="col-md-4 col-sm-12">
                <q-btn dense round flat label="Egr Cliente" color="accent" @click="reclRow()" icon="remove" v-if="$store.state.login.boolregingreso"></q-btn>
                <q-table dense
                  title="LISTA EGRESOS CLIENTE"
                  :rows="tabegcl"
                  :columns="egrclcol"
                  row-key="name"
                  :rows-per-page-options="[10,20,50,0]"
                              >
                            <template v-slot:body-cell-opcion="props">
              <q-td key="opcion" :props="props">
                  <q-btn dense  size="xs" flat color="red" @click="delegcl(props.row)" icon="delete" v-if="$store.state.login.boolelingreso"></q-btn>
              </q-td>
             </template>
                </q-table>
              </div>
            </div>
            <div>
              <span><b>Total Ingreso: </b>{{totaling}}</span> <br>
              <span><b>Total Egreso: </b>{{totaleg}}</span> <br>
              <span><b>Total Egreso Cliente: </b>{{totalegcl}}</span> <br>
              <span><b>Total Adeudado : </b>{{totaling - totaleg}}</span> <br>
              <span><b>Total Adeudado Cliente: </b>{{totaling - totalegcl}}</span>
            </div>

            </q-card-section>
            <q-card-section align="right">
              <q-btn flat label="Imprimir Egresos" color="primary" icon="print" @click="impresionpagos"/>
              <q-btn flat label="Imprimir Egresos clientes" color="primary" icon="print" @click="impresioncliente"/>
              <q-btn flat label="Cancelar" color="primary" icon="delete" v-close-popup />
            </q-card-section>
          </q-card>
        </q-dialog>
                    <q-dialog v-model="dialog_falt" >
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">Requisitos Faltantes</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
            <q-checkbox size="xl" dense rigth-label v-model="r.estado" :label="r.nombre" v-for="(r,i) in reqfal" :key="i" class="full-width" />

        </q-card-section>

        <q-card-actions align="right" class="text-primary">
          <q-btn flat label="Cancel" v-close-popup />
          <q-btn flat label="Actualizar" @click="updrequisito" />
        </q-card-actions>
      </q-card>
        </q-dialog>
      </div>
    </div>

    <q-dialog v-model="modalagenda" full-width>
      <q-card >
        <q-card-section>
          <div class="text-h6">Crear agenda</div>
        </q-card-section>
        <q-card-section class="q-pt-none">
            <q-form @submit="crearagenda">
            <div class="row">
              <div class="col-12 col-md-4">
                <q-select dense outlined label="" :options="etapas" v-model="etapa" use-input @filter="filterEt">
                        <template v-slot:no-option>
          <q-item>
            <q-item-section class="text-grey">
              No results
            </q-item-section>
          </q-item>
        </template>
      </q-select>
              </div>
                            <div class="col-12 col-md-3">
                <q-select dense outlined label="Usuario" v-model="user" :options="usuarios" required/>
              </div><br>
                            <div class="col-12 col-md-5">
                <q-input dense outlined label="Actividad" v-model="agenda.actividad" type="textarea" required/>
              </div>

              <div class="col-12 col-md-5">
                <q-input dense outlined label="Proximo paso" v-model="agenda.proximopaso" type="textarea" required/>
              </div>
                <div class="col-12 col-md-3">
                <q-input dense outlined label="Fecha PP" v-model="agenda.fechafin" type="date" required/>
              </div>
              <div class="col-12 col-md-2">
                <q-input dense outlined label="Hora PP" v-model="agenda.horafin" type="time" required/>
              </div>


              <div class="col-12 col-md-2 flex flex-center">
                <q-btn type="submit" label="agregar" icon="add_circle" color="positive"/>
              </div>
            </div>
          </q-form>
        </q-card-section>
        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn flat label="cancelar" color="negative" icon="delete" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
// import $ from 'jquery'
import { jsPDF } from "jspdf";
import {date} from 'quasar'
export default {
  data(){
    return {
      filteragenda:'',
      etapas:[],
      etapas2:[],
      etapa:{},
      agendas:[],
      agenda:{},
      modalagenda:false,
      tab:'agenda',
      imagen : null,
      miaccion:'',
      columnsagenda:[
        {label:'ESTADO',name:'estado',field:'estado'},
        {label:'FECHA',name:'fechaini',field:'fechaini'},
        {label:'ETAPA',name:'etapa',field:'etapa'},
        {label:'ARCHIVO',name:'archivo',field:'archivo'},
        {label:'ACTIVIDAD',name:'actividad',field:'actividad'},
        {label:'PROXIMO PASO',name:'proximopaso',field:'proximopaso'},
        {label:'USUARIO',name:'usuario',field:'userterminado'},
        {label:'FECHA PROXIMO',name:'fechafin',field:'fechafin'},
        // {label:'opciones',name:'opciones',field:'opciones'},
      ],
      filter:'',
      usuario:'',
      user:{label:''},
      dialogcliente:false,
      dialogdatos:false,
      dialogarchivo:false,
      dialog_despacho:false,
      dialog_add:false,
      dialog_remove:false,
      dialog_list:false,
      dialog_gastos:false,
      dialog_remcl:false,
      dialog_modimg:false,
      url:process.env.API,
      reqdespacho:{},
      reqfal:[],
      dialog_falt:false,
      demandados:[{ci:'',nombre:''}],
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
      infocliente:{},
      cliente2:'',
      cliente3:{},
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
      egrcl:{},
      tabingreso:[],
      tabegreso:[],
      tabegcl:[],
      gastos:[],
      boolmod:false,
          proformas:[],
      proforma:{},
      columns:[
        {field:'opciones',name:'opciones',label:'OPCIONES',align:'center'},
        {field:'ci',name:'ci',label:'CI',align:'right'},
        {field:'nombre',name:'nombre',label:'NOMBRE',align:'right'},
        {field:'telefono',name:'telefono',label:'TELEFONO',align:'right'},
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
      ],

      descol:[
        {field:'opcion',name:'opcion',label:'OPCION',align:'center'},
        {field:'fecha',name:'fecha',label:'FECHA',align:'right'},
        {field:'hora',name:'hora',label:'HORA',align:'right'},
        {field:'tipo',name:'tipo',label:'TIPO',align:'right'},
        {field:'tramite',name:'tramite',label:'TRAMITE',align:'right'},
        {field:'demandante',name:'demandante',label:'DEMANDANTE',align:'right'},
        {field:'demandados',name:'demandados',label:'DEMANDADOS',align:'right'},
        {field:'requisitos',name:'requisitos',label:'requisitos',align:'right'},
      ],
      ingresocol:[
        {field:'opcion',name:'opcion',label:'opcion',align:'right'},
        {field:'fecha',name:'fecha',label:'fecha',align:'right'},
        {field:'hora',name:'hora',label:'hora',align:'right'},
        {field:'monto',name:'monto',label:'monto',align:'right'},
        {field:'concepto',name:'concepto',label:'Concepto',align:'right'},
        {field:'id',name:'recibo',label:'recibo',align:'right'},

      ],
      egresocol:[
        {field:'opcion',name:'opcion',label:'opcion',align:'right'},
        {field:'fecha',name:'fecha',label:'fecha',align:'right'},
        {field:'hora',name:'hora',label:'hora',align:'right'},
        {field:'monto',name:'monto',label:'monto',align:'right'},
         {field:'concepto',name:'concepto',label:'concepto',align:'left'},

      ],
      egrclcol:[
        {field:'opcion',name:'opcion',label:'opcion',align:'right'},
        {field:'fecha',name:'fecha',label:'fecha',align:'right'},
        {field:'hora',name:'hora',label:'hora',align:'right'},
        {field:'monto',name:'monto',label:'monto',align:'right'},
         {field:'concepto',name:'concepto',label:'concepto',align:'left'},

      ]
    }
  },
  created() {
    this.misetapas()
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
        d.requisitos.forEach(re=>{
          re.estado=false
        })
        d.label=r.tipo+' '+r.nombre
        this.tramites.push(d)
      })
      this.tramite={label:'',requisitos:[]}
      //this.requisitos=this.tramites[0].requisitos;
      // this.requisitos=this.tramite.requisitos;
      this.tramites.forEach(r=>{
        r.requisitos.forEach(element => {
        element.estado=false;
      });
      })

      this.tramites2=this.tramites
    })
    this.resetdespacho();
    this.misusuarios()
  },
  methods:{
    moddema(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/updemandado',{id:this.cliente3.id,demandados:this.cliente3.demandados}).then(res=>{
        this.misdatos()
        this.$q.loading.hide()
        this.dialogdatos=false
        this.$q.notify({
          message:'Despacho registrado!!',
          color:'green',
          icon:'done'
        })
        this.listdespacho(this.cliente2)
      }).catch(err=>{
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error'
        })
        this.$q.loading.hide()
      })
    },
                descargar(agenda){
              console.log(agenda)
              var fileName=this.url+'/../archivos/'+agenda.archivo;
              window.open(fileName, 'Download');
        },
        imprec(pago){
          this.$axios.get(process.env.API+'/imprecibo/'+pago.id).then(res=>{
                    let myWindow = window.open("", "Imprimir", "width=1000,height=500");
        myWindow.document.write(res.data);
        myWindow.document.close();
        myWindow.focus();
        setTimeout(function(){
          myWindow.print();
          myWindow.close();
        },500);
          })

        },
    updatemonto(pago){
      console.log(pago)
      this.$q.dialog({
        title: 'CONFIRMAR',
        message: 'Modificar Monto?',
        cancel: true,
        prompt: {
          model: pago.monto,
          type: 'number'
        },
        persistent: false
      }).onOk(data => {
        this.$axios.post(process.env.API+'/updmonto/'+pago.id,{monto:data}).then(res=>{
          this.$axios.post(process.env.API+'/ringreso/'+this.datodespacho.id).then(res=>{
              this.tabingreso=res.data;
        });
        })
      }).onOk(() => {
        // console.log('>>>> second OK catcher')
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
    },
        deling(pago){
                this.$q.dialog({
        title: 'CONFIRMAR',
        message: 'ESTA SEGURO DE ELIMINAR?',
        cancel: true,
        persistent: false
      }).onOk(() => {
      this.$axios.delete(process.env.API+'/ingreso/'+pago.id).then(res=>{
        this.$axios.post(process.env.API+'/ringreso/'+this.datodespacho.id).then(res=>{
              this.tabingreso=res.data;
        });
      })
      }).onOk(() => {
        // console.log('>>>> second OK catcher')
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })


    },
    deleg(pago){
                      this.$q.dialog({
        title: 'CONFIRMAR',
        message: 'ESTA SEGURO DE ELIMINAR?',
        cancel: true,
        persistent: false
      }).onOk(() => {
           this.$axios.delete(process.env.API+'/egreso/'+pago.id).then(res=>{
                this.$axios.post(process.env.API+'/regreso/'+this.datodespacho.id).then(res=>{
              this.tabegreso=res.data;
      });
      })
      }).onOk(() => {
        // console.log('>>>> second OK catcher')
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })

    },
    delegcl(pago){
                            this.$q.dialog({
        title: 'CONFIRMAR',
        message: 'ESTA SEGURO DE ELIMINAR?',
        cancel: true,
        persistent: false
      }).onOk(() => {
      this.$axios.delete(process.env.API+'/egotro/'+pago.id).then(res=>{
                this.$axios.post(process.env.API+'/regotro/'+this.datodespacho.id).then(res=>{
              this.tabegcl=res.data;
      });
      })
      }).onOk(() => {
        // console.log('>>>> second OK catcher')
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })

    },
    misusuarios(){
      this.$axios.post(process.env.API+'/listuser').then(res=>{
        res.data.forEach(r => {
        this.usuarios.push({label:r.name,r})

        });
      })

    },
    enlazar(){
      if(this.proforma=={label:''})
      return false;
      console.log(this.proforma.r)
      this.$axios.post(process.env.API+'/updespacho/',{despacho_id:this.cliente3.id,proforma_id:this.proforma.r.id}).then(res=>{
      })
    },
        misproformas(cliente_id){
          this.proformas=[]
          this.proforma={label:''}
      this.$axios.post(process.env.API+'/listproforma/'+cliente_id).then(res=>{
        console.log(res.data)
        res.data.forEach(r => {
          this.proformas.push({label:r.total+'Bs '+r.fecha+' '+r.tramite.nombre ,r});
        });


      })
    },
    nuevaagenda(){
      this.modalagenda=true
      this.agenda.fechaini=date.formatDate(new Date(),'YYYY-MM-DD')
      this.agenda.horaini=date.formatDate(new Date(),'HH:mm:00')
      this.agenda.fechafin=date.formatDate(new Date(),'YYYY-MM-DD')
      this.agenda.horafin=date.formatDate(new Date(),'HH:mm:00')
    },
    misetapas(){
      this.$axios.get(process.env.API+'/etapa').then(res=>{
        this.etapas=[]
        res.data.forEach(r=>{
          let d=r
          d.label=r.nombre
          this.etapas.push(d)
        })
        this.etapa={label:''}
        this.etapas2=this.etapas
      })
    },
        filterEt (val, update) {
      console.log(val)
        if (val === '') {
          update(() => {
            this.etapa={label:''}
            this.etapas = this.etapas2

            // here you have access to "ref" which
            // is the Vue reference of the QSelect
          })
          return
        }

        update(() => {
          const needle = val.toLowerCase()
          this.etapas = this.etapas2.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
        })
      },
        faltante(prop){
      console.log(prop);
        this.reqfal=[];
        this.reqdespacho.despacho_id=prop.id;
      this.$axios.post(process.env.API+'/reqfaltantes/',{despacho_id:prop.id,tramite_id:prop.tramite_id}).then(res=>{
        this.reqfal=res.data;
        console.log(res.data)
        this.reqfal.forEach(element => {
            element.estado=false
        });
        //return false
          this.dialog_falt=false;
        if(this.reqfal.length>0)
          this.dialog_falt=true;
      })
    },
    crearagenda(){
      console.log(this.user)
      if(this.user.r==undefined)
        return false
      else{
      //this.$q.loading.show()
      this.agenda.despacho_id=this.despacho.id
      this.agenda.etapa_id=this.etapa.id
      this.agenda.user_id=this.user.r.id
      this.$axios.post(process.env.API+'/agenda',this.agenda).then(res=>{
        // console.log(res.data)
        this.agenda={}
        this.modalagenda=false
        this.misagendas(this.despacho.id)
        // this.$q.loading.hide()

      })}
    },
    updrequisito(){
      this.reqdespacho.requisitos=this.reqfal;
      this.$axios.post(process.env.API+'/updrequisito/',this.reqdespacho).then(res=>{
      this.dialog_falt=false;
      this.dialog_despacho=false
      this.$q.notify({
          message:"Agregado",
          color:'green',
          icon:'done'
        })
      })
        this.misdatos();
    },
    mas(){
        this.demandados.push({ci:'',nombre:''});
    },
    menos(index){
        if(index>=1)
        this.demandados.splice(index, 1);
        if(index==0)
        this.demandados=[{ci:'',nombre:''}]
    },
    mas2(){
      this.cliente3.demandados.push({ci:'',nombre:''})
    },
    menos2(index){
        if(index>=1)
        this.cliente3.demandados.splice(index, 1);
        if(index==0)
        this.cliente3.demandados=[{ci:'',nombre:''}]
    },
    buscar(i,index){
      this.$axios.get(process.env.API+'/demandado/'+i.ci).then(res=>{
        // console.log(res.data)
        if(res.data.length>0) {
          // this.demandados[index]={ci:res.data[0].ci,nombre:res.data[0].nombre};}
          this.demandados[index].nombre = res.data[0].nombre
        }else{
        // this.demandados[index]={ci:i.ci,nombre:''};
          this.demandados[index].nombre = ''
        }
      })
    },
        buscar2(i,index){
      this.$axios.get(process.env.API+'/demandado/'+i.ci).then(res=>{
        // console.log(res.data)
        if(res.data.length>0) {
          // this.demandados[index]={ci:res.data[0].ci,nombre:res.data[0].nombre};}
          this.cliente3.demandados[index].nombre = res.data[0].nombre
        }else{
        // this.demandados[index]={ci:i.ci,nombre:''};
          this.cliente3.demandados[index].nombre = ''
        }
      })
    },
    lrequisito(){
      console.log(this.tramite.requisitos)
      // this.tramite.requisitos.forEach(r=>{
      //   console.log(r)
      // })
      // // return false
      // this.requisitos=[];
      // this.requisitos=tramite.requisitos;
      // this.requisitos.forEach(element => {
      //   element.estado=false
      // })
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
        this.$axios.post(process.env.API+'/ringreso/'+this.datodespacho.id).then(res=>{
              this.tabingreso=res.data;
      });
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
            this.$axios.post(process.env.API+'/regreso/'+this.datodespacho.id).then(res=>{
              this.tabegreso=res.data;
      });

      });
    },
    regegrcliente(){
      this.egrcl.despacho_id=this.datodespacho.id;
      this.egrcl.fecha=date.formatDate(Date.now(),'YYYY-MM-DD');
      this.egrcl.hora=date.formatDate(Date.now(),'HH:mm');
      this.$axios.post(process.env.API+'/egotro',this.egrcl).then(res=>{
          this.$q.notify({
          message:"Agregado",
          color:'green',
          icon:'done'
        })
        this.dialog_remcl=false;
        this.egreso={};
                  this.$axios.post(process.env.API+'/regotro/'+this.datodespacho.id).then(res=>{
              this.tabegcl=res.data;
      });
      });
    },
    addRow(prop){
      this.dialog_add=true;
    },
    removeRow(prop){
      this.dialog_remove=true;

    },
        reclRow(prop){
      this.dialog_remcl=true;

    },
    listRow(prop){
            this.datodespacho=prop;
      this.$axios.post(process.env.API+'/ringreso/'+this.datodespacho.id).then(res=>{
              this.tabingreso=res.data;
      });
            this.$axios.post(process.env.API+'/regreso/'+this.datodespacho.id).then(res=>{
              this.tabegreso=res.data;
      });
                  this.$axios.post(process.env.API+'/regotro/'+this.datodespacho.id).then(res=>{
              this.tabegcl=res.data;
      });
             this.dialog_gastos=true;
    },
    detalle(prop){
      this.despacho=prop
       console.log(prop)
      this.misagendas(this.despacho.id)
      // console.log(prop)
      this.misproformas(prop.cliente_id)
      this.cliente3=prop

      this.dialogdatos=true;
    },
    misagendas(id){
      this.$q.loading.show()
      this.$axios.get(process.env.API+'/agenda/'+id).then(res=>{
        console.log(res.data)
        // this.tabegcl=res.data;
        this.agendas=res.data
        this.$q.loading.hide()
        console.log(res.data)
      });
    },
    imprimir2(despacho){
          console.log(despacho)
        // this.$axios.post(process.env.API+'/impresion/'+this.datodespacho.id).then(res=>{
        //   let myWindow = window.open("", "Imprimir", "width=900,height=600");
        //   myWindow.document.write(res.data);
        //   myWindow.document.close();
        //   myWindow.focus();
        //   setTimeout(function(){
        //     myWindow.print();
        //     myWindow.close();
        //   },500);
        // })
      let demandados="";
          despacho.demandados.forEach(d=>{
            // console.log(d)
            demandados+=d.nombre+","
          })
        let myWindow = window.open("", "Imprimir", "width=900,height=600");
        myWindow.document.write("" +
          "<table style='width: 100%;font-size: 28px;padding-left: 50px;padding: 10px;padding-right: 50px;border: 5px solid black;border-radius: 20px'>" +
          "<tr >" +
          "<td colspan='2'><b>JUZGADO:</b> "+despacho.juzgado+"</td>" +
          "</tr>"+
          "<tr>" +
          "<td><b>NURREJ:</b> "+despacho.nurej+"</td>" +
          "<td><b>WEB-ID:</b> "+despacho.webid+"</td>" +
          "</tr>"+
          "<tr >" +
          "<td colspan='2'><b>PROCESO:</b> "+despacho.proceso+"</td>" +
          "</tr>"+
          "<tr >" +
          "<td colspan='2'><b>DEMANDANTE:</b> "+despacho.demandante+"</td>" +
          "</tr>"+
          "<tr >" +
          "<td colspan='2'><b>DEMANDADOS:</b> "+demandados+"</td>" +
          "</tr>"+
          "<tr >" +
          "<td colspan='2'><b>JUEZ:</b> "+despacho.juez+"</td>" +
          "</tr>"+
          "</table>");
        myWindow.document.close();
        myWindow.focus();
        // setTimeout(function(){
          myWindow.print();
          myWindow.close();
        // },500);
    },
        impresionpagos(){
      let mc=this

      function header(){
        var img = new Image()
        var img2 = new Image()

        img.src = 'img/logocastillogonzales2.png'
        img2.src = 'img/fondo2.png'
        doc.setFontSize(12);

        doc.addImage(img, 'jpg', 0.5, 0.5, 5, 3)
        doc.setFont(undefined,'bold')
        doc.text(8, 2.5, 'GASTOS '+ mc.cliente2.nombre)
        doc.setFontSize(8);
        doc.text(6, 3,  mc.datodespacho.tramite.nombre.substring(0,75))
        if(mc.datodespacho.tramite.nombre.length>75)
        doc.text(6, 3.5,  mc.datodespacho.tramite.nombre.substring(75))
        doc.setFont(undefined,'normal')
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
      // let xx=x
      // let yy=y
      let y=0
      let y1=0
      let y2=0
      let sum1=0
      let sum2=0
      //this.ventas.forEach(r=>{
        y+=0.5

        if (y+5>34){
          doc.addPage();
          header()
          footer()
          y=0
        }
        doc.setFont(undefined,'bold')
        doc.text(7, 4,'INGRESOS' )
        doc.setLineWidth(0.05);
        doc.line(0.5,4.2,20,4.2)
        doc.text(1, 4.5,'FECHA' )
        doc.text(3, 4.5,'RECIBO' )
        doc.text(4.5, 4.5,'CONCEPTO' )
        doc.text(9, 4.5,'MONTO Bs' )
        doc.setFont(undefined,'normal')
        mc.tabingreso.forEach(ing => {
          sum1+=parseFloat(ing.monto)
          y1+=0.5
        doc.text(1, y1+4.5,ing.fecha+'' )
        doc.text(3, y1+4.5, ing.id+'' )
        doc.text(4.5, y1+4.5,ing.concepto+'' )
        doc.text(9, y1+4.5,ing.monto.toFixed(2)+'' )
        });
        doc.setFont(undefined,'bold')
        doc.text(17, 4, 'EGRESOS')
        doc.text(14, 4.5,'CONCEPTO' )
        doc.text(19, 4.5,'MONTO Bs' )
        doc.setFont(undefined,'normal')
        mc.tabegreso.forEach(egr => {
          sum2+=parseFloat( egr.monto)
          y2+=0.5
        doc.text(12, y2+4.5,egr.concepto.substring(0,36)+'')
        doc.text(20, y2+4.5,egr.monto.toFixed(2)+'','right')
        });
        if(y2>y1)
          {doc.line(11.5,4.5,11.5,y2+4.5)
          y=y2}
        else
          {doc.line(11.5,4.5,11.5,y1+4.5)
          y=y1}
          y+=0.5
        doc.line(0.5,y+4.5,20,y+4.5)
          y+=0.5
        doc.setFont(undefined,'bold')
        doc.text(1, y+4.5,' INGRESO TOTAL:')
        doc.setFont(undefined,'normal')
        doc.text(9, y+4.5,sum1.toFixed(2)+' Bs' )
        doc.setFont(undefined,'bold')
        doc.text(14, y+4.5,'EGRESO TOTAL')
        doc.setFont(undefined,'normal')
        doc.text(19, y+4.5,sum2.toFixed(2)+' Bs' )
          y+=0.5
          let tot= parseFloat(sum1) - parseFloat(sum2)
        doc.setFont(undefined,'bold')
         doc.text(1, y+4.5,' TOTAL ADEUDADO:')
        doc.setFont(undefined,'normal')
          doc.text(9, y+4.5,tot.toFixed(2)+' Bs' )


      window.open(doc.output('bloburl'), '_blank');
    },

            impresioncliente(){
      let mc=this

      function header(){
        var img = new Image()
        var img2 = new Image()

        img.src = 'img/logocastillogonzales2.png'
        img2.src = 'img/fondo2.png'
        doc.setFontSize(12);

        doc.addImage(img, 'jpg', 0.5, 0.5, 5, 3)
        doc.setFont(undefined,'bold')
        doc.text(8, 2.5, 'GASTOS '+ mc.cliente2.nombre)
        doc.setFontSize(8);
        doc.text(6, 3,  mc.datodespacho.tramite.nombre.substring(0,75))
                if(mc.datodespacho.tramite.nombre.length>75)
        doc.text(6, 3.5,  mc.datodespacho.tramite.nombre.substring(75))
        doc.setFont(undefined,'normal')
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
      // let xx=x
      // let yy=y
      let y=0
      let y1=0
      let y2=0
      let sum1=0
      let sum2=0
      //this.ventas.forEach(r=>{
        y+=0.5

        if (y+5>34){
          doc.addPage();
          header()
          footer()
          y=0
        }
        doc.setFont(undefined,'bold')
        doc.text(7, 4,'INGRESOS' )
        doc.setLineWidth(0.05);
        doc.line(0.5,4.2,20,4.2)
        doc.text(1, 4.5,'FECHA' )
        doc.text(3, 4.5,'RECIBO' )
        doc.text(4.5, 4.5,'CONCEPTO' )
        doc.text(9, 4.5,'MONTO Bs' )
        doc.setFont(undefined,'normal')
        mc.tabingreso.forEach(ing => {
          sum1+=parseFloat(ing.monto)
          y1+=0.5
        doc.text(1, y1+4.5,ing.fecha+'' )
        doc.text(3, y1+4.5, ing.id+'' )
        doc.text(4.5, y1+4.5,ing.concepto+'' )
        doc.text(9, y1+4.5,ing.monto.toFixed(2)+'' )
        });
        doc.setFont(undefined,'bold')
        doc.text(17, 4, 'EGRESOS')
        doc.text(14, 4.5,'CONCEPTO' )
        doc.text(19, 4.5,'MONTO Bs' )
        doc.setFont(undefined,'normal')
        mc.tabegcl.forEach(egr => {
          sum2+=parseFloat( egr.monto)
          y2+=0.5
        doc.text(12, y2+4.5,egr.concepto.substring(0,36)+'')
        doc.text(20, y2+4.5,egr.monto.toFixed(2)+'','right')
        });
        if(y2>y1)
          {doc.line(11.5,4.5,11.5,y2+4.5)
          y=y2}
        else
          {doc.line(11.5,4.5,11.5,y1+4.5)
          y=y1}
          y+=0.5
        doc.line(0.5,y+4.5,20,y+4.5)
          y+=0.5
        doc.setFont(undefined,'bold')
        doc.text(1, y+4.5,' INGRESO TOTAL:')
        doc.setFont(undefined,'normal')
        doc.text(9, y+4.5,sum1.toFixed(2)+' Bs' )
        doc.setFont(undefined,'bold')
        doc.text(14, y+4.5,'EGRESO TOTAL')
        doc.setFont(undefined,'normal')
        doc.text(19, y+4.5,sum2.toFixed(2)+' Bs' )
          y+=0.5
          let tot= parseFloat(sum1) - parseFloat(sum2)
        doc.setFont(undefined,'bold')
         doc.text(1, y+4.5,' TOTAL ADEUDADO:')
        doc.setFont(undefined,'normal')
          doc.text(9, y+4.5,tot.toFixed(2)+' Bs' )


      window.open(doc.output('bloburl'), '_blank');
    },

    imprimir(){
      this.$axios.post(process.env.API+'/impresion/'+this.datodespacho.id).then(res=>{
        let myWindow = window.open("", "Imprimir", "width=900,height=600");
        myWindow.document.write(res.data);
        myWindow.document.close();
        myWindow.focus();
        setTimeout(function(){
          myWindow.print();
          myWindow.close();
        },500);
      })

    },
        impcliente(){
            this.$axios.post(process.env.API+'/impcliente/'+this.datodespacho.id).then(res=>{
              let myWindow = window.open("", "Imprimir", "width=900,height=600");
              myWindow.document.write(res.data);
              myWindow.document.close();
              myWindow.focus();
              setTimeout(function(){
                myWindow.print();
                myWindow.close();
              },500);
            })

    },
    delcliente(prop){
      this.$q.dialog({
        title: 'Seguro de Eliminar',
        message: 'Se eliminara todo lo relacionado con el Cliente',
        cancel: true,
        persistent: false
      }).onOk(() => {
        // console.log('>>>> OK')
        this.$axios.delete(process.env.API+'/cliente/'+prop.id).then(res=>{
          this.misdatos(process.env.API)

        })

      }).onOk(() => {
        // console.log('>>>> second OK catcher')
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
    },
    deldespacho(prop){
      this.$q.dialog({
        title: 'Seguro de Eliminar',
        message: 'Se eliminara todo lo relacionado con el Despacho',
        cancel: true,
        persistent: false
      }).onOk(() => {
        // console.log('>>>> OK')
        this.$axios.delete(process.env.API+'/despacho/'+prop.id).then(res=>{
          this.dialog_despacho=false
          this.misdatos(process.env.API)

        })

      }).onOk(() => {
        // console.log('>>>> second OK catcher')
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
    },
    listdespacho(prop){
       // console.log(prop)
       this.cliente2=prop
      // // console.log(prop)
      //
      // this.infodespacho=[];

      this.$q.loading.show()
      // this.dialog_despacho=true
        this.infodespacho=[]
      this.$axios.get(process.env.API+'/despacho/'+prop.id).then(res=>{
        // console.log(res.data)
        res.data.forEach(d => {
                      if(d.demandados.length==0)
            d.demandados=[{id:'',ci:'',nombre:''}]
        this.infodespacho.push(d)

          });
       //this.infodespacho=res.data
        this.$q.loading.hide()
        this.dialog_despacho=true
      })
       console.log(this.infodespacho)

    },
    modimagen(){

    },
    crearcliente(){
      this.$q.loading.show()
      var data = new  FormData();
      //Añadimos la imagen seleccionada
      data.append('imagen', this.imagen);
      data.append('ci', this.cliente.ci);
      data.append('nombre', this.cliente.nombre);
      data.append('telefono', this.cliente.telefono);
      data.append('tipo', 'PERSONA');
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
      console.log(val)
      if (val === '') {
        update(() => {
          this.tramite={label:'',requisitos:[]}
          this.tramites = this.tramites2

          // here you have access to "ref" which
          // is the Vue reference of the QSelect
        })
        return
      }

      update(() => {
        const needle = val.toLowerCase()
          this.tramite.requisitos=[]

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
      this.despacho.tipo=this.tramite.tipo
      this.despacho.tramite_id=this.tramite.id
      this.despacho.cliente_id=this.cliente2.id
      // console.log(this.requisitos)
      // return false
      this.despacho.requisitos=this.tramite.requisitos
      this.despacho.demandados=this.demandados
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/despacho',this.despacho).then(res=>{
        console.log(res.data)
        this.misdatos()
        this.$q.loading.hide()
        this.despacho={fecha:date.formatDate(Date.now(),'YYYY-MM-DD'),hora:date.formatDate(Date.now(),'HH:mm')}
        this.resetdespacho()
        this.dialogcliente=false
        this.$q.notify({
          message:'Despacho registrado!!',
          color:'green',
          icon:'done'
        })
        this.listdespacho(this.cliente2)
      }).catch(err=>{
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error'
        })
        this.$q.loading.hide()
      })
    },
        moddespacho(){
      this.$q.loading.show()
      this.$axios.put(process.env.API+'/despacho/'+this.cliente3.id,this.cliente3).then(res=>{
        console.log(res.data)
        this.misdatos()
        this.$q.loading.hide()
        this.dialogdatos=false
        this.$q.notify({
          message:'Despacho registrado!!',
          color:'green',
          icon:'done'
        })
        this.listdespacho(this.cliente2)
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
    modimg(prop){
      this.infocliente=prop
      this.dialog_modimg=true

    },
    onmodimg(){
            this.$q.loading.show()
      var data = new  FormData();
      data.append('imagen', this.imagen);
      data.append('id', this.infocliente.id);

      this.$axios.post(process.env.API+'/clienteimg',data).then(res=>{
        this.$refs.ima.value=''
        this.misdatos()
        this.$q.notify({
          message:"Cambio imagen",
          color:'green',
          icon:'done'
        })
      })
    },
    mod(prop){
      this.cliente=prop;
      this.boolmod=true;
    },
    modcliente(){

      this.boolmod=false;
        this.$axios.put(process.env.API+'/cliente/'+this.cliente.id,this.cliente).then(res=>{
                    this.$q.notify({
            message: 'Modificado',
            caption: 'Registro Modificado',
            color: 'green',
            icon:'done'
          });
          this.cliente={}
        });

    },
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
        this.clientes=[]
        res.data.forEach(r=>{


          if (r.tipo=='PERSONA'){
            this.clientes.push(r)
          }
        })
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
      this.despacho.webid='';
      this.despacho.nurej='';
      this.despacho.proceso='';
      this.despacho.ci='';
      this.despacho.demandante='';
      this.despacho.representate='';
      this.demandados=[{ci:'',nombre:''}];
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
          totalegcl:function (){
      let t=0;
      this.tabegcl.forEach(r=>{
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
