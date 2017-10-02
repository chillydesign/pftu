<?php



add_action('init', 'create_post_type_inscription');
function create_post_type_inscription()
{
    //register_taxonomy_for_object_type('category', 'inscription'); // Register Taxonomies for Category
    //register_taxonomy_for_object_type('post_tag', 'inscription');
    register_post_type('inscription', // Register Custom Post Type
    array(
        'labels' => array(
            'name' => __('Inscriptions', 'webfactor'), // Rename these to suit
            'singular_name' => __('Inscription', 'webfactor'),
            'add_new' => __('Ajouter', 'webfactor'),
            'add_new_item' => __('Nouveau Inscription', 'webfactor'),
            'edit' => __('Modifier', 'webfactor'),
            'edit_item' => __('Modifier Inscription', 'webfactor'),
            'new_item' => __('Nouveau Inscription', 'webfactor'),
            'view' => __('Afficher Inscription', 'webfactor'),
            'view_item' => __('Afficher Inscription', 'webfactor'),
            'search_items' => __('Chercher Inscription', 'webfactor'),
            'not_found' => __('Aucun Inscription trouvé', 'webfactor'),
            'not_found_in_trash' => __('Aucun Inscription trouvé dans la Corbeille', 'webfactor')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'exclude_from_search' => false, // remove from search engine
        'supports' => array(
            'title',
        //    'editor',
        //    'excerpt',
            'author',
            'thumbnail',
            'comments'
        ), // Go to Dashboard Custom webfactor Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            // 'post_tag',
            // 'category'
        ) // Add Category and Post Tags support
    ));
}


add_action( 'manage_posts_extra_tablenav', 'add_download_link'  );
function add_download_link($which){

    if ( is_post_type_archive('inscription') ) {
        if($which == 'bottom'){
            $download_link = get_home_url() . '/api/v1/?inscriptions'  ;
            echo '<div class="alignleft actions"><a class="action button-primary button" href="'. $download_link .'">Télécharger CSV</a></div>';
        }
    }

}


function inscription_meta_box_markup(){

    $download_link = get_home_url() . '/api/v1/?inscriptions&id=' . $_GET['post'] ;
    echo '<div class=" "><a style="display:block;text-align:center" class="action button-primary button" href="'. $download_link .'">Télécharger les inscriptions (csv)</a></div>';

}

function add_inscription_meta_box()
{
    add_meta_box("inscriptions-meta-box", " Inscriptions", "inscription_meta_box_markup", "evenement", "side", "high", null);
}

add_action("add_meta_boxes", "add_inscription_meta_box");




function inscription_fields(){
    return [


        'first_name' => 'Prénom',
        'last_name' => 'Nom',
        'email' => 'Adresse électronique',
        'institution' => 'Institution',
        'fonction' => 'Fonction',
        'repas' => 'Repas',


        //,
        //'featured_image' => 'Featured image'


    ];
}


// GET POSTED DATA FROM FORM
// TO DO REMAME FUNCTION
add_action( 'admin_post_nopriv_inscription_form',    'process_inscription_form'   );
add_action( 'admin_post_inscription_form',  'process_inscription_form' );




function process_inscription_form () {

    $referer = $_SERVER['HTTP_REFERER'];
$referer =  explode('?',   $referer)[0];

    // IF DATA HAS BEEN POSTED
    if ( isset($_POST['action'])  && $_POST['action'] == 'inscription_form'   ) {


        $event_id = $_POST['event_id'];
        $event_title = $_POST['event_title'];

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $institution = $_POST['institution'];
        $fonction = $_POST['fonction'];
        $repas = (isset($_POST['repas'])) ? $_POST['repas'] : 'non';


        $choice_1 = $choice_2 = $choice_3 = $choice_4 = $choice_5 = false;

        if (  isset($_POST['choice_1']) ) {
            $choice_1 = [$_POST['choice_1'], $_POST['choice_1_name']  ];
        }
        if (  isset($_POST['choice_2']) ) {
            $choice_2 = [$_POST['choice_2'], $_POST['choice_2_name']  ];
        }
        if (  isset($_POST['choice_3']) ) {
            $choice_3 = [$_POST['choice_3'], $_POST['choice_3_name']  ];
        }
        if (  isset($_POST['choice_4']) ) {
            $choice_4 = [$_POST['choice_4'], $_POST['choice_4_name']  ];
        }
        if (  isset($_POST['choice_5']) ) {
            $choice_5 = [$_POST['choice_5'], $_POST['choice_5_name']  ];
        }

        $choices = array($choice_1, $choice_2, $choice_3, $choice_4, $choice_5 );


        // if we  have the right data and user logged in
        //  && $current_user_id > 0
        if ( !empty($email)  && !empty($first_name) &&  !empty($last_name)  ) {
            $post = array(
                'post_title'   => $first_name . ' ' . $last_name,
                'post_status'  => 'publish',
                'post_type'    => 'inscription',
                'post_content' => '',
                'post_parent' =>  $event_id

            );


            // EDIT OR ADD NEW POST
            $new_inscription = wp_insert_post( $post );

            // IF SUCCESS
            if ($new_inscription > 0) {
                // add email to ACF

                $fields = inscription_fields();
                foreach ($fields as $field => $translation) :
                    $$field = $_POST[$field];
                    if ($$field  != '') :
                        update_field( $field, $$field,  $new_inscription  );
                    endif;
                endforeach;

                $first_choice = $second_choice = $third_choice = $fourth_choice = $fifth_choice = false;


                foreach ($choices as $choice) {
                    if ($choice != false) {

                        $score = $choice[0];
                        $choice_name = $choice[1];
                         if ($score == 1) {
                              $first_choice = $choice_name;
                            update_field( 'choix_1', $choice_name,  $new_inscription  );
                        } elseif ($score == 2) {
                             $second_choice = $choice_name;
                            update_field( 'choix_2', $choice_name,  $new_inscription  );
                        } elseif ($score == 3) {
                            $third_choice = $choice_name;
                            update_field( 'choix_3', $choice_name,  $new_inscription  );
                        } elseif ($score == 4) {
                            $fourth_choice = $choice_name;
                            update_field( 'choix_4', $choice_name,  $new_inscription  );
                        } elseif ($score == 5) {
                            $fifth_choice = $choice_name;
                            update_field( 'choix_5', $choice_name,  $new_inscription  );
                        }

                    }
                }


                $all_choices = array($first_choice, $second_choice, $third_choice, $fourth_choice, $fifth_choice);

                // SEND EMAILS TO THE ADMIN AND THE PERSON WHO SUBMITTED
                send_inscription_emails( $_POST , $all_choices );





                wp_redirect( $referer . '?success', $status = 302 );
                //wp_redirect(  get_permalink( $new_inscription )  );

                // something went wrong with adding the inscription post
            } else {
                wp_redirect($referer . '?problem', $status = 302);
            }

            // if we dont have all the data or user not logged in
        } else {
            wp_redirect($referer . '?problem', $status = 302);
        }

        // if the form didnt post the action field
    } else {
        wp_redirect($referer . '?problem', $status = 302);
    }


}

