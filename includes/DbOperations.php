<?php

class DbOperations
{
    private $con;

    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }
    
    //Method student register
    function studentRegister($id, $name, $class, $mobile_no, $email_id, $password, $date_of_birth)
    {
        if (!$this->isStudentExists($id, $email_id)) {
            $password = base64_encode($password);
            $stmt = $this->con->prepare("INSERT INTO student (id, name, class, mobile_No, email_Id, password, date_Of_Birth) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssss", $id,$name,$class, $mobile_no, $email_id, $password, $date_of_birth);
            if ($stmt->execute())
                return USER_CREATED;
            return USER_CREATION_FAILED;
        }
        return USER_EXIST;
    }
    
    //Method student register
    function updateStatus($status, $date, $student_id)
    {
        if(!$this->isStatusExists($date, $student_id))
        {
            $stmt = $this->con->prepare("INSERT INTO status (status, date, student_id) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $status, $date, $student_id);
            if ($stmt->execute())
                return STATUS_UPDATED;
            return STATUS_NOT_UPDATED;
        }
        return STATUS_EXIST;
            
        
    }
    
    function adiminRegister($name, $mobile_no, $email_id, $password)
    {
        if (!$this->isAdminExists($email_id)) {
            $password = base64_encode($password);
            $stmt = $this->con->prepare("INSERT INTO admin (name, mobile_No, email_Id, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $mobile_no, $email_id, $password);
            if ($stmt->execute())
                return USER_CREATED;
            return USER_CREATION_FAILED;
        }
        return USER_EXIST;
    }
    
    //Method for student login
    function adminLogIn($email, $pass)
    {
        $password = base64_encode($pass);
        $stmt = $this->con->prepare("SELECT id FROM admin WHERE email_Id = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
    
    
    
    function isAdminExists($email_id)
    {
        $stmt = $this->con->prepare("SELECT id FROM admin WHERE email_Id = ? ");
        $stmt->bind_param("s", $email_id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
    
    
    function isStatusExists($date, $student_id)
    {
        $stmt = $this->con->prepare("SELECT id FROM status WHERE date = ? AND student_id = ? ");
        $stmt->bind_param("si", $date, $student_id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
    
    function isStudentExists($id, $email_id)
    {
        $stmt = $this->con->prepare("SELECT id FROM student WHERE id = ? OR email_Id = ? ");
        $stmt->bind_param("is", $id, $email_id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
    
    
    //Method for student login
    function studentLogIn($email, $pass)
    {
        $password = base64_encode($pass);
        $stmt = $this->con->prepare("SELECT id FROM student WHERE email_Id = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
    
    function getUserById($email_id)
    {
        $stmt = $this->con->prepare("SELECT id, name, class, mobile_No, email_Id, date_Of_Birth FROM student WHERE email_Id = ?");
        $stmt->bind_param("s", $email_id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $class, $mobile_No, $email_Id, $date_Of_Birth);
        $user = array();
        while($stmt->fetch()){
        $temp = array();
        $temp['id'] = $id;
        $temp['name'] = $name;
        $temp['class'] = $class;
        $temp['mobile_No'] = $mobile_No;
        $temp['email_Id'] = $email_Id;
        $temp['date_Of_Birth'] = $date_Of_Birth;
        array_push($user, $temp);
        }
        return $user;
    }
    
    
    //Method to get status
    function getStatus($date, $status)
    {
        $date =$date;
        $status =$status;
        $stmt = $this->con->prepare("SELECT student.id , student.name  FROM student JOIN status ON student.id = status.student_id WHERE status.date = ? AND status.status = ? "); 
        $stmt->bind_param("si", $date, $status);
        $stmt->execute();
        $stmt->bind_result($id, $name);
        $messages = array();
        while ($stmt->fetch()) {
            $temp = array();
             $temp['id'] = $id;
             $temp['name'] = $name;
           
           #$temp['student_id'] = $student_id;
           
            array_push($messages, $temp);
        }

        return $messages;
    }

//Method to get status
    function getStatusBetweenDates($from_date, $to_date, $status)
    {
        $stmt = $this->con->prepare("SELECT distinct s.id , s.name  FROM student s, status ss where 
s.id = ss.student_id and ss.date BETWEEN ? and ? and ss.status = ? "); 
        $stmt->bind_param("ssi", $from_date, $to_date, $status);
        $stmt->execute();
        $stmt->bind_result($id, $name);
        $messages = array();
        while ($stmt->fetch()) {
            $temp = array();
             $temp['id'] = $id;
             $temp['name'] = $name;
           #$temp['student_id'] = $student_id;
            array_push($messages, $temp);
        }
        return $messages;
    }

function getAdminById($email_id)
    {
        $stmt = $this->con->prepare("SELECT id, name, mobile_No, email_Id FROM admin WHERE email_Id = ?");
        $stmt->bind_param("s", $email_id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $mobile_No, $email_Id);
        $user = array();
        while($stmt->fetch()){
            $temp = array();
        $temp['id'] = $id;
        $temp['name'] = $name;
        $temp['mobile_No'] = $mobile_No;
        $temp['email_Id'] = $email_Id;
        array_push($user, $temp);
        }
        return $user;
    }



    //Method to get all students
    function getAllStudents(){
        $stmt = $this->con->prepare("SELECT id, name, class, email_Id, mobile_No FROM student ");
        $stmt->execute();
        $stmt->bind_result($id, $name, $class, $email_Id, $mobile_No);
        $users = array();
        while($stmt->fetch()){
            $temp = array();
            $temp['id'] = $id;
            $temp['name'] = $name;
            $temp['class'] =$class;
            $temp['email_Id'] = $email_Id;
            $temp['mobile_No'] = $mobile_No;
            array_push($users, $temp);
        }
        return $users;
    }
    
}

 

