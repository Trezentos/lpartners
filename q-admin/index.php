<?php
require("config.php");

if ( $_GET['erro'] ) {
	echo "string";
	$alertFail 		= true;
	$alertMessage 	= 'Atenção, você tentou acessa uma página sem permissão!';
}

$_header['titulo'] = 'Administrador';
$_header['icon'] = 'home';

get_header_gestor();
get_barra_header();
?>

<!-- <div class="row">
	<div class="col-xs-12 col-sm-6 col-lg-6">
		<div id="box-home" class="box-visitas">
			<h2><?php //foreach ($ultimasVisitas as $dados) echo $dados->getSessions(); ?></h2>
			<p>Visitas (hoje)</p>
			<span class="glyphicon glyphicon-signal"></span>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-lg-6">
		<div id="box-home" class="box-newsletter">
			<h2><?php //echo $qNewsletter; ?></h2>
			<p>Assinantes da Newsletter</p>
			<span class="glyphicon glyphicon-envelope"></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h2 class="panel-title">Analytics</h2></div>
			<div class="panel-body">
				<table class="table-analytics table">
					<thead>
						<tr>
							<th data-sorter="false">Cidade</th>
							<th data-sorter="false">Visitantes</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Barra Velha</td>
							<td><span id="barravelha-bar"></span></td>
						</tr>
						<tr>
							<td>Joinville</td>
							<td><span id="joinville-bar"></span></td>
						</tr>
						<tr>
							<td>Jaraguá do Sul</td>
							<td><span id="jaragua-bar"></span></td>
						</tr>
						<tr>
							<td>Blumenau</td>
							<td><span id="blumenau-bar"></span></td>
						</tr>
						<tr>
							<td>Itajaí</td>
							<td><span id="itajai-bar"></span></td>
						</tr>
						<tr>
							<td>Balneário Camboriú</td>
							<td><span id="balneario-bar"></span></td>
						</tr>
						<tr>
							<td>Navegantes</td>
							<td><span id="navegantes-bar"></span></td>
						</tr>
						<tr>
							<td>Florianópolis</td>
							<td><span id="florianopolis-bar"></span></td>
						</tr>
						<tr>
							<td>Brasil</td>
							<td><span id="brasil-bar"></span></td>
						</tr>
					</tbody>
				</table>
				<script src="<?php //echo HTTP_GESTOR ?>js/jquery.sparkline.min.js"></script>
				<script>
				(function($){
					$(window).load(function() {
						$("#barravelha-bar").sparkline([<?php //echo implode($bv, ','); ?>], { type: 'bar', tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:offset}} - {{value}}', tooltipValueLookups: { 'offset': { <?php //echo implode($legenda, ','); ?> } } });
						$("#joinville-bar").sparkline([<?php //echo implode($jv, ','); ?>], { type: 'bar', tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:offset}} - {{value}}', tooltipValueLookups: { 'offset': { <?php //echo implode($legenda, ','); ?> } } });
						$("#jaragua-bar").sparkline([<?php //echo implode($js, ','); ?>], { type: 'bar', tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:offset}} - {{value}}', tooltipValueLookups: { 'offset': { <?php //echo implode($legenda, ','); ?> } } });
						$("#blumenau-bar").sparkline([<?php //echo implode($bl, ','); ?>], { type: 'bar', tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:offset}} - {{value}}', tooltipValueLookups: { 'offset': { <?php //echo implode($legenda, ','); ?> } } });
						$("#itajai-bar").sparkline([<?php //echo implode($it, ','); ?>], { type: 'bar', tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:offset}} - {{value}}', tooltipValueLookups: { 'offset': { <?php //echo implode($legenda, ','); ?> } } });
						$("#balneario-bar").sparkline([<?php //echo implode($bc, ','); ?>], { type: 'bar', tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:offset}} - {{value}}', tooltipValueLookups: { 'offset': { <?php //echo implode($legenda, ','); ?> } } });
						$("#navegantes-bar").sparkline([<?php //echo implode($nv, ','); ?>], { type: 'bar', tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:offset}} - {{value}}', tooltipValueLookups: { 'offset': { <?php //echo implode($legenda, ','); ?> } } });
						$("#florianopolis-bar").sparkline([<?php //echo implode($fl, ','); ?>], { type: 'bar', tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:offset}} - {{value}}', tooltipValueLookups: { 'offset': { <?php //echo implode($legenda, ','); ?> } } });
						$("#brasil-bar").sparkline([<?php //echo implode($br, ','); ?>], { type: 'bar', tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:offset}} - {{value}}', tooltipValueLookups: { 'offset': { <?php //echo implode($legenda, ','); ?> } } });
					});
				})(window.jQuery);
				</script>
			</div>
		</div>
	</div>
</div> -->
<?php get_footer_gestor(); ?>