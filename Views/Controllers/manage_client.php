<?php

class clientController {
    public function inForClient() {
        $aUser = new manage_client();
        $inFor = $aUser->getAllInFor();

        include_once 'manage_client/list_user.php';
    }
} 
        ?>