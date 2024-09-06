<?php
// BANNERS
$qBanners = $db->get_results("SELECT * FROM ".$tables['BANNERS']." WHERE status=1 ORDER BY ordem ASC");

// PUBLICIDADES
$qPublicidades = $db->get_results("SELECT * FROM ".$tables['PUBLICIDADES']." WHERE status=1");

// BLOG
$qNoticias = $db->get_results("SELECT * FROM ".$tables['NOTICIAS']." WHERE status=1 ORDER BY data_criacao DESC LIMIT 3");


add_javascript(array('jquery.thooClock.js','clock.js'));
get_header();
?>

<section class="container_slide waypoint animation_bottom">
		<ul class="cycle-slideshow" data-cycle-slides="li" data-cycle-timeout="6000" data-cycle-pause-on-hover="true" data-cycle-pager="#no-template-pager" data-cycle-pager-template="">
			<div class="cycle-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
			<div class="cycle-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
		<?php foreach ($qBanners as $rs) :
		
			if($rs->link)
			{
				$slide = '<a href="http://'.$rs->link.'" target="'.($rs->link?$rs->destino:'').'"><img src="'.HTTP_UPLOADS_IMG.($MOBILE?$rs->imagem_mobile:$rs->imagem).'" class="banner"></a>';
			}
			else
			{
				$slide = '<img src="'.HTTP_UPLOADS_IMG.($MOBILE?$rs->imagem_mobile:$rs->imagem).'" class="banner">';
			}
		?>
			<li><?php echo $slide; ?></li>
        <?php endforeach; ?>
    </ul>

		<div class="lp_container">
			<div class="lp_top">
				LP TRACKING
				<div class="lp_globe"><i class="fa fa-search" aria-hidden="true"></i></div>
				<div class="lp_close"><i class="fa fa-times" aria-hidden="true"></i></div>
			</div>
			<div class="lp_body">
				<?=$_lang[$lang]['acesse_o_rastramento']?>
				<br><br>
				<form action="#" method="POST" name="tracking" onsubmit="return trackme()">
					<input type="hidden" name="token" value="0675a16509edc42c9172cd4b48721e0e5559a546" />
					<select name="company" id="company">
						<option value=""><?=$_lang[$lang]['select']?></option>
						<option value="https://www.fedex.com/fedextrack/?tracknumbers=[trackcode]">FedEx</option>
						<option value="http://www.dhl.com.br/content/br/en/express/tracking.shtml?brand=DHL&AWB=[trackcode]">DHL</option>
						<option value="http://www.tnt.com/webtracker/tracking.do?respCountry=us&respLang=en&navigation=1&page=1&sourceID=1&sourceCountry=ww&plazaKey=&refs=&requesttype=GEN&searchType=CON&cons=[trackcode]">TNT</option>
						<option value="http://www.aramex.com/express/track-results-multiple.aspx?ShipmentNumber=[trackcode]">ARAMEX</option>
						<option value="http://wwwapps.ups.com/WebTracking/track?track=yes&trackNums=[trackcode]">UPS</option>
						<option value="http://www.shippingline.org/track/?container=[trackcode]">Containers</option>
					</select>
					<input type="text" name="trackid" id="trackid" placeholder="<?=$_lang[$lang]['numero_awb']?>" />
					<div class="has-text-centered">
						<button class="botao"><?=$_lang[$lang]['acessar']?></button>
					</div>
					
				</form>
			</div>
        </div>
        
    </section>

    
    <div id="no-template-pager" class="cycle-pager external is-hidden-mobile waypoint animation_bottom">
        <?php foreach($qBanners as $rs) : ?>
        <img src="<?=HTTP_UPLOADS_IMG.($MOBILE?$rs->imagem_mobile:$rs->imagem)?>" width=120 height=120>
        <?php endforeach; ?>
    </div>

	
	<section class="chamada-produtos">
		<div class="wrap">

			<h1 class="waypoint animation_bottom"><?php echo $_lang[$lang]['nossos_produtos']; ?></h1>
			<br><br>
			<div class="columns">
				<div class="column is-3 waypoint animation_right">
					<a href="<?php echo HTTP.'produtos/beef/'.$lang; ?>" class="has-text-centered card-home-produtos">
						<div class="card-icon">
							<img src="<?php echo HTTP; ?>img/icon-beef.png">
						</div>
						<h2><?php echo $_lang[$lang]['boi']; ?></h2>
						<hr>
						<div><?php echo $_lang[$lang]['melhores_cortes']; ?></div>
						<div class="has-text-centered">
							<div class="botao"><?php echo $_lang[$lang]['ver_mais']; ?></div>
						</div>
					</a>
				</div>
				<div class="column is-3 waypoint animation_left">
					<a href="<?php echo HTTP.'produtos/poultry/'.$lang; ?>" class="has-text-centered card-home-produtos pork">
						<div class="card-icon">
							<img src="<?php echo HTTP; ?>img/icon-poltry.png">
						</div>
						<h2><?php echo $_lang[$lang]['frango']; ?></h2>
						<hr>
						<div><?php echo $_lang[$lang]['melhores_cortes']; ?></div>
						<div class="has-text-centered">
							<div class="botao"><?php echo $_lang[$lang]['ver_mais']; ?></div>
						</div>
					</a>
				</div>
				<div class="column is-3 waypoint animation_bottom">
					<a href="<?php echo HTTP.'produtos/pork/'.$lang; ?>" class="has-text-centered card-home-produtos">
						<div class="card-icon">
							<img src="<?php echo HTTP; ?>img/icon-pork.png">
						</div>
						<h2><?php echo $_lang[$lang]['porco']; ?></h2>
						<hr>
						<div><?php echo $_lang[$lang]['melhores_cortes']; ?></div>
						<div class="has-text-centered">
							<div class="botao"><?php echo $_lang[$lang]['ver_mais']; ?></div>
						</div>
					</a>
				</div>
				<div class="column is-3 waypoint animation_bottom">
					<a href="<?php echo HTTP.'produtos/fish/'.$lang; ?>" class="has-text-centered card-home-produtos">
						<div class="card-icon">
							<img src="<?php echo HTTP; ?>img/icon-fish.png">
						</div>
						<h2><?php echo $_lang[$lang]['peixe']; ?></h2>
						<hr>
						<div><?php echo $_lang[$lang]['melhores_cortes']; ?></div>
						<div class="has-text-centered">
							<div class="botao"><?php echo $_lang[$lang]['ver_mais']; ?></div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="nossa-empresa">
		<div class="wrap">
			<h1 class="waypoint animation_bottom"><?php echo $_lang[$lang]['nossa_empresa']; ?></h1>
			<br><br class="no_mobile">
			<div class="columns">
				<div class="column is-6 waypoint animation_left">
					<div class="has-text-justify">
						<?php echo $_lang[$lang]['empresa_texto']; ?>
						<br><br>
						<a href="<?php echo HTTP; ?>institucional/<?php echo $lang; ?>" class="botao"><?php echo $_lang[$lang]['saiba_mais']; ?></a>
					</div>
				</div>
				<div class="column is-6 waypoint animation_right">
					<div class="atuacao">
						&nbsp; &nbsp; &nbsp; &nbsp; <?php echo $_lang[$lang]['empresa_subfrase']; ?>
						<div class="frase">
							<?php echo $_lang[$lang]['empresa_frase_maior']; ?>
							<hr>
						</div>
						<?php echo $_lang[$lang]['empresa_tags']; ?>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="nossos-servicos">
		<div class="columns">
			<div class="column is-6 itens-servicos">
				<div class="wrap-servicos waypoint animation_right">
					<div class="columns is-multiline">
						<div class="column is-4 has-text-centered">
							<a href="<?php echo HTTP;?>representacao-exclusiva/<?php echo $lang; ?>">
								<img src="<?php echo HTTP;?>img/icon-mao.png">
								<h3><?php echo $_lang[$lang]['menu_assessoria']; ?></h3>
								
							</a>
						</div>
						<div class="column is-4 has-text-centered">
							<a href="<?php echo HTTP;?>suporte-logistico-e-documental/<?php echo $lang; ?>">
								<img src="<?php echo HTTP;?>img/icon-documental.png">
								<h3><?php echo $_lang[$lang]['menu_asssitencia_logistica']; ?></h3>
							
							</a>
						</div>
						<div class="column is-4 has-text-centered">
							<a href="<?php echo HTTP;?>desenvolvimento-de-marcas/<?php echo $lang; ?>">
								<img src="<?php echo HTTP;?>img/icon-empreendedorismo.png">
								<h3><?php echo $_lang[$lang]['menu_estruturacao_frigorificos']; ?></h3>
							
							</a>
						</div>
						<div class="column is-4 has-text-centered">
							<a href="<?php echo HTTP;?>inteligencia-de-mercado/<?php echo $lang; ?>">
								<img src="<?php echo HTTP;?>img/icon-inteligencia-mercado.png">
								<h3><?php echo $_lang[$lang]['menu_pesquisa_mercadologica']; ?></h3>
							</a>
						</div>
						<div class="column is-4 has-text-centered">
							<a href="<?php echo HTTP;?>mercado-internacional/<?php echo $lang; ?>">
								<img src="<?php echo HTTP;?>img/icon-mercado-internacional.png">
								<h3><?php echo $_lang[$lang]['menu_mercado_internacional']; ?></h3>
							</a>
						</div>
						<div class="column is-4 has-text-centered">
							<a href="<?php echo HTTP;?>trading/<?php echo $lang; ?>">
								<img src="<?php echo HTTP;?>img/icon-globo.png">
								<h3><?php echo $_lang[$lang]['menu_diagnostico_comercializacao']; ?></h3>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="column is-6 informacoes">
				<div class="wrap-servicos-inf has-text-justify waypoint animation_left">
					<h1><?php echo $_lang[$lang]['nossos_servicos']; ?></h1>
					<?=$_lang[$lang]['nossos_serv_texto'];?>
					<br>
					<a href="<?php echo HTTP;?>trading/<?php echo $lang; ?>" class="botao"><?php echo $_lang[$lang]['saiba_mais']; ?></a>
				</div>
			</div>
		</div>
	</section>


	<section class="blog_home">
		<div class="wrap has-text-centered">

			<h1 class="waypoint animation_bottom"><?php echo $_lang[$lang]['nosso_blog']; ?></h1>
			<br>
			<p class="waypoint animation_bottom"><?php echo $_lang[$lang]['blog_texto']; ?></p>
			<br><br>

			<div class="columns waypoint animation_bottom"">
			<?php 
				foreach ($qNoticias as $rs) :
					$qCapaNot = $db->get_row("SELECT * FROM ".$tables['NOTICIAS_IMG']." WHERE ativo=1 AND id_galeria={$rs->id} ORDER BY capa DESC");
					
			?>
				<div class="column is-4">
					<article class="item_not">
						<a href="<?php echo HTTP.'post/'.$rs->permalink."/".$lang; ?>" >
							<div class="blog_item_container">
								<div class="hover_gray"><span class="icon is-large"><i class="fa fa-plus-circle fa-5x" aria-hidden="true"></i></span></div>
								<img src="<?php echo $qCapaNot->arquivo ? HTTP_UPLOADS_IMG."tb_".$qCapaNot->arquivo : HTTP.'img/not-sem_foto.jpg'; ?>">
							</div>
							<div class="desc_not has-text-justify">
								<h1><?=$rs->{"titulo_".$lang}; ?></h1>
								<?=$rs->{"resumo_".$lang}; ?>
							</div>
							<div class="has-text-right">
								<div class="botao"><?php echo $_lang[$lang]['saiba_mais']; ?> <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
							</div>
						</a>
					</article>
				</div>
			<?php endforeach; ?>
			</div>

			<br><br class="no_mobile"><br class="no_mobile">
			<a href="<?=HTTP; ?>blog/<?php echo $lang; ?>" class="botao waypoint animation_bottom"><?php echo $_lang[$lang]['ver_mais']; ?></a>
			<br class="no_mobile">

		</div>
	</section>


<?php 
include(TEMPLATE."includes/nossos-escritorios.php");
include(TEMPLATE."includes/contato-skp.php");
get_footer();