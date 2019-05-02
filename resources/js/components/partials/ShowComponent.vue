<template>
	<div>
		<div class="modal fade" :class="show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-primary modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        	
            <h4 class="modal-title">
            	<i class="far fa-address-card">&nbsp;</i>Detalle del Cliente 
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
        			<h6 class="float-left text-gray"><i class="fas fa-address-card">&nbsp;</i> Datos Personales</h6>
                  </div>
                  <div class="card-body">
					<table class="table table-sm">
						<tr>
							<th>Nombre:</th>
							<td colspan="3" v-text="data.name"></td>
							<th>N° Código:</th>
							<td v-text="data.code"></td>
						</tr>
						<tr>
							<th>Razón Social:</th>
							<td colspan="5" v-text="data.razon_social"></td>
						</tr>
						<tr>
							<th>Email:</th>
							<td colspan="3" v-text="data.email"></td>
							<th>Nickname:</th>
							<td v-text="data.nickname"></td>
						</tr>
						<tr>
							<th>CP:</th>
							<td v-text="data.cp"></td>
							<th>CUIT:</th>
							<td v-text="data.cuit"></td>
							<th>Impuesto:</th>
							<td v-text="data.tax"></td>
						</tr>
					</table>	
                  </div>
                </div>
              </div>
              	</div>
		
              	<div class="row">
              <div class="col-md-12">
                <div class="card card-accent-success">
                  <div class="card-header">
        			<h6 class="float-left text-gray"><i class="fas fa-map-marked-alt">&nbsp;</i> Dirección</h6>
                  </div>
                  <div class="card-body">
					<table class="table table-sm">
						<tr>
							<th>Dirección:</th>
							<td colspan="5" v-text="data.address"></td>
						</tr>
						<tr>
							<th>Localidad:</th>
							<td colspan="2" v-text="data.locality"></td>
							<th class="text-right">Provincia:</th>
							<td colspan="2"v-text="data.province"></td>
						</tr>
						<tr>
							<th>Teléfono:</th>
							<td v-text="data.phone_number"></td>
							<th>Celular:</th>
							<td v-text="data.cell_number"></td>
							<th>Nextel:</th>
							<td v-text="data.nextel_number"></td>
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
