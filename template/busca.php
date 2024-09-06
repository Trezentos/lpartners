<?php
require(PHP.'classes/Class.paginacao.cliente.php');

$busca = antiSQL($_GET["q"]);

if($busca)
{
	
	$campo = "titulo_".$lang;
	$resumo = "resumo_".$lang;

	// PRODUTOS
	// $qProdutos     = $db->get_results("SELECT * FROM ".$tables['PRODUTOS']." WHERE status=1 AND {$campo} LIKE '%{$busca}%' ORDER BY {$campo} ASC");
	
	$qProdutos = $db->get_results("SELECT * FROM ".$tables['PRODUTOS']." WHERE status=1 AND titulo_pt LIKE '%{$busca}%' OR titulo_en LIKE '%{$busca}%' or titulo_es LIKE '%{$busca}%' ORDER BY {$campo} ASC");
	$qNoticias = $db->get_results("SELECT * FROM ".$tables['NOTICIAS']." WHERE status=1 AND {$campo} LIKE '%{$busca}%' OR {$resumo} LIKE '%{$busca}%' ORDER BY data_criacao ASC");

	$countProdutos = count($qProdutos);
	$countNoticias = count($qNoticias);
}

get_header();
?>

	<section class="banner_sub waypoint animation_bottom is-hidden-mobile">
		<div class="wrap">
			<h1><?php echo $_lang[$lang]['busca_produtos']; ?> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $busca; ?></h1>
		</div>
	</section>


	<section class="wrap">
		<div class="breadcrumb waypoint animation_bottom">
			<a href="<?php echo HTTP.$lang; ?>" title="Home"><?=$_lang[$lang]['inicial'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo HTTP; ?>busca/"><?php echo $_lang[$lang]['busca']; ?></a>
		</div>
		<br>
	
		<div class="columns waypoint animation_bottom">
			<div class="column">
				<h2 class="maior"><?php echo $_lang[$lang]['resultado_busca']; ?>: <strong>"<?php echo $busca; ?>"</strong></h2>
			</div>
			<div class="column has-text-right">
				<?php echo $_lang[$lang]['produtos_encontrados']. ':'. $countProdutos; ?>
			</div>
		</div>
	</section>


	<section class="nossos-produtos sub pt10 mt30">
		<div class="wrap">
			
			<div class="columns is-multiline">
				<?php if($countProdutos > 0) : ?>
					<?php 
					foreach ($qProdutos as $rs) : 
						$qCapa = $db->get_var("SELECT arquivo FROM ".$tables['PRODUTOS_IMG']." WHERE id_galeria = {$rs->id}");
					?>
						<div class="column is-3-desktop is-6-mobile waypoint animation_bottom">
							<a href="<?php echo HTTP.'produto/'.$rs->permalink."/".$lang; ?>" class="box_produto box_pesquisa">
								<div class="card-img-produto">
									
									<div><i class="fa fa-search-plus" aria-hidden="true"></i></div>
									
									<img src="<?php echo HTTP_UPLOADS_IMG."800x600_".$qCapa; ?>">
									
								</div>
								<div class="card-nome-produto"><?php echo $rs->{'titulo_'.$lang} == '' ? $rs->titulo_pt : $rs->{'titulo_'.$lang}; ?></div>
							</a>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="column has-text-left">
						<h2><?=$_lang[$lang]['nenhum_produto_encontrado']?></h2>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<div class="line"></div>

	<section class="nossos-produtos sub pt10 mt30">
		<div class="wrap">
			<div class="columns waypoint animation_bottom">
				<div class="column">
					<h2 class="maior"><?php echo $_lang[$lang]['resultado_busca']; ?>: <strong>"<?php echo $busca; ?>"</strong></h2>
				</div>
				<div class="column has-text-right">
					<?php echo $_lang[$lang]['noticias_encontradas'].':'. $countNoticias; ?>
				</div>
			</div>

			<?php if($countNoticias > 0) : ?>
						
				<?php foreach ($qNoticias as $rs) : ?>
						
					<a href="<?php echo HTTP.'post/'.$rs->permalink.'/'.$lang; ?>" class="box_produto">
						
						<div class="card-nome-produto"><?php echo $rs->{"titulo_".$lang}; ?></div>
					</a>
						
				<?php endforeach; ?>
			
			<?php else : ?>
				<div class="column has-text-left">
					<h2><?=$_lang[$lang]['nenhuma_noticia_encontrada']?></h2>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php get_footer(); ?>