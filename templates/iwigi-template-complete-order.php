<?php
/** 
 * This template is for displaying the message when an order is completed
 */
if(have_posts()){
    while(have_posts()){
        the_post();
       
        the_content();
        
    }
}