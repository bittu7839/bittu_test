<?php
    class Source extends Database {

        public $query;

        // Accept all database queries
        public function query($query, $param = [])
        {
            if (empty($param)) {
                // We do not have parameters
                $this->query = $this->db->prepare($query);
                return $this->query->execute();
            }else{
                // We have some parameters
                $this->query = $this->db->prepare($query);
                return $this->query->execute($param);
            }
        }

        // Count the number of rows

        public function countRows()
        {
            return $this->query->rowCount();
        }

        // Fetch all records from specific table
        public function fetchAll()
        {
            return $this->query->fetchAll(PDO::FETCH_OBJ);
        }

        // Fetch single row from specific table
        public function single()
        {
            return $this->query->fetch(PDO::FETCH_OBJ);
        }
    }

?>