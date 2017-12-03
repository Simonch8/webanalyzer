<?php
/**
* This class handles all requests from the plugin and the backend when something has to be
* done with the database. E.g. select, delete, create etc.
* @author   Raphael Hänni
* @version  v1.0.0
**/
class Connector {

    private $serverName;
    private $user;
    private $pw;
    private $dbName;

    private $conn;

    /**
    * Constructor
    * Loads database information from the file db.config into the object
    * @param $path -> path to the db.config file
    **/
    function __construct( $path ) {
        $handle = fopen($path, "r" );
        if( $handle ) {

            while( $line = fgets($handle) ) {
                $line = substr($line, 0, -2);
                $split = explode( "#:#", $line );

                switch( $split[0] ) {
                    case "serverName":
                        $this->serverName = $split[1];
                        break;
                    case "user":
                        $this->user = $split[1];
                        break;
                    case "pw":
                        $this->pw = $split[1];
                        break;
                    case "dbName":
                        $this->dbName = $split[1];
                        break;
                }
            }

            fclose($handle);

            //creates connection after config file has been read
            $this->conn = new mysqli( "$this->serverName", "$this->user", "$this->pw", "$this->dbName" ) or die( "Database could not be connected" );
        } else {
            echo "ERROR: could not open file";
        }
    }

    /**
    * Closes the connection when the object is destructed
    **/
    function __destruct() {
        $this->conn->close();
    }

///
// FUNCTIONS
///

    /**
    * Returns list of all calls of given url
    * @param $url -> domain name of website (E.g. www.gibb.ch)
    **/
    public function selectCallsFromUrl( $url ) {
        $result = array();
        $query = "SELECT * FROM calls c JOIN urls u ON (u.id_url = c.fk_url) WHERE u.isBlacklist LIKE 0 AND u.url LIKE '$url'";
        $data = $this->conn->query( $query );

        while( $row = $data->fetch_assoc() ) {
            array_push( $result, $row );
        }

        $data->free();

        return $result;
    }

    /**
    * Returns all calls from all the urls as a list
    **/
    public function selectAllCalls() {
        $result = array();
        $query = "SELECT * FROM calls c JOIN urls u ON (u.id_url = c.fk_url) WHERE u.isBlacklist LIKE 0";
        $data = $this->conn->query( $query );

        while( $row = $data->fetch_assoc() ) {
            array_push( $result, $row );
        }

        $data->free();

        return $result;
    }

    /**
    * Returns boolean if the url already exists in the database
    * @param $url -> domain name (E.g. www.gibb.ch)
    * @return $result -> true/false
    **/
    public function urlExists( $url ) {
        $result = false;
        $query = "SELECT url FROM urls WHERE url LIKE '$url'";
        $data = $this->conn->query( $query );

        if( $row = $data->fetch_assoc() ) {
            if( $url == $row['url'] ){
                $result = true;
            }
        }
        $data->free();

        return $result;
    }

    /**
    * Saves a new domain
    * @param $url -> domain name (E.g. www.gibb.ch)
    * @param $isBlacklisted -> 1=blacklisted; 0=not blacklisted
    **/
    public function saveUrl( $url, $isBlacklisted ) {
        $query = "INSERT INTO `urls` (`url`, `isBlacklist`) VALUES ('$url', '$isBlacklisted')";
        $this->conn->query( $query );
    }

    /**
    * Saves a new call of a website that was received from the plugins
    * @param $url -> domain name (E.g. www.gibb.ch)
    **/
    public function saveCall( $url ) {
        $urlID;
        $selectQuery = "SELECT id_url FROM urls WHERE url LIKE '$url'";

        if( !$this->isOnBlacklist($url) ) {

            //Create entry for url if it doesn't exist
            if( !$this->urlExists($url) ) {
                $this->saveUrl( $url, 0 );
            }

            $selectData = $this->conn->query( $selectQuery );
            if( $row = $selectData->fetch_assoc() ) {

                $urlID = $row['id_url'];
                $saveQuery = "INSERT INTO `calls` ( `fk_url` ) VALUES ( $urlID )";
                $this->conn->query( $saveQuery );
            }
            $selectData->free();
        }
    }

