<?php 
    class ShorterUrl
    {

        public $db;

        public function __construct()
        {
            $this->$db = new SQLite3('mydb.db');
        }

        public function getCount()
        {
            $sql = "SELECT COUNT(1) FROM urls";
            $result = $this
                ->$db->querySingle($sql);
            return $result;
        }

        public function getInitUrl($url_short)
        {
            $sql = "SELECT url_init FROM urls WHERE url_short='" . $url_short . "'";
            $result = $this
                ->$db->querySingle($sql);
            return $result;
        }

        public function generateUrl()
        {
            $number = $this->getCount();
            return strtr(rtrim(base64_encode(pack('i', $number)) , '=') , '+/', '-_');
        }

        public function addUrl($url)
        {
            $url_short = $this->generateUrl();
            $this
                ->$db->exec("INSERT INTO urls (url_init, url_short) VALUES ('" . $url . "', '" . $url_short . "')");
            return $url_short;
        }
    }
?>