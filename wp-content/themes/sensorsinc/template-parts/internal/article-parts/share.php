
<div class="share">
    <h4 class="f-label">Share</h4>
    <?php
    echo gsc("socials", [
            "content" => [
            "facebook" => true,
            "twitter" => true,
            "instagram" => false,
            "youtube" => false
            ],
        "style" => [
            "type" => "share",
            "class" => 'social-share',
            "id" => '',
            "attrs" => []
        ]
      ]);
    ?>
</div>