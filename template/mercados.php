<?php

$qDirComercial = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%1%' AND status=1");
$qSourcing     = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%2%' AND status=1");
$qAmericas     = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%3%' AND status=1");
$qOrienteMedio = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%4%' AND status=1");
$qAfrica	   = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%5%' AND status=1");
$qCIS		   = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%6%' AND status=1");
$qAsia		   = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%7%' AND status=1");
$qCaribe	   = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%8%' AND status=1");
$qMercosul	   = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%9%' AND status=1");
rsort($qAfrica);
arsort($qCIS);
arsort($qMercosul);
get_header();
?>
	<section class="banner_sub mercados waypoint animation_bottom is-hidden-mobile">
		<div class="wrap">
			<h1><?php echo $_lang[$lang]['menu_mercados']; ?></h1>
		</div>
	</section>

	<div class="wrap waypoint animation_bottom">
		<div class="breadcrumb">
			<a href="<?php echo HTTP; ?>" title="Home"><?=$_lang[$lang]['inicial'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo HTTP; ?>mercados/<?=$lang?>"><?php echo $_lang[$lang]['menu_mercados']; ?></a>
		</div>
		<br>
	</div>

	<section class="escritorios-mapa mercados has-text-centered">
		<h1 class="waypoint animation_bottom"><?php echo $_lang[$lang]['escritorios_localizados']; ?></h1>
		<br>
		<p class="waypoint animation_bottom"><?php echo $_lang[$lang]['escritorios_textos']; ?></p>
		<div class="mapa has-text-left">
			<div class="wrap relative">
				<div class="marc-1 waypoint animation_left"><div class="hexagon large"></div><?=$_lang[$lang]['mercosul'];?></div>
				<div class="marc-11 waypoint animation_left"><div class="hexagon large"></div><?=$_lang[$lang]['america_do_norte'];?></div>
				<div class="marc-12 waypoint animation_left"><div class="hexagon large"></div><?=$_lang[$lang]['cis'];?></div>
				<div class="marc-7 waypoint animation_left"><div class="hexagon large"></div><?=$_lang[$lang]['caribe'];?></div>
				<div class="marc-2 waypoint animation_right"><div class="hexagon large"></div><?=$_lang[$lang]['africa'];?></div>
				<div class="marc-3 waypoint animation_right"><div class="hexagon large"></div><?=$_lang[$lang]['oriente_medio'];?></div>
				<div class="marc-4 waypoint animation_right"><div class="hexagon large"></div><?=$_lang[$lang]['asia'];?></div>
				<div class="marc-5 waypoint animation_right"><div class="hexagon large"></div><?=$_lang[$lang]['cei_europa'];?></div>
				<div class="marc-6 waypoint animation_right"><div class="hexagon large"></div><?=$_lang[$lang]['oceania'];?></div>
				<div class="marc-map-icon waypoint animation_left mp-icon-1"><img src="<?= HTTP.'img/lp-icon.png'?>"></div>
				<div class="marc-map-icon waypoint animation_right mp-icon-2"><img src="<?= HTTP.'img/lp-icon.png'?>"></div>
				<div class="marc-map-icon waypoint animation_left mp-icon-3"><img src="<?= HTTP.'img/lp-icon.png'?>"></div>
			</div>
		</div>
	</section>




	
	<section class="mercados-informacoes">
		<div class="wrap">
		
			<div class="has-text-centered">

				<i class="fa fa-envelope"></i> <span id="email-setor">E-mail: <a href="mailto:commercial@lpartners.net"> commercial@Lpartners.net</a></span>

			</div>



			<div class="columns is-centered is-multiline">
				<div class="column is-12 waypoint animation_bottom has-text-centered">

					<?php if ($qDirComercial ) { ?>

					<h4 class="has-text-centered"><?php echo $_lang[$lang]['diretor_comercial_mercado']; ?></h4>
					<?php foreach ($qDirComercial as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".str_replace('lp', 'LP', $rs->email)."<br>":""); ?>
					<?php echo ($rs->telefone?$_lang[$lang]['telefone'].$rs->telefone."<br>":""); ?>	
					<?php echo $_lang[$lang]['telefone']." +971 4 432 7366<br>"; ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<!-- <?php echo ($rs->skype?"Skype: ".str_replace('lp', 'LP', $rs->skype)."<br>":""); ?> -->
					<br>
					<?php } ?>

					<?php } ?>
					
				</div>




				<div class="column is-12 waypoint animation_bottom">


					<?php if ($qSourcing ) { ?>

					<h4 class="has-text-centered"><?=$_lang[$lang]['gerente_abastecimento'] ?></h4>

					<div class="columns">
						<?php foreach ($qSourcing as $rs) { ?>
							<div class="column is-4">
								<strong><?php echo $rs->titulo; ?></strong><br>
								<?php echo ($rs->email?"E-mail: ".str_replace('lp', 'LP', $rs->email)."<br>":""); ?>
								<?php echo ($rs->telefone?$_lang[$lang]['telefone'].$rs->telefone."<br>":""); ?>
								<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
								<?php echo ($rs->skype?"Skype: ".str_replace('lp', 'LP', $rs->skype)."<br>":""); ?>
								<br>
							</div>
						<?php } ?>
					</div>

					<?php } ?>
				</div>
			</div>

			<div class="line"></div>
			<br>

			<div class="columns is-multiline">
				

				<?php if ($qOrienteMedio ) { ?>
				
				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left middle-east"><?=$_lang[$lang]['oriente_medio'];?></h4>
					<?php foreach ($qOrienteMedio as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".str_replace('lp', 'LP', $rs->email)."<br>":""); ?>
					<?php echo ($rs->telefone?$_lang[$lang]['telefone'].$rs->telefone."<br>":""); ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".str_replace('lp', 'LP', $rs->skype)."<br>":""); ?>
					<br>
					<?php } ?>
				</div>

				<?php } ?>




				<?php if ($qAsia ) { ?>

				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left asia"><?=$_lang[$lang]['asia'];?></h4>
					<?php foreach ($qAsia as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".str_replace('lp', 'LP', $rs->email)."<br>":""); ?>
					<?php echo ($rs->telefone?$_lang[$lang]['telefone'].$rs->telefone."<br>":""); ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".str_replace('lp', 'LP', $rs->skype)."<br>":""); ?>
					<br>
					<?php } ?>
				</div>

				<?php } ?>




				<?php if ($qCIS ) { ?>

				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left cis"><?=$_lang[$lang]['cei_europa_ru'];?></h4>
					<?php foreach ($qCIS as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".str_replace('lp', 'LP', $rs->email)."<br>":""); ?>
					<?php echo ($rs->telefone?$_lang[$lang]['telefone'].$rs->telefone."<br>":""); ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".str_replace('lp', 'LP', $rs->skype)."<br>":""); ?>
					<br>
					<?php } ?>
				</div>

				<?php } ?>






				<?php if ($qCaribe ) { ?>

				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left americas"><?= $_lang[$lang]['caribe']; ?></h4>
				  <?php foreach ($qCaribe as $rs) { ?>
				 	<strong><?php echo $rs->titulo; ?></strong><br>
				 	<?php echo ($rs->email?"E-mail: ".str_replace('lp', 'LP', $rs->email)."<br>":""); ?>
				 	<?php echo ($rs->telefone?$_lang[$lang]['telefone'].$rs->telefone."<br>":""); ?>
				 	<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
				 	<?php echo ($rs->skype?"Skype: ".str_replace('lp', 'LP', $rs->skype)."<br>":""); ?>
				 	<br>
				 	<?php } ?>
				</div>

				<?php } ?>






				<?php if ($qAfrica ) { ?>

				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left africa"><?=$_lang[$lang]['africa'];?></h4>
					<?php foreach ($qAfrica as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".str_replace('lp', 'LP', $rs->email)."<br>":""); ?>
					<?php echo ($rs->telefone?$_lang[$lang]['telefone'].$rs->telefone."<br>":""); ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".str_replace('lp', 'LP', $rs->skype)."<br>":""); ?>
					<br>
					<?php } ?>
				</div>

				<?php } ?>

				


				<?php if ($qMercosul ) { ?>
				
				<div class="column is-4 waypoint animation_bottom">
					<h4 class="has-text-left americas"><?=$_lang[$lang]['mercosul'];?></h4>
					<?php foreach ($qMercosul as $rs) { ?>
					<strong><?php echo $rs->titulo; ?></strong><br>
					<?php echo ($rs->email?"E-mail: ".str_replace('lp', 'LP', $rs->email)."<br>":""); ?>
					<?php echo ($rs->telefone?$_lang[$lang]['telefone'].$rs->telefone."<br>":""); ?>
					<!-- <?php echo ($rs->celular?"Celular: ".$rs->celular."<br>":""); ?> -->
					<?php echo ($rs->skype?"Skype: ".str_replace('lp', 'LP', $rs->skype)."<br>":""); ?>
					<br>
					<?php } ?>
				</div>

				<?php } ?>


				
			</div>
		</div>
	</section>
	
<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php get_footer(); ?>