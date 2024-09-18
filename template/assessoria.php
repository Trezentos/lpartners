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
				<i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo HTTP.'representacao-exclusiva/'.$lang?>"><?php echo $_lang[$lang]['menu_assessoria']; ?></a>
			</div>

			<br>

			<div class="columns">

				<div class="column is-2 waypoint animation_left">
					<?php include(TEMPLATE."includes/nossos-servicos-list-icon.php"); ?>
				</div>

				<div class="column is-8">
					<h1 class="waypoint animation_right"><?php echo $_lang[$lang]['menu_assessoria']; ?></h1>

					<img src="<?php echo HTTP; ?>img/representacao-exclusiva.jpg" class="waypoint animation_right">

					<br><br>

					<div class="has-text-justify waypoint animation_right">
						<!-- Assessoria para que a internacionalização do produto e/ou da marca aconteça dentro da normalidade das operações e adequada às estratégias comerciais da empresa, sem a necessidade de exposição à riscos; -->
						<?php echo $_lang[$lang]['rp_exclusiva_texto']; ?>
					</div>
					<!-- <div class="representacao-container-fora waypoint animation_bottom">
						<div class="column">
							<div class="representacao-container">
								<figure class="representacao-logo">
									<img src="<?=HTTP.'img/alegra.png'?>">
								</figure>
								<p><?=$_lang[$lang]['representacao_exclusivo']?></p>
							</div>
						</div>
						<div class="column">
							<div class="representacao-container">
								<figure class="representacao-logo">
									<img src="<?=HTTP.'img/mountain.png'?>">
								</figure>
								<p><?=$_lang[$lang]['representacao_oriente']?></p>
							</div>
						</div>
						<div class="column">
							<div class="representacao-container">
								<figure class="representacao-logo">
									<img src="<?=HTTP.'img/soychu.png'?>">
								</figure>
								<p><?=$_lang[$lang]['representacao_oriente']?></p>
							</div>
						</div>
						<div class="column">
							<div class="representacao-container">
								<figure class="representacao-logo">
									<img src="<?=HTTP.'img/pifpaf.png'?>">
								</figure>
								<p><?=$_lang[$lang]['representacao_pifpaf']?></p>
							</div>
						</div>
						<div class="column">
							<div class="representacao-container">
								<figure class="representacao-logo">
									<img src="<?=HTTP.'img/lar.png'?>">
								</figure>
								<p><?=$_lang[$lang]['representacao_lar']?></p>
							</div>
						</div>
					</div>
				</div>

			</div> -->

		</div>
	</section>

<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php include(TEMPLATE."includes/nossos-servicos-faixa.php"); ?>

<?php include(TEMPLATE."includes/nossos-escritorios.php"); ?>

<?php get_footer(); ?>