<?php
add_javascript(array('jquery.thooClock.js','clock.js'));
get_header(); ?>

	<section class="banner_sub servicos waypoint animation_bottom is-hidden-mobile">
		<div class="wrap">
			<h1><?php echo $_lang[$lang]['nossos_servicos']; ?></h1>
		</div>
	</section>


	<section class="nossos-servicos sub pt30">
		<div class="wrap">

			<div class="breadcrumb waypoint animation_bottom">
				<a href="<?php echo HTTP; ?>" title="Home"><?=$_lang[$lang]['inicial'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <span><?php echo $_lang[$lang]['menu_servicos']; ?></span>
				<i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo HTTP.'desenvolvimento-de-marcas/'.$lang?>"><?php echo $_lang[$lang]['menu_estruturacao_frigorificos']; ?></a>
			</div>

			<br>

			<div class="columns">

				<div class="column is-2 waypoint animation_left">
					<?php include(TEMPLATE."includes/nossos-servicos-list-icon.php"); ?>
				</div>

				<div class="column is-8">
					<h1 class="waypoint animation_right"><?php echo $_lang[$lang]['menu_estruturacao_frigorificos']; ?></h1>

					<img src="<?php echo HTTP; ?>img/desenvolvimento_de_marcas.jpg" class="waypoint animation_right">

					<br><br>

					<div class="has-text-justify waypoint animation_right">
						<!-- Assessoria na estruturação de frigoríficos para sua inserção no mercado internacional no que tange ao desenvolvimento e/ou adequação de produtos e embalagens, criação e tradução de etiquetas; normatização e exigências do país importador; -->
						<?php echo $_lang[$lang]['dev_marcas_texto']; ?>
					</div>
				</div>

			</div>

		</div>
	</section>

<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php include(TEMPLATE."includes/nossos-servicos-faixa.php"); ?>

<?php include(TEMPLATE."includes/nossos-escritorios.php"); ?>

<?php get_footer(); ?>