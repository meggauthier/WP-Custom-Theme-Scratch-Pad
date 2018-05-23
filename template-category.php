<?php
// Template Name: Category Page

get_header();

?>


<div class="header bg-black">
  <h2 class="text-center">Clothing Category Page</h2>
</div>

<div class="">
  <div class="row">
    <div class="col-sm-3 col-sm-offset-1 text-left">

      <form class="form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">

     <div class="elements">
          <h3>Department</h3>
            <?php
              if( $terms = get_terms(['taxonomy'=>"clothes"]) ) : 
                echo '<select style="color: rgb(46, 48, 62);" name="categoryfilter"><option>Select category...</option>';
                foreach ( $terms as $key => $term ) :
                  echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; 
                endforeach;
                echo '</select>';
              endif;

              echo '<br>';
            ?>

          <div class="row">
            <div class="col-sm-10 col-md-6">
               <h3>Colors</h3>
             <?php
              if( $color = get_terms(['taxonomy'=>"colors"]) ) : 
                foreach ( $color as $key => $colors ) :
                  echo '<input type="checkbox" name="colorfilter" value="' . $colors->term_id . '"><label>'  . $colors->name . '</label><br>'; 
                endforeach;
              endif;
              echo '<br>';
            ?>
            </div>
            <div class="col-sm-10 col-md-6">
                <h3>Sizes</h3>
                  <input type="checkbox" name="small" value="small"><label>Small</label><br/>
                  <input type="checkbox" name="medium" value="medium"><label>Medium</label><br/>
                  <input type="checkbox" name="large" value="large"><label>Large</label><br/>
                <br>
            </div>
            <div class="col-sm-12">
                <h3>Sort</h3>
                <h4>Price Range</h4>
                  <input type="text" name="price_min" placeholder="Min price" style="color: rgb(46, 48, 62);"/>
                  <input type="text" name="price_max" placeholder="Max price" style="color: rgb(46, 48, 62);"/>
                  <br>
            </div>
            <div class="col-sm-12">
                  <br>
                  <!--
                  <label>
                    <input type="radio" name="date" value="ASC" /> Price Low to High
                  </label>
                  <br>
                  <label>
                    <input type="radio" name="date" value="DESC" selected="selected" /> Price High to Low
                  </label>
                  <br>
                -->
                    <label>
                    <input type="checkbox" name="stock_status" /> Only show in stock items
                  </label>
                  <br>
                  <br>
                <button type="submit" name="submit" value="Apply" style="color: rgb(46, 48, 62);">Search</button>
                <input type="hidden" name="action" value="myfilter">
            </div>
          </div>
        </div>
        </form>
      </div>
      <div class="col-sm-7">
        <div class="row">
            <div id="response">
 
            </div>
        </div>
      </div>
  </div>
</div>

