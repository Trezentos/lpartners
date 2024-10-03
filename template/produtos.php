<?php

// PUBLICIDADES
$qPublicidades = $db->get_results("SELECT * FROM ".$tables['PUBLICIDADES']." WHERE status=1");

$FriendURL = returnFriendyURL();
$categoria = $FriendURL[1];

$WHERE = "";


if( isset($categoria) )
{
	$cat = get_id_categoria_produtos($categoria);
	$catNome = get_nome_categoria_produtos($cat, $lang);
	$WHERE  .= " AND id_grupo='{$cat}'";
}




// echo "***************************".$FriendURL[0]."***************************";

$_GET["page"] = antiSQL($_GET["page"]);
$_GET["ipp"]  = antiSQL($_GET["ipp"]);

$count = $db->get_var("SELECT COUNT(*) FROM ".$tables['PRODUTOS']." WHERE status=1 ".$WHERE);
$qProdutos = $db->get_results("SELECT * FROM ".$tables['PRODUTOS']." WHERE status=1 AND destaque=1 ".$WHERE." ORDER BY ordem ASC LIMIT 10");
//$db->debug();

$escolhaCorteTitulo = $categoria == 'others-products' ? 
	$_lang[$lang]['escolha'] : $_lang[$lang]['escolha_seu_corte'];