    /**
    * get all urls
    * @return $result = JSON array of urls[id_url, url]
    **/
    public function selectAllURL() {
        $result = array();
        $query = "SELECT * FROM urls";
        $data = $this->conn->query( $query );

        while( $row = $data->fetch_assoc() ) {
            array_push( $result, $row );
        }
        $data->close();

        return $result;
    }

    /**
    * Checks if the given url is on the blacklist or not
    * @param $url -> domain name (E.g. www.gibb.ch)
    * @return $result -> true/false
    **/
    public function isOnBlacklist( $url ) {
        $result = false;
        $query = "SELECT * FROM urls WHERE url LIKE 'google.ch'";
        $data = $this->conn->query( $query );

        if( $row = $data->fetch_assoc() ) {
            if( $row['isBlacklist'] === 1 ) {
                $result = true;
            }
        }

        return $result;
    }

    /**
    * get all blacklisted urls
    * @return $result = JSON array of urls[id_url, url]
    **/
    public function selectAllBlacklistedURL() {
        $result = array();
        $query = "SELECT id_url, url FROM urls WHERE isBlacklist LIKE 1";
        $data = $this->conn->query( $query );

        while( $row = $data->fetch_assoc() ) {
            array_push( $result, $row );
        }
        $data->close();

        return $result;
    }

    /**
    * Registers an existing URL as blacklisted
    * @param $url -> domain name (E.g. www.gibb.ch)
    * @param $blackListStatus -> 0 or 1
    **/
    public function updateURL( $url, $blackListStatus ) {
        $query = "UPDATE `urls` SET `isBlacklist`= `$blackListStatus` WHERE `url` LIKE '$url'";

        if( $this->urlExists($url) ) {
            $this->conn->query( $query );
        }
    }

    /**
    * Registers an existing URL as blacklisted
    * @param $url -> domain name (E.g. www.gibb.ch)
    * @param $isBlacklist -> 0 or 1
    **/
    public function alterBlacklist( $url, $isBlacklist ) {
        $query = "UPDATE `urls` SET `isBlacklist`= '$isBlacklist' WHERE `url` LIKE '$url'";

        if( $this->urlExists($url) ) {
            $this->conn->query( $query );
        }
    }

    /**
    * Registers an existing URL as blacklisted
    * @param $url -> domain name (E.g. www.gibb.ch)
    **/
    public function addToBlacklist( $url ) {
        $query = "UPDATE `urls` SET `isBlacklist`= 1 WHERE `url` LIKE '$url'";

        if( $this->urlExists($url) ) {
            $this->conn->query( $query );
        }
    }

    /**
    * Invokes the blacklisted status from an URL
    * @param $url -> domain name (E.g. www.gibb.ch)
    **/
    public function removeFromBlacklist( $url ) {
        $query = "UPDATE `urls` SET `isBlacklist`= 0 WHERE `url` LIKE '$url'";

        if( $this->urlExists($url) ) {
            $this->conn->query( $query );
        }
    }

    public function getMostVisited() {
        $result = array();
        $urls = array();
        $queryUrl = "SELECT url FROM urls WHERE isBlacklist NOT LIKE 1";
        $dataUrl = $this->conn->query( $queryUrl );
        while( $row = $dataUrl->fetch_assoc() ) {
            array_push( $urls, $row );
        }

        foreach ($urls as $key => $value) {
            $url = $value['url'];
            $queryCount = "SELECT COUNT(c.id_call) AS '$url' FROM calls c JOIN urls u ON (u.id_url = c.fk_url) WHERE url = '$url'";
            $dataCount = $this->conn->query( $queryCount );

            $value = $dataCount->fetch_assoc()[ $url ];

            $result[ $url ] = $value;
        }

        return $result;
    }

}
?>
