<?php
// Database connection
$host = "localhost";
$user = "Filzah";
$password = "Password123";
$db = "student_portal";

// Establishing connection to the database
$data = mysqli_connect($host, $user, $password, $db);

// Check the connection
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handling the search functionality
$searchQuery = "";
if (isset($_GET['searchQuery'])) {
    $searchQuery = $_GET['searchQuery'];
    $query = "SELECT * FROM addmission WHERE student_name LIKE '%$searchQuery%' OR matric_number LIKE '%$searchQuery%'";
} else {
    $query = "SELECT * FROM addmission";
}

// Fetching the data
$result = mysqli_query($data, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($data));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(90deg, #202020, #202020);
            height: 100vh;
            font-family: 'Arial', sans-serif;
            display: flex;
            color: #fff;
            width: 100%;
        }

        .sidebar {
            width: 238px;
            height: 100vh;
            margin: 0;
            padding: 20px;
            text-align: left;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
            background: linear-gradient(180deg, #101010, #202020);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        h2 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        h1 {
    font-size: 3rem;
    margin-bottom: 30px;
    color: #00bcd4f;
    text-align: center; /* Centers text horizontally */
    display: flex;
    justify-content: center; /* Centers content horizontally if it's inside a flex container */
    align-items: center; /* Centers content vertically if it's inside a flex container */
    height: 9vh; /* Full viewport height if you want it vertically centered within the page */
    text-shadow: 0 0 10px #00b0ff, 0 0 20px #00b0ff, 0 0 30px #00b0ff, 0 0 40px #00b0ff;
    animation: glowAnimation 0.8s infinite alternate;
}
        .search-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 10px;
            border-radius: 20px;
        }

        .search-bar input {
            width: calc(100% - 70px);
            border: none;
            background: none;
            color: #fff;
            font-size: 16px;
            outline: none;
        }

        .search-bar button {
            width: 80px;
            padding: 8px;
            border: none;
            border-radius: 20px;
            background: linear-gradient(90deg, #00d4ff, #00ff95);
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .search-bar button:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(90deg, #00d4ff, #00ff95);
            color: #ffffff;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
        }

        .info-button {
            background: linear-gradient(90deg, #4e54c8, #8f94fb); /* Neon blue to violet gradient */
        }

        .grading-button {
            background: linear-gradient(90deg, #00b09b, #96c93d); /* Vibrant green gradient */
        }

         /* Logout Button */
        .logout-button {
        margin-top: auto;
        background-color: #FF5733; /* Red */
        color: white;
        padding: 14px 20px;
        font-size: 18px;
        border: none;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease;
        margin-bottom: 35px;
    }


    .logout-button:hover {
    background-color: #c0392b; /* Darker red */
    }  

        .info-container {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: flex-start;
            width: 100%;
            height: 100vh;
            padding-left: 270px;
            box-sizing: border-box;
        }

        .info-display {
            margin-top: 135px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
            display: none;
            color: #fff;
            width: 95%;
            height: 75%;
            transition: background-color 0.3s ease, opacity 0.3s ease;
        }

        .info-content {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            height: 100%;
            padding: 20px;
        }

        .info-content h3 {
            font-size: 24px;
        }

        .info-content p {
            font-size: 18px;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th {
            color: #00ff95;
        }

        td.pass {
            color: #00ff95;
        }

        td.fail {
            color: #ff1c1c;
            font-weight: bold;
        }

        .show-info {
            background: linear-gradient(90deg, #3f72af , #00b0ff);
        }

        .show-grade {
            background: linear-gradient(90deg, #734128 ,#391E10);
        }

        .admin-form {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
            width: 50%;
            margin: 50px auto;
            display: none;
        }

        .admin-form input {
            width: 97%;
            padding: 4px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 16px;
        }

        .admin-form button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #ff4747, #ff7979);
            border: none;
            border-radius: 25px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .admin-form button:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(255, 71, 71, 0.5);
        }

        .edit-button, .delete-button {
            padding: 4px 12px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
            transition: 0.3s;
        }

        .edit-button {
            background: linear-gradient(90deg, #ff9800, #ff5722); /* Orange gradient */
            color: white;
        }

        .edit-button:hover {
            transform: scale(0.8);
            box-shadow: 0 0 10px rgba(255, 152, 0, 0.5);
        }

        .delete-button {
            background: linear-gradient(90deg, #f44336, #e91e63); /* Red gradient */
            color: white;
        }

        .delete-button:hover {
            transform: scale(0.8);
            box-shadow: 0 0 10px rgba(244, 67, 54, 0.5);
        }

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>WELCOME, STUDENT</h2>

        <!-- Search Bar -->
        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" id="searchInput" name="searchQuery" placeholder="Search..." value="<?php echo htmlspecialchars($searchQuery); ?>" />
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="button-container">
            <button class="info-button" onclick="showInfo()">Show Info</button>
            <button class="grading-button" onclick="showGrade()">Show Grade</button>
        </div>


        <!-- Logout Button -->
        <button class="logout-button" onclick="logout()">Logout</button>
    </div>

    <!-- Info and Grade Display Area -->
    <div class="info-container">
        <!-- Info Display -->
        <div id="infoDisplay" class="info-display">
            <div class="info-content">
                <h1>USER INFORMATION:</h1>
                <body style="background-color: #121212; font-family: Arial, sans-serif; color: #ddd; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div style="text-align: center; padding: 40px 60px; background: #222; border-radius: 15px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5); color: #fff; animation: glow 5s infinite alternate;">
        <h1 style="font-size: 40px; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 20px; color: #fff; text-shadow: 0 0 10px rgba(0, 255, 255, 0.8), 0 0 20px rgba(0, 255, 255, 0.8);">STUDENT DASHBOARD</h1>

        <p style="font-size: 18px; margin: 10px 0;"><strong style="font-size: 20px;">Username:</strong> <span style="font-size: 22px; font-weight: bold; text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);">student</span></p>
        <p style="font-size: 18px; margin: 10px 0;"><strong style="font-size: 20px;">Phone Number:</strong> <span style="font-size: 22px; text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);">0132701804</span></p>
        <p style="font-size: 18px; margin: 10px 0;"><strong style="font-size: 20px;">Email:</strong> <span style="font-size: 22px; text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);">student@gmail.com</span></p>
        <p style="font-size: 18px; margin: 10px 0;"><strong style="font-size: 20px;">Password:</strong> <span style="font-size: 22px; font-weight: bold; text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);">Password2408</span></p>
        <p style="font-size: 18px; margin: 10px 0;"><strong style="font-size: 20px;">Usertype:</strong> <span style="font-size: 22px; text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);">student</span></p>

        <br>
    </div>

    <script>
        // Adding the glowing background effect via JavaScript for the body
        document.body.style.animation = "glow 5s infinite alternate";

        // Defining the glow animation directly in the script
        let styleSheet = document.styleSheets[0];
        styleSheet.insertRule(`
            @keyframes glow {
                0% {
                    box-shadow: 0 0 10px rgba(0, 255, 255, 0.5), 0 0 20px rgba(0, 255, 255, 0.5), 0 0 30px rgba(0, 255, 255, 0.5);
                }
                50% {
                    box-shadow: 0 0 20px rgba(0, 255, 255, 1), 0 0 30px rgba(0, 255, 255, 1), 0 0 40px rgba(0, 255, 255, 1);
                }
                100% {
                    box-shadow: 0 0 10px rgba(0, 255, 255, 0.5), 0 0 20px rgba(0, 255, 255, 0.5), 0 0 30px rgba(0, 255, 255, 0.5);
                }
            }
        `, styleSheet.cssRules.length);
    </script>

</body>
            </div>
        </div>

<!-- Grade Display -->
<div id="gradeDisplay" class="info-display">
    <div class="info-content">
        <h1>GRADING INFORMATION</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>                    
                    <th>Student Name</th>
                    <th>Matric Number</th>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Test 1</th>
                    <th>Grade</th>
                    <th>Test 2</th>
                    <th>Grade</th>
                    <th>Final Examination</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Assuming the $result contains the grading information fetched from the database
                    while ($info = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($info['id']); ?></td>
                    <td><?php echo htmlspecialchars($info['student_name']); ?></td>
                    <td><?php echo htmlspecialchars($info['matric_number']); ?></td>
                    <td><?php echo htmlspecialchars($info['subject_name']); ?></td>
                    <td><?php echo htmlspecialchars($info['subject_code']); ?></td>
                    <td><?php echo htmlspecialchars($info['test1']); ?></td>
                    <td>
                        <?php
                            // Grade for Test 1
                            $test1Grade = $info['test1'];
                            if ($test1Grade >= 80) {
                                echo "<span class='pass'>A</span>";
                            } elseif ($test1Grade >= 65) {
                                echo "<span class='pass'>B</span>";
                            } elseif ($test1Grade >= 50) {
                                echo "<span class='pass'>C</span>";
                            } elseif ($test1Grade >= 40) {
                                echo "<span class='pass'>D</span>";
                            } else {
                                echo "<span class='fail'>E</span>";
                            }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($info['test2']); ?></td>
                    <td>
                        <?php
                            // Grade for Test 2
                            $test2Grade = $info['test2'];
                            if ($test2Grade >= 80) {
                                echo "<span class='pass'>A</span>";
                            } elseif ($test2Grade >= 65) {
                                echo "<span class='pass'>B</span>";
                            } elseif ($test2Grade >= 50) {
                                echo "<span class='pass'>C</span>";
                            } elseif ($test2Grade >= 40) {
                                echo "<span class='pass'>D</span>";
                            } else {
                                echo "<span class='fail'>E</span>";
                            }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($info['final_examination']); ?></td>
                    <td>
                        <?php
                            // Grade for Final Examination
                            $finalExamGrade = $info['final_examination'];
                            if ($finalExamGrade >= 80) {
                                echo "<span class='pass'>A</span>";
                            } elseif ($finalExamGrade >= 65) {
                                echo "<span class='pass'>B</span>";
                            } elseif ($finalExamGrade >= 50) {
                                echo "<span class='pass'>C</span>";
                            } elseif ($finalExamGrade >= 40) {
                                echo "<span class='pass'>D</span>";
                            } else {
                                echo "<span class='fail'>E</span>";
                            }
                        ?>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>


        <!-- Admin Form -->
        <div id="adminForm" class="admin-form">
            <h1>Add Student</h1>
            <form method="POST" action="data_check.php">
    <label for="studentName">Student Name:</label>
    <input type="text" id="studentName" name="studentName" placeholder="Enter student name" required><br>

    <label for="matricNumber">Matric Number:</label>
    <input type="text" id="matricNumber" name="matricNumber" placeholder="Enter matric number" required><br>

    <label for="subjectName">Subject Name:</label>
    <input type="text" id="subjectName" name="subjectName" placeholder="Enter subject name" required><br>

    <label for="subjectCode">Subject Code:</label>
    <input type="text" id="subjectCode" name="subjectCode" placeholder="Enter subject code" required><br>

    <h3>Grades</h3>
    <label for="test1Grade">Test 1:</label>
    <input type="number" id="test1Grade" name="test1Grade" required><br>

    <label for="test2Grade">Test 2:</label>
    <input type="number" id="test2Grade" name="test2Grade" required><br>

    <label for="finalExamGrade">Final Exam:</label>
    <input type="number" id="finalExamGrade" name="finalExamGrade" required><br>

    <button type="submit" name="apply">Submit</button>
</form>
        </div>


        </div>
    </div>
    <script>
        const infoDisplay = document.getElementById('infoDisplay');
        const gradeDisplay = document.getElementById('gradeDisplay');
        const adminForm = document.getElementById('adminForm');

        function showInfo() {
            hideAllDisplays();
            infoDisplay.style.display = 'block';
        }

        function showGrade() {
            hideAllDisplays();
            gradeDisplay.style.display = 'block';
        }

        function showAdminForm() {
            hideAllDisplays();
            adminForm.style.display = 'block';
        }

        function logout() {
        // Clear session storage or any user-related data
        sessionStorage.clear();
        localStorage.clear(); // Optional: clear local storage if used
        
        // Redirect to the login page
        window.location.href = 'login.php'; // Replace with the actual path to your login page
        }

        function hideAllDisplays() {
            infoDisplay.style.display = 'none';
            gradeDisplay.style.display = 'none';
            adminForm.style.display = 'none';
        }

        function deleteGrade(id) {
    // Confirm with the user before proceeding
    if (confirm('Are you sure you want to delete this record?')) {
        // If confirmed, redirect to the delete.php script with the ID
        window.location.href = 'delete.php?id=' + id;
    }

    function search() {
    const searchInput = document.getElementById('searchInput').value;
    if (searchInput.trim() !== '') {
        // Reload the page with the search query as a GET parameter
        window.location.href = `?searchQuery=${encodeURIComponent(searchInput)}`;
    }
}

}


    </script>
</body>
</html>