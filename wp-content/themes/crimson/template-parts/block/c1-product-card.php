<?php

/*
 * Product Line Configurator Block
 * Author: Zac Sanders
 */
?>

<?php 

$diclaimer = get_field('sp_disc', 'options');

$vendorsQuery = new WP_Query([
    'post_type' => 'vendors',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order'   => 'ASC',
    'post__not_in' => array(29302),
]);

$vendors = [];
$availableLocations = [];
$availableVendors = [];
$currentStates = [];
$singleCategory = [];
$countryMade = [];

if($vendorsQuery->have_posts()) {

    while($vendorsQuery->have_posts()) {
        $vendorsQuery->the_post();

        $vendorProducts     = get_field('products', get_the_ID());
        $productCategory    = get_the_terms( get_the_id(), 'product-category' );
        $countryMade        = get_field('manufactured', get_the_ID());
        $singleCategory     = get_field('single_cat', get_the_ID());
        $currentStates      = get_the_terms( get_the_ID(), 'states' );
        $currentStateNames  = wp_list_pluck( $currentStates, 'slug' );
        $availableVendors   = get_the_title();
        $post               = get_post(get_the_ID()); 
        $slug               = $post->post_name;

        $vendors[] = [
            'id'                => get_the_ID(),
            'url'               => get_the_permalink(),
            'title'             => get_the_title(),
            'prod_category'     => $productCategory,
            'made_in'           => $countryMade,
            'slug'              => $slug,
            'available_states'  => $currentStates,
            'filter_states'     => $currentStateNames,
            'single_category'   => str_replace(' ', '-', $singleCategory),
            'products'          => $vendorProducts,
        ];
    }
}


?>

<script>
    window.vendors = <?php echo json_encode($vendors); ?>;
</script>

