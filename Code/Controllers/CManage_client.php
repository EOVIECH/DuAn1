<?php

class clientController {
    public function inForClient() {
        $aUser = new manage_client();
        $inFor = $aUser->getAllInFor();

        include_once './Views/Admin/list_user.php';
    }
} 
        ?>