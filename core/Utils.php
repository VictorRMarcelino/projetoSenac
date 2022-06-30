<?php 

class Utils {

    public static function converteData($data){
        return date('d/m/Y', strtotime($data));
    }
}