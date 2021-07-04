<?php

if(!function_exists('flash')){
    function flash($message  , $type = 'success' , $id=-1){
        session()->flash('notification.message',$message);
        session()->flash('notification.type',$type);
        session()->flash('notification.id',$id);
    }
}
