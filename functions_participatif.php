<?php



add_action('init', 'create_post_type_partage');
function create_post_type_partage()
{
    //register_taxonomy_for_object_type('category', 'partage'); // Register Taxonomies for Category
    //register_taxonomy_for_object_type('post_tag', 'partage');
    register_post_type('partage', // Register Custom Post Type
    array(
        'labels' => array(
            'name' => __('Partages', 'webfactor'), // Rename these to suit
            'singular_name' => __('Partage', 'webfactor'),
            'add_new' => __('Ajouter', 'webfactor'),
            'add_new_item' => __('Nouveau Partage', 'webfactor'),
            'edit' => __('Modifier', 'webfactor'),
            'edit_item' => __('Modifier Partage', 'webfactor'),
            'new_item' => __('Nouveau Partage', 'webfactor'),
            'view' => __('Afficher Partage', 'webfactor'),
            'view_item' => __('Afficher Partage', 'webfactor'),
            'search_items' => __('Chercher Partage', 'webfactor'),
            'not_found' => __('Aucun Partage trouvé', 'webfactor'),
            'not_found_in_trash' => __('Aucun Partage trouvé dans la Corbeille', 'webfactor')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'exclude_from_search' => true, // remove from search engine
        'supports' => array(
            'title',
        //    'editor',
        //    'excerpt',
            'author',
            'thumbnail'
        ), // Go to Dashboard Custom webfactor Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}


// GET POSTED DATA FROM FORM
// TO DO REMAME FUNCTION
add_action( 'admin_post_nopriv_partage_form',    'get_email_from_partage_form'   );
add_action( 'admin_post_partage_form',  'get_email_from_partage_form' );



function partage_fields(){
    return [


        'name' => 'Nom',
        'email' => 'Adresse email',
        'name_of_project' => 'Nom du projet',
        'description' => 'Description',
        'link' => 'Lien'
        //,
        //'featured_image' => 'Featured image'


    ];
}


//  ADD partage FORM AS A SHORTCODE
add_shortcode( 'partage_form',  'partage_form_shortcode' );
function partage_form_shortcode($atts , $content = null) {





    $rp_frm = '';


    // MESSAGE TO SAY THERE WAS A PROBLEM
    if (isset($_GET['problem'])) {
        $rp_frm .= ' <p>Une erreur s’est produite en enregistrant ce Partage. Veuillez réessayer. </p>';
    };

    // MESSAGE TO SAY PARTAGE SAVE WAS SUCCESFUL
    if (isset($_GET['success'])) {
        $rp_frm .= ' <p>Your  partage was saved!! </p>';
    };




    $rp_frm .= ' <form enctype="multipart/form-data" id="partage_form" action="' .  esc_url( admin_url('admin-post.php') ) . '" method="post">';



    $rp_frm .=  make_partage_field('name', 'Nom',  'input');
    $rp_frm .=  make_partage_field('email', 'Email',  'input');

    $rp_frm .=  make_partage_field('name_of_project', 'Nom du Projet',  'input');
    $rp_frm .=  make_partage_field('description', 'Description',  'textarea');
    $rp_frm .=  make_partage_field('link', 'Lien',  'input');
    $rp_frm .=  make_partage_field('featured_image', 'Featured Image',  'file' );





    // HIDDEN ACTION INPUT IS REQUIRED TO POST THE DATA TO THE CORRECT PLACE
    $rp_frm .= '
    <input type="submit" id="submit_course_form" value="Envoyer">
    <input type="hidden" name="action" value="partage_form">';



    $rp_frm .= '</form>';


    return  $rp_frm;


}





function get_email_from_partage_form () {

    // IF DATA HAS BEEN POSTED
    if ( isset($_POST['action'])  && $_POST['action'] == 'partage_form'   ) {



        $email = $_POST['email'];
        $name_of_project = $_POST['name_of_project'];


        $current_user_id = get_current_user_id();



        // if we  have the right data and user logged in
        //  && $current_user_id > 0
        if ( !empty($email)  && !empty($name_of_project)   ) {
            $post = array(
                'post_title'   => $name_of_project,
                'post_status'  => 'publish',
                'post_type'    => 'partage',
                'post_content' => ''
                //,
            //    'post_author'  =>  $current_user_id

            );



            // EDIT OR ADD NEW POST
            $new_partage = wp_insert_post( $post );

            // IF SUCCESS
            if ($new_partage > 0) {
                // add email to ACF

                $fields = partage_fields();
                foreach ($fields as $field => $translation) :
                    $$field = $_POST[$field];
                    if ($$field  != '') :
                        update_field( $field, $$field,  $new_partage  );
                    endif;
                endforeach;


                //if filesize of upload is greater than 0 bytes, ie it exists
                // add or replace the file already there
                $featured_image = $_FILES['featured_image'];
                if ($featured_image['size'] > 0 ) {
                  $file_id = partage_add_file_upload( $featured_image, $new_partage );
                  update_field( 'featured_image', $file_id,  $new_partage  );
                }

                wp_redirect(site_url('/partages?success' ), $status = 302);
                //wp_redirect(  get_permalink( $new_partage )  );

                // something went wrong with adding the partage post
            } else {
                wp_redirect(site_url('/partages?problem'), $status = 302);
            }

            // if we dont have all the data or user not logged in
        } else {
            wp_redirect(site_url('/partages?problem'), $status = 302);
        }

        // if the form didnt post the action field
    } else {
        wp_redirect(site_url('/partages?problem'), $status = 302);
    }


}

function partage_add_file_upload($artist_file, $parent){
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




function make_partage_field($attribute, $translation,   $type='input', $choices=[] ) {


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
