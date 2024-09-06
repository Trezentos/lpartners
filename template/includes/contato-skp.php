<div class="pg-layer-contact">
	<?php
		$qSourcing     = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%2%' AND status=1");
		$qAmericas     = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%3%' AND status=1");
		$qOrienteMedio = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%4%' AND status=1");
		$qAfrica	   = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%5%' AND status=1");
		$qCIS		   = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%6%' AND status=1");
		$qAsia		   = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%7%' AND status=1");
		$qCaribe	   = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%8%' AND status=1");
		$qMercosul	   = $db->get_results("SELECT * FROM ".$tables['MERCADOS']." WHERE segmentos LIKE '%9%' AND status=1");

		$count = 0;
	?>


		<div class="pg-layer-body">
			<div class="pg-layer-head">
				<i class="fa fa-skype" aria-hidden="true"></i>
				<?=$_lang[$lang]['skype_contato'];?>
			</div>

			<div class="pg-sub-header"><?=$_lang[$lang]['suprimentos_skype'];?></div>
			<?php foreach($qSourcing as $rs) : ?>
			<div class="pg-list-item" id="<?php echo $count;?>">
				<h3><?= $rs->titulo ?></h3>
				<i class="fa fa-arrow-right arrow-right" aria-hidden="true"></i>
				<i class="fa fa-arrow-down arrow-down pg-hidden" aria-hidden="true"></i>
			</div>
			<div class="pg-list-info pg-hidden">
				<div class="pg-mail">
					<span>E-mail: </span>
					<a href="mailto:<?= $rs->email ?>"><?= str_replace('lp', 'LP', $rs->email); ?></a>
				</div>
				<div class="pg-telefone">
					<span><?=$_lang[$lang]['telefone']?> </span>
					<a href="callto:<?= trim($rs->telefone) ?>"><?= $rs->telefone ?></a>
				</div>
				<div class="pg-skype">
					<a class="btn-skype" href="skype:<?= $rs->skype?>"><i class="fa fa-skype" aria-hidden="true"></i> Skype directly</a>
				</div>
			</div>
			<?php 
			$count++;
			endforeach; ?>



			<div class="pg-sub-header"><?=$_lang[$lang]['africa_skype'];?></div>
			<?php foreach($qAfrica as $rs) : ?>
			<div class="pg-list-item" id="<?php echo $count; ?>">
				<h3><?= $rs->titulo ?></h3>
				<i class="fa fa-arrow-right arrow-right" aria-hidden="true"></i>
				<i class="fa fa-arrow-down arrow-down pg-hidden" aria-hidden="true"></i>

			</div>
			<div class="pg-list-info pg-hidden">
				<div class="pg-mail">
					<span>E-mail: </span>
					<a href="mailto:<?= $rs->email ?>"><?= str_replace('lp', 'LP', $rs->email); ?></a>
				</div>
				<div class="pg-telefone">
					<span><?=$_lang[$lang]['telefone']?> </span>
					<a href="callto:<?= trim($rs->telefone) ?>"><?= $rs->telefone ?></a>
				</div>
				<div class="pg-skype">
					<a class="btn-skype" href="skype:<?=$rs->skype?>"><i class="fa fa-skype" aria-hidden="true"></i> Skype directly</a>
				</div>
			</div>
			<?php $count++; ?>
			<?php endforeach; ?>


			<div class="pg-sub-header"><?=$_lang[$lang]['asia_skype'];?></div>
			<?php foreach($qAsia as $rs) : ?>
			<div class="pg-list-item" id="<?php echo $count; ?>">
				<h3><?= $rs->titulo ?></h3>
				<i class="fa fa-arrow-right arrow-right" aria-hidden="true"></i>
				<i class="fa fa-arrow-down arrow-down pg-hidden" aria-hidden="true"></i>
			</div>
			<div class="pg-list-info pg-hidden">
				<div class="pg-mail">
					<span>E-mail: </span>
					<a href="mailto:<?= $rs->email ?>"><?= str_replace('lp', 'LP', $rs->email); ?></a>
				</div>
				<div class="pg-telefone">
					<span><?=$_lang[$lang]['telefone']?> </span>
					<a href="callto:<?= trim($rs->telefone) ?>"><?= $rs->telefone ?></a>
				</div>
				<div class="pg-skype">
					<a class="btn-skype" href="skype:<?= $rs->skype?>"><i class="fa fa-skype" aria-hidden="true"></i> Skype directly</a>
				</div>
			</div>
			<?php $count++ ?>
			<?php endforeach; ?>



			<div class="pg-sub-header"><?=$_lang[$lang]['caribe_skype'];?></div>
			<?php foreach($qCaribe as $rs) : ?>
			<div class="pg-list-item" id="<?php echo $count; ?>">
				<h3><?= $rs->titulo ?></h3>
				<i class="fa fa-arrow-right arrow-right" aria-hidden="true"></i>
				<i class="fa fa-arrow-down arrow-down pg-hidden" aria-hidden="true"></i>
			</div>
			<div class="pg-list-info pg-hidden">
				<div class="pg-mail">
					<span>E-mail: </span>
					<a href="mailto:<?= $rs->email ?>"><?= str_replace('lp', 'LP', $rs->email); ?></a>
				</div>
				<div class="pg-telefone">
					<span><?=$_lang[$lang]['telefone']?> </span>
					<a href="callto:<?= trim($rs->telefone) ?>"><?= $rs->telefone ?></a>
				</div>
				<div class="pg-skype">
					<a class="btn-skype" href="skype:<?= $rs->skype?>"><i class="fa fa-skype" aria-hidden="true"></i> Skype directly</a>
				</div>
			</div>
			<?php $count++ ?>
			<?php endforeach; ?>


			<div class="pg-sub-header"><?=$_lang[$lang]['cis_eu_ru_skype'];?></div>
			<?php foreach($qCIS as $rs) : ?>
			<div class="pg-list-item" id="<?php echo $count; ?>">
				<h3><?= $rs->titulo ?></h3>
				<i class="fa fa-arrow-right arrow-right" aria-hidden="true"></i>
				<i class="fa fa-arrow-down arrow-down pg-hidden" aria-hidden="true"></i>
			</div>
			<div class="pg-list-info pg-hidden">
				<div class="pg-mail">
					<span>E-mail: </span>
					<a href="mailto:<?= $rs->email ?>"><?= str_replace('lp', 'LP', $rs->email); ?></a>
				</div>
				<div class="pg-telefone">
					<span><?=$_lang[$lang]['telefone']?> </span>
					<a href="callto:<?= trim($rs->telefone) ?>"><?= $rs->telefone ?></a>
				</div>
				<div class="pg-skype">
					<a class="btn-skype" href="skype:<?= $rs->skype?>"><i class="fa fa-skype" aria-hidden="true"></i> Skype directly</a>
				</div>
			</div>
			<?php $count++ ?>
			<?php endforeach; ?>



			<div class="pg-sub-header"><?=$_lang[$lang]['mercosul_skype'];?></div>
			<?php foreach($qMercosul as $rs) : ?>
			<div class="pg-list-item" id="<?php echo $count; ?>">
				<h3><?= $rs->titulo ?></h3>
				<i class="fa fa-arrow-right arrow-right" aria-hidden="true"></i>
				<i class="fa fa-arrow-down arrow-down pg-hidden" aria-hidden="true"></i>
			</div>
			<div class="pg-list-info pg-hidden">
				<div class="pg-mail">
					<span>E-mail: </span>
					<a href="mailto:<?= $rs->email ?>"><?= str_replace('lp', 'LP', $rs->email); ?></a>
				</div>
				<div class="pg-telefone">
					<span><?=$_lang[$lang]['telefone']?> </span>
					<a href="callto:<?= trim($rs->telefone) ?>"><?= $rs->telefone ?></a>
				</div>
				<div class="pg-skype">
					<a class="btn-skype" href="skype:<?= $rs->skype?>"><i class="fa fa-skype" aria-hidden="true"></i> Skype directly</a>
				</div>
			</div>
			<?php $count++ ?>
			<?php endforeach; ?>



			<div class="pg-sub-header"><?=$_lang[$lang]['orientem_skype'];?></div>
			<?php foreach($qOrienteMedio as $rs) : ?>
			<div class="pg-list-item" id="<?php echo $count; ?>">
				<h3><?= $rs->titulo ?></h3>
				<i class="fa fa-arrow-right arrow-right" aria-hidden="true"></i>
				<i class="fa fa-arrow-down arrow-down pg-hidden" aria-hidden="true"></i>
			</div>
			<div class="pg-list-info pg-hidden">
				<div class="pg-mail">
					<span>E-mail: </span>
					<a href="mailto:<?= $rs->email ?>"><?= str_replace('lp', 'LP', $rs->email); ?></a>
				</div>
				<div class="pg-telefone">
					<span><?=$_lang[$lang]['telefone']?> </span>
					<a href="callto:<?= trim($rs->telefone) ?>"><?= $rs->telefone ?></a>
				</div>
				<div class="pg-skype">
					<a class="btn-skype" href="skype:<?= $rs->skype?>"><i class="fa fa-skype" aria-hidden="true"></i> Skype directly</a>
				</div>
			</div>
			<?php $count++ ?>
			<?php endforeach; ?>

		</div>

	</div>