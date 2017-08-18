<?php

//hook filter => orient� contenu
/*add_filter('the_title', 'mon_titre');

function mon_titre($title){
	return $title.' - yo';
}*/




//ajout d'un custom post type
//1er param => nom du hook
//2eme param => fonction � appeler
add_action( 'init', 'add_drink_custom_post_type' ); 

function add_drink_custom_post_type(){

	 $labels = array(
    'name'               => 'Boissons',
    'singular_name'      => 'Boisson',
    'add_new'            => 'Ajouter',
    'add_new_item'       => 'Ajouter une boisson',
    'edit_item'          => 'Modifier une boisson',
    'new_item'           => 'Nouvelle boisson',
    'all_items'          => 'Toutes les boissons',
    'view_item'          => 'Voir la boisson',
    'search_items'       => 'Rechercher dans les boissons',
    'not_found'          => 'Aucune boisson trouv�e',
    'not_found_in_trash' => 'Aucune boisson dans la corbeille', 
    'parent_item_colon'  => '',
    'menu_name'          => 'Boissons'
  );

	$args = array(
	    'labels'        => $labels,
	    'description'   => 'Custom post type pour des boissons',
	    'public'        => true,
	    'menu_position' => 3,
	    'menu_icon'		=> get_stylesheet_directory_uri().'/img/drink.png',
	    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
	    'has_archive'   => true,
	  );
	//get_stylesheet_directory_uri() => recupere le chemin du theme utilis�

	//fonction qui permet d'ajouter un custom post type
	//1er param => nom du post_type
	//2eme param => tableau de param�tres
	register_post_type('drink', $args);
}

add_action('widgets_init','register_drink_sidebar');

function register_drink_sidebar(){

    $args = array("name" => "Boisson sidebar",
                    "id" => "drink_sidebar",
                    "description" => "Sidebar affichee sur la page boisson",
                    "before_title" => "<h3>",
                    "after_title" => "</h3>",
                    "before_widget" => "<li>",
                    "after_widget" => "</li>");
    register_sidebar($args);
}

//creation d'un shortcode
//1er param =>nom du shortcode utilisé dans l'admin
//1er param =>nom de la function utilisée
add_shortcode('display-last-drinks', 'display_last_drinks');

function display_last_drinks($atts){
    global $wpdb; // connection bdd wordpress
    $table = $wpdb->prefix."posts";// prefix=> recupere le prefix choisi lors de l'installation

    $args = shortcode_atts(array("nbelt"=>2), $atts);
    //fusion entre tableau de valeur par defaut et le tableau recu par le shortcode

    $nbElt = $args['nbelt'];
    $width = floor(100/$nbElt)-1;
    $margin = floor((100 - ($width * $nbElt))/($nbElt-1));

    $query = "select * from $table where post_type = 'drink' and post_status = 'publish' order by post_date DESC limit 0,%d";

    $prepareQuery = $wpdb->prepare($query, $nbElt);



    $drinks = $wpdb->get_results($prepareQuery); //execute la requete SQL

    //var_dump($drinks);


    $html = '<div id="last_drinks" class="clearfix">';
    foreach($drinks as $drink){
        $id = $drink->ID;
        $img = get_the_post_thumbnail_url($id, 'thumbnail');
        $link = get_permalink($id);
        //var_dump($img);
        $html .= '<div class="one_drink" style="width:'.$width.'%;margin-right:'.$margin.'%;">';
        $html .= '<img src="'.$img.'">';
        $html .= '<h4><a href="'.$link.'">'.$drink->post_title.'</a><h4>';
        $html .= '</div>';

    }
    $html .='</div>';

    return $html;
}

//second shortcode
add_shortcode('cross-selling','cross_selling');

function cross_selling(){
    global  $wpdb; // connection bdd wordpress
    $table = $wpdb->prefix."posts";

    global $post;
    $id = $post->ID;

    $query = "select * from $table
    where post_status = 'publish' and post_type = 'drink' AND ID <> %d order BY RAND() limit 0,1";
    $preapreQuery = $wpdb->prepare($query, $id);

    $drink = $wpdb->get_row($preapreQuery);

    //var_dump($drink);



        $mojiId = $drink->ID;
        $img = get_the_post_thumbnail_url($mojiId, 'thumbnail');
        $link = get_permalink($mojiId);
        //var_dump($img);
        $html = '<div class="cross_selling">';
        $html .= '<img src="'.$img.'">';
        $html .= '<h4><a href="'.$link.'">'.$drink->post_title.'</a><h4>';
        $html .= '</div>';
    return $html;
    }

//Modification des colonnes de l'administration des boissons
//1er param => hook
//2eme param => fonction à appeler
//3eme param => manage_edit_MONCOSTUMTYPE_columns
//Implicitement le hook transmet un tableau de colonnes à la fonction
add_filter('manage_edit-drink_columns','show_columns');

function show_columns($listeCols){

    //pour ajouter des colonnes en plus de rajouter des colonnes existantes
    //$listeCols['prix'] = 'Prix';
    //$listeCols['vignette'] = 'Vignette';

    $listeCols = array(
        'cb' => '<input type="checkbox">',
        'title' => 'Titre',
        'vignette' => 'Vignette',
        'prix' => 'Prix',
        'date' => 'Date' //gauche =>valeur , droite =>affichage

    );

    return $listeCols;

}
//affichage des valeurs d la nouvelle colonne
//1er param => nom du hook => manage_MONCUSTOMTYPE_posts_custom_column
//2eme param => fonction à appeler
//2eme param => priorité
//3eme param => nb de parametres que le hook va fournir a la fonction

add_action('manage_drink_posts_custom_column','show_value',10,2);


//$nomCol => nom colonne à afficher, fourni par le hook a la fonction
//$post_id =>
function show_value($nomCol, $post_id){
    if($nomCol == 'prix'){
        echo get_field('prix', $post_id);
    }
    if($nomCol == 'vignette'){
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }

}

//ajout d'un tri de colonne par prix
//nom du hook => manage_edit-MONCUSTOMTYPE_sortable_columns
//le hook transmet en param la liste des colonnes triables
//nom de la fonction
add_filter('manage_edit-drink_sortable_columns','sortable_price');

function sortable_price($sortCols){
    $sortCols['prix'] = 'tri_prix'; //[nom_colonne] = 'nom_tri'

    return $sortCols;

}
//fonction de tri
//le hook transmet a la fonction la requete utilisée pour recuperer les posts
add_action('pre_get_posts','price_order');

function price_order($query){
    if ($query->is_main_query() && ($orderby = $query->get('orderby'))){
        switch ($orderby){
            case 'tri_prix':
                $query->set('meta_key', 'prix');
                $query->set('orderby', 'meta_value_num'); //meta_value_num => tri des chiffres, sinon meta_value
                break;
        }
    }
}



