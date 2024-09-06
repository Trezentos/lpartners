<h2 style="text-transform: uppercase;">Moedas</h2>
<div class="list-moedas">
    <a href="<?php echo HTTP.'indices-financeiros?moeda=USD/'.$lang;?>" title="">

        <div class="card-icon <?php echo $moeda == 'USD'?'active':''?>">
            <i class="fa fa-usd fa-2x" aria-hidden="true"></i>
        </div>
    </a>
    <a href="<?php echo HTTP.'indices-financeiros?moeda=EUR/'.$lang; ?>" title="">
        <div class="card-icon <?php echo $moeda == 'EUR'?'active':''?>">
            <i class="fa fa-eur fa-2x" aria-hidden="true"></i>
        </div>
    </a>
    <a href="<?php echo HTTP.'indices-financeiros?moeda=ARS/'.$lang; ?>" title="<?php echo $_lang[$lang]['menu_estruturacao_frigorificos']; ?>">
        <div class="card-icon <?php echo $moeda == 'ARS'?'active':''?>">
            <i class="fa fa-rub fa-2x" aria-hidden="true"></i>
        </div>
    </a>
</div>