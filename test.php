<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'studentmarlabs');
/* $myArray = array();
  if ($result = $mysqli->query("SELECT * FROM users")) {

  while ($row = $result->fetch_assoc()) {
  $myArray[] = $row;
  }
  echo json_encode($myArray);
  } */





$data = json_decode(file_get_contents("php://input"));
if ($data->task == 'validate') {
    $query1 = "select count(*) from users where email='" . $data->email . "' and password = '" . $data->password . "'";
    $result = $mysqli->query($query1);
    $row_cnt = $result->fetch_row();
    if ($row_cnt[0] == 1) {

        echo ('success');
        $_SESSION["currentuser"] = $data->email;
    } else
        echo 'validation failed';
}//validatation for login
else if ($data->task == 'addClass') {
    
        $sql = "insert into class (class_level) values ('" . $data->class_level . "')";
        if ($mysqli->query($sql) === TRUE) {
            echo 'success';
           
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    
}
else if ($data->task == 'addSubject') {
    
        $sql = "insert into subjects (subject_name) values ('" . $data->subject_name . "')";
        if ($mysqli->query($sql) === TRUE) {
            echo 'success';
           
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    
}
else if ($data->task == 'addMarks') {
    
        $sql = "insert into studentmarksinfo (student_id, subject_id, marks) values (" . $data->student_id . ",$data->subject_id ,$data->marks  )";
        if ($mysqli->query($sql) === TRUE) {
            echo 'success';
           
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    
}
else if ($data->task == 'addStudent') {
    
        $sql = "insert into student (student_name, class_id) values ('" . $data->name . "',   $data->class_id )";
        if ($mysqli->query($sql) === TRUE) {
            echo 'success';
           
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    
}
else if ($data->task == 'register') {
    $query1 = "select count(*) from users where email='" . $data->email . "' or username = '" . $data->username . "'";
    $result = $mysqli->query($query1);
    $row_cnt = $result->fetch_row();
    if ($row_cnt[0] >= 1) {
        echo 'username or email already exists';
    } else {
        $sql = "insert into users (name, email,username,password, location,contact_no) values ('" . $data->name . "',  '" . $data->email . "', '" . $data->username . "', '" . $data->password . "', '" . $data->location . "',  '" . $data->contact_no . "')";
        if ($mysqli->query($sql) === TRUE) {
            echo 'success';
            $_SESSION["currentuser"] = $data->email;
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }//if user name or email doesnt exist
}//registration from registration
else if ($data->task == 'logout') {
    
    unset($_SESSION['currentuser']);
    if(!isset($_SESSION['currentuser']))
        echo 'success';
    else
        echo 'failed to destroy session';
}
else if ($data->task == 'getsessiondata') {
    $myArray = array();
    if(isset($_SESSION["currentuser"]))
    {
        
    
  if ($result = $mysqli->query("SELECT * FROM users where email='".$_SESSION["currentuser"]."'")) {

  while ($row = $result->fetch_assoc()) {
  $myArray[] = $row;
  }
  echo json_encode($myArray);
    }
    
  }//if the session is set
  else 
  {
      echo 'nosession';
  }

}//if get session data is requested
else if ($data->task == 'updateuser') {
   
    if(isset($_SESSION["currentuser"]))
    {
        $query1 = "select count(*) from users where email !='" . $data->email . "' and username = '" . $data->username . "'";
    $result = $mysqli->query($query1);
    $row_cnt = $result->fetch_row();
    if ($row_cnt[0] == 1) {

        echo ('usernameexists');
        
    }
    else 
    {
       
        $sql = "update  users set name = '" . $data->name . "' ,username= '" . $data->username . "',password = '" . $data->password . "', location = '" . $data->location . "',contact_no = '" . $data->contact_no . "' where email ='" . $data->email . "'";
        if ($mysqli->query($sql) === TRUE) {
            echo 'success';
                    
            
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
    

    
  }//if the session is set
  else 
  {
      echo 'nosession';
  }

}//if get session data is requested
else if ($data->task == 'getStudentMarksInfo') {
    $myArray = array();
    if (isset($_SESSION["currentuser"])) {
        $query1 = "select smi.*,st.student_name, c.class_level,su.subject_name from studentmarksinfo smi join subjects su on su.subject_id= smi.subject_id join student st on st.student_id= smi.student_id join class c on c.class_id = st.class_id order by st.student_name asc
";
        $result = $mysqli->query($query1);
        $row_cnt = $result->num_rows;
        if ($row_cnt > 0) {
            while ($row = $result->fetch_assoc()) {
                $myArray[] = $row;
            }
            
        }
        echo json_encode($myArray);
    }//if the session is set
  else 
  {
      echo 'nosession';
  }

}//if get session data is requested
else if ($data->task == 'getClass') {
    $myArray = array();
    if (isset($_SESSION["currentuser"])) {
        $query1 = "select * from class ";
        $result = $mysqli->query($query1);
        $row_cnt = $result->num_rows;
        if ($row_cnt > 0) {
            while ($row = $result->fetch_assoc()) {
                $myArray[] = $row;
            }
            
        }
        echo json_encode($myArray);
    }//if the session is set
  else 
  {
      echo 'nosession';
  }

}//if get session data is requested
else if ($data->task == 'getSubject') {
    $myArray = array();
    if (isset($_SESSION["currentuser"])) {
        $query1 = "select * from subjects ";
        $result = $mysqli->query($query1);
        $row_cnt = $result->num_rows;
        if ($row_cnt > 0) {
            while ($row = $result->fetch_assoc()) {
                $myArray[] = $row;
            }
            
        }
        echo json_encode($myArray);
    }//if the session is set
  else 
  {
      echo 'nosession';
  }

}//if get session data is requested
else if ($data->task == 'getStudent') {
    $myArray = array();
    if (isset($_SESSION["currentuser"])) {
        $query1 = "select st.*,c.class_level from student st join class c on st.class_id= c.class_id";
        $result = $mysqli->query($query1);
        $row_cnt = $result->num_rows;
        if ($row_cnt > 0) {
            while ($row = $result->fetch_assoc()) {
                $myArray[] = $row;
            }
            
        }
        echo json_encode($myArray);
    }//if the session is set
  else 
  {
      echo 'nosession';
  }

}//if get session data is requested
else if ($data->task == 'updateimportance') {
    ;
    if (isset($_SESSION["currentuser"])) {
        $sql = "update  messages set important='".$data->flag."' where id =" . $data->id;
       if ($mysqli->query($sql) === TRUE) {
            echo 'success';
                    
            
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }//if the session is set
  else 
  {
      echo 'nosession';
  }

}//if get session data is requested
else if ($data->task == 'deletemessage') {
    
    if (isset($_SESSION["currentuser"])) {
        $sql = "delete from messages where id =" . $data->id;
       if ($mysqli->query($sql) === TRUE) {
            echo 'success';
                    
            
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }//if the session is set
  else 
  {
      echo 'nosession';
  }

}//if get session data is requested
else if ($data->task == 'getsinglemessage') {
    $myArray = array();
    if (isset($_SESSION["currentuser"])) {
        $query1 = "select m.*, u.email from messages m join users u on u.id = m.sender_id where m.id =" . $data->id;
        $result = $mysqli->query($query1);
        $row_cnt = $result->num_rows;
        if ($row_cnt > 0) {
            while ($row = $result->fetch_assoc()) {
                $myArray[] = $row;
            }
            
        }
        echo json_encode($myArray);
    }//if the session is set
  else 
  {
      echo 'nosession';
  }

}//if get session data is requested
else if ($data->task == 'replyToUser') {
    $myArray = array();
    if (isset($_SESSION["currentuser"])) {
        $query1 = "select id from users where email ='" . $data->receiver . "'";
    $result = $mysqli->query($query1);
    $row_cnt = $result->fetch_row();
   
        $sql = "insert into messages (message_title, message_body,sender_id,receiver_id) values ('" . $data->subject . "',  '" . $data->body . "', '" . $data->sender . "', '" . $row_cnt[0] . "')";
        if ($mysqli->query($sql) === TRUE) {
            echo 'success';
           
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }//if the session is set
  else 
  {
      echo 'nosession';
  }

}//if get session data is requested

//$result->close();
$mysqli->close();
