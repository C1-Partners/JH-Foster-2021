<section class="not-found">
  <?php
    $msg = 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.';
  if ( is_search() ):
    $msg = 'Sorry, but nothing matched your search terms. Please try again with different keywords.';
  endif;
  ?>
  <p><?php echo $msg ?></p>
</section>