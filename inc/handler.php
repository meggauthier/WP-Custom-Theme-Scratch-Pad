<?php

function megs_filter(){
	$args = array(
		'post_type' => 'product',//query these posts
		'orderby' => 'price', // we will sort posts by date
		'order'	=> $_POST['price'] // ASC or DESC
	);

	// for taxonomies / categories drop down
	if( isset( $_POST['categoryfilter'] ) ) 
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'clothes',
				'field' => 'id',
				'terms' => $_POST['categoryfilter']
			)
		);
    
    	if( isset( $_POST['colorfilter'] ) ) 
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'colors',
				'field' => 'id',
				'terms' => $_POST['colorfilter']
			)
		);
/*
	//color queries
	if( isset( $_POST['blue'] ) ) {
		$args['meta_query'][] = array(
					'key' => 'blue',
					'compare' => '=',
					'value' => '1',
				);
	}

	if( isset( $_POST['red'] ) ) {
		$args['meta_query'][] = array(
					'key' => 'red',
					'compare' => '=',
					'value' => '1',
				);
	}

	if( isset( $_POST['green'] ) ) {
		$args['meta_query'][] = array(
					'key' => 'green',
					'compare' => '=',
					'value' => '1',
				);
	}

*/
	//size query
	if( isset( $_POST['small'] ) ) {
		$args['meta_query'][] = array(
					'key' => 'small',
					'compare' => '=',
					'value' => '1',
				);
	}

	if( isset( $_POST['medium'] ) ) {
		$args['meta_query'][] = array(
					'key' => 'medium',
					'compare' => '=',
					'value' => '1',
				);
	}

	if( isset( $_POST['large'] ) ) {
		$args['meta_query'][] = array(
					'key' => 'large',
					'compare' => '=',
					'value' => '1',
				);
	}

	if( isset( $_POST['stock_status'] ) ) {
		$args['meta_query'][] = array(
					'key' => 'stock_status',
					'compare' => '=',
					'value' => "true"
					
				);
	}


	// if both minimum price and maximum price isset we will use BETWEEN comparison
	if( isset( $_POST['price_min'] ) && $_POST['price_min'] && isset( $_POST['price_max'] ) && $_POST['price_max'] ) {
		$args['meta_query'][] = array(
			'key' => 'price',
			'value' => array( $_POST['price_min'], $_POST['price_max'] ),
			'type' => 'numeric',
			'compare' => 'between'
		);
	} else {
		// if only min price is set
		if( isset( $_POST['price_min'] ) && $_POST['price_min'] )
			$args['meta_query'][] = array(
				'key' => 'price',
				'value' => $_POST['price_min'],
				'type' => 'numeric',
				'compare' => '>'
			);
 
		// if only max price is set
		if( isset( $_POST['price_max'] ) && $_POST['price_max'] )
			$args['meta_query'][] = array(
				'key' => 'price',
				'value' => $_POST['price_max'],
				'type' => 'numeric',
				'compare' => '<'
			);


	}


	$query = new WP_Query( $args );

	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();

			$images = get_field('images');
			$model  = get_field('model_number');
			$price  = get_field('price');
			$stock  = get_field('stock_status');
			//Since I couldn't get the arrays to filter
			//$colors  = get_field('color');
			//$sizes   = get_field('size');

			//Below is the long hand
			$blue	= get_field('blue');
			$red    = get_field('red');
			$green    = get_field('green');
			$small    = get_field('small');
			$medium    = get_field('medium');
			$large    = get_field('large');

	?>
	<div class="col-xs-10 col-sm-6">
		<h2 class="text-center"><?= $query->post->post_title ?></h2>
				<div class="col-md-6" style="position: relative;">
				<?php if($stock === 'false') : ?>
					<img src="/wp-content/uploads/2018/05/temp-out-of-stock.png" height="auto" width="100" class="temp" />
				<?php endif; ?>
					<img src="<?= $images ?>" height="200" width="auto" />
				</div>
				<div class="col-md-6">
					<p><?= $query->post->post_content ?></p>
					<p>Comes in:</p>
					<?php 
						if($blue === true) : ?>
						<li>Blue</li>
					<?php endif; ?>
					<?php 
						if($red === true) : ?>
						<li>Red</li>
					<?php endif; ?>
					<?php 
						if($green === true) : ?>
						<li>Green</li>
					<?php endif; ?>
                    <ul>
                    <?php
                        $terms = get_the_terms( $post->ID, 'colors' );

                        if( $terms ){
                            foreach( $terms as $term ){

                            $term_arr[$term->term_id] = $term->name;
                                echo "<li>"; print_r($term->name); echo "</li>";
                            }

                        }
                      ?>
                    </ul>
						<div class="mt-4">
							<p>Model Number: <?= $model ?></p>
							<p>Price $<?= $price ?></p>
						</div>
					<?php 
						if($small === true) : ?>
						| Small
					<?php endif; ?>
					<?php 
						if($medium === true) : ?>
						| Medium
					<?php endif; ?>
					<?php 
						if($large === true) : ?>
						| Large
					<?php endif; ?>
					<?php
					/*foreach($sizes as $size) : ?>
					 | <?= $size ?> 
					<?php endforeach; 
					*/ ?>
				</div>
	</div>


	<?php

		endwhile;

		wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;

	die();
}
 
 
add_action('wp_ajax_myfilter', 'megs_filter'); 
add_action('wp_ajax_nopriv_myfilter', 'megs_filter');
