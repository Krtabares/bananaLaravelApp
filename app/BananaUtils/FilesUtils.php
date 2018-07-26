<?php

namespace App\BananaUtils;

use App\constant;
use App\BananaClient;

class FilesUtils{

    public $client_storageURL;

    public  function setStorageSimple ($DNS)
    {
        try {

            $DBinfo = BananaClient::where('client_dns', $DNS)->first();


            if($DBinfo != null){

                $configStorage = array(
                    'driver' => 'local',
                    'root' => $DBinfo->client_storageURL.'/store/'.$DBinfo->id,
                    'visibility' => 'public'

                );

                $this->client_storageURL = $DBinfo->client_storageURL;

                \Config::set('filesystems.disks.'.$DBinfo->client_name_storageURL, $configStorage);


            } else{

                throw new \Exception(Constant::MSG_CLI_NOT_FOUND, 1);

            }

        } catch (\Illuminate\Database\QueryException  $e) {

            throw new \Exception(Constant::MSG_CONNECTION_ERROR, Constant::CONNECTION_ERROR);
        }

        return  $this->client_storageURL;

    }



}
