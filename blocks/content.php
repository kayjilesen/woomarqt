<?php
	/*
	* File: content.php
	* Created: 12/11/2020
	* Author: Kay Jilesen (info@averex.nl)
	* -----
	* Last Modified: 12/11/2020
	* -----
	* © 2020 Averex
    */
    
    $page_id = get_queried_object_id();

    $blockIndex = 1;

    foreach(get_field('blok') as $layout){

        if($layout['acf_fc_layout'] === 'producten'){
            echo '<section id="block' . $blockIndex . '" class="product bg-gray-300 py-' . $layout['styling']['padding_y'] . ' px-' . $layout['styling']['padding_x'] . '">';
                echo '<div class="row ' . $layout['styling']['width'] . ' mx-auto">';       
                    echo 'test';
                echo '</div>';
            echo '</section>';
        }
        if($layout['acf_fc_layout'] === 'custom'){

            echo '<section id="block' . $blockIndex . '" class="custom bg-gray-300 py-' . $layout['styling']['padding_y'] . ' px-' . $layout['styling']['padding_x'] . '">';
                echo '<div class="row flex flex-wrap ' . $layout['styling']['width'] . ' mx-auto">';     
                    foreach($layout['kolommen'] as $kolom){
                        echo '<div class="column lg:' . $kolom['breedte'] . ' flex flex-col">';

                            foreach($kolom['subblokken'] as $subblok){
                                echo '<div class="subblock ' . 'py-' . $subblok['styling']['padding_y'] . ' px-' . $subblok['styling']['padding_x'] . '">';

                                    foreach($subblok['sub_content'] as $content){
                                        if($content['acf_fc_layout'] === 'titel'){
                                            echo '<' . $content['type'] . '>' . $content['tekst'] . '</' . $content['type'] . '>';
                                        } else if($content['acf_fc_layout'] === 'cta'){
                                            if($content['type'] === 'button'){
                                                echo '<a class="button" href="' . $content['link'] . '">' . $content['tekst'] . '</a>';
                                            } else if($content['type'] === 'text'){
                                                echo '<a class="text" href="' . $content['link'] . '">' . $content['tekst'] . '</a>';
                                            }
                                        }
                                    }

                                echo '</div>';
                            }

                        echo '</div>';
                    }
                echo '</div>';
            echo '</section>';

        }
        $blockIndex++;
    }