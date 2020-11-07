<div id="head" class="navigation-bar <?php if($header['sticky_head']) echo 'sticky'; ?>">
    <?php
        if(!empty($huisstijl['logo'])) echo '<img src="' . $huisstijl['logo']['url'] . '" alt="' . $huisstijl['logo']['alt'] . '">';
        if($header['show_searchbar']) echo '<input type="text" name="search" placeholder="" value="">';
    ?>
</div>