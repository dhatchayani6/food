<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $servername = "localhost"; // Change this to your MySQL server name
    $username = "root"; // Change this to your MySQL username (default is root)
    $password = ""; // Change this to your MySQL password (default is empty)
    $database = "food"; // Change this to your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    // SQL query to check if email and password exist in the database
    $sql = "SELECT * FROM signup WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email and password match, insert into tbl_login
        $insertSql = "INSERT INTO login (email, password) VALUES ('$email', '$password')";
        if ($conn->query($insertSql) === TRUE) {
            echo "Inserted into tbl_login successfully";
        } else {
            if ($conn->errno == 1062) {
                echo "Duplicate entry for email and password.";
            } else {
                echo "Error inserting into tbl_login: " . $conn->error;
            }
        }
    
        // Redirect to the next page
        header("Location: index.php");
        exit;
    } else {
        // Email and password do not match, display error message
        echo "No matching user found in the database";
    }

    // Close connection
    $conn->close();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/login.css"/> <!-- Assuming you have your custom CSS for styling -->
</head>
<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <form method="post">
                        <h2>LOGIN PAGE</h2>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <img src="background.jpg" alt="Login Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
</body>
</html>