add_javascript(array('page-produtos.js'));
get_header(); ?>

	<section class="banner_sub produtos waypoint animation_bottom is-hidden-mobile">
		<div class="wrap">
			<h1><?php echo $_lang[$lang]['nossos_produtos']; ?></h1>
		</div>
	</section>


	<section class="nossos-produtos sub pt30">

		<div class="wrap">

			<div class="breadcrumb waypoint animation_bottom">
				<a href="<?php echo HTTP."/".$lang; ?>" title="Home"><?=$_lang[$lang]['inicial'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo HTTP; ?>produtos/<?php echo $lang;?>"><?php echo $_lang[$lang]['menu_produtos']; ?></a>
				<?php if( isset($categoria) ) { ?>
				<i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo HTTP; ?>produtos/<?php echo $categoria."/".$lang; ?>/"><?php echo $catNome; ?></a>
				<?php } ?>
			</div>

			<br>

			<h3 class="waypoint animation_bottom"><?php echo $escolhaCorteTitulo; ?> <?php echo $catNome; ?></h3>

			<div class="columns cortes">

				<div class="column is-2 waypoint animation_left">
					<div class="categorias-produtos">
						<a href="<?php echo HTTP; ?>produtos/beef/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['boi']; ?>">
							<div class="card-icon <?php echo ($categoria=="beef"?"active":""); ?>">
								<img src="<?php echo HTTP; ?>img/icon-beef.png">
							</div>
						</a>
						<a href="<?php echo HTTP; ?>produtos/poultry/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['frango']; ?>">
							<div class="card-icon <?php echo ($categoria=="poultry"?"active":""); ?>">
								<img src="<?php echo HTTP; ?>img/icon-poltry.png">
							</div>
						</a>
						<a href="<?php echo HTTP; ?>produtos/pork/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['porco']; ?>">
							<div class="card-icon <?php echo ($categoria=="pork"?"active":""); ?>">
								<img src="<?php echo HTTP; ?>img/icon-pork.png">
							</div>
						</a>
						<a href="<?php echo HTTP; ?>produtos/fish/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['peixe']; ?>">
							<div class="card-icon <?php echo ($categoria=="fish"?"active":""); ?>">
								<img src="<?php echo HTTP; ?>img/icon-fish.png">
							</div>
						</a>
						<a href="<?php echo HTTP; ?>produtos/lamb/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['cordeiro']; ?>">
							<div style="padding-top: 15px;" class="card-icon <?php echo ($categoria=="lamb"?"active":""); ?>">
								<img src="<?php echo HTTP; ?>img/icon-cordeiro.png">
							</div>
						</a>
						<a href="<?php echo HTTP; ?>produtos/turkey/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['peru']; ?>">
							<div style="padding-top: 12px;" class="card-icon <?php echo ($categoria=="turkey"?"active":""); ?>">
								<img src="<?php echo HTTP; ?>img/icon-peru.png">
							</div>
						</a>
						<a href="<?php echo HTTP; ?>produtos/others-products/<?php echo $lang; ?>" title="<?php echo $_lang[$lang]['peru']; ?>">
							<div style="padding-top: 12px;" class="card-icon <?php echo ($categoria=="others-products"?"active":""); ?>">
								<img src="<?php echo HTTP; ?>img/icon-saco.png">
							</div>
						</a>
					</div>
				</div>

				<div class="column is-4 waypoint animation_top">
					<ul class="list-cortes">
					<?php
					$cont = 1;
					foreach ($qProdutos as $rs)
					{	
						
						$img_thumb = $db->get_var("SELECT arquivo FROM ".$tables['PRODUTOS_IMG']." WHERE ativo=1 AND id_galeria={$rs->id} ORDER BY ordem DESC ");
						
						echo '<li class="'.($cont==1?"active":"").'" data-name="'.$rs->{"titulo_".$lang}.'" data-img="'.HTTP_UPLOADS_IMG.'800x600_'.$img_thumb.'" data-link="'.HTTP."produto/".$rs->permalink."/".$lang.'">'.(empty($rs->{"titulo_".$lang}) ? $rs->titulo_pt : $rs->{"titulo_".$lang}).'</li>';
						if($cont==1){
							$img_inicial  = HTTP_UPLOADS_IMG.'800x600_'.$img_thumb;
							$nome_inicial = $rs->{"titulo_".$lang};
							$permalink_inicial = $rs->permalink;

						}
						$cont++;
					}
					?>
					</ul>
				</div>

				<div class="column is-5 is-offset-1">
					<div class="relative">
						<a href="<?php echo HTTP; ?>produto/<?php echo $permalink_inicial."/".$lang; ?>" class="link_destaque" title="<?php echo $nome_inicial; ?>">
							<div class="seta-down waypoint animation_top"></div>
							<div class="load-img button is-loading waypoint animation_top"></div>
							<div class="has-text-centered card-img waypoint animation_bottom">
								<div><i class="fa fa-search-plus" aria-hidden="true"></i></div>
								<img src="<?php echo $img_inicial; ?>" id="card-img" alt="<?php echo $nome_inicial; ?>">

							</div>
							<div class="titulo_produto waypoint animation_bottom"><?php echo $nome_inicial; ?></div>
						</a>
					</div>
				</div>

			</div>


			<!-- <div class="has-text-centered waypoint animation_bottom">
				<a href="<?php echo HTTP; ?>produto/<?php echo $permalink_inicial."/".$lang; ?>" class="link_destaque botao"> <?php echo $_lang[$lang]['ver_mais']; ?></a>
			</div> -->


			<br><br>
			<div class="line-dotted waypoint animation_bottom"></div>
			<br><br>

			<h1 class="waypoint animation_bottom"><?php echo $_lang[$lang]['todos_os_cortes']; ?></h1>

			<br>

			<div class="columns is-multiline">
			<?php
				$qProdutos2 = $db->get_results("SELECT * FROM ".$tables['PRODUTOS']." WHERE id_grupo = {$cat} and status = 1 ORDER BY ordem ASC");
				foreach ($qProdutos2 as $rs)
				{
					$qCapa = $db->get_row("SELECT * FROM ".$tables['PRODUTOS_IMG']." WHERE id_galeria = {$rs->id}");
			?>
					<div class="column is-4-desktop is-6-mobile waypoint animation_bottom">
						<a href="<?php echo HTTP.'produto/'.$rs->permalink."/".$lang; ?>" class="box_produto box_">
							<div class="card-img-produto">
								
								<div><i class="fa fa-search-plus" aria-hidden="true"></i></div>
								
								<img src="<?php echo HTTP_UPLOADS_IMG."800x600_".$qCapa->arquivo; ?>">
								
							</div>
							<div class="card-nome-produto"><?php echo $rs->{'titulo_'.$lang} == '' ? $rs->titulo_pt : $rs->{'titulo_'.$lang}; ?></div>
						</a>
					</div>
			<?php
				}
			?>
			</div>
			
		</div>

	</section>

	<?php 
	
		$pagAtual 	= $_SERVER['SCRIPT_URI'];
		$pagCompara = HTTP.'produtos/beef/'.$lang;
		$pagSuino   = HTTP.'produtos/pork/'.$lang;
		
		if($pagAtual == $pagCompara) {
			echo '<div class="has-text-centered waypoint animation_bottom">
					<a class="link_destaque botao" href="http://brazilianbeef.org.br/BeefCutsCatalogueDigital.aspx" target="_blank">Catálogo</a>
				</div>
				<br><br><br><br>';
		}
	?>

<section class="chamada-produtos">
		<div class="wrap">

			<h1 class="waypoint animation_bottom"><?php echo $_lang[$lang]['nossos_produtos']; ?></h1>
			<p class="has-text-centered waypoint animation_bottom" > <?php echo $_lang[$lang]['melhores_cortes']; ?></p>
			<br><br>
			<div class="columns">
				<div class="column waypoint animation_right">
					<a href="<?php echo HTTP.'produtos/beef/'.$lang; ?>" class="has-text-centered card-home-produtos">
						<div class="card-icon">
							<img src="<?php echo HTTP; ?>img/icon-beef.png">
						</div>
						<h2><?php echo $_lang[$lang]['boi']; ?></h2>
						<div class="has-text-centered">
							<div class="botao"><?php echo $_lang[$lang]['ver_mais']; ?></div>
						</div>
					</a>
				</div>
				<div class="column waypoint animation_left">
					<a href="<?php echo HTTP.'produtos/poultry/'.$lang; ?>" class="has-text-centered card-home-produtos pork">
						<div class="card-icon">
							<img src="<?php echo HTTP; ?>img/icon-poltry.png">
						</div>
						<h2><?php echo $_lang[$lang]['frango']; ?></h2>
						<div class="has-text-centered">
							<div class="botao"><?php echo $_lang[$lang]['ver_mais']; ?></div>
						</div>
					</a>
				</div>
				<div class="column waypoint animation_bottom">
					<a href="<?php echo HTTP.'produtos/pork/'.$lang; ?>" class="has-text-centered card-home-produtos">
						<div class="card-icon">
							<img src="<?php echo HTTP; ?>img/icon-pork.png">
						</div>
						<h2><?php echo $_lang[$lang]['porco']; ?></h2>
						<div class="has-text-centered">
							<div class="botao"><?php echo $_lang[$lang]['ver_mais']; ?></div>
						</div>
					</a>
				</div>
				<div class="column waypoint animation_bottom">
					<a href="<?php echo HTTP.'produtos/fish/'.$lang; ?>" class="has-text-centered card-home-produtos">
						<div class="card-icon">
							<img src="<?php echo HTTP; ?>img/icon-fish.png">
						</div>
						<h2><?php echo $_lang[$lang]['peixe']; ?></h2>
						<div class="has-text-centered">
							<div class="botao"><?php echo $_lang[$lang]['ver_mais']; ?></div>
						</div>
					</a>
				</div>
				<div class="column waypoint animation_bottom">
					<a href="<?php echo HTTP.'produtos/lamb/'.$lang; ?>" class="has-text-centered card-home-produtos">
						<div class="card-icon" style="padding-top: 15px;">
							<img src="<?php echo HTTP; ?>img/icon-cordeiro.png">
						</div>
						<h2><?php echo $_lang[$lang]['cordeiro']; ?></h2>
						<div class="has-text-centered">
							<div class="botao"><?php echo $_lang[$lang]['ver_mais']; ?></div>
						</div>
					</a>
				</div>
				<div class="column waypoint animation_bottom">
					<a href="<?php echo HTTP.'produtos/turkey/'.$lang; ?>" 
					class="has-text-centered card-home-produtos"
					>
						<div class="card-icon"  style="padding-top: 12px;">
							<img src="<?php echo HTTP; ?>img/icon-peru.png">
						</div>
						<h2><?php echo $_lang[$lang]['peru']; ?></h2>
						<div class="has-text-centered">
							<div class="botao"><?php echo $_lang[$lang]['ver_mais']; ?></div>
						</div>
					</a>
				</div>
				<div class="column waypoint animation_bottom">
					<a href="<?php echo HTTP.'produtos/others-products/'.$lang; ?>" 
					class="has-text-centered card-home-produtos"
					>
						<div class="card-icon"  style="padding-top: 12px;">
							<img src="<?php echo HTTP; ?>img/icon-saco.png">
						</div>
						<h2><?php echo $_lang[$lang]['outros_produtos']; ?></h2>
						<div class="has-text-centered">
							<div class="botao"><?php echo $_lang[$lang]['ver_mais']; ?></div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>




	<!-- <section class="publicidade sub waypoint animation_bottom <?php echo $pagSuino == $pagAtual ? '' : 'is-hidden';?>">
		<div class="wrap">
			<ul class="cycle-slideshow" data-cycle-slides="li" data-cycle-timeout="6000" data-cycle-pause-on-hover="true">
				<div class="cycle-pager"></div>
			<?php foreach ($qPublicidades as $rs)
			{
				if($rs->link)
				{
					$slide = '<a href="http://'.$rs->link.'" target="'.($rs->link?$rs->destino:'').'"><img src="'.HTTP_UPLOADS_IMG.($MOBILE?$rs->imagem_mobile:$rs->imagem).'"></a>';
				}
				else
				{
					$slide = '<img src="'.HTTP_UPLOADS_IMG.($MOBILE?$rs->imagem_mobile:$rs->imagem).'">';
				}
			?>
				<li><?php echo $slide; ?></li>
		    <?php } ?>
			</ul>
		</div>
	</section> -->

<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php get_footer(); ?>