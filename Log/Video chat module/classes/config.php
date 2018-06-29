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
        $this->dbname = "Video_chat_module";

        $this->mysqli = new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
        return $this->mysqli;
    }

    public function insert($fname,$lname,$uname,$email,$password)
    {
        $fname = $this->mysqli->real_escape_string($fname);
        $lname = $this->mysqli->real_escape_string($lname);
        $uname = $this->mysqli->real_escape_string($uname);
        $email = $this->mysqli->real_escape_string($email);
        $password = $this->mysqli->real_escape_string($password);

        $result = $this->mysqli->query("INSERT INTO users(fname,lname,username,email,password,role)VALUES('$fname','$lname','$uname','$email','$password','admin')");
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
}
?>
