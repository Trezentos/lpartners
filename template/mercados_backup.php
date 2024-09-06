<section class="mercados-informacoes">
		<div class="wrap">
			<div class="columns is-multiline">
				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left"><?php echo $_lang[$lang]['diretor_comercial']; ?></h4>
					<?php foreach ($qDirComercial as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".$rs->email."<br>":""); ?>
					<?php echo ($rs->telefone?"Telefone: ".$rs->telefone."<br>":""); ?>	
					<?php echo "Telefone: +971 4 432 7366<br>"; ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".$rs->skype."<br>":""); ?>
					<br>
					<?php } ?>

					
					
					<h4 class="has-text-left">SOURCING</h4>
					<?php foreach ($qSourcing as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".$rs->email."<br>":""); ?>
					<?php echo ($rs->telefone?"Telefone: ".$rs->telefone."<br>":""); ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".$rs->skype."<br>":""); ?>
					<br>
					<?php } ?>
				</div>

				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left africa">AFRICA</h4>
					<?php foreach ($qAfrica as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".$rs->email."<br>":""); ?>
					<?php echo ($rs->telefone?"Telefone: ".$rs->telefone."<br>":""); ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".$rs->skype."<br>":""); ?>
					<br>
					<?php } ?>
				</div>

				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left cis">CIS, EUROPE AND RUSSIA</h4>
					<?php foreach ($qCIS as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".$rs->email."<br>":""); ?>
					<?php echo ($rs->telefone?"Telefone: ".$rs->telefone."<br>":""); ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".$rs->skype."<br>":""); ?>
					<br>
					<?php } ?>
				</div>

				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left asia">ASIA</h4>
					<?php foreach ($qAsia as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".$rs->email."<br>":""); ?>
					<?php echo ($rs->telefone?"Telefone: ".$rs->telefone."<br>":""); ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".$rs->skype."<br>":""); ?>
					<br>
					<?php } ?>
				</div>

				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left americas">MERCOSUL</h4>
					<?php foreach ($qMercosul as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".$rs->email."<br>":""); ?>
					<?php echo ($rs->telefone?"Telefone: ".$rs->telefone."<br>":""); ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".$rs->skype."<br>":""); ?>
					<br>
					<?php } ?>
				</div>

				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left middle-east"><?php echo $_lang[$lang]['oriente_medio']; ?></h4>
					<?php foreach ($qOrienteMedio as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".$rs->email."<br>":""); ?>
					<?php echo ($rs->telefone?"Telefone: ".$rs->telefone."<br>":""); ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".$rs->skype."<br>":""); ?>
					<br>
					<?php } ?>
				</div>


				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left americas"><?= $_lang[$lang]['caribe']; ?></h4>
				  <?php foreach ($qCaribe as $rs) { ?>
				 	<strong><?php echo $rs->titulo; ?></strong><br>
				 	<?php echo ($rs->email?"E-mail: ".$rs->email."<br>":""); ?>
				 	<?php echo ($rs->telefone?"Telefone: ".$rs->telefone."<br>":""); ?>
				 	<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
				 	<?php echo ($rs->skype?"Skype: ".$rs->skype."<br>":""); ?>
				 	<br>
				 	<?php } ?>
				 </div>

			</div>
		</div>
	</section>