<?php

class helpers {
    
    public function isRequestPost($request) {
        
        if ($request['REQUEST_METHOD'] == 'POST') {
            return true;
        }
        
        return false;
    }
    
    public function getPostData($post) {
        if (empty($post)) { return array(); }
        
        return $post;
    }
    
    public function getGetData($get) {
        if (empty($get)) { return array(); }
        
        return $get;
    }
}