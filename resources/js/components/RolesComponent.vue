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
                    <i class="fas fa-user-tag"></i> Roles
                    <!-- <i class="fa fa-align-justify"></i> Clientes -->
                    <button @click="openModal('client','insert')" type="button" class="btn btn-secondary float-right">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-2">
                            <select class="form-control" v-model="queryField">
                              <option value="name">Nombre</option>
                              <option value="description">Description</option>
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
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in arrayRoles" :key="item.id">
                                    <td v-text="item.name"></td>
                                    <td v-text="item.description"></td>
                                    <td>
                                        <div v-if="item.condition">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-danger" v-show="!arrayRoles.length">
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
    </main>
</template>

<script>
    export default {
        data () {
            return {
                modal: 0,
                rol_id: 0,
                name: '',
                descriptio: '',
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
                axios.get('/roles?page=' + this.pagination.current_page).then(function (response) {
                    // handle success
                    var result = response.data
                    me.arrayRoles = result.roles.data;
                    me.pagination = result.roles;
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            searchData() {
                axios.get('api/roles/buscar/'+ this.queryField + '/' + this.query)
                    .then(response => {
                        // handle success
                        var result = response.data
                        console.log(result)
                        this.arrayRoles = result.roles.data;
                        this.pagination = result.roles;
                    }).catch(function (error) {
                        // handle error
                        console.log(error);
                    })
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
