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
                    <i class="fas fa-user-tag"></i> Usuarios
                    <!-- <i class="fa fa-align-justify"></i> Clientes -->
                    <!-- <button @click="openModal('user','insert')" type="button" class="btn btn-secondary float-right">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button> -->
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-2">
                            <select class="form-control" v-model="queryField">
                              <option value="name">Nombre</option>
                              <option value="username">UserName</option>
                              <option value="email">Email</option>
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
                   
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th width="150">Opciones</th>
                                    <th width="300">Nombre</th>
                                    <th>UserName</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in arrayUsers" :key="item.id">
                                    <td>
                                    <a v-if="item.condition" @click="openModal('user', 'update', item)" href="#" class="btn btn-link text-success" title="Editar"><strong><i class="fas fa-pencil-alt"></i></strong></a>

                                    <a v-else @click="openModal('user', 'update', item)" href="#" class="btn btn-link text-success isDisabled" title="Editar"><strong><i class="fas fa-pencil-alt"></i></strong></a>

                                    <a @click="openModal('user', 'show', item)" href="#" class="btn btn-link text-info" title="Ver"><strong><i class="fas fa-eye"></i></strong></a>

                                    <a v-if="!item.condition" @click="restore(item)" href="#" class="btn btn-link text-warning" title="Restaurar"><strong><i class="fas fa-trash-restore"></i></strong></a>

                                    <a v-else @click="destroy(item)" href="#" class="btn btn-link text-danger" title="Eliminar"><strong><i class="fas fa-trash-alt"></i></strong></a>

                                    </td>
                                    <td v-text="item.name"></td>
                                    <td v-text="item.username"></td>
                                    <td v-text="item.email"></td>
                                    <td v-text="item.rolename"></td>
                                    <td v-text="item.description"></td>
                                    <td>
                                        <div v-if="item.condition">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Inactivo</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-danger" v-show="!arrayUsers.length">
                                    <td colspan="8">
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
        <div class="modal fade mt-5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true" :class="{'show_' : modal}">
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
                            <div class="row">
                               <div class="col-md-6">
                                    <div v-if="personData==1" class="float-left"><strong ><i class="fas fa-address-card">&nbsp;</i></strong> Datos del Usuario</div>
                               </div>
                            </div>
                            <hr>
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal needs-validation" novalidate>
                            <div v-if="personData==1">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-on:keyup="clearErrors('name')" class="form-control" placeholder="Nombres y Apellidos" v-model="name" :class="{ 'is-invalid': errors.name, 'is-valid': name }">
                                        <small class="error-control text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                        <span class="help-block">(*) Ingrese el nombre completo</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">UserName</label>
                                    <div class="col-md-9">
                                        <input type="text" v-on:keyup="clearErrors('username')" class="form-control" placeholder="UserName" v-model="username" :class="{ 'is-invalid': errors.username, 'is-valid': username }">
                                        <small class="error-control text-danger" v-if="errors.username">{{ errors.username[0] }}</small>
                                        <span class="help-block">(*) Ingrese UserName</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-on:keyup="clearErrors('email')" class="form-control" placeholder="Email" v-model="email" :class="{ 'is-invalid': errors.email, 'is-valid': email }">
                                        <small class="error-control text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                        <span class="help-block">(*) Ingrese Email</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="date-input">Role</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="role_id">
                                            <option value="0">Seleccione un Rol</option>
                                            <option v-for="role in arrayRoles" :key="role.id" :value="role.id" v-text="role.name">
                                            </option>
                                        </select>
                                        <span class="help-block">(*) Ingrese Rol</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" v-on:keyup="clearErrors('password')" class="form-control" placeholder="Password" v-model="password" :class="{ 'is-invalid': errors.password, 'is-valid': password }">
                                        <small class="error-control text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                        <span class="help-block">(*) Ingrese Password</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> 

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal()">Cerrar</button>

                        <!-- <button type="button" class="btn btn-primary" v-if="typeAction==1" @click="store()">Guardar</button> -->
                        <button type="button" class="btn btn-primary" @click="update()">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->

        <transition name="fade" mode="out-in">
            <show-user-component :show='modalShow' :data="arrayUser"  @closeRequest='closeModal'></show-user-component>
        </transition>
        <vue-snotify></vue-snotify>
    </main>
