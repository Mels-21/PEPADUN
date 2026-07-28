<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate_db extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function index() {
        $sql_file = FCPATH . 'pepadun.sql';
        
        if (!file_exists($sql_file)) {
            die('Error: pepadun.sql not found at ' . $sql_file);
        }
        
        $sql = file_get_contents($sql_file);
        
        // Remove comments and split into separate queries
        $sql = preg_replace('/--.*$/m', '', $sql);
        $sql = preg_replace('/^#.*$/m', '', $sql);
        $queries = explode(';', $sql);
        
        $success_count = 0;
        $error_count = 0;
        
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                if ($this->db->query($query)) {
                    $success_count++;
                } else {
                    $error_count++;
                    echo "Error on query: " . $query . "<br>";
                    $db_error = $this->db->error();
                    echo "Message: " . $db_error['message'] . "<br><hr>";
                }
            }
        }
        
        echo "<h3>Database Import Finished!</h3>";
        echo "Queries successful: " . $success_count . "<br>";
        echo "Queries failed: " . $error_count . "<br>";
        echo "<br><b>Please check your app now!</b>";
    }
}
