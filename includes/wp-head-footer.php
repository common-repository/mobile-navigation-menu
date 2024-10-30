<?php
/**
 * Register and enqueue a stylesheets and scripts in the Frontend.
 *
 * @see WP Docs
 * @todo Replace only if you're creating your own Plugin
 * @todo mnm - Find all and replace text
 */

/**
 * Get Options Fixes
 * @param $db_field string
 * @param $default string
 */
function mnm_display($db_field, $default){
  $get_option = get_option($db_field);
  if(empty($get_option)){
    $get_option = $default;
  }
  return $get_option;
}

function mnm_wp_head_hook() {
  $disabled_wpnav = get_option('mnm_option_1');
  $mnm_option_2 = mnm_display('mnm_option_2', '#333333');
  $mnm_option_3 = mnm_display('mnm_option_3', '#dddddd');
  $mnm_option_4 = mnm_display('mnm_option_4', '#c4c4c4');
  $mnm_option_5 = mnm_display('mnm_option_5', '#222222');
  $mnm_option_6 = mnm_display('mnm_option_6', '720');
  $mnm_option_6_clean = str_replace(array('px','PX','Px','pX',' '), '', $mnm_option_6);
  $mnm_option_8 = mnm_display('mnm_option_8', '.navselector');
?>

<style type="text/css">
<?php if(isset($disabled_wpnav) && $disabled_wpnav==1): ?>
#wpadminbar {
    display: none;
}
<?php endif; ?>

#ml-wrapnav {
    background: <?php echo $mnm_option_2 ?>;
}
@media (max-width: <?php echo $mnm_option_6_clean ?>px) {
  #ml-wrapnav {
    display: block;
  }
  <?php echo $mnm_option_8; ?>{
    display: none;
  }
}
.fa.icons-mnm {
  color: <?php echo $mnm_option_3 ?>;
}
.mnm-label {
  color: <?php echo $mnm_option_4 ?>;
}
.ml-menu {
    background: <?php echo $mnm_option_5 ?>;
}
</style>

<?php
}
add_action( 'wp_head', 'mnm_wp_head_hook' );

function mnm_wp_footer_hook(){
  $site_url = get_site_url();
  $default_opt12 = array(  "label" => array("", "Home", "About", "Contact"), 
                        "icon"  => array("", "fa-home", "fa-info-circle", "fa-envelope"),
                        "url" => array("", $site_url."/", $site_url."/about-us", $site_url."/contact-us")
                    );
  $nmn_option_12 = mnm_display('mnm_option_12', $default_opt12);
  $mnm_option_6 = mnm_display('mnm_option_6', '720');
  $mnm_option_6_clean = str_replace(array('px','PX','Px','pX',' '), '', $mnm_option_6);
  $mnm_option_8 = mnm_display('mnm_option_8', 'nav:first');

?>
<div id="ml-wrapnav">
  <div class="ml-wrapnav">
    
    <div class="ml-slideicon">
      <div class="mnm-icon-menu">
        <a href="#ml-sidemenu">
          <i class="fa fa-bars icons-mnm icons-mnm-menu"></i>
          <i class="mnm-label mnm-label-menu">Menu</i>
        </a>
      </div>
    </div>

    <div class="ml-iconwrap">
      <?php
        if(isset($nmn_option_12) && !empty($nmn_option_12)):
          for($i=1; $i<count($nmn_option_12["label"]); $i++):  
      ?>
      <div class="mnm-icon-menu">
        <a href="<?php echo $nmn_option_12['url'][$i]; ?>">
          <i class="fa icons-mnm <?php echo $nmn_option_12['icon'][$i]; ?>"></i>
          <i class="mnm-label <?php echo $nmn_option_12['icon'][$i]; ?>-label"><?php echo $nmn_option_12['label'][$i]; ?></i>
        </a>
      </div>
      <?php
          endfor;
        endif;
      ?>
    </div>
  </div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    <?php 
          $mnm_option_7_clean = preg_replace('/^\s+|\n|\r|\s+$/m', '', mnm_display('mnm_option_7', 'MENU') );
    ?> 

    // var sample = false ? "this is true": false;
    var getLogo = "<?php echo $mnm_option_7_clean; ?>",
        srcLogo = "";
    // Image Extension Validity
    if((/\.(gif|jpg|jpeg|tiff|png)$/i).test(getLogo)){
      srcLogo = '<img src=\"'+getLogo+'\" alt=\"wordpress demo\">';
    } else {
      srcLogo = getLogo;
    }

    $("html").MNMenu({
        breakpoint: "<?php echo $mnm_option_6_clean ?>",
        navigationbar: "<?php echo $mnm_option_8 ?>",
        navlogo: srcLogo
    })
  })
</script>

<?php
}
add_action( 'wp_footer', 'mnm_wp_footer_hook' );
