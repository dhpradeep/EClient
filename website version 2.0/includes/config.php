<?php
class Database
{
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    public $mysqli;

    public function __construct()
    {
        $this->start();
    }
    public function __destruct() {
        $this->mysqli->close();
    }

    public function start()
    {
        $this->hostname = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "eclient";

        $this->mysqli = new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
        return $this->mysqli;
    }

    // public function insert($fname,$lname,$uname,$email,$password)
    // {

    // }

    public function make($string, $salt = '') {
        return hash('sha256', $string . $salt);
    }

    public function register_company($fname,$lname,$company_full_name,$company_registration_number,$company_email_address,$company_website,$company_country,$company_address)
    {
        $fname = $this->mysqli->real_escape_string($fname);
        $lname = $this->mysqli->real_escape_string($lname);
        $company_full_name = $this->mysqli->real_escape_string($company_full_name);
        $company_registration_number = $this->mysqli->real_escape_string($company_registration_number);
        $company_email_address = $this->mysqli->real_escape_string($company_email_address);
        $company_website = $this->mysqli->real_escape_string($company_website);
        $company_country = $this->mysqli->real_escape_string($company_country);
        $company_address = $this->mysqli->real_escape_string($company_address);

        $result = $this->mysqli->query("INSERT INTO company_temp(fName,lName,company_full_name,company_registration_number,company_email_address,company_website,company_country,company_address)VALUES('$fname','$lname','$company_full_name','$company_registration_number','$company_email_address','$company_website','$company_country','$company_address')");
        return $this->result;
    }

    public function getUser($notid)
    {
        $query = "SELECT * FROM users WHERE NOT id=$notid";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }

    public function login($username,$password)
    {  
        $username = $this->mysqli->real_escape_string($username);
        $password = $this->mysqli->real_escape_string($password);

        //$password = Hash::make($password,'$#@!abcd!@#$1234');

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result=$this->mysqli->query($query);
        //$count=mysqli_num_rows($result);
        $count = $result->num_rows;
        if($count == 1)
        {
            $row = $result->fetch_assoc();
            return $row;
        }else{
            return false;
        }
    }

    public function getcompany($company_id)
    {
        $query = "SELECT * FROM company WHERE ID=$company_id";
        $result=$this->mysqli->query($query);
        $count = $result->num_rows;
        if($count == 1) 
        {
            $row = $result->fetch_assoc();
            return $row;
        }else{
            return false;
        }
    }

    public function getClient($client_id)
    {
        $query = "SELECT * FROM project WHERE ID=$client_id";
        $result=$this->mysqli->query($query);
        $count = $result->num_rows;
        if($count == 1)
        {
            $row = $result->fetch_assoc();
            return $row;
        }else{
            return false;
        }
    }

    public function getNotification($id)
    {
        $query = "SELECT * FROM notification WHERE to_who='$id'";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = null;
        while($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        if($results)
        {
            return json_encode($results);
        }else{
            return null;
        }
    }

    public function setNotification($toid,$byid,$username,$roomNo)
    {
        $toid = $this->mysqli->real_escape_string($toid);
        $byid = $this->mysqli->real_escape_string($byid);
        $username = $this->mysqli->real_escape_string($username);
        $roomNo = $this->mysqli->real_escape_string($roomNo);
        $this->mysqli->query("INSERT INTO notification(by_whom,to_who,data,room)VALUES('$byid','$toid','$username calling you','$roomNo')");
    }

    public function delete($id)
    {
        $query = "DELETE FROM notification WHERE id=$id";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute();
    }

    public function change_status($id)
    {
        $query = "UPDATE users SET user_account_status='active' WHERE id=$id";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute();
    }

    public function make_offline($id)
    {
        $query = "UPDATE users SET user_account_status='deactive' WHERE id=$id";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute();
    }

    public function updateallcompany($id)
    {
        $query = "INSERT INTO company(ID,fName,lName,company_full_name,company_registration_number,company_email_address,company_website,company_country,company_address)SELECT ID,fName,lName,company_full_name,company_registration_number,company_email_address,company_website,company_country,company_address FROM company_temp WHERE ID=$id";  
        $stmt = $this->mysqli->prepare($query);
        $query1 = "Delete FROM company_temp WHERE ID=$id";
        $stmt1 = $this->mysqli->prepare($query1);
        $stmt->execute();
        $stmt1->execute(); 
    }

    public function rejectcompany($id)
    {
        $query = "INSERT INTO company_rejected(ID,fName,lName,company_full_name,company_registration_number,company_email_address,company_website,company_country,company_address)SELECT ID,fName,lName,company_full_name,company_registration_number,company_email_address,company_website,company_country,company_address FROM company_temp WHERE ID=$id";  
        $stmt = $this->mysqli->prepare($query);
        $query1 = "Delete FROM company_temp WHERE ID=$id";
        $stmt1 = $this->mysqli->prepare($query1);
        $stmt->execute();
        $stmt1->execute();
    }
    public function deletecompany($id)
    {
        $query = "Delete FROM company WHERE ID=$id";
        $stmt = $this->mysqli->prepare($query);

        $query1 = "Delete FROM users WHERE related_company=$id";
        $stmt1 = $this->mysqli->prepare($query1);

        $query2 = "Delete FROM project WHERE company_id=$id";
        $stmt2 = $this->mysqli->prepare($query2);

        $stmt->execute();
        $stmt1->execute();
        $stmt2->execute();
    }
}
?>
