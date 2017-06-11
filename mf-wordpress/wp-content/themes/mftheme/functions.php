<?php
//un s'execute a un evenement de wordpress
add_action( 'init', 'mf_register_types' );
//s execute
add_filter('wp_title', 'custom_wp_title');
register_nav_menu('header', 'la navigation principal du site');
//pour les thumbnails des articles
add_theme_support( 'post-thumbnails' );


/*
*    Register custom post-types during initialization
*/

function mf_register_types(){
    register_post_type( 'Trip', [
        'label' => 'Voyages',
        'labels' => [
            'singular_name' => 'voyage',
            'add_new_item' => 'Ajouter un nouveau voyage'
        ] ,
        'description' => 'Permet d’ajouter des voyages',
        'public' => true,
        'menu position' => 20,
        'menu_icon' => 'dashicons-palmtree'
    ]);
    register_taxonomy('places', 'trip',['label'=>'Endroits',
    'labels'=>[
        'singular_name' => 'Endroit',
        'edit_item'=> 'Editer l’endroit',
        'add_new_item' => 'ajouter un nouvel endroit'
    ],
    'description' => 'Permet de preciser un continent, un pays ou une ville pour un voyage donne',
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

function mf_get_the_excerpt($length = null){
    $excerpt = get_the_excerpt();

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

function mf_the_excerpt($length = null){
    echo mf_get_the_excerpt($length);
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
