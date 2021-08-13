    <?php
session_start();

class CreateInstallation
{
    /*** MYSQL HOSTNAME ***/
    protected $db_host = null; // Put your Host name here...

    /*** MYSQL DATABANSE NAME  ***/
    protected $db_name = null; // Put your Database name here...

    /*** MYSQL USERNAME ***/
    protected $db_user = null; // Put your MYSQL Username here

    /*** MYSQL PASSWORD ***/
    protected $db_pass = null; // Put Your MYSQL Password here

    /*** PDO error mode set ***/
    protected $db_optn = null; // PDO Exception

    /*** database resource ***/
    public $conn = null; // Database handler queries

    /*** Databse error List  */
    private static $ErrorArray; // Databse error handler

    /*** Return error message */
    public $error_message = null;

    /** Create New User */
    private $CreateUser = null;

    /** Collect Data */
    private $CollectData = null;

    /** Open SQL file  */
    private $filename = null;

    /** Cross Check Table */
    private $Entries = null;

    /** Check if the database exists */
    private $CrossCheck = null;

    /** Config Update */
    private $Config_update = null;

    /** Get Config file */
    private $GetFileToUpdate = null;

    /** Create Table */
    private $Save_token = null;

    public function installdata()
    {
        $this->InstallCounriesList();
    }

    private function InstallCounriesList()
    {
        self::$ErrorArray = array(
            /**
             * Unknown database - 1049
             * Depending on how MySQL was installed, it is possible that the default MySQL database was NOT created.
             * This may be checked by looking in /var/lib/mysql for a mysql subfolder
             * (i.e. /var/lib/mysql/mysql ). If the path does NOT contain a mysql subfolder,
             * it needs to be created
             */
            "1049" => " <strong> Database </strong> not found",

            /**
             *Access denied - 1045
             * MySQL provides a privilege system that authenticates the user
             * who connects from a host, and associates the user with access
             * privileges on a database. The privileges include SELECT, INSERT, UPDATE,
             * and DELETE and are able to identify anonymous users and grant privileges
             * for MySQL specific functions, such as LOAD DATA INFILE and administrative
             * operations. The access denied error may occur because of many causes.
             * In many cases, the problem is caused because of MySQL accounts that the
             * client programs use to connect with the MySQL server with permission
             * from the server.
             */
            "1045" => " <strong> username or password </strong> incorrect",

            /**
             * hostname not found - 2002
             * The MySQL hostname will always be ‘localhost’
             * in your configuration files. If you need to
             * connect to your database from your
             */
            "2002" => " Please confirm web <strong> hostname </strong>",

            /**
             * Letters are exceeding to the limit - 42000
             * The ERROR 1064 (42000) mainly occurs when the syntax
             * isn’t set correctly i.e. error in applying
             * the backtick symbol or while creating a database
             * without them can also create an error,
             * if you will use hyphen in the name, for example,
             * Demo-Table will result in ERROR 1064 (42000).
             */
            "42000" => " Letters are exceeding to the limit",

            /**
             * Duplicate answer - 42S21
             * Please note that views must have unique column names with no duplicates.
             * By default, the names of the columns retrieved by the SELECT
             * statement are used for the view column names. As your
             * tables in SELECT statement contain some column
             * names which are the same, therefore it results in
             * violation and throws an error.
             */
            "42S21" => " Duplicate answer",

            /**Avoid the problem by refining your queries - 2013
             *In many cases, you can avoid the problem entirely
             * by refining your SQL queries. For example,
             * instead of joining all the contents of two
             * very large tables, try filtering out the records
             * you don’t need. Where possible, try reducing the
             * number of joins in a single query. This should have
             * the added benefit of making your query easier to read.
             * For my purposes, I’ve found that denormalizing
             * content into working tables can improve the
             * read performance. This avoids time-outs.
             * Re-writing the queries isn’t always option so you can
             * try the following server-side and
             * client-side workarounds. */
            "2013" => " <strong>Lost connection </strong> to MySQL server during query",

            /**On some systems, you may find that your password  - 1524
             * works when specified in an option file or on
             * the command line, but not when you enter
             * it interactively at the Enter password: prompt.
             * This occurs when the library provided by
             * the system to read passwords limits password
             * values to a small number of characters (typically eight).
             * That is a problem with the system library, not with MySQL.
             * To work around it, change your MySQL password to a value that is
             * eight or fewer characters long, or put
             * your password in an option file. */
            "1524" => " <strong>Password fails </strong> when entered incorrectly",

            /** The number of connections permitted is controlled by -  1129
             * the MySQL/MariaDB max_connections system variable.
             * The default value is 151 to improve performance when
             * MySQL is used with the Web server. You might run into
             * a problem if you are running a high trafficked web site or
             * MariaDB server in clustered mode or using a Galera master to master
             * DB cluster. If you need to support more connections,
             */
            "1129" => " Host <strong>'host_name' is blocked </strong> because of many connection",

            /** Out of memory - 2008
             * To remedy the problem first check whether your query is correct.
             * Is it reasonable that it should return so many rows?
             * If not, correct the query and try again. Otherwise,
             * you can invoke mysql with the --quick option. This causes
             * it to use the mysql_use_result() C API function to retrieve the result set,
             * which places less of a load on the client (but more on the server).
             * */
            "2008" => " MySQL client ran <strong> out of memory </strong>",

            /**
             * Packet too large - 2027
             * It is safe to increase the value of this variable because
             * the extra memory is allocated only when needed. For example,
             * mysqld allocates more memory only when you
             * issue a long query or when mysqld must return a large result row.
             */
            "2027" => " Packet <strong> too large </strong>",

            /**
             * The table is full - 1114
             * If a table-full error occurs, it may be that the
             * disk is full or that the table has reached its
             * maximum size. The effective maximum table size for MySQL
             * databases is usually determined by operating system
             * constraints on file sizes, not by MySQL internal limits.
             */
            "1114" => " The table is <strong> full </strong>",

            /**
             * Commands out of sync - 2014
             * If you get Commands out of sync; you can't
             * run this command now in your client code,
             * you are calling client functions in the wrong order.
             * This can happen, for example, if you are using
             * mysql_use_result() and try to execute a new query
             * before you have called mysql_free_result(). It can also
             * happen if you try to execute two queries that return data
             * without calling mysql_use_result() or mysql_store_result()
             * in between.
             */
            "2014" => " Commands <strong> out of sync </strong>",

            /**
             * Ignoring user - 00000
             * If you get the following error, it means that when mysqld was
             * started or when it reloaded the grant tables, it found an account
             * in the user table that had an invalid password.
             * Found wrong password for user 'some_user'@'some_host'; ignoring user
             * As a result, the account is simply
             * ignored by the permission system.
             * To fix this problem, assign a new, valid password to the account. */
            "00000" => " <strong> Database </strong> Ignoring user",

            /**
             * Table 'tbl_name' doesn't exist - 1146
             * In some cases, it may be that the table does exist
             * but that you are referring to it incorrectly:
             * Because MySQL uses directories and files to
             * store databases and tables, database and table
             * names are case sensitive if they are located on a
             * file system that has case-sensitive file names.
             * Even for file systems that are not case-sensitive,
             * such as on Windows, all references to a given table
             *  within a query must use the same lettercase.
             */
            "1146" => " Table tbl_name <strong> doesn’t exist </strong>",
        );
        try {
            /** Collect data infromation  */
            $this->db_host = $_SESSION["hostname"];
            $this->db_name = $_SESSION["dbname"];
            $this->db_user = $_SESSION["dbuser"];
            $this->db_pass = $_SESSION["dbpass"];
            $this->db_keys = $_SESSION["token"];
            /** Connect database */
            $this->conn = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_user, $this->db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /* installation */

            if (!file_exists('life_time_free.sql')) {
                echo "<span style='display : none'> OPWRTY </span>";

            } else {

                $this->filename = 'life_time_free.sql';
                $templine = '';
                // Read in entire file
                $lines = file($this->filename);
                $req = 1;
                // Loop through each line
                foreach ($lines as $line) {
                    // Skip it if it's a comment
                    if (substr($line, 0, 2) == '--' || $line == '') {
                        continue;
                    }

                    // Add this line to the current segment
                    $templine .= $line;
                    // If it has a semicolon at the end, it's the end of the query
                    if (substr(trim($line), -1, 1) == ';') {
                        // Perform the query
                        if ($this->conn->query($templine)) {$req = 3;} else { $req = 0;}
                        // Reset temp variable to empty
                        $templine = '';
                    }
                }
                if ($req == 3) {
                    $this->Save_token = "CREATE TABLE `key` (
            `key_id` int(11) NOT NULL,
            `secret_key` varchar(40) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            INSERT INTO `key` (`secret_key`) VALUES (:token)";
                    $qer = $this->conn->prepare($this->Save_token);
                    $qer->bindParam(':token', $this->db_keys);
                    $qer->execute();

                    echo '<span style="display : none"> 789jpo </span>';
                    $this->GetFileToUpdate = fopen("config.php", "w");
                    $this->Config_update = '<?php
            class php_config
            {
            private $status = true;
            public $conn;
            public function __construct()
            {
            try {
            $h = $this->webhost = "' . $this->db_host . '";
            $u = $this->username = "' . $this->db_user . '";
            $p = $this->pass = "' . $this->db_pass . '";
            $d = $this->database = "' . $this->db_name . '";
            $this->conn = new PDO("mysql:host=$h; dbname=$d",$u,$p);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $dx)
            {
            $code = $dx->getCode();
            $arr = array(
            "1049"=> " <strong>Database</strong> not found" ,
            "1045"=> " <strong>username or password </strong> incorrect",
            "2002"=> " Please confirm web <strong>hostname</strong>",
            "42000"=> " Letters are exceeding to the limit",
            "42S21"=> " Duplicate answer",
            "2002"=> " Please confirm web hostname"
            );
            echo $dx->getMessage();
            foreach($arr as $codes => $string)
            {  if($code == $codes):
            echo $string;
            endif;
            }
            }
            }
            }
            if(count(get_included_files()) ==1){
            ?>
    <script>
window.location = "404";
    </script>
    <?php
            exit("Direct access not permitted.");
            } ?>';
    fwrite($this->GetFileToUpdate, $this->Config_update);
    fclose($this->GetFileToUpdate);} else {echo '<span style="display : none"> oiiwug </span>';}

    }

    } catch (PDOException $error) {/** Detect error from the connecting process */
    $dx = $error->getCode(); // Detect databse error
    /** search error code from the array */
    foreach (self::$ErrorArray as $codes => $string) {if ($dx == $codes): echo $string;endif;}
    }
    }

    }

    if (isset($_SESSION["hostname"])) {
    $install = new CreateInstallation();
    $install->installdata();
    }
    ?>