<?php
//un s'execute a un evenement de wordpress
add_action( 'init', 'mf_register_types' );
//s execute
add_filter('wp_title', 'custom_wp_title');
register_nav_menu('header', 'la navigation principal du site');
//pour les thumbnails des articles
add_theme_support( 'post-thumbnails' );
//pour les previous et next links
add_filter('next_posts_link_attributes', 'posts_link_attributes_next');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_previous');


/*
*    Register custom post-types during initialization
*/

function mf_register_types(){
    register_post_type( 'Project', [
        'label' => 'Projets',
        'labels' => [
            'singular_name' => 'projet',
            'add_new_item' => 'Ajouter un nouveau projet'
            ] ,
            'description' => 'Permet d’ajouter des projets',
            'public' => true,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-hammer',
            'rewrite' => [
                'pages' => true
            ],
            'supports' => [
                'title', 'editor','thumbnail'
            ]
        ]);
    register_post_type( 'Event', [
        'label' => 'Événements',
        'labels' => [
            'singular_name' => 'événement',
            'add_new_item' => 'Ajouter un nouveau événement'
            ] ,
            'description' => 'Permet d’ajouter des Événements',
            'public' => true,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-calendar-alt',
            'rewrite' => [
                'pages' => true
            ],
            'supports' => [
                'title', 'editor','thumbnail'
            ]
        ]);
    register_post_type( 'Trip', [
        'label' => 'Voyages',
        'labels' => [
            'singular_name' => 'voyage',
            'add_new_item' => 'Ajouter un nouveau voyage'
            ] ,
            'description' => 'Permet d’ajouter des voyages',
            'public' => true,
            'menu_position' => 21,
            'menu_icon' => 'dashicons-palmtree',
            'rewrite' => [
                'pages' => true
            ],
            'supports' => [
                'title', 'editor','thumbnail'
            ]
        ]);

    register_taxonomy('places', ['trip', 'projects','events'],['label'=>'Endroits',
    'labels'=>[
        'singular_name' => 'Endroit',
        'edit_item'=> 'Editer l’endroit',
        'add_new_item' => 'ajouter un nouvel endroit'
    ],
    'description' => 'Permet de preciser un continent, un pays ou une ville pour un voyage, projet ou événement donne',
    'public' => true,
    'hierarchical' => true]);
}

/*
* Hooks into Wp_title() content formatting
*@check add_filter();
*/

function custom_wp_title($title){
    //actions sur le title
    if (empty($title)) {
        $title = 'Bienvenue!';
    }
    $title .= ' - ' . get_bloginfo('name');
    //remove extra spaces from $title
    return trim($title);
}

/*
* Retrieve the absolute  URI for given asset in this theme
*/
function get_theme_asset($src = ''){
    return get_template_directory_uri(). '/assets/'. trim($src,'/');
}

function theme_asset($src = '') {
    echo get_theme_asset($src);
}

/*
* Get navigation links (objects) for given location
*/

function mf_get_nav_items($location){
    $id = mf_get_nav_id($location);
    $children = [];
    $nav = [];
    if (!$id) return $nav;
    //recuperer les items du menu $location
    $items = wp_get_nav_menu_items($id);
    // Boucler dedans
    foreach ($items as $object) {
        // creer un objet (stdClass)
        $item = new stdClass();
        // assigner les propriétés url & label a cet objet
        $item->url = $object->url;
        $item->label = $object->title;
        $item->parent = intval($object->menu_item_parent);
        $item->icon = $object->classes[0];
        $item->children = [];

        if ($item->parent) {
            $children[] = $item;
        }else{
            // pousser cet objet dans un tableau
            $nav[$object->ID] = $item;
        }
    }
    foreach ($children as $item) {
        $nav[$item->parent]->children[] = $item;
    }
    //retourne ce tableau
    return $nav;
}


/*
* Get Navigation ID from given Location
*/

function mf_get_nav_id($location){
    foreach (get_nav_menu_locations() as $navLocation => $navId) {
        if($navLocation == $location) return $navId;
    }
    //arreter l'execution
    return false;
}

/*
* Return a custom excerpt for given length
*/

