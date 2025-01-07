<?php
$localhost = "localhost";
$username = "Filzah";
$password = "Password123";
$database_name = "student_portal";

$connection = new mysqli($localhost, $username, $password, $database_name);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$id = "";
$student_name = "";
$matric_number = "";
$subject_name = "";
$subject_code = "";
$test1 = "";
$test2 = "";
$final_examination = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: data_check.php");
        exit;
    }

    $id = $_GET["id"];

    // Read the row of the selected student from the database table
    $sql = "SELECT * FROM addmission WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /student_portal/data_check.php");
        exit;
    }

    // Pre-fill the form with the student's current data
    $student_name = $row["student_name"];
    $matric_number = $row["matric_number"];
    $subject_name = $row["subject_name"];
    $subject_code = $row["subject_code"];
    $test1 = $row["test1"];
    $test2 = $row["test2"];
    $final_examination = $row["final_examination"];
}

else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST method: Update the data of the student
    $id = $_POST['id'];
    $student_name = $_POST['student-name'];
    $matric_number = $_POST['matric-number'];
    $subject_name = $_POST['subject-name'];
    $subject_code = $_POST['subject-code'];
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $final_examination = $_POST['final-exam'];

    // Update the student data in the database
    $sql = "UPDATE addmission SET
            student_name='$student_name',
            matric_number='$matric_number',
            subject_name='$subject_name',
            subject_code='$subject_code',
            test1='$test1',
            test2='$test2',
            final_examination='$final_examination'
            WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
        echo "<script>alert('Student data updated successfully'); window.location.href='adminhome.php';</script>";
    } else {
        echo "<script>alert('Error updating student data: " . $connection->error . "');</script>";
    }
}
?>

<?php
$localhost = "localhost";
$username = "Filzah";
$password = "Password123";
$database_name = "student_portal";

$connection = new mysqli($localhost, $username, $password, $database_name);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$id = "";
$student_name = "";
$matric_number = "";
$subject_name = "";
$subject_code = "";
$test1 = "";
$test2 = "";
$final_examination = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: data_check.php");
        exit;
    }

    $id = $_GET["id"];

    // Read the row of the selected student from the database table
    $sql = "SELECT * FROM addmission WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /student_portal/data_check.php");
        exit;
    }

    // Pre-fill the form with the student's current data
    $student_name = $row["student_name"];
    $matric_number = $row["matric_number"];
    $subject_name = $row["subject_name"];
    $subject_code = $row["subject_code"];
    $test1 = $row["test1"];
    $test2 = $row["test2"];
    $final_examination = $row["final_examination"];
}

else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST method: Update the data of the student
    $id = $_POST['id'];
    $student_name = $_POST['student-name'];
    $matric_number = $_POST['matric-number'];
    $subject_name = $_POST['subject-name'];
    $subject_code = $_POST['subject-code'];
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $final_examination = $_POST['final-exam'];

    // Update the student data in the database
    $sql = "UPDATE addmission SET
            student_name='$student_name',
            matric_number='$matric_number',
            subject_name='$subject_name',
            subject_code='$subject_code',
            test1='$test1',
            test2='$test2',
            final_examination='$final_examination'
            WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
        echo "<script>alert('Student data updated successfully'); window.location.href='adminhome.php';</script>";
    } else {
        echo "<script>alert('Error updating student data: " . $connection->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Data</title>
    <style>
        /* General Layout */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Orbitron', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0F2027, #203A43, #2C5364);
            color: #E0E0E0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            background: rgba(20, 20, 20, 0.9);
            border: 1px solid #4A6572;
            border-radius: 16px;
            padding: 30px;
            width: 400px;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
            text-align: center;
        }

        /* Header */
        .form-header h1 {
            font-size: 1.8rem;
            color: #00FFFF;
            text-shadow: 0 0 10px #00FFFF, 0 0 20px #00FFFF;
            margin-bottom: 30px;
        }

        /* Input fields */
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 0.9rem;
            color: #8FAABB;
            margin-bottom: 6px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 8px;
            border: 1px solid #4A6572;
            background: rgba(50, 50, 50, 0.9);
            color: #E0E0E0;
        }

        .input-group input:focus {
            border-color: #00FFFF;
            outline: none;
            box-shadow: 0 0 5px #00FFFF;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            width: 48%;
            padding: 12px;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .btn-save {
            background: #00FFFF;
            color: #0F2027;
            border: none;
        }

        .btn-save:hover {
            background: #008B8B;
            transform: scale(1.05);
        }

        .btn-cancel {
            background: #FF4040;
            color: #FFFFFF;
            border: none;
        }

        .btn-cancel:hover {
            background: #B22222;
            transform: scale(1.05);
        }

        .btn:active {
            transform: scale(0.95);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>Edit Student Data</h1>
        </div>
        
        <form id="student-form" method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            
            <!-- Student Information -->
            <div class="input-group">
                <label for="student-name">Student Name</label>
                <input type="text" id="student-name" name="student-name" value="<?php echo $student_name; ?>" required>
            </div>
            
            <div class="input-group">
                <label for="matric-number">Matric Number</label>
                <input type="text" id="matric-number" name="matric-number" value="<?php echo $matric_number; ?>" required>
            </div>
            
            <!-- Subject Information -->
            <div class="input-group">
                <label for="subject-name">Subject Name</label>
                <input type="text" id="subject-name" name="subject-name" value="<?php echo $subject_name; ?>" required>
            </div>
            
            <div class="input-group">
                <label for="subject-code">Subject Code</label>
                <input type="text" id="subject-code" name="subject-code" value="<?php echo $subject_code; ?>" required>
            </div>
            
            <!-- Test Scores -->
            <div class="input-group">
                <label for="test1">Test 1</label>
                <input type="number" id="test1" name="test1" value="<?php echo $test1; ?>" required>
            </div>
            
            <div class="input-group">
                <label for="test2">Test 2</label>
                <input type="number" id="test2" name="test2" value="<?php echo $test2; ?>" required>
            </div>
            
            <div class="input-group">
                <label for="final-exam">Final Exam</label>
                <input type="number" id="final-exam" name="final-exam" value="<?php echo $final_examination; ?>" required>
            </div>
            
            <!-- Action Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn btn-save">Save Changes</button>
                <button type="button" class="btn btn-cancel" onclick="window.location.href='adminhome.php';">Cancel</button>
            </div>
        </form>
    </div>

    <script>
         // Handle form submission
         document.getElementById('student-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from reloading the page

            // Gather all form data
            const studentName = document.getElementById('student-name').value;
            const matricNumber = document.getElementById('matric-number').value;
            const subjectName = document.getElementById('subject-name').value;
            const subjectCode = document.getElementById('subject-code').value;
            const test1 = document.getElementById('test1').value;
            const test2 = document.getElementById('test2').value;
            const finalExam = document.getElementById('final-exam').value;

            // Output form data (for demonstration purposes)
            alert(Student Data Saved:
    Name: ${studentName}
    Matric No: ${matricNumber}
    Subject: ${subjectName} (${subjectCode})
    Test 1: ${test1}
    Test 2: ${test2}
    Final Exam: ${finalExam});
        });

        // Reset form fields
        function resetForm() {
            document.getElementById('student-form').reset();
        }
    </script>
</body>
</html>

