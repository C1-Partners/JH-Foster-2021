<?php

    $mkOptionsRequestQuote = get_field('mkt_rq', 'options');
    $mkUniqueRequestQuote = get_field('mk_unq');

?>

<h2 class="widgettitle">Request a Quote</h2>

<?php if($mkUniqueRequestQuote) :
        // Show unique marketo form for this page if enabled
        echo $mkUniqueRequestQuote;
    else :
        // Otherwise, show the global form
        echo $mkOptionsRequestQuote;
    endif;
?>