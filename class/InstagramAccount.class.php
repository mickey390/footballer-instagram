<?php
/**
 * @category  PHP
 * @package   InstagramAccounts
 * @author    mickey390 <author@mail.com>
 * @copyright 2015 mickey390
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version   Git
 * @link      http://pear.php.net/package/InstagramAccounts
 * @see       References to other sections (if any)...
 */

/**
 * Description for require_once
 */
require_once 'InstagramBase.class.php';

/**
 * Short description for class
 *
 * Long description (if any) ...
 *
 * @category  PHP
 * @package   InstagramAccounts
 * @author    mickey390 <author@mail.com>
 * @copyright 2015 mickey390
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/InstagramAccounts
 * @see       References to other sections (if any)...
 */
class InstagramAccounts extends InstagramBase
{

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
        parent::__construct();
    }

    /**
     * Short description for function
     *
     * @return void
     * @access public
     */
    public function setCollection()
    {
        if ($this->isLocal) {
            // 開発環境
            $this->col = $this->db->selectCollection(LocalEnv::MONGO_LAB_COL1);
        } else {
            // 本番環境
            $this->col = $this->db->selectCollection(getenv('MONGOLAB_COL1'));
        }
    }

    /**
     * Short description for function
     *
     * @param  number  $offset Parameter description (if any) ...
     * @return unknown Return description (if any) ...
     * @access public
     */
    public function getAccountData($offset)
    {
        $limit = 24;
        $skip = ($offset-1) * $limit;

        $docs = $this->col->find(array("id" => array('$exists' => true)))->skip($skip)->limit($limit);

        return $docs;
    }
}
