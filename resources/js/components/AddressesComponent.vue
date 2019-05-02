<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-map-marked"></i> Direcciones
                    <!-- <i class="fa fa-align-justify"></i> Direcciones -->
                    <!-- <button @click="openModal('client','insert')" type="button" class="btn btn-secondary float-right">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button> -->
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-2">
                            <select class="form-control" v-model="queryField">
                              <option value="name">Nombre</option>
                              <option value="code">Código</option>
                            </select>
                        </div>
                  
                        <div class="input-group col-md-6">
                            <input class="form-control" v-model="query" type="text" placeholder="Buscar...">
                            <span class="input-group-append">
                              <button class="btn btn-primary" type="button" disabled>
                                <i class="fa fa-search"></i> Buscar
                              </button>
                            </span>
                        </div>
                    </div>
                   
                    <div id="div1" class="table-responsive-sm">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th width="150">Opciones</th>
                                    <th>Código</th>
                                    <th>Nombre y Apellido</th>
                                    <th width="500">Dirección</th>
                                    <th>Localidad</th>
                                    <th>Provincia</th>
                                    <th>Teléfono</th>
                                    <th>Celular</th>
                                    <th>Nextel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in arrayAddresses" :key="item.id">
                                    <td>
                                    <a @click="openModal('address', 'update', item)" href="#" class="btn btn-link text-success" title="Editar"><strong><i class="fas fa-pencil-alt"></i></strong></a>

                                    <a @click="openModal('address', 'show', item)" href="#" class="btn btn-link text-info" title="Ver"><strong><i class="fas fa-eye"></i></strong></a>

                                    <!-- <a v-if="item.deleted_at" @click="restore(item)" href="#" class="btn btn-link text-warning" title="Restaurar"><strong><i class="fas fa-trash-restore"></i></strong></a> -->
                                    <a @click="destroy(item)" href="#" class="btn btn-link text-danger isDisabled" title="Eliminar"><strong><i class="fas fa-trash-alt"></i></strong></a>
