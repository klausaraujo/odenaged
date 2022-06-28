<div>
	<footer class="bg-white iq-footer">
	   <div class="container-fluid">
	      <div class="row">
	         <div class="col-lg-6">
	            <ul class="list-inline mb-0">
	               <li class="list-inline-item"><a href="#" target="_blank">Politicas de Privacidad</a></li>
	               <li class="list-inline-item"><a href="#" target="_blank">Términos de Uso</a></li>
	            </ul>
	         </div>
	         <div class="col-lg-6 text-right">
	            Copyright © 2021 <a href="#" target="_blank"> Caja De Protección Y Asistencia Social Ley 10674 </a> Todos los derechos reservados.
	         </div>
	      </div>
	   </div>
	</footer>
</div>
<div class="modal fade" id="decisionModal" tabindex="-1" role="dialog" aria-labelledby="decisionModalLabel"
	style="margin-top: -15px; z-index: 2600;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirmaci&oacute;n</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?if(!$this->uri->segment(1)=="")
					echo $formNew;
				?>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success" id="btnNuevo">Nuevo</button>
				<button type="submit" class="btn btn-primary" id="btnEnviar">Guardar registro</button>
				<button class="btn btn-primary" id="btnCancelar" name="btnCancelar" role="button" data-dismiss="modal" aria-pressed="true">Cancelar</button>
			</div>
			<div class="col-md-12 text-center cargando"></div>
		</div>
	</div>
</div>
