<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Example_Model extends CIL_Model
{
        const MDL_TABLE = 'blog';
    
        public function __construct() {
            parent::__construct(self::MDL_TABLE);
        }
}