<!-- 
                                    <button @click="openModal('client', 'update', client)" type="button" class="col-3 btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp; -->
                                    <!--<button @click="openModal('client', 'show', client)" type="button" class="col-3 btn btn-info btn-sm">
                                      <i class="icon-eye"></i>
                                    </button> &nbsp;
                                    <button @click="destroy(client)" type="button" class="col-3 btn btn-danger btn-sm">
                                      <i class="icon-trash"></i>
                                    </button> -->
                                    </td>
                                    <td v-text="item.code"></td>
                                    <td v-text="item.name"></td>
                                    <td v-text="item.address"></td>
                                    <td v-text="item.locality"></td>
                                    <td v-text="item.province"></td>
                                    <td v-text="item.phone_number"></td>
                                    <td v-text="item.cell_number"></td>
                                    <td v-text="item.nextel_number"></td>
                                    <!-- <td>
                                        <div v-if="!item.deleted_at">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                    </td> -->
                                </tr>
                                <tr class="table-danger" v-show="!arrayAddresses.length">
                                    <td colspan="9">
                                       Lo sentimos no se encuentra la información de este Cliente :(  ! 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- PaginationComponent -->
                    <pagination-component
                        v-if="pagination.last_page > 1"
                        :pagination="pagination"
                        :offset="offset"
                        @paginate="query === '' ? getData() : searchData()"
                    ></pagination-component>
                    <!-- End PaginationComponent -->
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true" :class="{'show_' : modal}">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 v-show="typeAction == 1" class="modal-title float-left">
                            <i class="fas fa-user-tag">&nbsp;</i>{{ titleModal }}
                        </h4>
                        <h4 v-show="typeAction == 2" class="modal-title float-left">
                            <i class="fas fa-user-edit">&nbsp;</i>{{ titleModal }}
                        </h4>
                        <button type="button" class="close" aria-label="Close" @click="closeModal()">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="row">
                               <div class="col-md-6">
                                    <!-- <div v-if="personData==1" class="float-left"><strong ><i class="fas fa-address-card">&nbsp;</i></strong> Datos Personales</div> -->
                                   <div class="float-left"><strong ><i class="fas fa-map-marked-alt">&nbsp;</i></strong> Dirección del Cliente: 
                                   <strong v-text="name"></strong>
                                   </div>
                               </div>
                                <!-- <div class="col-md-6">
                                    <button v-if="personData==0" @click="personData=1" class="btn btn-primary btn-sm float-right">Datos Personales</button>
                                    <button v-if="personData==1" @click="personData=0" class="btn btn-success btn-sm float-right"><i class="icon-plus"></i>&nbsp; Dirección</button>
                                </div> -->
                            </div>
                            <hr>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal needs-validation" novalidate>
                            <div v-if="personData==1">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Código</label>
                                    <div class="col-md-9">
                                      <input type="text" class="form-control" v-model="code" readonly="">
                                      <!-- <p class="form-control-static" v-model="code" v-text=""></p> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Nombres y Apellidos" v-model="name" readonly>
                                    </div>
                                </div>

                                <!-- <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Razón Social</label>
                                    <div class="col-md-9">
                                        <input type="text" v-on:keyup="clearErrors('razon_social')" id="nombre" name="nombre" class="form-control" placeholder="Razón Social" v-model="razon_social" :class="{ 'is-invalid': errors.razon_social, 'is-valid': razon_social }">
                                        <small class="error-control text-danger" v-if="errors.razon_social">{{ errors.razon_social[0] }}</small>
                                        <span class="help-block">(*) Ingrese Razón Social</span>
                                    </div>
                                </div> -->
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="textarea-input">Dirección</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="textarea-input" name="textarea-input" rows="3" placeholder="Dirección.." v-model="address"></textarea>
                                        <small class="error-control text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                        <span class="help-block">(*) Ingrese Dirección</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label">Localidad</label>
                                    <div class="col-md-9">
                                        <input type="text" v-on:keyup="clearErrors('locality')" class="form-control" placeholder="Localidad" v-model="locality" :class="{ 'is-invalid': errors.locality, 'is-valid': locality }">
                                        <small class="error-control text-danger" v-if="errors.email">{{ errors.locality[0] }}</small>
                                        <span class="help-block">(*) Ingrese Localidad</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label">Provincia</label>
                                    <div class="col-md-9">
                                        <input type="text" v-on:keyup="clearErrors('province')" id="nickname" name="nickname" class="form-control" placeholder="Provincia" v-model="province" :class="{ 'is-invalid': errors.province, 'is-valid': province }">
                                        <small class="error-control text-danger" v-if="errors.province">{{ errors.province[0] }}</small>
                                        <span class="help-block">(*) Ingrese Provincia</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label">Teléfono</label>
                                    <div class="col-md-9">
                                        <input v-on:keyup="clearErrors('phone_number')" class="form-control" type="text" placeholder="Teléfono" v-model="phone_number" :class="{ 'is-invalid': errors.phone_number, 'is-valid': phone_number }">
                                        <small class="error-control text-danger" v-if="errors.phone_number">{{ errors.phone_number[0] }}</small>      
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label">Nextel</label>
                                    <div class="col-md-9">
                                        <input v-on:keyup="clearErrors('nextel_number')" class="form-control" type="text" placeholder="Nextel" v-model="nextel_number" :class="{ 'is-invalid': errors.nextel_number, 'is-valid': nextel_number }">
                                        <small class="error-control text-danger" v-if="errors.nextel_number">{{ errors.nextel_number[0] }}</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label">Celular</label>
                                    <div class="col-sm-9">
                                      <input v-on:keyup="clearErrors('cell_number')" class="form-control" type="text" placeholder="Celular" v-model="cell_number" :class="{ 'is-invalid': errors.cell_number, 'is-valid': cell_number }">
                                      <small class="error-control text-danger" v-if="errors.cell_number">{{ errors.cell_number[0] }}</small>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> 

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal()">Cerrar</button>

                        <button type="button" class="btn btn-primary" v-if="typeAction==1" @click="store()">Guardar</button>
                        <button type="button" class="btn btn-primary" v-if="typeAction==2" @click="update()">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->

        <transition name="fade" mode="out-in">
            <show-component :show='modalShow' :data="arrayAddress"  @closeRequest='closeModal'></show-component>
        </transition>
        <vue-snotify></vue-snotify>
    </main>
</template>

<script>
    export default {
        data () {
            return {
                client_id: 0,
                code: '',
                name: '',
                razon_social: '',
                nickname: '',
                email: '',
                birth_date: '',
                reference: '',
                cp: '',
                cuit: '',
                tax: '',
                address: '',
                locality: '',
                province: '',
                phone_number: '',
                nextel_number: '',
                cell_number: '',
                arrayAddresses: [],
                arrayAddress: [],
                modal: 0,
                modalShow: '',
                titleModal: '',
                typeAction: 0,
                personData: 0,
                errors: [],
                arrayError: [],
                pagination: {
                    current_page: 1
                },
                offset: 3,
                query: '',
                queryField: 'name' 

            }
        },
        watch: {
                query: function(newQ, old) {
                  if (newQ === "") {
                    this.getData();
                  } else {
                    this.searchData();
                }
            }
        },
        methods: {
            getData() {
                let me = this;
                axios.get('/direccion?page=' + this.pagination.current_page).then(function (response) {
                    // handle success
                    var result = response.data
                    me.arrayAddresses = result.addresses.data;
                    me.pagination = result.addresses;
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            searchData() {
                axios.get('api/direcciones/buscar/'+ this.queryField + '/' + this.query)
                    .then(response => {
                        // handle success
                        var result = response.data
                        console.log(result)
                        this.arrayAddresses = result.addresses.data;
                        this.pagination = result.addresses;
                    }).catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },
            // store() {
            //     this.errors = {}
            //     let me = this;

            //     axios.post('/Addresses',{
            //       'code': this.code,  
            //       'name': this.name,
            //       'razon_social': this.razon_social,
            //       'nickname': this.nickname,
            //       'email':  this.email,
            //       'birth_date': this.birth_date,
            //       'reference': this.reference,
            //       'cp': this.cp,
            //       'cuit': this.cuit,
            //       'tax': this.tax,
            //       'address': this.address,
            //       'locality': this.locality,
            //       'province': this.province,
            //       'phone_number': this.phone_number,
            //       'nextel_number': this.nextel_number,
            //       'cell_number': this.cell_number
            //     }).then(function(response){
            //         me.$snotify.success("Cliente Registrado", "Exitosamente..!");
            //         me.closeModal();
            //         me.getData();
            //     }).catch(function(error) {
            //         if(error.response.status === 422) {
            //             me.errors = error.response.data.errors
            //             me.arrayError = me.errors
            //             console.log(me.errors)
            //         }
            //         me.$snotify.error(
            //           "Se presento un error vuelva a intentarlo.",
            //           "Error"
            //         );
            //     });

            // },
            update() {
                this.errors = {}
                let me = this;

                axios.put(`/direccion/${this.client_id}`,{
                  'id': this.client_id,  
                  'code': this.code,  
                  'name': this.name,
                  'razon_social': this.razon_social,
                  'nickname': this.nickname,
                  'email':  this.email,
                  'birth_date': this.birth_date,
                  'reference': this.reference,
                  'cp': this.cp,
                  'cuit': this.cuit,
                  'tax': this.tax,
                  'address': this.address,
                  'locality': this.locality,
                  'province': this.province,
                  'phone_number': this.phone_number,
                  'nextel_number': this.nextel_number,
                  'cell_number': this.cell_number
                }).then(function(response){
                    me.$snotify.success("Dirección Actualizada", "Exitosamente..!");
                    me.closeModal();
                    me.getData();
                }).catch(function(error) {
                    if(error.response.status === 422) {
                        me.errors = error.response.data.errors
                        me.arrayError = me.errors
                        console.log(me.errors)
                    }
                    me.$snotify.error(
                      "Se presento un error vuelva a intentarlo.",
                      "Error"
                    );
                });

            },
            clearErrors(error) {

                 if(this.arrayError.length != 0){
                    switch (error) {
                        case "name":
                            this.errors.name = '';
                            break;
                        case "razon_social":
                            this.errors.razon_social = '';
                            break;
                        case "nickname":
                            this.errors.nickname = '';
                            break;
                        case "birth_date":
                            this.errors.birth_date = '';
                            break;    
                        case "email":
                            this.errors.email = '';
                            break;
                        case "cp":
                            this.errors.cp = '';
                            break;    
                        case "cuit":
                            this.errors.cuit = '';
                            break;
                        case "tax":
                            this.errors.tax = '';
                            break;
                        default:
                            // statements_def
                            break;
                    }

                 }

            },
            closeModal() {
                this.personData = 0;
                this.modalShow = '';
                this.modal = 0;
                this.titleModal = '';
                this.typeAction = 0;
                this.code = '';
                this.name = '';
                this.razon_social = '';
                this.nickname = '';
                this.email = '';
                this.birth_date = '';
                this.reference = '';
                this.birth_date = '';
                this.cp = '';
                this.cuit = '';
                this.tax ='';
                this.address ='';
                this.locality ='';
                this.province ='';
                this.phone_number ='';
                this.nextel_number ='';
                this.cell_number ='';
            },
            openModal(model, action, data = []) {
                this.errors = {};
                switch (model) {
                    case "address":
                        switch (action) {
                            case "insert":
                            let me = this;
                                axios.get('/direccion/create').then(function (response) {
                                    // handle success
                                    me.code = response.data.code;
                                    console.log(me.code)

                                  })
                                  .catch(function (error) {
                                    // handle error
                                    console.log(error);
                                })
                                this.modal = 1;
                                this.personData = 1;
                                this.typeAction = 1;
                                this.titleModal = 'Nuevo Dirección'
                                this.name = '';
                                this.razon_social = '';
                                this.nickname = '';
                                this.email = '';
                                this.birth_date = '';
                                this.reference = '';
                                this.cp = '';
                                this.cuit = '';
                                this.tax ='';
                                this.address ='';
                                this.locality ='';
                                this.province ='';
                                this.phone_number ='';
                                this.nextel_number ='';
                                this.cell_number ='';
                                break;
                            case "update":
                                // console.log(data)
                                this.modal = 1;
                                this.personData = 1;
                                this.typeAction = 2;
                                this.titleModal = 'Actualizar Dirección';
                                this.client_id = data['id'];
                                this.code = data['code'];
                                this.name = data['name'];
                                this.razon_social = data['razon_social'];
                                this.nickname = data['nickname'];
                                this.email = data['email'];
                                this.birth_date = data['birth_date'];
                                this.reference = data['reference'];
                                this.cp = data['cp'];
                                this.cuit = data['cuit'];
                                this.tax = data['tax'];
                                this.address = data['address'];
                                this.locality = data['locality'];
                                this.province = data['province'];
                                this.phone_number = data['phone_number'];
                                this.nextel_number = data['nextel_number'];
                                this.cell_number = data['cell_number'];
                                break;
                            case "show":
                                this.modalShow = 'show_';
                                this.arrayAddress = data;
                                break;
                        }

                    break;

                }
            }        
        },
        mounted() {
            this.getData()
            console.log('Component mounted.')
        }
    }
</script>

<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .show_{
        display: list-item !important;
        opacity:  1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
        transition: all 500ms !important;
    } 
    .isDisabled {
        color: currentColor;
        cursor: not-allowed;
        opacity: 0.5;
        text-decoration: none;
    }   
</style> 
