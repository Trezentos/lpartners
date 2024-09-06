<?php 
$FriendURL = returnFriendyURL();

$ativarTag = true;

// INF DO PRODUTO
$produto   = antiSQL($FriendURL[1]);
$qProduto  = $db->get_row("SELECT * FROM ".$tables['PRODUTOS']." WHERE permalink='{$produto}'");
$qGaleria  = $db->get_results("SELECT * FROM ".$tables['PRODUTOS_IMG']." WHERE ativo=1 AND id_galeria={$qProduto->id} ORDER BY capa DESC, ordem ASC");
$qImgCapa  = $db->get_row("SELECT * FROM ".$tables['PRODUTOS_IMG']." WHERE ativo=1 AND id_galeria='{$qProduto->id}' ORDER BY capa DESC");

// PRODUTOS RELACIONADOS
// $qProdRel = $db->get_results("SELECT * FROM ".$tables['PRODUTOS_RELACIONADOS']." WHERE pai_id = '{$qProduto->id}' ORDER BY filho_id ASC");
// $db->debug();


$imgDestaque  = HTTP_UPLOADS_IMG.'tb_'.$qImgCapa->arquivo;
$title_share  = $qProduto->titulo;
$desc_share   = get_nome_categoria_produtos($qProduto->id_grupo, $lang);
$permalink_cat= get_permalink_categoria_produtos($qProduto->id_grupo);


add_style(array('css/jquery.fancybox.css'));
add_javascript(array('jquery.cycle2.carousel.min.js', 'jquery.jcarousel.min.js', 'jquery.pikachoose.js', 'jquery.fancybox.pack.js', 'page.produto.js'));
get_header(); ?>

	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56af8a2bc873af5b"></script>

	<section class="banner_sub produtos waypoint animation_bottom is-hidden-mobile">
		<div class="wrap">
			<h1><?php echo $_lang[$lang]['nossos_produtos']; ?></h1>
		</div>
	</section>



	<section class="wrap produto">

		<div class="breadcrumb waypoint animation_bottom">
			<a href="<?php echo HTTP; ?>" title="Home"><?=$_lang[$lang]['inicial'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo HTTP; ?>produtos/<?php echo $permalink_cat; ?>"><?=	$_lang[$lang]['menu_produtos'];?></a>
			<i class="fa fa-angle-right" aria-hidden="true"></i> <span><?=$desc_share?></span>
		</div>
	

		<h1 class="titulo_produto waypoint animation_bottom"><?php echo $qProduto->{"titulo_".$lang}; ?></h1>
		<hr class="linha_prod waypoint animation_bottom">
		<div class="categoria waypoint animation_bottom">
			<?php echo get_nome_categoria_produtos($qProduto->id_grupo, $lang); ?>
		</div>



		<div class="descricao">
			<div class="galeria">
				<div class="gal">
					<ul>
					<?php foreach ($qGaleria AS $rs) { ?>
						<li><a href="<?php echo HTTP_UPLOADS_IMG.'800x600_'.$rs->arquivo; ?>" rel="gal" title="<?php echo $qProduto->titulo;?>">
								<img title="<?php echo $qProduto->titulo; ?>" src="<?php echo HTTP_UPLOADS_IMG.'800x600_'.$rs->arquivo; ?>"/>
							</a>
						</li>
					<?php } ?>
					</ul>
				</div>

				<?php 
				if( count($qGaleria) > 1 )
				{
					foreach ($qGaleria AS $rs){
				?>
						<a class="fancybox" href="<?php echo HTTP_UPLOADS_IMG.'800x600_'.$rs->arquivo; ?>" rel="gal"></a>
				<?php
					}
				}
				?>

				<?php if( $qProduto->video_url ){ ?>
					<div class="clear"></div>
					<br><br>
					<h1 class="has-text-left">VÍDEO</h1>
					<iframe width="535" height="360" src="http://www.youtube.com/embed/<?=$qProduto->video_url?>" frameborder="0" allowfullscreen></iframe>
				<?php } ?>
			</div>

			<div class="desc waypoint animation_bottom">
				<h2><?php echo $_lang[$lang]['descricao']; ?></h2>
				<hr class="linha_prod">
				
				<?php echo stripcslashes($qProduto->{"descricao_".$lang}); ?>

				<div class="clear"></div>

				<br>
				<hr class="linha_prod">
				<br>

				<!-- Go to www.addthis.com/dashboard to customize your tools -->
				<p style="margin-bottom: 10px;"><?php echo $_lang[$lang]['compartilhar']; ?></p>
				<div class="addthis_sharing_toolbox"></div>
			</div>
		</div>

		<br>

		<div class="has-text-centered">
			<a href="<?php echo HTTP; ?>produtos/<?php echo $permalink_cat; ?>" class="botao waypoint animation_bottom"><?php echo $_lang[$lang]['voltar']; ?></a>
		</div>

	</section>



	<?php if($qProdRel){ ?>
	<section class="nossos_produtos">
		<div class="wrap">
			<h1 class="waypoint animation_bottom menor">PRODUTOS RELACIONADOS</h1>
			<br>
			<br class="no_mobile">

			<div class="columns is-multiline waypoint animation_bottom">
			<?php
				foreach ($qProdRel as $rel)
				{
					$qProdRel = $db->get_row("SELECT * FROM ".$tables['PRODUTOS']." WHERE id = '{$rel->filho_id}'");
					$qCapa = $db->get_row("SELECT * FROM ".$tables['PRODUTOS_IMG']." WHERE ativo = 1 AND id_galeria = {$qProdRel->id} ORDER BY capa DESC");
			?>
					<div class="column is-3 waypoint animation_bottom">
						<a href="<?php echo HTTP.'produto/'.$qProdRel->permalink ?>" class="box_categorias">
							<img src="<?php echo HTTP_UPLOADS_IMG."800x600_".$qCapa->arquivo?>">
							<div class="box_itens">
								<h2 class="linha">MOTOMIL</h2>
								<h1><?=$qProdRel->{"titulo_".$lang}?></h1>
								<div class="categoria"><?=get_nome_categoria_produtos($qProdRel->id_grupo)?></div>
							</div>
							<div class="icon-more"><i class="fa fa-plus" aria-hidden="true"></i></div>
						</a>
					</div>
			<?php
				}
			?>
			</div>
			<br><br>
			<a href="<?php echo HTTP; ?>produtos" class="botao waypoint animation_bottom">MAIS PRODUTOS</a>
		</div>
	</section>
	<?php
		}
	?>

	<br><br><br>
<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php get_footer(); ?>