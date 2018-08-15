<?php

namespace App\Http\BnImplements;

use Illuminate\Support\Facades\DB;
use App\BananaClient;
use App\Constant;


class signinBananaBnImplement
{
    public function createClient($nombre, 
    $description, 
    $bdname, 
    $bdhost, 
    $bduser, 
    $bdpassword, 
    $bddriver, 
    $dns, 
    $nameConBD) {

         $banana_client = new BananaClient();
        //$banana_client = BananaClient::findOrfail();

        $banana_client->client_name = $nombre;
        $banana_client->client_description= $description;
        $banana_client->client_DB_name =$bdname;
        $banana_client->client_DB_host=$bdhost;
        $banana_client->client_DB_user=$bduser;
        $banana_client->client_DB_password=$bdpassword;
        $banana_client->client_DB_driver=$bddriver;
        $banana_client->client_dns=$dns;
        $banana_client->client_name_conecction_BD=$nameConBD;

            
        $banana_client->save();
        //$banana_client->update();

        return $banana_client;
    }  
    
    public function updateClient($nombre,  $description, $bdname, $bdhost, $bduser, $bdpassword, $bddriver, $bddns, $nameConBD){
        
        $banana_client =  BananaClient::findOrfail();

        $banana_client->client_name =$nombre;
        $banana_client->client_description= $description;
        $banana_client->client_DB_name =$bdname;
        $banana_client->client_DB_host=$bdhost;
        $banana_client->client_DB_user=$bduser;
        $banana_client->client_DB_password=$bdpassword;
        $banana_client->client_BD_driver=$bddriver;
        $banana_client->client_dns=$bddns;
        $banana_client->client_name_conecction_BD=$nameConBD;

        $banana_client->update();




    }
}
