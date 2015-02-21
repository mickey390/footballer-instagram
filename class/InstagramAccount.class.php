<?php

require_once('InstagramBase.class.php');

class InstagramAccounts extends InstagramBase
{

    function __construct() {
        parent::__construct();
    }

    public function setCollection(){
        // exit;
        if($this->isLocal){
            // 開発環境
            $this->col = $this->db->selectCollection(LocalEnv::MONGO_LAB_COL1);
        }else{
            // 本番環境
            $this->col = $this->db->selectCollection(getenv('MONGOLAB_COL1'));
        }

    }


    public function getAccountData($offset){

        $limit = 24;
        $skip = ($offset-1) * $limit;

        $docs = $this->col->find()->skip($skip)->limit($limit);


        return $docs;


    }

}

?>