		<div class="col-sm-12 "><br>                    
			<div class="iq-card">
				<div class="iq-card-header d-flex justify-content-between">
				   <div class="iq-header-title card-body ">
				<h3 style="font-size:22px;" class="text-center">
				   <b>SISTEMA INTEGRADO DE REGISTRO DE EVENTOS DEL SECTOR EDUCACIÓN - SIRESE</b>
				</h3>
					</div>
				</div>
			</div>
		</div>
	<?php
		$listaModulos = $this->session->userdata("modulos");
		foreach($listaModulos as $row): ?>
		<div class="col-sm-6 col-md-3 dashboard__card">
			<a <?=($row->activo === '1')? 'href="'.base_url().$row->url.'"' : '';?> class="card_button">
				<div class="iq-card">
				<div class="iq-card-body-elements">
					<div style="margin-top: 15px;" class="doc-profile">
						<img class="img-fluid avatar-80" src="<?=base_url()?>public/template/images/principal/<?=$row->icono?>" alt="<?=$row->url?>">
					</div>
					<div class="dashboard__title">
						<h6 style="color: <?=($row->activo === '1')? 'white' : '#AAAAAA';?>;"> <?=$row->descripcion?></h6>
					</div>
				</div>
				</div>
			</a>
		</div>
	<?php 
		endforeach;
		