function inscription_add_file_upload($artist_file, $parent){
    $upload = wp_upload_bits($artist_file['name'], null, file_get_contents( $artist_file['tmp_name'] ) );
    $wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );
    $wp_upload_dir = wp_upload_dir();


    $attachment = array(
        'guid' => $wp_upload_dir['baseurl'] . _wp_relative_upload_path( $upload['file'] ),
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename( $upload['file'] )),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment( $attachment, $upload['file'], $parent );


    return $attach_id;

}



function send_inscription_emails($data, $choices){

     $event_title = $data['event_title'];

    $headers = 'From: PFTU <no-reply@plateforme-pftu.org>' . "\r\n";
    $headers .= 'Reply-To: PFTU <patricia.naegeli@hesge.ch>' . "\r\n";
    $emailheader = file_get_contents(dirname(__FILE__) . '/emails/email_header.php');
    $emailfooter = file_get_contents(dirname(__FILE__) . '/emails/email_footer.php');
    add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));




    $paragraph_for_admin = '<p>Nouvelle inscription pour l’évènement '.  $event_title .'</p><br /><br />';

    $paragraph_for_admin .= '<p><b>Prénom</b> : ' . $data['first_name']. '</p>';
    $paragraph_for_admin .= '<p><b>Nom</b> : ' .$data['last_name'] . '</p>';
    $paragraph_for_admin .= '<p><b>Adresse électronique</b> ' . $data['email'] . '</p>';
    $paragraph_for_admin .= '<p><b>Institution</b> : ' . $data['institution'] . '</p>';
    $paragraph_for_admin .= '<p><b>Fonction</b> : ' . $data['fonction']  . '</p>';

    $paragraph_for_admin  .= '<p>';
    $c = 1;
    foreach ($choices as $choice) {
        if ($choice){
            $paragraph_for_admin .= '<b>Choix '. $c. '</b> : ' . $choice  . '<br />';
        }
        $c++;
    }
    $paragraph_for_admin  .= '</p>';

    $paragraph_for_admin .= '<p><b>Participation au repas de midi </b> : ' . $data['repas']  . '</p>';
    $email_subject_for_admin = 'Nouvelle inscription pour l’évènement ' . $event_title;
    $email_content_for_admin = $emailheader  . $paragraph_for_admin  . $emailfooter;
    wp_mail( 'patricia.naegeli@hesge.ch' , $email_subject_for_admin, $email_content_for_admin, $headers );



    $paragraph_for_user = '<p>Bonjour,</p><p>Votre inscription a bien été enregistrée pour l’évènement '.  $event_title . '</p><p>Bien cordialement, <br/> L’équipe PFTU</p>';
    $email_subject_for_user = 'PFTU  - Inscription à l’évènement  ' . $event_title;
    $email_content_for_user = $emailheader . $paragraph_for_user .  $emailfooter;

    wp_mail( $_POST['email'], $email_subject_for_user, $email_content_for_user, $headers );



    remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );



}






function make_inscription_field($attribute, $translation,   $type='input', $choices=[] ) {


        $value = '';

    if ($type == 'textarea') {

        return '
        <label for="inp_'. $attribute .'">'.  $translation   .'</label>
        <textarea  id="inp_'. $attribute .'"  name="'. $attribute.'"> '. $value .'</textarea>
        ';

    } elseif( $type == 'radio') {
        $str = '';
        foreach ($choices as $choice) {
            $selected =  ($choice == $value) ? ' checked ' : '';
            $str.=   '<label class="inline_label" for="inp_'. $attribute .'">'.  $choice   .'<input '. $selected .' type="radio" name="'. $attribute .'" value="'. $choice.'" /></label>';
        }
        return $str;

    } elseif( $type == 'file') {

        return '
        <label for="inp_'. $attribute .'">'.  $translation   .'</label>
        <input type="file"  id="inp_'. $attribute .'"  name="'. $attribute.'"  value="'. $value .'" />
        ';

    } else {

        return '
        <label for="inp_'. $attribute .'">'.  $translation   .'</label>
        <input type="text"  id="inp_'. $attribute .'"  name="'. $attribute.'"  value="'. $value .'" />
        ';
    }



}



?>
