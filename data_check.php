<?php

session_start();

$host = "localhost";
$user = "Filzah";
$password = "Password123";
$db = "student_portal";

// Establishing connection to the database
$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection error");
}

// Check if the form is submitted
if (isset($_POST['apply'])) {

    // Retrieving form data
    $student_name = $_POST['studentName'];
    $matric_number = $_POST['matricNumber'];
    $subject_name = $_POST['subjectName'];
    $subject_code = $_POST['subjectCode'];
    $test1 = $_POST['test1Grade'];
    $test2 = $_POST['test2Grade'];
    $final_exam = $_POST['finalExamGrade'];

    // Inserting data into the database
    $sql = "INSERT INTO addmission (student_name, matric_number, subject_name, subject_code, test1, test2, final_examination) 
            VALUES ('$student_name', '$matric_number', '$subject_name', '$subject_code', '$test1', '$test2', '$final_exam')";

    // Execute the query
    $result = mysqli_query($data, $sql);

    // Check if the query was successful
    if ($result) {
        $_SESSION['message']="your application sent successfully";
        header("location:adminhome.php");
    } else {
        echo "Apply Failed: " . mysqli_error($data);
    }
    
}

?>
