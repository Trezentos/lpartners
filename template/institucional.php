<?php
// PARCEIROS
$qParceiros = $db->get_results("SELECT * FROM ".$tables['PARCEIROS']." WHERE status='1'");

get_header();
?>
	<section class="banner_sub waypoint animation_bottom institucional is-hidden-mobile">
		<div class="wrap">
			<!-- <h1><?php echo $_lang[$lang]['nossa_empresa']; ?></h1> -->
		</div>
	</section>

	<div class="wrap waypoint animation_bottom">
		<div class="breadcrumb">
            <a href="<?php echo HTTP; ?>" title="Home"><?=$_lang[$lang]['inicial'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> 
            <a href="<?php echo HTTP; ?>institucional/"><?php echo $_lang[$lang]['menu_institucional']; ?></a>
		</div>
		<br>
	</div>

	
	<section class="nossa-empresa">
		<div class="wrap">			
			<div class="columns">
				<div class="column is-6 waypoint animation_left">
					<h1 class="has-text-left"><?=$_lang[$lang]['inst_intro_titulo'];?></h1>
					<br>
					<div class="has-text-justify">
						<?=$_lang[$lang]['inst_intro_texto'];?>
					</div>
				</div>
				<div class="column is-6 waypoint animation_right">
					<br class="no_mobile"><br class="no_mobile"><br class="no_mobile">
					<div class="atuacao">
						<!-- &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $_lang[$lang]['empresa_subfrase']; ?> -->
						<div class="frase" style="text-transform: uppercase;">
							<?php echo $_lang[$lang]['empresa_frase_maior']; ?>
							<hr>
						</div>
						<?php echo $_lang[$lang]['empresa_tags']; ?>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- <section class="diferenciais waypoint animation_bottom">
		<div class="wrap">
			<h1 class="has-text-left"><?php echo $_lang[$lang]['diferenciais']; ?></h1>
			<br><br>
			<div class="columns">
				<div class="column is-6">
					<ul class="has-text-justify">
						<li>Matriz estrategicamente localizada em Dubai, Emirados Árabes Unidos, garantindo fácil e rápida acessibilidade aos mercados potenciais;</li>
						
						<li>Escritorio comercial em Hong Kong, assegurando mobilidade na atuação da empresa e seus parceiros no Mercado Asiático.</li>
						
						<li>Escritório de suporte comercial e base operacional localizado em Itajai, no estado de Santa Catarina, Brasil, importante pólo exportador de congelados e próximo às principais regiões produtoras de carnes do país;</li>
						
						<li>Profissionais cujo profundo conhecimento do mercado internacional de carnes foi construído ao longo de muitos anos de vivência efetiva em países tradicionalmente importadores, e que, com uma frequência criteriosamente definida, são enviados constantemente a experenciar in locu o mercado em que atuam;</li>
						
						<li>Valorização da parceria através do respeito, transparência e ajuda mútua, vislumbrando sempre a construção de um relacionamento duradouro;</li>
						
						<li>Práticas mercadológicas comprometidas com a imagem da marca e sua integridade;
						Proximidade com seus parceiros através de visitas periódicas e participação nos principais eventos mundiais da alimentação;</li>
						
						<li>Sólida parceria com os melhores produtores brasileiros, americanos e europeus;
						Capacidade em identificar precisamente as tendências do mercado internacional de carnes;</li>
						
						<li>Comprometida com o bem-estar do ser humano, sendo ele seu colaborador, parceiro comercial ou membro de uma entidade assistida;</li>
						
						<li>Conhecimento cultural e mercadológico efetivo que extinguem possíveis riscos financeiros das operações por desconhecimento das práticas comerciais internacionais.</li>
					</ul>
				</div>
				<div class="column"></div>
			</div>
		</div>
	</section> -->


	<section class="mvv">
		<div class="wrap">
			<div class="columns">
				<div class="column is-8-desktop is-12-mobile">
					<div class="waypoint animation_left">
						<h2 class="has-text-left"><?php echo $_lang[$lang]['missao']; ?></h2>
						<div class="has-text-justify">
							<!-- Prover nossos fornecedores e clientes com as melhores solues para o mercado mundial de carnes, lidando com produtos que atendam os mais exigentes padroes internacionais de qualidade, comprometidos com a transparencia e confianca nas relacoes com os parceiros e garantindo seguranca e pontualidade nas relacoes comerciais. -->
							<?php echo $_lang[$lang]['missao_texto']; ?>
						</div>
					</div>

					<div class="line-dotted waypoint animation_left"></div>

					<div class="waypoint animation_left">
						<h2 class="has-text-left"><?php echo $_lang[$lang]['visao']; ?></h2>
						<div class="has-text-justify">
							<!-- Sermos reconhecidos como a melhor empresa no comercio global de carnes pela excelencia nos servicos prestados e credibilidade conquistada no mercado junto a seus clientes, fornecedores e colaboradores. -->
							<?php echo $_lang[$lang]['visao_texto']; ?>
						</div>
					</div>

					<div class="line-dotted waypoint animation_left"></div>

					<div class="waypoint animation_left">
						<h2 class="has-text-left"><?php echo $_lang[$lang]['pilares']; ?></h2>
						<br>
						<div class="has-text-justify">
							<!-- Sermos reconhecidos como a melhor empresa no comercio global de carnes pela excelencia nos servicos prestados e credibilidade conquistada no mercado junto a seus clientes, fornecedores e colaboradores. -->
							<div class="pillar-container">

								<div class="pillar-tag">
									<img class="is-centered" src="<?=HTTP.'img/icon-credibilidade.png';?>">
									<p class="p-tag"><?=$_lang[$lang]['pilares_texto_credibilidade'] ?></p>
								</div>
								<div class="pillar-tag">
									<img class="is-centered" src="<?=HTTP.'img/icon-empreendedorismo.png';?>">
									<p class="p-tag"><?=$_lang[$lang]['pilares_texto_empreend'] ?></p>
								</div>
								<div class="pillar-tag">
									<img class="is-centered" src="<?=HTTP.'img/icon-lealdade.png';?>">
									<p class="p-tag"><?=$_lang[$lang]['pilares_texto_lealdade'] ?></p>
								</div>
								<div class="pillar-tag">
									<img class="is-centered" src="<?=HTTP.'img/icon-atitude-dono.png';?>">
									<p class="p-tag"><?=$_lang[$lang]['pilares_texto_atdono'] ?></p>
								</div>
								<div class="pillar-tag">
									<img class="is-centered" src="<?=HTTP.'img/icon-agregar-valor.png';?>">
									<p class="p-tag"><?=$_lang[$lang]['pilares_texto_agregar'] ?></p>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="column is-hidden-mobile"></div>
			</div>
		</div>
	</section>

<div class="columns waypoint animation_bottom"> </div> 

	<!-- <section class="parceiros">
 	<div class="wrap">
 		<h1 class="waypoint animation_bottom"><?php echo $_lang[$lang]['parceiros']; ?></h1>

			
			
			<div class="cycle-slideshow" data-cycle-fx="carousel" data-cycle-timeout="2000" data-cycle-slides="> div" data-cycle-carousel-visible="4" data-cycle-carousel-fluid="true">
				<?php 
				
					foreach ($qParceiros as $rs) {
						
						echo '<div class="column is-3 has-text-centered"><a href="http://'.$rs->link.'" target="_blank"><img src="'.HTTP_UPLOADS_IMG.$rs->imagem.'"/></a></div>';
			
	 				}
				?>
			</div>
		</div>
	 </section> -->

	<section class="parceiros">
		<div class="wrap">
			<h1 class="waypoint animation_bottom"><?php echo $_lang[$lang]['parceiros']; ?></h1>

			<div class="cycle-slideshow" data-cycle-fx="carousel" data-cycle-timeout="3000" data-cycle-slides="> div" data-cycle-carousel-visible="<?=($MOBILE?'2':'4');?>" data-cycle-carousel-fluid="true">

				<?php foreach($qParceiros as $rs) { ?>
					
					<div class="column is-3 has-text-centered waypoint animation_bottom">
						<a href="http://<?= $rs->link; ?>" target="_blank"><img src="<?= HTTP_UPLOADS_IMG.$rs->imagem; ?>"></a>
					</div>

				<?php } ?>

			</div>

		</div>
	</section>
<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php get_footer(); ?>