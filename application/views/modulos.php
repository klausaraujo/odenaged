<style>
.hummingbird-treeview i {font-size:0.8em;margin-right:5px}
</style>
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
	<?php endforeach; ?>
	<!--<div class="col-sm-12">
		<div id="treeview_container" class="hummingbird-treeview" style="height: 230px; overflow-y: scroll;">
			<ul id="treeview" class="hummingbird-base">
				<li data-id="0"><i class="fa fa-plus"></i><label><input id="xnode-0" data-id="custom-0" type="checkbox" /> node-0</label>
					<ul>
						<li data-id="1"><i class="fa fa-plus"></i><label><input  id="xnode-0-1" data-id="custom-0-1" type="checkbox" /> node-0-1</label>
							<ul>
								<li><label><input class="hummingbird-end-node" id="xnode-0-1-1" data-id="custom-0-1-1" type="checkbox" /> node-0-1-1</label></li>
								<li data-id="2"><i class="fa fa-plus"></i><label><input  id="xnode-0-1-2" data-id="custom-0-1-2" type="checkbox" /> node-0-1-2</label>
									<ul>
										<li><label><input class="hummingbird-end-node" id="xnode-0-1-2-1" data-id="custom-0-1-2-1" type="checkbox" /> node-0-1-2-1</label></li>
										<li><label><input class="hummingbird-end-node" id="xnode-0-1-2-2" data-id="custom-0-1-2-2" type="checkbox" /> node-0-1-2-2</label></li>
									</ul>
								</li>
								<li><label><input class="hummingbird-end-node" id="xnode-0-1-2" data-id="custom-0-1-3" type="checkbox" /> node-0-1-3</label></li>
							</ul>
						</li>
						<li data-id="1"><i class="fa fa-plus"></i><label><input  id="xnode-0-2" data-id="custom-0-2" type="checkbox" /> node-0-2 </label>
							<ul>
								<li><label><input class="hummingbird-end-node" id="xnode-0-2-1" data-id="custom-0-2-1" type="checkbox" /> node-0-2-1</label></li>
								<li><label><input class="hummingbird-end-node" id="xnode-0-2-2" data-id="custom-0-2-2" type="checkbox" /> node-0-2-2</label></li>
							</ul>
						</li>
					</ul>
			  </li>
			</ul>
		</div>
	</div>-->