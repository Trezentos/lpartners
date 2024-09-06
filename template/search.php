<?php
require(PHP.'classes/Class.paginacao.cliente.php');

$busca = antiSQL($_GET["q"]);

if($busca)
{
	$_GET["page"] = antiSQL($_GET["page"]);
	$_GET["ipp"]  = antiSQL($_GET["ipp"]);

	$campo = "titulo_".$lang;

	// PRODUTOS
	// $countProdutos = $db->get_var("SELECT COUNT(id) FROM ".$tables['PRODUTOS']." WHERE {$campo} LIKE '%{$busca}%' AND status=1");
	// $qProdutos     = $db->get_results("SELECT * FROM ".$tables['PRODUTOS']." WHERE status=1 AND {$campo} LIKE '%{$busca}%' ORDER BY {$campo} ASC");
	$qProdutos = $db->get_results("SELECT * FROM ".$tables['PRODUTOS']." WHERE status=1 AND {$campo} LIKE '%{$busca}%' ORDER BY {$campo} ASC".$navbar->limit);
	$countProdutos = count($qProdutos);

	if ($countProdutos>0)
	{
		$navbar = new Paginator;
		$navbar->items_total = $countProdutos;
		$navbar->mid_range = 2;
		$navbar->items_per_page = 30;
		$navbar->link = HTTP.'busca/'.($FriendURL[1]!=""?$FriendURL[1]."/":"");
		$navbar->paginate();
	}
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
				<?php echo $_lang[$lang]['produtos_encontrados']; ?>: <?php echo $countProdutos; ?>
			</div>
		</div>
	</section>


	<section class="nossos-produtos sub pt10 mt30">
		<div class="wrap has-text-centered">
			<div class="columns is-multiline mt50">
			<?php
				foreach ($qProdutos as $rs)
				{
					$qCapa = $db->get_row("SELECT * FROM ".$tables['PRODUTOS_IMG']." WHERE ativo=1 AND id_galeria={$rs->id} ORDER BY capa DESC");
			?>
					<div class="column is-4 waypoint animation_bottom">
						<a href="<?php echo HTTP.'produto/'.$rs->permalink.'/'.$lang; ?>" class="box_produto">
							<div class="card-img-produto">
								<div><i class="fa fa-search-plus" aria-hidden="true"></i></div>
								<img src="<?php echo HTTP_UPLOADS_IMG."800x600_".$qCapa->arquivo; ?>">
							</div>
							<div class="card-nome-produto"><?php echo $rs->{"titulo_".$lang}; ?></div>
						</a>
					</div>
			<?php
				}
			?>
			</div>

	
			<?php if ($navbar->num_pages>1) {?>
			<div class="pagination ">
				<?php echo $navbar->display_pages() ?>
			</div>
			<?php } ?>

		</div>
	</section>

<?php get_footer(); ?>