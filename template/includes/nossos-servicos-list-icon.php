	<h2 style="text-transform: uppercase;"><?php echo $_lang[$lang]['menu_servicos']; ?></h2>
	<div class="list-servicos">
		<a href="<?php echo HTTP; ?>representacao-exclusiva/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['menu_assessoria']; ?>">
			<div class="card-icon <?php echo ($permalink=="representacao-exclusiva"?"active":""); ?>">
				<img src="<?php echo HTTP; ?>img/icon-mao.png">
			</div>
		</a>
		<a href="<?php echo HTTP; ?>suporte-logistico-e-documental/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['menu_asssitencia_logistica']; ?>">
			<div class="card-icon <?php echo ($permalink=="suporte-logistico-e-documental"?"active":""); ?>">
				<img src="<?php echo HTTP; ?>img/icon-documental.png">
			</div>
		</a>
		<a href="<?php echo HTTP; ?>desenvolvimento-de-marcas/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['menu_estruturacao_frigorificos']; ?>">
			<div class="card-icon <?php echo ($permalink=="desenvolvimento-de-marcas"?"active":""); ?>">
				<img src="<?php echo HTTP; ?>img/icon-empreendedorismo.png">
			</div>
		</a>
		<a href="<?php echo HTTP; ?>inteligencia-de-mercado/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['menu_pesquisa_mercadologica']; ?>">
			<div class="card-icon <?php echo ($permalink=="inteligencia-de-mercado"?"active":""); ?>">
				<img src="<?php echo HTTP; ?>img/icon-inteligencia-mercado.png">
			</div>
		</a>
		<a href="<?php echo HTTP; ?>mercado-internacional/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['menu_mercado_internacional']; ?>">
			<div class="card-icon <?php echo ($permalink=="mercado-internacional"?"active":""); ?>">
				<img src="<?php echo HTTP; ?>img/icon-mercado-internacional.png">
			</div>
		</a>
		<a href="<?php echo HTTP; ?>trading/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['menu_diagnostico_comercializacao']; ?>">
			<div class="card-icon <?php echo ($permalink=="trading"?"active":""); ?>">
				<img src="<?php echo HTTP; ?>img/icon-globo.png">
			</div>
		</a>
	</div>