<?php 
get_header();
add_javascript(['alegra.js']);
?>

<style type="text/css">
    html {
      scroll-behavior: smooth;
    }
</style>

<section class="wrap intro_alegra_page">
  <div class="columns">
    <div class="column">
      <div id="video-institucional" class="waypoint animation_top">
				<a href="https://www.youtube.com/watch?v=YuAH9t8UYOg">
					<video id="alegra-video" min-height="400px" poster="http://www.alegrafoods.com.br/wp-content/uploads/2017/08/sede-alegra.jpg" autoplay muted loop>
					  <source src="http://www.alegrafoods.com.br/wp-content/uploads/2017/08/alegra.mp4" type="video/mp4">
					</video>
											
          <div id="video-overlay">
            <h2 class="title-overlay">
              5 million kilos of food per month produced in one of the most modern plants in Latin America.
            </h2>
            <div id="video-alegra-play">
                <img  src="img/alegra_img/btn-play.png" class="watch-video-btn"/>
            </div>
					</div>
				</a>
    </div>
      <!-- <figure>
        <img src="<?=HTTP.'img/alegra_bg.jpg';?>" alt="Alegra Foods">
      </figure> -->
    </div>
  </div> 
</section>

<section class="wrap alegra_infos">
  
  <div class="columns is-vcentered">
    <div class="column is-7-desktop is-12-mobile">
      <figure class="waypoint animation_left">
        <img src="<?=HTTP.'img/new_foto.png'?>" alt="Presidents photo">
      </figure>
    </div>  

    <div class="column is-5-desktop is-12-mobile has-text-right">
      <div class="alegra_infos_item" style="margin-top: 15px;">
        <br/>
        <br/>
        <br/>
        <img src="<?=HTTP.'img/alegra_img/presidents.png';?>" class="waypoint animation_top">

        <p class="waypoint animation_right">
          When we started with Alegra, Brazil began to experience the worst economic crisis of the last de- cades. We enter with a new brand in a scenario of market retraction.
        </p>

        <a href="#download-banner" class="btn-alegra waypoint animation_bottom">
          SEE MORE
        </a>
      </div>
    </div>
  </div>

  <div class="columns is-vcentered reformulation is-row-reverse-mobile">
    <div class="column is-5-desktop is-12-mobile">
      <div class="alegra_infos_item">
        <img src="<?=HTTP.'img/alegra_img/reformulation.png';?>" class="waypoint animation_top">

        <p class="waypoint animation_left">
          When we started with Alegra, Brazil began to experience the worst economic crisis of the last de- cades. We enter with a new brand in a scenario of market retraction.
        </p>

        <a href="#download-banner" class="btn-alegra left waypoint animation_bottom">
          SEE MORE
        </a>
      </div>
    </div>

    <div class="column is-7-desktop is-12-mobile has-text-right">
      <figure>
        <img src="<?=HTTP.'img/alegra_img/woman_alegra.png'?>" alt="Presidents photo" class="waypoint animation_right">
      </figure>
    </div>  
  </div>
</section>

<section class="stakeholders">
  <div class="wrap">
    <div class="columns is-vcentered is-row-reverse-mobile">
      <div class="column is-7-desktop is-12-mobile">
        <div class="stakeholder_item">
          <img id="stake-circle" src="<?=HTTP.'img/alegra_img/graph.png';?>" class="waypoint animation_left">

          <a href="#download-banner" class="btn-alegra is-hidden-desktop">
            SEE MORE
          </a>
        </div>
      </div>

      <div class="column is-5-desktop is-12-mobile">
        <div class="stakeholder_item">
          <img src="<?=HTTP.'img/alegra_img/aproach_stakeholder.png';?>" class="waypoint animation_top">

          <p class="waypoint animation_right">
            For the year 2017, a well-structured stakeholder engagement plan was designed to better meet the demand of these stakeholders. 
            However, due to some changes in the organizational structure of the parts that make Alegra, this plan of engagement had to be postponed, starting only in 2018.
          </p>

          <a class="btn-alegra is-hidden-mobile waypoint animation_bottom">
            SEE MORE
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="wrap alegra_infos">
  <div class="columns is-vcentered certification is-row-reverse-mobile">
    <div class="column is-6-desktop is-12-mobile">
      <div class="alegra_infos_item">
        <br/>
        <br/>
        <br/>
        <br/>
        <img src="<?=HTTP.'img/alegra_img/certification.png';?>" class="waypoint animation_top">

        <p class="waypoint animation_left">
        Animal welfare is one of the items to which Alegra maintains special attention. It is not only related to the care of animals within the industry, but throughout the production chain. In all, there are 132 cooperating suppliers of swines, receiving constant technical assistance from professionals in the most diverse areas, such as: veterinary medicine, zootecnia, engineering and agricultural technicians with knowledge in the areas of health, nutrition, animal welfare, and environment. 
        </p>

        <a href="#download-banner" class="btn-alegra left waypoint animation_bottom">
          SEE MORE
        </a>
        <br/>
        <br/>
      </div>
    </div>

    <div class="column is-6-desktop is-12-mobile has-text-right">
        <img id="certif" src="<?=HTTP.'img/alegra_img/certif_2.png'?>" alt="Presidents photo" class="waypoint animation_right">
    </div>  
  </div>
