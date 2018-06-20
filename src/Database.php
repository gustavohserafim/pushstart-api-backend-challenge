<?php

class Database{
    static public function conectar(){
        return new PDO('mysql:host=localhost; dbname=api;', 'root', '');
    }
};
