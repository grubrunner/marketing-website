<?php

namespace NotificationXPro\Core;

use NotificationX\Core\PostType as PostTypeFree;

/**
 * This class will provide all kind of helper methods.
 */
class PostType extends PostTypeFree {


    public function can_enable($source){
        return true;
    }

    public function update_enabled_source($post){

    }

}
