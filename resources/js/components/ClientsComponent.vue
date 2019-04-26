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
                    <i class="fa fa-align-justify"></i> Clientes
                    <button @click="openModal('client','insert')" type="button" class="btn btn-secondary float-right">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-8">
                          <div class="input-group">
                                <select class="form-control col-md-3" id="opcion" name="opcion">
                                  <option value="nombre">Nombre</option>
                                  <option value="descripcion">Descripción</option>
                                </select>
                      
                            <input class="form-control" id="input3-group2" type="text" name="input3-group2" placeholder="Search">
                            <span class="input-group-append">
                              <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i> Buscar
                              </button>
                            </span>
                          </div>
                        </div>
                        <!-- <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button> -->
                    </div>
                   
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="300">Opciones</th>
                                    <th>Código</th>
                                    <th width="400">Nombre</th>
                                    <th width="300">Razópn Social</th>
                                    <th>Nickname</th>
                                    <th>Email</th>
                                    <th width="200">Fecha Nac</th>
                                    <th width="500">Referencia</th>
                                    <th>CP</th>
                                    <th>CUIT</th>
                                    <th>Imp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="client in arrayClients" :key="client.id">
                                    <td>
                                    <button @click="openModal('client', 'update', client)" type="button" class="col-3 btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" class="col-3 btn btn-info btn-sm">
                                      <i class="icon-eye"></i>
                                    </button> &nbsp;
                                    <button type="button" class="col-3 btn btn-danger btn-sm">
                                      <i class="icon-trash"></i>
                                    </button>
                                    </td>
                                    <td v-text="client.code"></td>
                                    <td v-text="client.name"></td>
                                    <td v-text="client.razon_social"></td>
                                    <td v-text="client.nickname"></td>
                                    <td v-text="client.email"></td>
                                    <td v-text="client.birth_date"></td>
                                    <td v-text="client.reference"></td>
                                    <td v-text="client.cp"></td>
                                    <td v-text="client.cuit"></td>
                                    <td v-text="client.tax"></td>
                                    <!-- <td>
                                        <span class="badge badge-success">Activo</span>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#">Ant</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true" :class="{'show' : modal}">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title float-left" v-text="titleModal"></h4>
                        <button type="button" class="close" aria-label="Close" @click="closeModal()">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="row">
                               <div class="col-md-6">
                                    <div v-if="personData==1" class="float-left"><strong ><i class="fas fa-address-card">&nbsp;</i></strong> Datos Personales</div>
                                   <div v-if="personData==0" class="float-left"><strong ><i class="fas fa-map-marked-alt">&nbsp;</i></strong> Dirección</div>
                               </div>
                                <div class="col-md-6">
                                    <button v-if="personData==0" @click="personData=1" class="btn btn-primary btn-sm float-right">Datos Personales</button>
                                    <button v-if="personData==1" @click="personData=0" class="btn btn-success btn-sm float-right">Agregar Dirección</button>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal needs-validation" novalidate>
                            <div v-if="personData==1">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Código</label>
                                    <div class="col-md-9">
                                      <input type="text" class="form-control text-white" v-model="code" readonly="">
                                      <!-- <p class="form-control-static" v-model="code" v-text=""></p> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-on:keyup="clearErrors('name')" id="nombre" name="nombre" class="form-control" placeholder="Nombres y Apellidos" v-model="name" :class="{ 'is-invalid': errors.name, 'is-valid': name }">
                                        <small class="error-control text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                        <span class="help-block">(*) Ingrese el nombre completo</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Razón Social</label>
                                    <div class="col-md-9">
                                        <input type="text" v-on:keyup="clearErrors('razon_social')" id="nombre" name="nombre" class="form-control" placeholder="Razón Social" v-model="razon_social" :class="{ 'is-invalid': errors.razon_social, 'is-valid': razon_social }">
                                        <small class="error-control text-danger" v-if="errors.razon_social">{{ errors.razon_social[0] }}</small>
                                        <span class="help-block">(*) Ingrese Razón Social</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Email y Nickname</label>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input type="email" v-on:keyup="clearErrors('email')" id="email" name="email" class="form-control" placeholder="Email" v-model="email" :class="{ 'is-invalid': errors.email, 'is-valid': email }">
                                                <small class="error-control text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                                <span class="help-block">(*) Ingrese Email</span>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" v-on:keyup="clearErrors('nickname')" id="nickname" name="nickname" class="form-control" placeholder="Nickname" v-model="nickname" :class="{ 'is-invalid': errors.nickname, 'is-valid': nickname }">
                                                <small class="error-control text-danger" v-if="errors.nickname">{{ errors.nickname[0] }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="date-input">Fecha de Nac.</label>
                                    <div class="col-md-9">
                                        <input class="form-control" v-on:keyup="clearErrors('birth_date')" v-on:click="clearErrors('birth_date')" id="date-input" type="date" name="date-input" placeholder="date" v-model="birth_date" :class="{ 'is-invalid': errors.birth_date, 'is-valid': birth_date }">
                                        <small class="error-control text-danger" v-if="errors.birth_date">{{ errors.birth_date[0] }}</small>
                                        <span class="help-block">Por favor colocar fecha valida</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="textarea-input">Referencia</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="textarea-input" name="textarea-input" rows="2" placeholder="Referencia.." v-model="reference"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input ">CP / CUIT / IMP.</label>
                                    <div class="form-group col-sm-3">
                                        <input v-on:keyup="clearErrors('cp')" class="form-control" id="cvv" type="text" placeholder="CP" v-model="cp" :class="{ 'is-invalid': errors.cp, 'is-valid': cp }">
                                        <small class="error-control text-danger" v-if="errors.cp">{{ errors.cp[0] }}</small>      
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <input v-on:keyup="clearErrors('cuit')" class="form-control" id="cuit" type="text" placeholder="cuit" v-model="cuit" :class="{ 'is-invalid': errors.cuit, 'is-valid': cuit }">
                                        <small class="error-control text-danger" v-if="errors.cuit">{{ errors.cuit[0] }}</small>
                                    </div>
                                    <div class="form-group col-sm-3">
                                      <input v-on:keyup="clearErrors('tax')" class="form-control" id="tax" type="number" placeholder="0.00" v-model="tax" :class="{ 'is-invalid': errors.tax, 'is-valid': tax }">
                                      <small class="error-control text-danger" v-if="errors.tax">{{ errors.tax[0] }}</small>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <h2>Dirección</h2>
                            </div>
                        </form>
                    </div> 

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal()">Cerrar</button>

                        <button type="button" class="btn btn-primary" v-if="typeAction==1" @click="newClient()">Guardar</button>
                        <button type="button" class="btn btn-primary" v-if="typeAction==2">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
        <!-- Inicio del modal Eliminar -->
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-danger" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar Categoría</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Estas seguro de eliminar la categoría?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- Fin del modal Eliminar -->
        <vue-snotify></vue-snotify>
    </main>
</template>

<script>
    export default {
        data () {
            return {
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
                arrayClients: [],
                modal: 0,
                titleModal: '',
                typeAction: 0,
                personData: 0,
                errors: [],
                arrayError: []
            }
        },
        methods: {
            getClients() {
                let me = this;
                axios.get('/clientes').then(function (response) {
                    // handle success
                    me.arrayClients = response.data;
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            newClient() {
                this.errors = {}
                
                let me = this;

                axios.post('/clientes',{
                  'code': this.code,  
                  'name': this.name,
                  'razon_social': this.razon_social,
                  'nickname': this.nickname,
                  'email':  this.email,
                  'birth_date': this.birth_date,
                  'reference': this.reference,
                  'cp': this.cp,
                  'cuit': this.cuit,
                  'tax': this.tax
                }).then(function(response){
                    me.$snotify.success("Cliente Registrado", "Exitosamente..!");
                    me.closeModal();
                    me.getClients();
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
            },
            openModal(model, action, data = []) {
                switch (model) {
                    case "client":
                        switch (action) {
                            case "insert":
                            let me = this;
                                axios.get('/clientes/create').then(function (response) {
                                    // handle success
                                    me.code = response.data.code;
                                    console.log(me.code)

                                  })
                                  .catch(function (error) {
                                    // handle error
                                    console.log(error);
                                })

                                this.errors = {};
                                this.personData = 1;
                                this.typeAction = 1;
                                this.modal = 1;
                                this.name = '';
                                this.razon_social = '';
                                this.nickname = '';
                                this.email = '';
                                this.birth_date = '';
                                this.reference = '';
                                this.cp = '';
                                this.cuit = '';
                                this.tax ='';
                                this.titleModal = 'Nuevo Cliente'
                                break;
                            case "update":
                                // statements_def
                                break;
                        }

                    break;

                }
            }        
        },
        mounted() {
            this.getClients()
            console.log('Component mounted.')
        }
    }
</script>

<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .show{
        display: list-item !important;
        opacity:  1 !important;
        position: absolute !important;
        background-color: #3c29297a !important; 
    }
    .invalid-feedback {
        display: none;
        margin-top: .25rem;
        font-size: .875rem;
        color: #f86c6b; 
    }
</style> 
