<?php

class InstagramBase
{
    public $isLocal = false;

    function __construct() {

        $this->envSwitcher();

        if($this->isLocal){
            // 開発環境
            $this->connection = new Mongo(LocalEnv::MONGO_LAB_URI);
            $this->db = $this->connection->selectDB(LocalEnv::MONGO_LAB_DB1);

        }else{
            // 本番環境
            $this->connection = new Mongo(getenv('MONGOLAB_URL1'));
            $this->db = $this->connection->selectDB(getenv('MONGOLAB_DB1'));

        }

    }

    private function envSwitcher(){
        // heroku config:set PHP_ENV=heroku
        switch (getenv('PHP_ENV')) {
            case 'heroku':
                $this->isLocal = false;
                break;
            default:
                $this->isLocal = true;
                require('../local/local.env.php');
                break;
        }
    }


}

?>