</section>

<section class="alegra_numbers">
  <div class="wrap">
    <div class="columns">
      <div class="column is-12 alegra_numbers_tittle">
        <img src="<?=HTTP.'img/alegra_img/tittle_alegra_numbers.png'?>" class="waypoint animation_top">
      </div>
    </div>
  
    <div class="columns is-multiline is-mobile">
      <div class="column is-4-desktop is-6-mobile grid-1">
        <figure>
          <img src="<?=HTTP.'img/alegra_img/total.png'?>" class="waypoint animation_right">
        </figure>
      </div>

      <div class="column is-4-desktop is-6-mobile has-text-centered grid-2">
        <figure>
          <img src="<?=!$MOBILE ? HTTP.'img/alegra_img/line_of_products.png' : 'img/alegra_img/line_of_products_mobile.png'; ?>" class="waypoint animation_top">
        </figure>
      </div>

      <div class="column is-4-desktop is-6-mobile has-text-right grid-3">
        <figure>
          <img src="<?=HTTP.'img/alegra_img/net_worth.png'?>" class="waypoint animation_right">
        </figure>
      </div>
   
      <div class="column is-4-desktop is-6-mobile grid-4">
        <img src="<?=HTTP.'img/alegra_img/contributors.png'?>" class="waypoint animation_left">
      </div>

      <div class="column is-5-desktop is-6-mobile exportation has-text-centered grid-5">
        <img src="<?=HTTP.'img/alegra_img/exportation.png'?>" class="waypoint animation_bottom">
      </div>

      <div class="column is-3-desktop is-12-mobile">
        <div class="alegra_numbers_container">
          <a href="#download-banner" class="btn-alegra waypoint animation_right">SEE MORE</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="suply_chain">
  <div class="wrap">
    <div class="columns is-vcentered">
      <div class="column is-3">
        <img src="<?=HTTP.'img/alegra_img/supply_chain.png'?>" class="waypoint animation_top">

        <p class="waypoint animation_left">
          In 2017 approximately 40% of the purchase value of Alegra was destined to local suppliers, 
          in this occasion we consider as local suppliers all those present in the area covered by DDD 42.
        </p>

        <a href="#download-banner" class="btn-alegra is-hidden-mobile waypoint animation_bottom">
          SEE MORE
        </a>
      </div>

      <div class="column is-9">
        <img src="<?=HTTP.'img/alegra_img/supply_chain_cycle.png'?>" class="waypoint animation_right">
      </div>

      <div class="column is-12 btn-container">
        <a href="#download-banner" class="btn-alegra is-hidden-desktop">
          SEE MORE
        </a>
      </div>
    </div>
  </div>
</section>

<section class="videos">
  <div class="wrap">
    <div class="columns is-multiline">
      <div class="column is-12 has-text-centered">
        <h2  class="waypoint animation_top">VÍDEOS</h2>
      </div>
      <div class="column is-4-desktop is-12-mobile waypoint animation_top">
        <iframe width="100%" height="220" src="https://www.youtube.com/embed/ERzl8H3BYjM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="column is-4-desktop is-12-mobile waypoint animation_top">
        <iframe width="100%" height="220" src="https://www.youtube.com/embed/WPtsWC-uGJ8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="column is-4-desktop is-12-mobile waypoint animation_top">
        <iframe width="100%" height="220" src="https://www.youtube.com/embed/YuAH9t8UYOg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="column is-4-desktop is-12-mobile waypoint animation_bottom">
        <iframe width="100%" height="220" src="https://www.youtube.com/embed/lSsQpPUvhNw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="column is-4-desktop is-12-mobile waypoint animation_bottom">
        <iframe width="100%" height="220" src="https://www.youtube.com/embed/X06XCAQtGBg?t=307" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="column is-4-desktop is-12-mobile waypoint animation_bottom">
        <iframe width="100%" height="220" src="https://www.youtube.com/embed/ULJUXmqLDNI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="column is-4-desktop is-12-mobile waypoint animation_bottom">
        <iframe width="100%" height="220" src="https://www.youtube.com/embed/GM7tMRSFBrQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="column is-4-desktop is-12-mobile waypoint animation_bottom">
        <iframe width="100%" height="220" src="https://www.youtube.com/embed/mxfPJDxxO7I" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="column is-4-desktop is-12-mobile waypoint animation_bottom">
        <iframe width="100%" height="220" src="https://www.youtube.com/embed/pCeC0gHFmL4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="column is-4-desktop is-12-mobile waypoint animation_bottom">
        <iframe width="100%" height="220" src="https://www.youtube.com/embed/TdkvYn-1vLw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</section>

<section id="download-banner" class="downloads wrap">
  <div class="download_container">
    <a href="../pdf/catalogo-produtos.pdf" download="catalogo-produtos" class="btn-download waypoint animation_left"> 
      DOWNLOAD PRODUCT CATALOG
    </a>
          
    <a href="../pdf/sustainability-report.pdf" download="sustainability-report" class="btn-download waypoint animation_right"> 
      DOWNLOAD SUSTAINABILITY REPORT
    </a>
  </div>
</section>

<?php get_footer(); ?>