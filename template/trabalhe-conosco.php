<?php
add_javascript(array('jquery.maskedinput.js', 'page.trabalhe-conosco.js'));
get_header();
?>

	<!-- <script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script> -->

	<section class="banner_sub waypoint animation_bottom is-hidden-mobile">
		<div class="wrap">
			<h1><?php echo $_lang[$lang]['trabalhe_conosco']; ?></h1>
		</div>
	</section>

	<section class="wrap">
		<div class="breadcrumb waypoint animation_bottom ">
			<a href="<?php echo HTTP; ?>" title="Home"><?=$_lang[$lang]['inicial'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo HTTP; ?>trabalhe-conosco/"><?php echo $_lang[$lang]['trabalhe_conosco']; ?></a>
		</div>

		<br class="no_mobile">

		<p class="waypoint animation_bottom"><?php echo $_lang[$lang]['trabalhe_conosco_texto']; ?></p>


		<form id="form-trabalhe-conosco" method="post" accept="multipart/form-data">

			<div id="contato" class="columns">	
				<div class="column is-6 waypoint animation_left">
					<label>
						<input type="text" name="nome" id="nome" placeholder="<?php echo $_lang[$lang]['nome']; ?> *">
					</label>
					<label>
						<input type="email" name="email" id="email" placeholder="E-MAIL *">
					</label>
					<label>
						<input type="text" name="telefone" id="telefone" placeholder="<?php echo $_lang[$lang]['telefone']; ?> *">
					</label>
					<label>
						<input type="file" name="curriculo" id="curriculo" class="curriculo">
					</label>
				</div>

				<div class="column is-6 has-text-right waypoint animation_right">
					<label>
						<textarea name="mensagem" id="mensagem" placeholder="<?php echo $_lang[$lang]['mensagem']; ?> *"></textarea>
					</label>
				</div>

			</div>

			<span class="load"></span>
			<div class="msg"></div>
			<button type="submit" name="enviar" class="botao waypoint animation_left"><?php echo $_lang[$lang]['enviar']; ?></button>

		</form>

	</section>

	<br><br>
<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php
get_footer();
?>