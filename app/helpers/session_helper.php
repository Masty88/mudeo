<?php
session_start();

// Flash Message
// EXEMPLE - flash('register_success', 'you are now registered')
//DISPLAY IN VIEW - <?= FLASH('register_success')
function flash($name='', $message='', $class = "has-text-white"){
if(!empty($name)){
    if(!empty($message) && empty($_SESSION[$name])){
        if(!empty($_SESSION[$name])){
            unset($_SESSION[$name]);
        }
        if(!empty($_SESSION[$name.'_class'])){
            unset($_SESSION[$name.'_class']);
        }
        $_SESSION[$name]= $message;
         $_SESSION[$name.'_class']=$class;
    }
    elseif (empty($message) && !empty($_SESSION[$name])){
        $class= !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
        echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name.'_class']);
    }
}
}
function isLoggedIn(){
    if(!$_SESSION['logged']){
        return false;
    }else{
        return true;
    }
}

function isAdded($id){
    if(in_array($id, $_SESSION['array_watch'] )){
        return true;
    }else{
        return false;
    }
}

function isLiked($id){
    if(in_array($id, $_SESSION['array_like'] )){
        return true;
    }else{
        return false;
    }
}

?>