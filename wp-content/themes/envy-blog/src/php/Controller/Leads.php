<?php
namespace php\Controller;

use \php\Types\ProjectPostType;

class Leads{
    
    public function renderLead(){
        $current_lead = get_queried_object();
        
        $args = [];
        $argsQuery = array(
            'post_type' => 'lead'
        );
    
        $args['leads'] = get_posts($argsQuery);
        
        return $args;
        
    }
    
}
?>