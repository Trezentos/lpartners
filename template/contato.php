<?php
add_javascript(['jquery.maskedinput.js', 'page.contato.js', 'jquery.thooClock.js', 'clock.js']);
get_header();
?>

<!-- <script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script> -->

<section class="wrap">
	<div class="breadcrumb waypoint animation_bottom">
		<a href="<?php echo HTTP; ?>" title="Home"><?=$_lang[$lang]['inicial'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo HTTP; ?>contato/"><?php echo $_lang[$lang]['menu_contato']; ?></a>
	</div>

	<br class="no_mobile">

	<?php include(TEMPLATE."includes/nossos-escritorios.php"); ?>
</section>

<br>
<br>

<section class="banner_sub waypoint animation_bottom is-hidden-mobile">
	<div class="wrap">
		<h1><?php echo $_lang[$lang]['nosso_contato']; ?></h1>
	</div>
</section>

<br>
<br>

<section class="wrap">
	<p class="waypoint animation_bottom"><?php echo $_lang[$lang]['contato_texto']; ?></p>

	<form id="form-contato" method="post">

		<div id="contato" class="columns">	
			<div class="column is-6 waypoint animation_left">
				<label>
					<span class="select">
				      <select name="escritorio" id="escritorio">
				        <option value=""><?php echo $_lang[$lang]['escolha_escritorio']; ?></option>
				        <option value="DUBAI">DUBAI - UAE (HEAD OFFICE)</option>
						<option value="ITAJAÍ">ITAJAÍ - BRAZIL - OFFICE</option>
						<option value="HONG KONG">HONG KONG - CHINA - OFFICE</option>
				      </select>
				    </span>
				</label>
				
				<label>
					<input type="text" name="nome" id="nome" placeholder="<?php echo $_lang[$lang]['nome']; ?> *">
				</label>
				<label>
					<input type="email" name="email" id="email" placeholder="E-MAIL *">
				</label>
				<label>
					<input type="text" name="telefone" id="telefone" placeholder="<?php echo $_lang[$lang]['telefone']; ?> *">
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