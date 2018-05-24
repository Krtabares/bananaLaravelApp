<?php

namespace App\BananaUtils;

use App\constant;
use App\BananaClient;

class DBManager{

    private $client_name_conecction_BD;

    public  function getClientBDConecction ($DNS)
    {
        try {

            $DBinfo = BananaClient::where('client_dns', $DNS)->first();


            if($DBinfo != null){

                $configDb = array(
                    'driver' => 'mysql',
                    'host' => $DBinfo->client_DB_host,
                    'database' => $DBinfo->client_DB_name,
                    'username' =>  $DBinfo->client_DB_user,
                    'password' =>  $DBinfo->client_DB_password,
                    'charset' => 'utf8',
                    'prefix' => '',
                );

                $this->client_name_conecction_BD = $DBinfo->client_name_conecction_BD;

                \Config::set('database.connections.'.$this->client_name_conecction_BD, $configDb);

                $conectionSQL = \DB::connection($this->client_name_conecction_BD);

            } else{

                throw new \Exception(Constant::MSG_CLI_NOT_FOUND, 1);
                
            }

        } catch (\Illuminate\Database\QueryException  $e) {
           dd($e);
        }

        return $conectionSQL; 

    }

    public function terminateClientBDConecction()
    {
        \DB::disconnect( $this->client_name_conecction_BD);
    }

}
