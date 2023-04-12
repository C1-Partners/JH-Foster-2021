<?php

$topics = get_field('accordion');
$title = get_field('accordion_title');
// $elm = get_field('hd_elm');

if( $link ): 
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif; 

?>

<section class="block-accordion">
    <div class="accordion-block">
        <?php if ($title): ?>
        <h2 class="accordion-title"><?php echo $title; ?></h2>
        <?php endif; ?>
        <div class="accordion">
        <?php
            $x=1; //setup our incrementing variable
            $rand = rand(1,500); // generate random numbers for accordion functionality

            foreach ( $topics as $topic ) : ?>

                <div class="accordion-item">
                    <div class="accordion-header" id="heading<?php echo $x . "-" . $rand; ?>">
                        <a href="#" 
                            class="toggle <?php echo ($x !== 1) ? 'collapsed' : ''; ?>" 
                            data-toggle="collapse" 
                            data-target="#collapse<?php echo $x . "-" . $rand; ?>" 
                            aria-expanded="true" 
                            aria-controls="collapse<?php echo $x . "-" . $rand; ?>">
                            <div class="title-outer">
                                <div class="plus">
                                    <div class="horizontal"></div>
                                    <div class="vertical"></div>
                                </div>
                                <h3 class="title"><?php echo $topic['title']; ?></h3>
                            </div>
                        </a>
                    </div>
                    <div id="collapse<?php echo $x . "-" . $rand; ?>" class="<?php echo ($x == 1) ? 'show' : 'collapse'; ?>" aria-labelledby="heading<?php echo $x . "-" . $rand; ?>" >
                        <div class="accordion-body">
                            <?php echo $topic['answer']; ?>
                        </div>
                    </div>
                </div>

        <?php $x++; endforeach ?>   
        
        </div>                    
    </div>
</section> 