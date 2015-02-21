<?php

require_once('InstagramBase.class.php');

class InstagramPosts extends InstagramBase
{

    function __construct() {
        parent::__construct();
    }

    public function setCollection(){
        // exit;
        if($this->isLocal){
            // 開発環境
            $this->col = $this->db->selectCollection(LocalEnv::MONGO_LAB_COL2);
        }else{
            // 本番環境
            $this->col = $this->db->selectCollection(getenv('MONGOLAB_COL2'));
        }

    }


    public function getPostData(){
        // public function getAccountData($offset){

        // $limit = 20;
        // $skip = ($offset-1) * $limit;
        $rand = mt_rand(1, 100);
        // $docs = $this->col->find()->skip($skip)->limit($limit);
        // $docs = $this->col->find();
        $docs = $this->col->find(array("rand"=>$rand));
        
        $out = array();
        foreach ($docs as $id =>$obj) {

            $out[] = $obj;

        }
        shuffle($out);

        return $out;


    }

}

?>