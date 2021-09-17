<?php

    function Redirect_Self_URL(){
        unset($_REQUEST);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }