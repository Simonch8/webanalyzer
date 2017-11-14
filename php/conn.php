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
    **/
    function __construct() {
        $handle = fopen("php/db.config", "r");
        if ($handle) {

            while ( $line = fgets($handle) ) {
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

    }

    /**
    * Registers an existing URL as blacklisted
    * @param $url -> domain name (E.g. www.gibb.ch)
    **/
    public function addAsBlacklist( $url ) {

    }

    /**
    * Invokes the blacklisted status from an URL
    * @param $url -> domain name (E.g. www.gibb.ch)
    **/
    public function deleteFromBlacklist( $url ) {

    }


}
?>