</template>

<script>
    export default {
        data () {
            return {
                modal: 0,
                user_id:0,
                role_id: 0,
                state_item:0,
                name: '',
                username: '',
                email:'',
                password: '',
                rolename: '',
                description: '',
                arrayUsers: [],
                arrayUser: [],
                arrayRoles: [],
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
                axios.get('/usuarios?page=' + this.pagination.current_page).then(function (response) {
                    // handle success
                    var result = response.data
                    me.arrayUsers = result.users.data;
                    me.pagination = result.users;
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            searchData() {
                axios.get('api/usuarios/buscar/'+ this.queryField + '/' + this.query)
                    .then(response => {
                        // handle success
                        var result = response.data
                        this.arrayUsers = result.users.data;
                        this.pagination = result.users;
                    }).catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },
            selectRole() {
                axios.get('/roles/select_role')
                    .then(response => {
                        // handle success
                        var result = response.data
                        this.arrayRoles = result.roles;
                    }).catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },
            update() {
                console.log(this.user_id)
                this.errors = {}
                let me = this;
                axios.put(`/usuarios/${this.user_id}`,{
                  'id': this.user_id,  
                  'role_id': this.role_id,  
                  'name': this.name,
                  'username': this.username,
                  'email':  this.email,
                  'password':  this.password,
                }).then(function(response){
                    me.$snotify.success("Usuario Actualizado", "Exitosamente..!");
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
            destroy(user) {
              this.$snotify.clear();
              this.$snotify.confirm(
                "Este registro solo podrá se activado por el Administrador!",
                "Destivar Registro.?",
                {
                  showProgressBar: false,
                  closeOnClick: false,
                  pauseOnHover: true,
                  buttons: [
                    {
                      text: "Si",
                      action: toast => {
                        this.$snotify.remove(toast.id);
                        axios.delete(`/usuarios/${user.id}`).then(response => {
                            this.getData();
                            this.$snotify.success(
                              "Usuario Desactivado","Exitosamente..!");
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
                      bold: true
                    },
                    {
                      text: "No",
                      action: toast => {
                        this.$snotify.remove(toast.id);
                      },
                      bold: true
                    }
                  ]
                }
              );
            },
            restore(user) {
              this.$snotify.clear();
              this.$snotify.confirm(
                "Este registro será activado !",
                "Activar Registro.?",
                {
                  showProgressBar: false,
                  closeOnClick: false,
                  pauseOnHover: true,
                  buttons: [
                    {
                      text: "Si",
                      action: toast => {
                        this.$snotify.remove(toast.id);
                        axios.get(`/usuarios/restaurar/${user.id}`).then(response => {
                            this.getData();
                            this.$snotify.success(
                              "Usuario fue Restaurado","Exitosamente..!");
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
                      bold: true
                    },
                    {
                      text: "No",
                      action: toast => {
                        this.$snotify.remove(toast.id);
                      },
                      bold: true
                    }
                  ]
                }
              );
            },
            clearErrors(error) {

                 if(this.arrayError.length != 0){
                    switch (error) {
                        case "name":
                            this.errors.name = '';
                            break;
                        case "username":
                            this.errors.username = '';
                            break;
                        case "email":
                            this.errors.email = '';
                            break;
                        case "role_id":
                            this.errors.role_id = '';
                            break;
                        case "password":
                            this.errors.password = '';
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
                this.user_id = 0;
                this.role_id = 0;
                this.name = '';
                this.username = '';
                this.email = '';
                this.password = '';
            },
            openModal(model, action, data = []) {
                this.errors = {};
                this.selectRole(); 

                switch (model) {
                    case "user":
                        switch (action) {
                            case "update":
                                console.log(data)
                                this.modal = 1;
                                this.personData = 1;
                                this.typeAction = 2;
                                this.titleModal = 'Actualizar Usuario';
                                this.user_id = data['id'];
                                this.role_id = data['role_id'];
                                this.name = data['name'];
                                this.username = data['username'];
                                this.email = data['email'];
                                this.password = data['password'];
                                break;
                            case "show":
                                this.modalShow = 'show_';
                                this.arrayUser = data;
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

