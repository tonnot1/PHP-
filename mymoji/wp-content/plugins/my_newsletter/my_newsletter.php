<?php
/*
Plugin Name: My Newsletter
Plugin URI: http://wordpress.org/plugins/my_newsletter/
Description: Plugin qui gère une newsletter
Author: Mee
Version: 1.0
Author URI: http://mee.tt/
*/
register_activation_hook(__FILE__,'my_newsletter_activation');

function my_newsletter_activation(){
    global $wpdb;
    $table = $wpdb->prefix."my_newsletter";

    $query = "CREATE TABLE $table ( 
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
      email VARCHAR(255) NOT NULL UNIQUE,
      nom VARCHAR(255) NOT NULL )";
    //faire attention aux espaces pour Wordpress:
    //espace entre $table et "("

    //option 1
    //$wpdb->query($query); //pose problème en cas de mise à jour

    //option 2
    //meuilleur soluce pour des maj de plugin
    require_once( ABSPATH .'wp-admin/includes/upgrade.php');
    dbDelta( $query );

    update_option('MY_NEWSLETTER_NB_ELT',10); //par défaut
}

//ajouter une page dans le menu d'administration'
add_action('admin_menu','my_newsletter_add_menu_page');

function my_newsletter_add_menu_page(){
    add_menu_page('My_newsletter - List emails', //titre de l'onglet
        'My newsletter', //titre du menu
    'manage_options', //capability=> uniquement pour le role admin, le seul role qui dispose de cette bapability
    'my_newsletter_admin_page', //slug=> unique (aussi pour sous page)
    'my_newsletter_build_page',//nom de la fonction qui va construire la page
    plugins_url('/img/email.png',__FILE__), //chemin icone
    2//position dans le menu
    );
}

function my_newsletter_build_page(){

    $page = isset($_GET['num_page'])?$_GET['num_page']:1;

    global $wpdb;
    $table = $wpdb->prefix."my_newsletter";

    $query = "select count(*) as nb from $table"; //requete SQL
    $row = $wpdb->get_row($query); //prend les resultats de la requete

    $nb_elt_total =$row->nb;
    $nb_elt_to_display = get_option('MY_NEWSLETTER_NB_ELT');
    $nb_page =ceil($nb_elt_total/$nb_elt_to_display);
    $start = ($page-1)*$nb_elt_to_display;


    $query = "select * from $table limit $start, $nb_elt_to_display"; //requete SQL
    $results = $wpdb->get_results($query); //prend les resultats de la requete

    $html = '<div class="wrap">';
    $html .= '<h1>My newsletter liste des inscrits</h1>';
    $html .= '<table class="widefat striped">';
    $html .= '<thead><tr><th>Id</th><th>Email</th><th>Nom</th></tr></thead>';
    $html .= '<tbody>';
    foreach ($results as $row){
        $html .= '<tr><td>'.$row->id.'</td><td>'.$row->email.'</td><td>'.$row->nom.'</td></tr>';
    }
    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';

    $html .= paginate_links(array(
        'base' => '%_%', //important sinon deregle les urls
        'total' => $nb_page, //nb de page
        'format' => '?num_page=%#%', //format de l'url
        'prev_next' => true, //affiche bouton next et prev
        'prev_text' =>'Precedent',
        'next_text' =>'Suivant',
        'current' => $page
    ));



    echo $html;

}
//Ajouter une sous page de config
//ajouter une entree dans le menu d'admin
add_action('admin_menu','my_newsletter_add_submenu_page');

