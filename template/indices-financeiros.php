<?php 
    get_header(); 
    $moedas = get_moedas('https://economia.awesomeapi.com.br/all', true);
    
    $moeda = strstr($_GET['moeda'], '/', true); 
    if($moeda == false) {
        $moeda = 'USD';
    }
?>

	<section class="banner_sub waypoint animation_bottom">
        <div class="wrap">
            <h1><?php echo $_lang[$lang]['page_cotacao_tittle']; ?></h1>
        </div>
    </section>

   
   <section class="wrap cotacao">
        <div class="breadcrumb">
            <a href="<?php echo HTTP.$lang; ?>" title="Home"><?=$_lang[$lang]['inicial'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <span><?php echo $_lang[$lang]['page_cotacao_tittle']; ?></span>
		</div>
        <br>
        
        <div class="columns">
        
       
            <div class="column is-2 waypoint animation_left has-text-centered">
                <?php include(TEMPLATE."includes/list-moedas.php"); ?>
            </div>

            <?php if($moeda == 'USD') : ?>
                <div class="column is-8 container-moeda">
                    <div class="columns">
                        <div class="column is-12">
                            <h1 class="waypoint animation_right has-text-left"><?php echo $_lang[$lang]['page_cotacao_tittle']; ?></h1>
                        </div>
                    </div>

                   <table class="table is-bordered is-striped waypoint animation_right">
                       <thead>
                            <tr>
                                <th>Moeda</th>
                                <th><?=$_lang[$lang]['compra'];?></th>
                                <th><?=$_lang[$lang]['venda'];?></th>
                            </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td><?=$_lang[$lang][$moedas['USD']['name']];?></td>
                               <td>R$ <?=str_replace('.', ',', $moedas['USD']['bid']);?></td>
                               <td>R$ <?=str_replace('.', ',', $moedas['USD']['ask']);?></td>
                           </tr>
                           <tr>
                                <td><?=$_lang[$lang][$moedas['USDT']['name']];?></td>
                               <td>R$ <?=str_replace('.', ',', $moedas['USDT']['bid']);?></td>
                               <td>R$ <?=str_replace('.', ',', $moedas['USDT']['ask']);;?></td>
                           </tr>
                       </tbody>
                    </table>    


                    
                </div>
            <?php else: ?>
                <div class="column is-8 container-moeda">
                    <div class="columns">
                        <div class="column is-12">
                            <h1 class="waypoint animation_right has-text-left"><?php echo $_lang[$lang]['page_cotacao_tittle']; ?></h1>
                        </div>
                    </div>

                   <table class="table is-bordered waypoint animation_right">
                       <thead>
                            <tr>
                                <th>Moeda</th>
                                <th><?=$_lang[$lang]['compra'];?></th>
                                <th><?=$_lang[$lang]['venda'];?></th>
                            </tr>
                       </thead>
                       <tbody>
                           <tr>
                                <td><?=$_lang[$lang][$moedas[$moeda]['name']];?></td>
                               <td>R$ <?=str_replace('.', ',', $moedas[$moeda]['bid']);?></td>
                               <td>R$ <?=str_replace('.', ',', $moedas[$moeda]['ask']);?></td>
                           </tr>
                       </tbody>
                    </table>   
            <?php endif; ?>
        </div>
    </section>

<?php include(TEMPLATE."includes/contato-skp.php"); ?>
<?php get_footer(); //indices financeiros - titulo no rodapé