<?php
function the_breadcrumb(){
	$sep = ' <svg enable-background="new 0 0 100 100" viewBox="0 0 100 100"><polygon points="72.2,50.2 48.7,73.7 50.2,75.3 76.4,49.1 50.2,22.9 48.7,24.5 72.2,48 18.5,48 18.5,50.2 "/></svg> ';
	global $post;
    if(!is_front_page()){
		echo '<div class="breadcrumbs">';
        echo '<a href="'.get_option('home').'">Home</a>';
        if(is_category() || is_single()){
            echo $sep;
            $cats = get_the_category( $post->ID );
            foreach ( $cats as $cat ){
                echo $cat->cat_name;
                echo $sep;
            }
            if (is_single()) {
                the_title();
            }
        }elseif (is_page()){
            if($post->post_parent){
                $anc = get_post_ancestors($post->ID);
                $anc_link = get_page_link($post->post_parent);
                foreach($anc as $ancestor){
                    $output = $sep."<a href=".$anc_link.">".get_the_title($ancestor)."</a>".$sep;
                }
                echo $output;
                the_title();

            }else{
                echo $sep;
                echo the_title();
            }
        }
		echo'</div>';
    }elseif(is_tag()){
		single_tag_title();
	}elseif(is_day()){
		echo'Archive: '; the_time('F jS, Y');
	}elseif(is_month()){
		echo'Archive: '; the_time('F, Y');
	}elseif(is_year()){
		echo'Archive: '; the_time('Y');
	}elseif(is_author()){
		echo'Author\'s archive: ';
	}elseif(isset($_GET['paged']) && !empty($_GET['paged'])){
		echo'Blogarchive: ';
	}elseif(is_search()){
		echo'Search results: ';
	}
}