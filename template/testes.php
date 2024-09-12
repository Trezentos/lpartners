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

<!-- BANNER -->
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
				L TRACKING
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

    
    <div id="no-template-pager" class="cycle-pager external">
        <?php foreach($qBanners as $rs) : ?>
        <img src="<?=HTTP_UPLOADS_IMG.($MOBILE?$rs->imagem_mobile:$rs->imagem)?>" width=120 height=120>
        <?php endforeach; ?>
    </div>
    
    
<?php get_footer(); ?>