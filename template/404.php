<?php
$permalink = "page-404";

get_header(); ?>

	<section class="container_slide sub slide_fx">
		<img src="<?=HTTP?>img/Banner3.jpg" class="banner">
		<div class="banner_inf_center">
			PÁGINA
			<h1>NÃO ENCONTRADA</h1>
		</div>
	</section>
	<br><br><br>

	<div class="text page-wrap has-text-centered">
		<h1>Erro 404</h1>
		<br><br><br>
		<h3>Página não encontrada! (<?php echo $pagina; ?>)</h3>
		<p>Desculpe, parece que a página que você estava procurando não existe mais ou pode ter sido movida.</p>
		<br><br>
		<ul>
			<li><a href="<?=HTTP?>" style="color:#000" title="Página inicial"><h2>Página inicial</h2></a></li>
			<li><a href="<?=HTTP?>contato" style="color:#000" title="Entre em contato"><br><h2>Contato</h2></a></li>
		</ul>
	</div>
	<br><br><br><br><br>
<?php get_footer(); ?>
