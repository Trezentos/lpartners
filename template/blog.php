<?php

require(PHP.'classes/Class.paginacao.cliente.php');

if( !empty($_GET["busca"]) )
{
	$busca = antiSQL($_GET["busca"]);
	$WHERE = ' AND titulo_pt LIKE "%'.$busca.'%"';
}

$FriendURL = returnFriendyURL();

if( !empty($FriendURL[1]) )
{
	$idCat   = get_id_categoria_blog( $FriendURL[1] );
	$descCat = " / ".get_categorias_values($idCat);
}

$qCategorias = $db->get_results("SELECT * FROM ".$tables['BLOG_CATEGORIAS']);
$qNotCategorias = $db->get_results("SELECT categorias FROM ".$tables['NOTICIAS']." GROUP BY categorias");

foreach ($qNotCategorias as $rs) {
	$todasCat.= $rs->categorias;
}

//$db->debug();


if($idCat)
{
	$count = $db->get_var("SELECT COUNT(*) FROM ".$tables['NOTICIAS']." WHERE status=1 AND data<=CURDATE() AND categorias LIKE '%{$idCat}%'".$WHERE);
}else{
	$count = $db->get_var("SELECT COUNT(*) FROM ".$tables['NOTICIAS']." WHERE status=1 AND data<=CURDATE()".$WHERE);
}

//$db->debug();

if ($count>0) {
	$navbar = new Paginator;
	$navbar->items_total = $count;
	$navbar->mid_range = 2;
	$navbar->items_per_page = 6;
	$navbar->link = HTTP.'blog';
	$navbar->paginate();

	if($idCat)
	{
		$qNoticias = $db->get_results("SELECT * FROM ".$tables['NOTICIAS']." WHERE status=1 AND data<=CURDATE() AND categorias LIKE '%{$idCat}%' {$WHERE} ORDER BY data DESC ".$navbar->limit);
	}else{
		$qNoticias = $db->get_results("SELECT * FROM ".$tables['NOTICIAS']." WHERE status=1 AND data<=CURDATE() {$WHERE} ORDER BY data DESC ".$navbar->limit);
	}
}

get_header();
?>
	<section class="banner_sub blog waypoint animation_bottom is-hidden-mobile">
		<div class="wrap">
			<!-- <h1><?php echo $_lang[$lang]['nosso_blog']; ?> <?=$descCat; ?></h1> -->
		</div>
	</section>



	<section class="wrap sub blog">
		<div class="breadcrumb waypoint animation_bottom">
			<a href="<?php echo HTTP; ?>" title="Home"><?=$_lang[$lang]['inicial'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo HTTP; ?>blog/">BLOG</a>
		</div>


		<div class="columns">

			<div class="column is-8">

			<?php if ($count > 0)
			{
				foreach ($qNoticias as $rs)
				{
					$qCapa = $db->get_row("SELECT * FROM ".$tables['NOTICIAS_IMG']." WHERE ativo=1 AND id_galeria={$rs->id} ORDER BY capa DESC");
			?>
					<article>
						<h1 class=""><?php echo $rs->{"titulo_".$lang}; ?></h1>
						
						<div class="box_imagem_noticia">
							<a href="<?php echo HTTP.'post/'.$rs->permalink."/".$lang; ?>" class="hover_green">
								<div><span class="icon is-large"><i class="fa fa-plus-circle fa-5x" aria-hidden="true"></i></span></div><?php echo $_lang[$lang]['saiba_mais']; ?>
							</a>
							<img src="<?php echo isset($qCapa->arquivo) ? HTTP_UPLOADS_IMG.'800x600_'.$qCapa->arquivo : HTTP.'img/post_sem_foto.jpg';?>" alt="<?php echo ($qCapa->legenda?$qCapa->legenda:$rs->{"titulo_".$lang}); ?>">
						</div>
						

						<div class="resumo"><?php echo $rs->{"resumo_".$lang}; ?></div>
						<div class="data">
							<!-- <div class="floatL">
								<i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("d",strtotime($rs->data)); ?> DE <?php echo $meses[date("n",strtotime($rs->data))-1]?> DE <?php echo date("Y",strtotime($rs->data))?>
							</div> -->
							<a href="<?php echo HTTP.'post/'.$rs->permalink."/".$lang; ?>" class="floalR">
								<?php echo $_lang[$lang]['saiba_mais']; ?> <i class="fa fa-angle-right" aria-hidden="true"></i>
							</a>
						</div>
					</article>

					<hr class="hr_blog ">

			<?php   }
				} else {
			?>
			<h3>Nenhum registro encontrado!</h3>
			<?php } if ($qNoticias != '' && $count > 6 && $navbar->num_pages > 1) { ?>

				<div class="pagination">
					<?php echo $navbar->display_pages(); ?>
				</div>
				<?php } ?>

				<br>
			</div>

			<div class="column is-3 is-offset-1 categorias">
				<h3 class="waypoint animation_right"><?php echo $_lang[$lang]['categorias']; ?></h3>

				<form action="" class="waypoint animation_right">
					<button id="bt_busca" class="botao"><i class="fa fa-search" aria-hidden="true"></i></button>
					<input type="text" name="busca" id="busca" value="<?=$_GET["busca"]?>" placeholder="<?php echo $_lang[$lang]['buscar']; ?>">
				</form>

				<?php
					foreach ($qCategorias as $rs)
					{
						if ( strpos($todasCat,$rs->id) === FALSE ) {
							//nao localizou a categoria
						}else{
							echo '<a href="'.HTTP.'blog/'.$rs->permalink.'" class="waypoint animation_right list-categorias"><i class="fa fa-caret-right" aria-hidden="true"></i> '.$rs->{'categoria_'.$lang}.'</a>';
						}
					}
					echo '<a href="'.HTTP.'blog/" class="waypoint animation_right list-categorias"><i class="fa fa-caret-right" aria-hidden="true"></i>'.$_lang[$lang]['btn_todas'].'</a>';
				?>
			</div>
		</div>

	</section>

	<br><br><br>
<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php get_footer(); ?>