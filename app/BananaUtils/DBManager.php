<?php

namespace App\BananaUtils;

use App\constant;
use App\BananaClient;
use App\BananaUtils\SessionToken;
use App\BananaUtils\ExceptionAnalizer;


class DBManager{

    private $client_name_conecction_BD;
    public $client_storageURL;
    public $client_name_storageURL;

    public  function getClientBDConecction ($DNS,$user,$token,$app)
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
                $this->client_storageURL = $DBinfo->client_storageURL;
                $this->client_name_storageURL = $DBinfo->client_name_storageURL;

                \Config::set('database.connections.'.$this->client_name_conecction_BD, $configDb);

                $conectionSQL = \DB::connection($this->client_name_conecction_BD);

                if($token != Constant::TOKEN_LOGIN){
                    SessionToken::validateToken($conectionSQL, $user, $token, $app);
                }

            } else{

                throw new \Exception(Constant::MSG_CLI_NOT_FOUND, 1);

            }

        } catch (\Illuminate\Database\QueryException  $e) {

            throw new \Exception(Constant::MSG_CONNECTION_ERROR, Constant::CONNECTION_ERROR);
        }

        return $conectionSQL;

    }

    public function terminateClientBDConecction()
    {
        \DB::disconnect( $this->client_name_conecction_BD);
    }

}
