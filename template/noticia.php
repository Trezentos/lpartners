<?php
$ativarTag = true;
$FriendURL = returnFriendyURL();
$qNoticia  = $db->get_row("SELECT * FROM ".$tables['NOTICIAS']." WHERE status=1 AND permalink='{$FriendURL[1]}'");

$qImgCapa  = $db->get_row("SELECT * FROM ".$tables['NOTICIAS_IMG']." WHERE ativo=1 AND id_galeria='{$qNoticia->id}' ORDER BY capa DESC");

$qImagens  = $db->get_results("SELECT * FROM ".$tables['NOTICIAS_IMG']." WHERE ativo=1 AND id_galeria='{$qNoticia->id}'");

// $qCategorias = $db->get_results("SELECT * FROM ".$tables['BLOG_CATEGORIAS']);
// $qNotCategorias = $db->get_results("SELECT categorias FROM ".$tables['NOTICIAS']." GROUP BY categorias");
// foreach ($qNotCategorias as $rs) {
// 	$todasCat.= $rs->categorias;
// }


$categoria = get_categorias_values($qNoticia->categorias);
$cat_permalink = get_permalink_categoria_blog($qNoticia->categorias);

$imgDestaque = HTTP_UPLOADS_IMG.'tb_'.$qImgCapa->arquivo;
$title_share = $qNoticia->{"titulo_".$lang};
$desc_share  = $qNoticia->{"resumo_".$lang};

$titulo = $qNoticia->{"titulo_".$lang}." - ".$empresa;

add_style(array('css/jquery.fancybox.css'));
add_javascript(array('jquery.fancybox.pack.js','page.noticia.js'));
get_header();
?>
	<section class="banner_sub blog waypoint animation_bottom is-hidden-mobile">
		<div class="wrap">
			<!-- <h1><?php echo $_lang[$lang]['nosso_blog']; ?></h1> -->
		</div>
	</section>

	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56af8a2bc873af5b"></script>

	<section class="wrap blog sub entry">
		<div class="breadcrumb waypoint animation_bottom">
			<a href="<?php echo HTTP; ?>" title="Home"><?=$_lang[$lang]['inicial'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> 
			<a href="<?php echo HTTP; ?>blog/">BLOG</a> <i class="fa fa-angle-right" aria-hidden="true"></i> 
			<a href="<?php echo HTTP; ?>blog/<?php echo $cat_permalink; ?>"><?php echo $categoria;?></a>
		</div>


		<div class="columns">
			<div class="column is-2 has-text-centered">

				<h5 class="compartilhe waypoint animation_left"><?php echo $_lang[$lang]['compartilhar']; ?></h5>

				<div class="list-redes waypoint animation_left">
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo HTTP."post/".$qNoticia->permalink; ?>" title="Compartilhar no Facebook" target="_blank">
						<div class="card-icon">
							<i class="fa fa-facebook" aria-hidden="true"></i>
						</div>
					</a>
					<a href="https://www.twitter.com/intent/tweet?text=<?php echo $titulo;?>&url=<?php echo HTTP."post/".$qNoticia->permalink; ?>" title="Compartilhar no Twitter" target="_blank">
						<div class="card-icon">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</div>
					</a>
					<a href="https://web.whatsapp.com/send?text=<?php echo $titulo;?> - Link: <?php echo HTTP."post/".$qNoticia->permalink; ?>" title="Compartilhar no Whatsapp" target="_blank">
						<div class="card-icon">
							<i class="fa fa-whatsapp" aria-hidden="true"></i>
						</div>
					</a>
					<a href="https://www.addthis.com/tellfriend_v2.php?v=300&winname=addthis&pub=ra-56af8a2bc873af5b&source=tbx-300&lng=pt&s=email&url=<?php echo HTTP.'post/'.$qNoticia->permalink; ?>&title=<?php echo $titulo; ?>&ate=AT-ra-56af8a2bc873af5b/-/-/5b30fe1a66a722f0/2&uid=5b1eb750fe2504c0&description=&uud=1&ct=1&ui_email_to=&ui_email_from=&ui_email_note=&pre=<?php echo HTTP.'blog/'; ?>&tt=0&captcha_provider=recaptcha2&pro=0&ats=&atc=username%3Dra-56af8a2bc873af5b%26services_exclude%3D%26services_exclude_natural%3D%26services_compact%3Dfacebook%252Ctwitter%252Cprint%252Cgoogle_plusone_share%252Cemail%252Cgmail%252Clinkedin%252Cfavorites%252Cpinterest_share%252Cblogger%252Cmore%26product%3Dtbx-300%26widgetId%3Dundefined%26pubid%3Dra-56af8a2bc873af5b%26ui_pane%3Demail&rb=false" title="Enviar por E-mail" target="_blank">
						<div class="card-icon">
							<i class="fa fa-envelope-o" aria-hidden="true"></i>
						</div>
					</a>
				</div>


			</div>
			<div class="column is-8">

				<article>
					<h1><?php echo $qNoticia->{"titulo_".$lang}; ?></h1>

					<div class="data">
						<div class="floatL">
							<?php echo date("d",strtotime($qNoticia->data)); ?> DE <?php echo $meses[date("n",strtotime($qNoticia->data))-1]; ?> DE <?php echo date("Y",strtotime($qNoticia->data)); ?>
						</div>
						<a href="<?php echo HTTP.'blog/'?>" class="floalR">
							<i class="fa fa-angle-left" aria-hidden="true"></i> <?php echo $_lang[$lang]['voltar']; ?>
						</a>
					</div>

					<?php if( $qImgCapa ){ ?>
						<img class="hide" src="<?php echo HTTP_UPLOADS_IMG.'800x600_'.$qImgCapa->arquivo; ?>" alt="<?php echo ($qImgCapa->legenda?$qImgCapa->legenda:$qNoticia->{"titulo_".$lang}); ?>">
					<?php } ?>

					<br>

					<?php if( $qNoticia->video_url ){ ?>
						<iframe width="100%" height="460" src="http://www.youtube.com/embed/<?=$qNoticia->video_url?>" frameborder="0" allowfullscreen></iframe>
						<br><br>
					<?php } ?>


					<div class="conteudo"><?php echo nl2br($qNoticia->{"conteudo_".$lang}); ?></div>

					<div id="galeria">
						<ul>
							<?php foreach ($qImagens as $rs) { ?>
							<li>
								<a class="fancybox" rel="img" href="<?php echo HTTP_UPLOADS_IMG.'800x600_'.$rs->arquivo?>" title="<?php echo ($rs->legenda ? $rs->legenda : $qNoticia->{"titulo_".$lang} ) ?>">
									<img src="<?php echo HTTP_UPLOADS_IMG.'tb_'.$rs->arquivo; ?>" width="230" alt="<?php echo ($rs->legenda ? $rs->legenda : $qNoticia->{"titulo_".$lang} ) ?>">
									<div class="over desktop_only">
										<span class="icon is-large"><i class="fa fa-plus-circle fa-5x" aria-hidden="true"></i></span>
									</div>
								</a>
							</li>
							<?php } ?>
							<div style="clear: both;"></div>
						</ul>
					</div>
					<br><br>
					<!-- Go to www.addthis.com/dashboard to customize your tools -->
					<p style="margin-bottom: 10px;"><?php echo $_lang[$lang]['compartilhar']; ?></p>
					<div class="addthis_sharing_toolbox"></div>

				</article>

			</div>
		</div>

		<br>
	</section>

<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php get_footer(); ?>
