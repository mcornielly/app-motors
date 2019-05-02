<template>
	<div>
		<div class="modal fade" :class="show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-primary modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        	
            <h4 class="modal-title">
            	<i class="fas fa-user-check">&nbsp;</i> Usuario 
            </h4>           
            <button type="button" class="close" aria-label="Close" @click="closeModal()">
              <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
		    <div class="row">
              <div class="col-md-12">
                <div class="card card-accent-primary">
                  <div class="card-header">
        			<h6 class="float-left text-gray"><i class="fas fa-address-card">&nbsp;</i> Datos del Usuario</h6>
                  </div>
                  <div class="card-body">
					<table class="table table-sm">
						<tr>
							<th>Nombre:</th>
							<td v-text="data.name"></td>
						</tr>
						<tr>
							<th>Email:</th>
							<td v-text="data.email"></td>
						</tr>
						<tr>
							<th>UserName:</th>
							<td v-text="data.username"></td>
						</tr>
						<tr>
							<th>Rol:</th>
							<td v-text="data.rolename"></td>
						</tr>
						<tr>
							<th>Estatus:</th>
							<td>
		  			            <div v-if="data.condition">
		                            <span class="badge badge-success">Activo</span>
		                        </div>
		                        <div v-else>
		                            <span class="badge badge-danger">Inactivo</span>
		                        </div>
							</td>
						</tr>
					</table>	
                  </div>
                </div>
              </div>
            </div>
       	</div> 
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">Cerrar</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
	</div>
	</div>
</template>

<script>
	export default{
		props:['show','data'],
		methods:{
			closeModal() {
				this.$emit('closeRequest')
            },
		}
	}
</script>
