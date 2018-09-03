<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require_once '../includes/DbOperations.php';

$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);


//registering a student
$app->post('/studentregister', function (Request $request, Response $response) {
    if (isTheseParametersAvailable(array('id', 'name', 'class', 'mobile_no', 'email', 'password','date_of_birth'))) {
        $requestData = $request->getParsedBody();
        $id = $requestData['id'];
        $name = $requestData['name'];
        $class = $requestData['class'];
        $mobile_no = $requestData['mobile_no'];
        $email_id = $requestData['email'];
        $password = $requestData['password'];
        $date_of_birth = $requestData['date_of_birth'];
        $db = new DbOperations();
        $responseData = array();

        $result = $db->studentRegister($id, $name, $class, $mobile_no, $email_id, $password, $date_of_birth);
        if ($result == USER_CREATED) {
            $responseData['error'] = false;
            $responseData['message'] = 'Registered successfully';
            $responseData['students'] = $db->getUserById($email_id);
           } elseif ($result == USER_CREATION_FAILED) {
            $responseData['error'] = true;
            $responseData['message'] = 'Some error occurred';
        } elseif ($result == USER_EXIST) {
            $responseData['error'] = true;
            $responseData['message'] = 'This email or Roll_Number already exist, please login';
        }
        $response->getBody()->write(json_encode($responseData));
    }
});

//student login 
  $app->post('/studentlogin', function (Request $request, Response $response) {
    if (isTheseParametersAvailable(array('email', 'password'))) {
        $requestData = $request->getParsedBody();
        $email = $requestData['email'];
        $password = $requestData['password'];

        $db = new DbOperations();

        $responseData = array();

        if ($db->studentLogIn($email, $password)) {
            $responseData['error'] = false;
            $responseData['students'] = $db->getUserById($email);
        } else {
            $responseData['error'] = true;
            $responseData['message'] = 'Invalid email or password';
        }

        $response->getBody()->write(json_encode($responseData));
    }
});

    
//registering a admin
$app->post('/adminregister', function (Request $request, Response $response) {
    if (isTheseParametersAvailable(array('name', 'mobile_no', 'email', 'password'))) {
        $requestData = $request->getParsedBody();
        $name = $requestData['name'];
        $mobile_no = $requestData['mobile_no'];
        $email_id = $requestData['email'];
        $password = $requestData['password'];
        $db = new DbOperations();
        $responseData = array();

        $result = $db->adiminRegister($name, $mobile_no, $email_id, $password);
        if ($result == USER_CREATED) {
            $responseData['error'] = false;
            $responseData['message'] = 'Registered successfully';
            $responseData['admin'] = $db->getAdminById($email_id);
           } elseif ($result == USER_CREATION_FAILED) {
            $responseData['error'] = true;
            $responseData['message'] = 'Some error occurred';
        } elseif ($result == USER_EXIST) {
            $responseData['error'] = true;
            $responseData['message'] = 'This email already exist, please login';
        }

        $response->getBody()->write(json_encode($responseData));
    }
});

//student login 
  $app->post('/adminlogin', function (Request $request, Response $response) {
    if (isTheseParametersAvailable(array('email', 'password'))) {
        $requestData = $request->getParsedBody();
        $email = $requestData['email'];
        $password = $requestData['password'];
        $db = new DbOperations();
        $responseData = array();

        if ($db->adminLogIn($email, $password)) {
            $responseData['error'] = false;
            $responseData['admin'] = $db->getAdminById($email);
        } else {
            $responseData['error'] = true;
            $responseData['message'] = 'Invalid email or password';
        }
        $response->getBody()->write(json_encode($responseData));
    }
});

//student status
  $app->post('/statusupdate', function (Request $request, Response $response) {
    if (isTheseParametersAvailable(array('status', 'date', 'student_id'))) {
        
        $requestData = $request->getParsedBody();
        $status = $requestData['status'];
        $date = $requestData['date'];
        if($status=="Present")
        {
            $stu=1;
        }
        if($status=="Absent")
        {
            $stu=0;
        }
        $student_id = $requestData['student_id'];
        $db = new DbOperations();
        $responseData = array();

        $result = $db->updateStatus($stu, $date, $student_id);
        if ($result == STATUS_UPDATED) {
            $responseData['error'] = false;
            $responseData['message'] = 'status updted';
            } elseif ($result == STATUS_NOT_UPDATED) {
            $responseData['error'] = true;
            $responseData['message'] = 'status not updated';
         }
         elseif ($result == STATUS_EXIST) {
            $responseData['error'] = true;
            $responseData['message'] = 'You already updated the status';
        }
        $response->getBody()->write(json_encode($responseData));
  }
});

//getting status
$app->get('/status/{date}/{stu}', function (Request $request, Response $response) {
    $date = $request->getAttribute('date');
    $status = $request->getAttribute('stu');
    if($status=='Present')
        {
            $stu=1;
        }
        if($status=='Absent')
        {
            $stu=0;
        }
    $db = new DbOperations();
            $responseData['error'] = false;
            $responseData['students'] = $db->getStatus($date , $stu);
        $response->getBody()->write(json_encode($responseData));
    });

//getting status by from_date and to_date
$app->get('/statusbetweendates/{from_date}/{to_date}/{status}', function (Request $request, Response $response) {
    $from_date = $request->getAttribute('from_date');
    $to_date = $request->getAttribute('to_date');
    $status = $request->getAttribute('status');
     if($status=="Present")
        {
            $stu=1;
        }
        if($status=="Absent")
        {
            $stu=0;
        }
    
    $db = new DbOperations();
            $responseData['error'] = false;
            $responseData['students'] = $db->getStatusBetweenDates($from_date, $to_date, $stu);
        $response->getBody()->write(json_encode($responseData));
    
    //$messages = $db->getStatusBetweenDates($from_date, $to_date, $stu);
    //$response->getBody()->write(json_encode(array("messages" => $messages)));
}
);

//getting all students
$app->get('/student', function (Request $request, Response $response) {
    $db = new DbOperations();
    $users = $db->getAllStudents();
    $response->getBody()->write(json_encode(array("students" => $users)));
});

//function to check parameters
function isTheseParametersAvailable($required_fields)
{
    $error = false;
    $error_fields = "";
    $request_params = $_REQUEST;

    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        $response = array();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echo json_encode($response);
        return false;
    }
    return true;
}

// Run app
$app->run();
