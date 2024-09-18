<?php

add_javascript(array('nossos-escritorios.js','jquery.cycle2.min.js', 'owl.carousel.min.js'));



?>


	<section class="escritorios">
		<div class="wrap has-text-centered">

			<h1 class="waypoint animation_bottom"><?=$_lang[$lang]['nossos_escritorios']; ?></h1>

			<div class="is-flex escritorios-carrousel owl-carousel owl-theme ">
				<div class=" montevideo waypoint animation_left">

					<div id="clock-uruguai"></div>

					<div class="card-escritorio">
						<div class="card-escritorio-top">
							<h4><?= $_lang[$lang]['montevideo_contato'];?></h4>

							<?php if($permalink!="home"){?>
							<!-- <select id="select-brasil" name="select-brasil">
								<option value="1"><?=$_lang[$lang]['diretor_comercial'];?></option>
								<option value="2"><?=$_lang[$lang]['gerente_de_compras'];?></option>
								<option value="3"><?=$_lang[$lang]['cargo_vendas_af_ca'];?></option>
								<option value="7"><?=$_lang[$lang]['cargo_vendas_ame_sul'];?></option>
								<option value="4"><?=$_lang[$lang]['cargo_ger_adm_log'];?></option>
								<option value="5"><?=$_lang[$lang]['cargo_coo_log_doc'];?></option>
								<option value="6"><?=$_lang[$lang]['cargo_log_int'];?></option>
							</select> -->
							<?php } ?>
						</div>

						<div class="endereco">
							<h5><?=$_lang[$lang]['montevideo_escritorio']?></h5>
							<br>
							<i class="fa fa-map-marker"></i>Constituyente 1467<br> 
							Edificio Torre El Gaucho<br>
							Oficina 1702. CP 11200 <br>
							
							<!-- <i class="fa fa-phone"></i> 
							<span id="mobile-setor">
								<?=$_lang[$lang]['telefone'];?>
								<a href=""></a>
							</span> -->
						</div>

						<div class="setores">

							<h4>Manager</h4>
								
							<strong id="nome-setor">Carolina Michelon</strong><br>
							<i class="fa fa-envelope"></i> <span id="email-setor">E-mail: <a href="mailto:carolina@lpartners.net">carolina@Lpartners.net</a></span><br>

							<br>

							<h4>Commercial Requirements</h4>
								
							<strong id="nome-setor">All Markets</strong><br>
							<i class="fa fa-envelope"></i> <span id="email-setor">E-mail: <a href="mailto:commercial@lpartners.net">commercial@Lpartners.net</a></span><br>
						</div>	

						<?php if($permalink=="home"){?>
						<br><a href="<?=HTTP?>contato/<?=$lang; ?>" class="botao"><?=$_lang[$lang]['saiba_mais']; ?></a>
						<?php } ?>
					</div>
				</div>
				<div class=" brasil waypoint animation_bottom">

					<div id="clock-brasil"></div>

					<div class="card-escritorio">
						<div class="card-escritorio-top">
							<h4><?= $_lang[$lang]['itajai_contato'];?></h4>

							<?php if($permalink!="home"){?>
							<!-- <select id="select-brasil" name="select-brasil">
								<option value="1"><?=$_lang[$lang]['diretor_comercial'];?></option>
								<option value="2"><?=$_lang[$lang]['gerente_de_compras'];?></option>
								<option value="3"><?=$_lang[$lang]['cargo_vendas_af_ca'];?></option>
								<option value="7"><?=$_lang[$lang]['cargo_vendas_ame_sul'];?></option>
								<option value="4"><?=$_lang[$lang]['cargo_ger_adm_log'];?></option>
								<option value="5"><?=$_lang[$lang]['cargo_coo_log_doc'];?></option>
								<option value="6"><?=$_lang[$lang]['cargo_log_int'];?></option>
							</select> -->
							<?php } ?>
						</div>

						<div class="endereco">
							<h5><?=$_lang[$lang]['itajai_escritorio']?></h5>
							<i class="fa fa-map-marker"></i>Rua Dr. Pedro Ferreira, 333<br>
							Absolute Business <br> 22º andar, Sala 2205/2206<br>
							Centro, Itajaí - SC<br>
							Brasil - CEP: 88301-030<br>
							<i class="fa fa-phone"></i> <span id="mobile-setor"><?=$_lang[$lang]['telefone'];?><a href="skype:+554730460506?call">+55 (47) 3046.0506</a></span>
						</div>

						<div class="setores">

							<h4><?=$_lang[$lang]['diretor_comercial'];?></h4>
							<strong id="nome-setor">Luciano Colonetti</strong><br>
							<i class="fa fa-envelope"></i> <span id="email-setor">E-mail: <a href="mailto:luciano@lpartners.net">luciano@Lpartners.net</a></span><br>
							<!-- <div class="skype-contato">
								<a class="btn-skype skype-button" id="skype-setor" href="skype:"><i class="fa fa-skype"></i> Skype directly</a>
							</div> -->

							<br>

							<h4>Manager</h4>
							<strong>Rafael Andreas Guenther</strong><br>

							<i class="fa fa-envelope"></i> <span>E-mail: <a href="mailto:rafael@lpartners.net">rafael@Lpartners.net</a></span>
							<br>
						</div>

						<?php if($permalink=="home"){?>
						<br><a href="<?=HTTP?>contato/<?=$lang; ?>" class="botao"><?=$_lang[$lang]['saiba_mais']; ?></a>
						<?php } ?>
					</div>
				</div>


				<div class=" dubai waypoint animation_right">

					<div id="clock-dubai"></div>

					<div class="card-escritorio">
						<div class="card-escritorio-top">
							<h4><?=$_lang[$lang]['dubai_contato'];?></h4>
							<?php if($permalink!="home"){?>
							<!-- <select id="select-dubai" name="select-dubai">
								<option value="21"><?=$_lang[$lang]['diretor_geral'];?></option>
								<option value="22"><?=$_lang[$lang]['vendas_africa_oriente'];?></option>
								<option value="23"><?=$_lang[$lang]['vendas_cis_russia'];?></option>
								<option value="24"><?=$_lang[$lang]['vendas_america_cingapura'];?></option>
							</select> -->
							<?php } ?>
						</div>

						<div class="endereco">
							<h5><?=$_lang[$lang]['db_escritorio_central']?></h5>
							<i class="fa fa-map-marker"></i> Jumeirah Lake Towers<br>
							Building Silver Tower<br>
							30th Floor, Office 30G<br>
							PO BOX 337481, Dubai - UAE<br>
							<i class="fa fa-phone"></i> <span id="mobile-setor"><?=$_lang[$lang]['telefone'];?><a href="skype:+97144327366?call">+971 4 432.7366</a></span><br>
						</div>

						<div class="setores">

							<h4><?=$_lang[$lang]['diretor_comercial'];?></h4>

							<strong>Luiz Pedro Bertuol</strong><br>
							<i class="fa fa-envelope"></i> <span id="email-setor">E-mail: <a href="mailto:luizbertuol@lpartners.net"> luizbertuol@Lpartners.net</a></span><br>

							

							<br>

							<h4>Manager</h4>
								
							<strong id="nome-setor">Cristiane Gonçalves</strong><br>
							<i class="fa fa-envelope"></i> <span id="email-setor">E-mail: <a href="mailto:cristiane@lpartners.net">cristiane@Lpartners.net</a></span><br>
							<!-- <div class="skype-contato">
								<a class="btn-skype skype-button" href="skype:"><i class="fa fa-skype"></i> Skype directly</a>
							</div> -->

						</div>

						<!-- <div class="setores" id="setores-complemento"></div> -->

						<?php if($permalink=="home"){?>
						<br><a href="<?=HTTP?>contato/<?=$lang; ?>" class="botao"><?=$_lang[$lang]['saiba_mais']; ?></a>
						<?php } ?>
					</div>
				</div>


				<div class=" hongkong waypoint animation_bottom">

					<div id="clock-hongkong"></div>

					<div class="card-escritorio">
						<div class="card-escritorio-top">
							<h4>Hong Kong - China</h4>
							<?php if($permalink!="home"){?>
							<!-- <select id="select-hongkong" name="select-hongkong">
								<option value="31"><?=$_lang[$lang]['hk_comercial']?></option>
								<option value="32"><?=$_lang[$lang]['hk_comercial_garfield']?></option>
							</select> -->
							<?php } ?>
						</div>

						

						<div class="endereco">
							<h5><?=$_lang[$lang]['hk_escritorio_central'];?></h5>
							<i class="fa fa-map-marker"></i> Unit 1301, 13/F,<br>
							OfficePlus @ Prince Edward,<br>
							No. 794-802 Nathan Road,<br>
							Kowloon, Hong Kong<br>
							<i class="fa fa-phone"></i> <span id="mobile-setor"><?=$_lang[$lang]['telefone'];?><a href="skype:+852421561515?call">+852 4 2156.1515</a></span>
						</div>

						<div class="setores">

							<h4>Manager</h4>
								
							<strong id="nome-setor">Gustavo Ribeiro Brandao</strong><br>
							<i class="fa fa-envelope"></i> <span id="email-setor">E-mail: <a href="mailto:gustavo@lpartners.net">gustavo@Lpartners.net</a></span><br>

							<br>

							<h4>Commercial Requirements</h4>
								
							<strong id="nome-setor">All Markets</strong><br>
							<i class="fa fa-envelope"></i> <span id="email-setor">E-mail: <a href="mailto:commercial@lpartners.net">commercial@Lpartners.net</a></span><br>
						
							<!-- <div class="skype-contato">
								<a class="btn-skype skype-button" href="skype:gustavo.lpartners"><i class="fa fa-skype"></i> Skype directly</a>
							</div> -->
							
						</div>	
						<?php if($permalink=="home"){?>
						<br><a href="<?=HTTP?>contato/<?=$lang; ?>" class="botao"><?=$_lang[$lang]['saiba_mais']; ?></a>
						<?php } ?>
					</div>
				</div>
			</div>

		</div>

	</section>