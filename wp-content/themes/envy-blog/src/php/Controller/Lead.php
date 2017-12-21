<?php
namespace php\Controller;

use \php\Types\ProjectPostType;

class Lead{
    
    public function renderLead(){
        $current_lead = get_queried_object();
        
        $args = [];
        $argsQuery = array(
            'post_type' => 'post',
            'post_parent' => $current_lead->ID,
        );
    
        $args['car'] = get_posts($argsQuery);
        
        return $args;
        
    }
    
}
?>