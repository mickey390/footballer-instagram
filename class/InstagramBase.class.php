<?php

/**
 * @category  PHP
 * @package   InstagramBase
 * @author    mickey390 <author@mail.com>
 * @copyright 2015 mickey390
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version   Git
 * @link      http://pear.php.net/package/InstagramBase
 * @see       References to other sections (if any)...
 */

/**
 * Short description for class
 *
 * Long description (if any) ...
 *
 * @category  PHP
 * @package   InstagramBase
 * @author    mickey390 <author@mail.com>
 * @copyright 2015 mickey390
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/InstagramBase
 * @see       References to other sections (if any)...
 */
class InstagramBase
{

    /**
     * Description for public
     * @var boolean
     * @access public
     */
    public $isLocal = false;

    /**
     * Short description for function
     *
     * Long description (if any) ...
     *
     * @return void
     * @access public
     */
    public function __construct()
    {
        $this->getEnv();

        $this->setMongInfo();
    }

    /**
     * 環境を取得
     *
     * @return void
     * @access private
     */
    private function getEnv()
    {
        // heroku config:set PHP_ENV=heroku
        switch (getenv('PHP_ENV')) {
            case 'heroku':
                $this->isLocal = false;
                break;
            default:
                $this->isLocal = true;
                require '../local/local.env.php';
                break;
        }
    }

    /**
     * サーバ情報をset
     *
     * @return void
     * @access private
     */
    private function setMongInfo()
    {
        if ($this->isLocal) {
            // 開発環境
            $this->connection = new Mongo(LocalEnv::MONGO_LAB_URI);
            $this->db = $this->connection->selectDB(LocalEnv::MONGO_LAB_DB1);
        } else {
            // 本番環境
            $this->connection = new Mongo(getenv('MONGOLAB_URL1'));
            $this->db = $this->connection->selectDB(getenv('MONGOLAB_DB1'));
        }
    }
}
