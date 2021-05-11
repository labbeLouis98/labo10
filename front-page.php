<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme-4w4
 */

get_header();
?>

<?php if ( have_posts() ) : ?>

<main id="primary" class="site-main">

    <header class="page-header">
        <?php
				//the_archive_title( '<h1 class="page-title">', '</h1>' ); 
				//the_archive_description( '<div class="archive-description">', '</div>' );
				?>
    </header><!-- .page-header -->

    <section class="lesAnnonces">

    <div id="annonce">
    
    </div>
    
    </section>

    <section class="list-cours">

    <?php
    $ctrl_radio = "";
			/* Start the Loop */
            $precedent = "XXXXXXX";
			while ( have_posts() ) :
				the_post();
                convertir_tableau($tPropriete);
                if ($precedent != $tPropriete ['typeCours']): ?>
    <?php if ($precedent != "XXXXXXX"): ?>
    
    </section>
    <?php endif;?>

    <?php if (in_array ($precedent, ['Web','Jeu','Spécifique','Image 2d/3d'])): ?>
    <section class="ctrl-carrousel">
        <?php echo $ctrl_radio;
        $ctrl_radio = "";
        ?>
    </section>
    <?php endif;?>

    
        
    <h2><?php echo $tPropriete ['typeCours'] ?> </h2>

    

    <section <?php echo class_composent($tPropriete ['typeCours']) ?>>
    
        <?php endif;?>
        <?php 
        if (in_array ($tPropriete ['typeCours'], ['Web','Jeu','Spécifique','Image 2d/3d'])):
    
          get_template_part( 'template-parts/content', 'carrousel' );
          $ctrl_radio .= '<div id="id-'.$tPropriete ['typeCours'].'" class="bout"><input class="checkmark" type="radio" name="rad-'.$tPropriete ['typeCours'].'"></div>';

          elseif ($tPropriete ['typeCours'] == 'Projets'): 

            get_template_part( 'template-parts/content', 'galerie' );

        else:
            get_template_part( 'template-parts/content', 'bloc' );
    
      endif; 

      
     $precedent = $tPropriete ['typeCours'];

      endwhile; ?>


    </section>

    <section class="admin-rapide">

    <div>

        <h3>Ajouter un article de catégorie "Nouvelles"</h3>
        <input type="text" name="title" placeholder="Titre">
        <textarea name="content"></textarea>
        <button id="bout-rapide">Créer une nouvelle</button>

    </div>
        
    </section>



    <section class="nouvelles">
    
    <section></section>

    </section>

    <?php endif; ?>

</main> <!-- #main -->

<?php
get_sidebar();
get_footer();

function convertir_tableau(&$tPropriete){
    $titre_grand = get_the_title();
    $tPropriete  ['session'] = substr($titre_grand, 4,1);
    $tPropriete  ['nbHeure'] = substr($titre_grand, -4,3);
    $tPropriete  ['titre'] = substr($titre_grand, 8, -6); 
    $tPropriete ['sigle'] = substr($titre_grand,0 , 7);
    $tPropriete['typeCours'] = get_field('type_de_cours');
    
}


function class_composent($typeCours){
    if(in_array ($typeCours, ['Web','Jeu','Spécifique','Image 2d/3d'])){
        return 'class="carrousel-2"';
    }

    elseif($typeCours == 'Projets'){
        return 'class="galerie"';
    }

    else{
        return 'class="bloc"';
    }

}