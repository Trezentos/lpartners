<?php
add_javascript(array('jquery.thooClock.js','clock.js'));
add_style(array('css/owl.carousel.min.css', 'css/owl.theme.default.min.css'));

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
				<i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo HTTP.'trading/'.$lang?>"><?php echo $_lang[$lang]['menu_diagnostico_comercializacao']; ?></a>
			</div>

			<br>

			<div class="columns">

				<div class="column is-2 waypoint animation_left">
					<?php include(TEMPLATE."includes/nossos-servicos-list-icon.php"); ?>
				</div>

				<div class="column is-8">
					<h1 class="waypoint animation_right"><?php echo $_lang[$lang]['menu_diagnostico_comercializacao']; ?></h1>

					<img src="<?php echo HTTP; ?>img/operacao-trading.jpg?v=2" class="waypoint animation_right">

					<br><br>

					<div class="has-text-justify waypoint animation_right">
						<!-- Diagnóstico da cadeia de comercialização adequada ao produto e marca, possibilitando regularidade nos embarques, proporcionando satisfação comercial entre clientes e fornecedores; -->
						<?php echo $_lang[$lang]['trading_texto']; ?>
					</div>
				</div>

			</div>

		</div>
	</section>

<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php include(TEMPLATE."includes/nossos-servicos-faixa.php"); ?>

<?php include(TEMPLATE."includes/nossos-escritorios.php"); ?>

<?php get_footer(); ?>