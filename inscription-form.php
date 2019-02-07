<?php  global $custom_text; ?>



<form id="inscription_form"  action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post"  enctype="multipart/form-data">


    <div class="row">
        <div class="col-sm-6"><label for="first_name"><?php _e( 'Prénom', 'webfactor' ); ?>*</label> </div>
        <div class="col-sm-6"><input type="text" id="input_first_name" name="first_name"></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><label for="last_name"><?php _e( 'Nom', 'webfactor' ); ?>*</label> </div>
        <div class="col-sm-6"><input type="text"  id="input_last_name"  name="last_name"></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><label for="email"><?php _e( 'Adresse électronique', 'webfactor' ); ?>*</label> </div>
        <div class="col-sm-6"><input type="text"  id="input_email"  name="email"></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><label for="institution"><?php _e( 'Institution', 'webfactor' ); ?></label> </div>
        <div class="col-sm-6"><input type="text" name="institution"></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><label for="fonction"><?php _e( 'Fonction', 'webfactor' ); ?></label> </div>
        <div class="col-sm-6"><input type="text" name="fonction"></div>
    </div>





        <?php if (have_rows('choices')) : ?>
        <?php  $choices = get_field_object('choices'); ?>
        <?php $choice_count = count($choices['value']); ?>
        <div id="choices_rows">

        <h3 style="margin-top:30px;"><?php echo $custom_text; ?></h3>
        <p>Veuillez s’il-vous-plaît indiquer vos préférences en mettant les chiffres  1 (premier choix) à <?php echo $choice_count; ?> (dernier choix) dans les cases prévues à cet effet. </p>
        <?php $i=1; while ( have_rows('choices') ) : the_row() ; ?>
            <div class="row" >
                <?php $choice_title =  get_sub_field('title') ; ?>
                <?php $choice_content =  get_sub_field('content') ; ?>
                <?php $choice_name = $choice_title . ' ' . $choice_content; ?>
                <div class="col-sm-6"><label for="choice_<?php echo $i; ?>"><strong><?php echo  $choice_title; ?></strong><br/><?php echo $choice_content; ?> </label> </div>
                <div class="col-sm-6"><input class="choice_number" style="width:50px" step="1" min="1" max="<?php echo $choice_count; ?>" type="number" name="choice_<?php echo $i; ?>">
                    <input type="hidden"  name="choice_<?php echo $i; ?>_name" value="<?php echo $choice_name; ?>" >
                </div>
            </div>
    	<?php $i++; endwhile; ?>
        </div>
        <?php endif;?>



        <?php if(get_field('meal')) : ?>
        <h3 style="margin-top:20px;"><?php _e( 'Je participe au repas de midi', 'webfactor' ); ?></h3>
        <div >
            <label class="radio_label" ><?php _e( 'Oui', 'webfactor' ); ?><input type="radio" name="repas" value="oui"> </label>
            <label class="radio_label" ><?php _e( 'Non', 'webfactor' ); ?><input type="radio" checked name="repas" value="non"> </label>
        </div>
      <?php else : ?>
        <label class="radio_label" style="display:none;"><?php _e( 'Non', 'webfactor' ); ?><input type="radio" checked name="repas" value="non">
      <?php endif; ?>


    <input type="hidden" name="action" value="inscription_form">
    <input type="hidden" name="event_id" value="<?php echo get_the_ID(); ?>">
    <input type="hidden" name="event_title" value="<?php echo get_the_title(); ?>">
    <div id="inscription_submit_button_outer" style="margin-top:30px;">
        <input id="inscription_submit_button" type="submit" value="<?php _e( 'Inscrivez-vous', 'webfactor' ); ?>">
    </div>

    <p id="form_alert" class="alert_message alert_error">Veuillez remplir tous les champs obligatoires pour valider votre inscription. Pensez à bien numéroter tous les ateliers par ordre de préférence.</p>


</form>