function mf_get_the_excerpt($length = null, $acffield){
    $excerpt = get_field($acffield, false, false);

    if(is_null($length) || strlen($excerpt) <= $length) return $excerpt;
    $string = '';
    $words = explode(' ', $excerpt);
    foreach ($words as $word ) {
        // + 2 is needed in order to include the next space and the &hellip
        if ((strlen($string) + strlen($word) + 2 ) > $length ) break;
        $string .= ' ' . $word;
    }
    return trim($string) . '&hellip;';
}

/*
* Output a custom excerpt for given length
*/

function mf_the_excerpt($length = null, $acffield){
    echo mf_get_the_excerpt($length, $acffield);
}

/*
* Return a list of visited places for given trip
*/

function mf_get_the_places($glue = '', $prefix = '', $suffix = '', $empty = ''){
    //recuperer les terms
    $terms = wp_get_post_terms(get_the_ID(), 'places', [
        'orderby' => 'name',
        'order' => 'ASC',
        'fields' => 'all']);
        //si on a pas des terms :
        //retourne la valeur d’empty
        if (!$terms) return $empty;
        // Sinon :
        //separer chaque term par $glue
        return implode($glue, array_map(function($term) use ($prefix, $suffix){
            // entourer chaque term par prefix et $suffix
            // returner la string générée
            //str_replace pour la
            return str_replace([':type',':link'], [get_field('type', $term), get_term_link($term)], $prefix) . $term->name . $suffix;
        }, $terms));
    }


/*
* Output a list of visited places for given trip
*/

function mf_the_places($glue = '', $prefix = '', $suffix = '', $empty = ''){
    echo mf_get_the_places($glue, $prefix, $suffix, $empty);
}

/*
* Return plural or singular sentence based on given number
*/

function mf_chose_singularity($number, $singular, $plural, $empty){
    switch(intval($number)){
        case 0:
        if (is_null($empty)) break;
        return str_replace(':number', $number, $empty);
        case 1:
        return str_replace(':number', $bumber, $singular);
        break;
    }
    return str_replace(':number', $bumber, $plural);
}

/*
* ACF functions
*/
function nop_the_field($content){
    return the_field( $content,false,false );
}
/*
* Get the single place taxonomy
*/
function mf_single_taxplace($taxonomy){
    $term = get_field($taxonomy);

    if( $term ){
        return $term->name;
    }
    return __('pas de lieu indique','mf');

}
/*
* Content Pagination
*/

function mf_pagination_link($total_pages,$current_page,$previoustitle,$nexttitle){
    $big = 999999999; // need an unlikely integer
    $args = [
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => $current_page,
        'end_size' => 0,
        'mid_size' => 0,
        'total' => $total_pages,
        'prev_next' => true,
        'prev_text'          => __($previoustitle,'mf'),
        'next_text'          => __($nexttitle,'mf')
    ];
    return paginate_links($args);
}

/*
* Get the page url
*/
function mf_get_page_url($thepage){
    $args = array(
    	'meta_key'         => '_wp_page_template',
    	'meta_value'       => $thepage,
    	'post_type'        => 'page'
    );
    $pages = get_posts( $args );

    foreach ($pages as $page) {
        return get_page_link($page->ID);
    }
}

/*
* Get url from given page
*/
function mf_get_page_id($thepage){
    $args = array(
    	'meta_key'         => '_wp_page_template',
    	'meta_value'       => $thepage,
    	'post_type'        => 'page'
    );
    $pages = get_posts( $args );

    foreach ($pages as $page) {
        return $page->ID;
    }
}

// /*Add Classes to previous and next link*/
function posts_link_attributes_next() {
    return 'class="view-link view-link--next"';
}
function posts_link_attributes_previous() {
    return 'class="view-link view-link--previous"';
}

/*
* Create own thumbnails
*/
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    // additional image sizes
    // additional small image size for projects and articles
    add_image_size( 'article-small', 320, 168, true);
    // aditional medium image size for articles
    add_image_size( 'article-medium', 488, 224, true);
    // aditional small image size for image gallery
    add_image_size( 'gallery-small', 240, 240, true);
    // aditional small image size for events
    add_image_size( 'events-small', 304, 168, true);
}