<section class="block-product-card">
    <div class="">
        <div class="product-search-bar">
            <input id="product-search-input" class="product-search-input" type="text" placeholder="Search Top Suppliers" onkeypress="handlKeyPress(event)">
            <button id="product-search-submit-button" class="product-submit btn btn-primary" type="submit">Search Top Suppliers</button>
        </div>
        <div class="export-row">
            <button id="product-seach-clear-button" class="clear-all d-none btn btn-outline">Clear All</button>
            <button id="js-export" class="btn btn-primary">Generate PDF</button>
        </div>
        <div class="row">
            <div class="col-lg-4 job-filters">
                <div class="job-filters-sticky">
                    <h2 class="job-search-heading">Filters</h2>
                    <!--Product Category Checkboxes-->
                    <a class="product-search-heading arrow-left" data-toggle="collapse" href="#collapseProductCheckboxes" role="button" aria-expanded="false" aria-controls="collapseLocationCheckboxes">Product Category</a>
                    <div id="collapseProductCheckboxes" class="collapse show">
                        <?php
                            // Create product category checkboxes
                            $prodFilterOptions = get_terms( 'product-category', array(
                                'hide_empty' => true,
                                'include'    => array( 211,227,213  )
                            ));
                        ?>

                        <?php if(is_array($prodFilterOptions)): ?>
                            <?php foreach($prodFilterOptions as $prodFilterOption): ?>

                                <div class="checkbox">
                                    <label for="product-search-input-<?= $prodFilterOption->term_id; ?>"><?= $prodFilterOption->name; ?><span class="job-detail"></span>
                                        <input id="product-search-input-<?= $prodFilterOption->term_id; ?>" class="product-search-filter-checkbox" type="checkbox" name="product-filter" value="<?= $prodFilterOption->slug; ?>">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!--Country of Manufacture Checkboxes-->
                    <a class="product-search-heading arrow-left" data-toggle="collapse" href="#collapseCountryCheckboxes" role="button" aria-expanded="false" aria-controls="collapseLocationCheckboxes">Manufactured</a>
                    <div id="collapseCountryCheckboxes" class="collapse show">
                        <div class="checkbox">
                            <label for="product-search-input-44590">USA Made<span class="job-detail"></span>
                                <input id="product-search-input-" class="product-search-filter-checkbox" type="checkbox" name="country-filter" value="usa">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="product-search-input-44591">Global (inc. USA)<span class="job-detail"></span>
                                <input id="product-search-input-" class="product-search-filter-checkbox" type="checkbox" name="country-filter" value="global">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <!--State Availability Checkboxes-->          
                    <a class="product-search-heading arrow-left" data-toggle="collapse" href="#collapseStateCheckboxes" role="button" aria-expanded="false" aria-controls="collapseLocationCheckboxes">Location</a>
                    <div id="collapseStateCheckboxes" class="collapse show">
                        <?php
                            //create available state checkboxes
                            $stateFilterOptions = get_terms( 'states', array(
                                'hide_empty' => true
                            ));
                        ?>

                        <?php if(is_array($stateFilterOptions)): ?>
                            <?php foreach($stateFilterOptions as $stateFilterOption): ?>

                                <div class="checkbox">
                                    <label for="product-search-input-<?= $stateFilterOption->term_id; ?>"><?= $stateFilterOption->name; ?><span class="job-detail"></span>
                                        <input id="product-search-input-<?= $stateFilterOption->term_id; ?>" class="product-search-filter-checkbox" type="checkbox" name="location-filter" value="<?= $stateFilterOption->slug; ?>">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!-- Vendor Checkboxes-->          
                    <a class="product-search-heading arrow-left" data-toggle="collapse" href="#collapseVendorCheckboxes" role="button" aria-expanded="false" aria-controls="collapseLocationCheckboxes">Top Suppliers</a>
                    <div id="collapseVendorCheckboxes" class="collapse show">

                        <?php if(is_array($vendors)): ?>
                            <?php foreach($vendors as $vIndex => $vendor): ?>

                                <div class="checkbox <?php echo (($vIndex) > 15 ) ? 'd-none' : 'supplier-shown'; ?>">
                                    <label for="vendor-search-input-<?= $vendor['id']; ?>"><?= $vendor['title']; ?><span class="job-detail"></span>
                                        <input id="product-search-input-<?= $vendor['id']; ?>" class="product-search-filter-checkbox" type="checkbox" name="vendor-filter" value="<?= $vendor['slug']; ?>">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            <?php endforeach; ?>
                            <p class="disclaimer"><?php echo $diclaimer; ?></p>
                            <button id="loadMoreSuppliers" class="load-more btn btn-primary">Load All Top Suppliers</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 pl-lg-5 prod-search-results" id="results">
                <h2 class="job-search-heading"><span class="js-results-counter"><?php echo count($vendors); ?></span> Results</h2>
                
                <?php foreach($vendors as $vIndex => $vendor):
                    $states = $vendor['available_states']; 
                    $products = $vendor['products'];
                    $prodCategories = $vendor['single_category'];
                    $alternateID = "";

                    if (!empty($vendor['alt_id'])) {
                        $alternateID = $vendor['alt_id'];
                    }
                ?>
                          
                    <div class="prod-search-result 

                    <?php if ($prodCategories) : ?>
                        <?php foreach ($prodCategories as $prodCategory): ?>
                        js-<?php echo strtolower($prodCategory); ?> 
                        <?php endforeach; ?>"
                    <?php endif; ?>
                    
                        id="job-search-result-<?php echo $vendor['id']; ?>"
                    >
                        <div class="title-wrap">
                            <a href="<?php echo $vendor['url']; ?>"><h2 class="prod-search-title"><?php echo $vendor['title']; ?></h2></a> <span class="pipe">|</span>
                            <span class="d-flex">
                            <?php if ($prodCategories) : $total = count($prodCategories); $i=0; ?>
                                <?php foreach ($prodCategories as $prodCategory): ?>
                                    <?php $i++ ?>
                                    <p class="prod-single-cat js-<?php echo strtolower(str_replace(' ', '-', $prodCategory)); ?> category-<?php echo $i; ?>">
                                        <?php echo ucwords(str_replace('-', ' ', $prodCategory));
                                        if ($i !== $total) echo ',';
                                        ?>
                                    </p>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </span>
                        </div>

                        <?php if ($states) : 
                            $total = count($states);
                            $i=0; ?>
                            
                            <p class="prod-location">
                            <?php foreach($states as $state) : ?>
                                <?php $i++ ?>
                                <?php if ($state) :
                                    echo $state->name;
                                if ($i !== $total) echo ',';
                                endif; ?>
                            <?php endforeach; ?>
                            </p>  
                        <?php endif; ?>

                        <?php if ($products) : ?>
                        <p class="products"><?php echo $products; ?></p>
                        <?php endif; ?>
                    
                        <?php if ($alternateID) : ?>
                        <p class="alt-id"><?php echo $alternateID; ?></p>
                        <?php endif; ?>

                    </div>   
                <?php endforeach; ?>
                       
            </div>
        </div>
    </div>
</section>