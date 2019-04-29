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
							<td colspan="3" v-text="client.name"></td>
							<th>N° Código:</th>
							<td v-text="client.code"></td>
						</tr>
						<tr>
							<th>Razón Social:</th>
							<td colspan="5" v-text="client.razon_social"></td>
						</tr>
						<tr>
							<th>Email:</th>
							<td colspan="3" v-text="client.email"></td>
							<th>Nickname:</th>
							<td v-text="client.nickname"></td>
						</tr>
						<tr>
							<th>CP:</th>
							<td v-text="client.cp"></td>
							<th>CUIT:</th>
							<td v-text="client.cuit"></td>
							<th>Impuesto:</th>
							<td v-text="client.tax"></td>
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
							<td colspan="5" v-text="client.address"></td>
						</tr>
						<tr>
							<th>Localidad:</th>
							<td colspan="2" v-text="client.locality"></td>
							<th class="text-right">Provincia:</th>
							<td colspan="2"v-text="client.province"></td>
						</tr>
						<tr>
							<th>Teléfono:</th>
							<td v-text="client.phone_number"></td>
							<th>Celular:</th>
							<td v-text="client.cell_number"></td>
							<th>Nextel:</th>
							<td v-text="client.nextel_number"></td>
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
		props:['show','client'],
		methods:{
			closeModal() {
				this.$emit('closeRequest')
            },
		}
	}
</script>
