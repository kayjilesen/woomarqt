<div id="usp" class="navigation-bar lightColor">
    <div class="innerWrapper max-w-screen-xl flex py-3 px-4 mx-auto">
        <?php   
        if(!empty($uspbar['usps'])) :
            foreach($uspbar['usps'] as $usp){
                echo '<div class="uspBlock text-sm mr-8"><i class="mr-2 ' . $usp['icon'] . '"></i>' . $usp['usp'] . '</div>';
            }
        endif;
        ?>
    </div>
</div>