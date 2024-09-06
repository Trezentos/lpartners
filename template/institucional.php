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


	<section class="timeline">
		<div class="wrap">
			<h1 class="has-text-centered waypoint animation_bottom"> <?= $_lang[$lang]['evolucao_marca'];  ?> </h1>
			<div class="columns" style="align-items: center;">
				<div class="column is-3 has-text-centered waypoint animation_left">
					<div>
						<img src="<?php echo HTTP; ?>img/logo-2006-lpexport.jpg"/>
					</div>
					<div class="ano">2006</div>
					<!-- <p class="has-text-justify">Fundador da empresa, realiza um sonho antigo, dá início a LP Export em Dubai, Emirados Arabes Unidos. Na época, com mais de 25 anos de atuação no mercado internacional de carnes, sua intenção inicial é promover a carne brasileira nos países do Oriente Médio e Rússia.</p> -->
				</div>
				<div class="column is-3 has-text-centered waypoint animation_bottom">
					<div>
						<img src="<?php echo HTTP; ?>img/logo-2008-lpexport.jpg"/>
					</div>
					<div class="ano">2008</div>
					<!-- <p class="has-text-justify">O horizonte da empresa se amplia e a LP Export vai em busca de novas parcerias, inclusive de outras origens. Consequentemente, cresce significativamente o número de fornecedores, dentre os quais agora constam americanos, europeus e asiáticos.</p> -->
				</div>
				<div class="column is-3 has-text-centered waypoint animation_right">
					<div>
						<img src="<?php echo HTTP; ?>img/logo-2010-lpexport.jpg"/>
					</div>
					<div class="ano">2010</div>
					<!-- <p class="has-text-justify">Estruturada, a empresa investe maciçamente na participação em Feiras e outros eventos e o resultado é inevitável: as operações crescem 20%, com exportações para 50 países neste ano.</p> -->
				</div>
				<div class="column is-3 has-text-centered waypoint animation_right">
					<div>
						<img src="<?php echo HTTP; ?>img/logo-2018-lpexport.jpg"/>
					</div>
					<div class="ano">2018</div>
					<!-- <p class="has-text-justify">Estruturada, a empresa investe maciçamente na participação em Feiras e outros eventos e o resultado é inevitável: as operações crescem 20%, com exportações para 50 países neste ano.</p> -->
				</div>
				

			</div>
		</div>
	</section>


	<!-- <section class="escritorios-mapa has-text-centered">
		<h1 class="waypoint animation_bottom"><?php echo $_lang[$lang]['escritorios_localizados']; ?></h1>
		<br>
		<p class="waypoint animation_bottom"><?php echo $_lang[$lang]['escritorios_textos']; ?></p>

		<div class="mapa has-text-left">
			<div class="wrap relative">
				<div class="marc-1 waypoint animation_bottom"><div class="hexagon"></div> Itajaí - <?php echo $_lang[$lang]['brasil']; ?></div>
				<div class="marc-2 waypoint animation_bottom"><div class="hexagon"></div> Dubai - UEA</div>
				<div class="marc-3 waypoint animation_bottom"><div class="hexagon"></div> China - Hong Kong</div>
			</div>
		</div>
	</section> -->


	<!-- <section class="sustentabilidade">
		<div class="wrap">
			<div class="columns">
				<div class="column is-6 has-text-justify waypoint animation_left">
					<br>
					<h1 class="has-text-left"><?php echo $_lang[$lang]['nossas_praticas']; ?></h1>
					<br><br>
					Construir e fortalecer nossas parcerias comerciais sempre com base no profissionalismo, respeito e cooperação mútua entre as partes;
					<br><br>
					Estimular permanentemente o desenvolvimento pessoal e profissional dos colaboradores;<br>
					Disseminar a utilização da inteligência de mercado em todos os níveis organizacionais para garantir que todas as operações sejam financeiramente saudáveis e comercialmente seguras para todos os envolvidos.
					<br><br>
					Rever incessantemente nossas práticas, processos, ações e abordagens para que a excelência de nossos serviços seja uma constante;
					<br><br>
					Agir de forma a consolidar a imagem da LP Export como uma empresa sólida, versátil e 100% confiável perante um mercado internacional extremamente exigente, mutável e multicultural.
				</div>
				<div class="column is-6 waypoint animation_right">
					<img src="<?php echo HTTP; ?>img/sustentabilidade.jpg"/>
				</div>
			</div>
		</div>
	</section> -->



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