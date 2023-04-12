<?php
// emergency/alert bar

$bar_visibility = get_field('bar_visibility', 'option');

?>

<?php if ($bar_visibility): ?>

  <aside id="alertBar" class="alertbar">
      <div class="alertbar__list container">
      <?php if( have_rows('alert_bar', 'option') ):
        // loop through the rows of data
        while ( have_rows('alert_bar', 'option') ) : the_row();
          $bar_title = get_sub_field('bar_title');
          $bar_text = get_sub_field('bar_text');
          $bar_icon = get_sub_field('bar_icon');
    
      ?>

        <div class="alertbar__item">
          <div class="alertbar_content"> 
            <span class="alertbar__icon">
              <?php if($bar_icon == 'alert'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="22.569" height="22.5" viewBox="0 0 22.569 22.5" aria-hidden="true">
                    <title>Alert</title>
                    <g transform="translate(-33.47 -38.864)">
                        <path d="M608.536,3010.5a.656.656,0,1,0,.656.656.656.656,0,0,0-.656-.656h0" transform="translate(-563.781 -2956.448)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                        <path d="M608.255,3009.937V3006" transform="translate(-563.5 -2959.823)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                        <path d="M622.927,3018.757a3.1,3.1,0,0,1-2.777,4.492H605.359a3.1,3.1,0,0,1-2.777-4.492l7.4-14.791a3.1,3.1,0,0,1,5.554,0Z" transform="translate(-568 -2962.635)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                    </g>
                </svg>
              <?php endif; ?>
              <?php if($bar_icon == 'info'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="22.5" height="22.5" viewBox="0 0 22.5 22.5" aria-hidden="true">
                    <title>Info</title>
                    <g transform="translate(-447.005 -1907)">
                        <g transform="translate(447.755 1907.75)">
                            <path d="M461.005,1923.1h-.7a1.4,1.4,0,0,1-1.4-1.4v-3.5a.7.7,0,0,0-.7-.7h-.7" transform="translate(-448.405 -1908.4)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            <path d="M458.6,1913.75a.35.35,0,1,0,.35.35.35.35,0,0,0-.35-.35h0" transform="translate(-448.455 -1908.15)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            <path d="M458.255,1928.75a10.5,10.5,0,1,0-10.5-10.5A10.5,10.5,0,0,0,458.255,1928.75Z" transform="translate(-447.755 -1907.75)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                        </g>
                    </g>
                </svg>
              <?php endif; ?>
            </span> <!-- /.alertbar__icon -->
            <div>
              <div class="alertbar__text">
                <strong class="alertbar__title">
                  <?php if($bar_title): ?>
                    <?php echo $bar_title; ?>
                  <?php endif; ?>
                </strong> 
              </div>
              <div class="alertbar__subtext">
                <?php if($bar_text): ?>
                  <?php echo $bar_text; ?>
                <?php endif; ?>
                </div> 
            </div>
          </div> 
        </div> <!-- /.alertbar__item -->
        <div class="alertbar__actions">
          <button type="button" class="alertbar__close" aria-label="Close">
              <span class="btn__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="14.121" height="14.121" viewBox="0 0 14.121 14.121" aria-hidden="true">
                    <title>Close</title>
                    <g transform="translate(-206.694 -4382.689)">
                        <g transform="translate(207.755 4383.75)">
                            <path d="M207.755,4395.75l12-12" transform="translate(-207.755 -4383.75)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                            <path d="M219.755,4395.75l-12-12" transform="translate(-207.755 -4383.75)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                        </g>
                    </g>
                  </svg>
              </span> <!-- /.button__icon -->
          </button> <!-- /.alertbar__close -->
        </div> <!-- /.alertbar__actions -->
     
      <?php endwhile; ?>
    </div> <!-- /.alertbar__list -->
    <?php endif; ?>
  </aside>  <!-- /.alertbar -->

  <?php endif; ?>