function my_newsletter_add_submenu_page()
{
    add_submenu_page('my_newsletter_admin_page',
        'My newsletter - configuration',
        'Configurations', 'manage_options', 'my_newsletter_configuration_page', 'my_newsletter_build_configuration'
    );

    // Construire le formulaire du sous menu
    function my_newsletter_build_configuration(){

        //$msg = '';
        if(isset($_POST['save'])){

            //bouton submit name=save
            if(!isset($_POST['nb_elt']) || ($_POST['nb_elt']) =="") {
                $errorMsg[] = 'Saisir un nombre d\'élément';
            }
            if(!is_numeric($_POST['nb_elt'])) {
                $errorMsg[] = 'Saisir un chiffre';
                }
            if(count($errorMsg)>0) {
                $msg = implode('<br>', $errorMsg);

            }else{
                //tout est ok, on sauvegarde la valeur
                update_option('MY_NEWSLETTER_NB_ELT', $_POST['nb_elt']);// fonction de wp qui sauvegarde la variable dans la table wp_options
                $msg = "Configuration sauvegardée";
            }
        }

        $html = '<div class="wrap">';
        $html .= '<h1>Configuration - My newsletter</h1>';
        if($errorMsg){
            $html .= '<div class="error notice">'.$msg.'</div>';
        }else{
            //sauvegarde dans la base => depuis function widget
            $html .= '<div class="updated notice">'.$msg.'</div>';
        }

        $html .= '<form action="#" method="post">';
        $html .= '<label>Nb elements à afficher</label>:';
        $html .= '<input type="text" name="nb_elt" value="'.$nb_elt.'">';
        $html .= '<br><br>';
        $html .= '<input type="submit" name="save" value="Envoyer">';
        $html .= '<br><br>';
        $html .= '</form>';
        $html .= '</div>';

        echo $html;
    }

}

//creaation d'un widget
add_action('widgets_init','my_newsletter_create_widget');

function my_newsletter_create_widget(){
    register_widget('MyNewsLetterWidget');

}
class MyNewsLetterWidget extends WP_Widget{

    //constructeur //aficher le widget dans la liste
    public function __construct(){
        parent::__construct(
            'my_newsletter_widget',//slug//id du widget
            'My_newsletter_form',//titre dans l'admin
            array('description' => 'Affiche un formulaire d\èinscription pour une newsletter') //description
        );

    }
    //formulaire dans l'admin => apparence/widgets
    public function form($instance){

        $titre = isset($instance['titre'])?$instance['titre']:'';
        $infos = isset($instance['infos'])?$instance['infos']:'';

        $html = '<p>';
        $html .= '<label>Titre</label>';
        $html .= '<input type="text" class="widefat" id="'.$this->get_field_id('titre').'" name="'.$this->get_field_name('titre').'" value="'.$titre.'">';
        $html .= '<label>Infos</label>';
        $html .= '<input type="text" class="widefat" id="'.$this->get_field_id('infos').'" name="'.$this->get_field_name('infos').'" value="'.$infos.'">';
        $html .= '</p>';

        echo $html;

    }
    //sauvegarde des donnes du form dans admin
    public function update($new_instance, $old_instance){
        $instance = array();
        $instance['titre'] = isset($new_instance['titre'])?$new_instance['titre']:'';

        $instance['infos'] = isset($new_instance['infos'])?$new_instance['infos']:'';

        return $instance;

    }
    //front
    public function widget($args, $instance)
    {

        global $wpdb;
        $table = $wpdb->prefix . "my_newsletter";
        $msg = '';
        if (isset($_POST['save'])) {
            $errorMsg = [];
            //bouton submit name=save
            if (!isset($_POST['email']) || ($_POST['email']) == "") {
                $errorMsg[] = 'Saisir un email';
            }

            if (isset($_POST['email']) && emailExist($_POST['email'])) {
                $errorMsg[] = 'Cet email existe';
            }


            if (count($errorMsg) > 0) {
                $msg = '<div class="error">'.implode('<br>', $errorMsg).'</div>';

            } else {
                //sauvegarde en base
                $query = "insert into $table (email) values (%s)";
                $preparedQuery = $wpdb->prepare($query, $_POST['email']);
                $wpdb->query($preparedQuery);
                $msg = '<div class="success">Inscription réussie</div>';

            }
        }

            $html = $args['before_widget'];//lie a la zone de widget

            $html .= $args['before_title'] . $instance['titre'] . $args['after_title'];
            $html .= $msg;
            $html .= '<form action="#" method="post">';
            $html .= '<input type="text" name="email" placeholder="Ton email">';
            $html .= '<input type="submit" name="save" value="S\'inscrire">';
            $html .= '</form>';

            $html .= $args['after_widget'];

            echo $html;
        }


}
function emailExist($email){
    global $wpdb;
    $table = $wpdb->prefix."my_newsletter";

    $query = "select * from $table WHERE email = %s";
    $preparedQuery = $wpdb->prepare($query, $email);
    $results = $wpdb->get_results($preparedQuery);

    if (count($results)>0){
        return true;
    }
    return false;
}

