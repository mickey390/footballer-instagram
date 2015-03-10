<?php

/**
 * @category  PHP
 * @package   InstagramPosts
 * @author    mickey390 <author@mail.com>
 * @copyright 2015 mickey390
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version   CVS: $Id:$
 * @link      http://pear.php.net/package/InstagramPosts
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
 * @package   InstagramPosts
 * @author    mickey390 <author@mail.com>
 * @copyright 2015 mickey390
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/InstagramPosts
 * @see       References to other sections (if any)...
 */
class InstagramPosts extends InstagramBase
{

    /**
     * Short description for function
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
            $this->col = $this->db->selectCollection(LocalEnv::MONGO_LAB_COL2);
        } else {
            // 本番環境
            $this->col = $this->db->selectCollection(getenv('MONGOLAB_COL2'));
        }
    }

    /**
     * Short description for function
     *
     * @return array Return description (if any) ...
     * @access public
     */
    public function getPostData()
    {
        $rand = mt_rand(1, 100);
        $docs = $this->col->find(array("rand" => $rand));
        $out = array();

        foreach ($docs as $id => $obj) {
            $out[] = $obj;
        }

        shuffle($out);

        return $out;
    }
}
