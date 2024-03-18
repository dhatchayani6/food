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
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $mobilenumber = isset($_POST['mobilenumber']) ? $_POST['mobilenumber'] : "";

    // SQL query to insert data into the table
    $sql = "INSERT INTO signup (name, email, password, mobilenumber) VALUES ('$name', '$email', '$password', '$mobilenumber')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
                        <h2>SIGN UP PAGE</h2>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="number" name="mobilenumber" placeholder="Enter your number">
                        </div>
                        <button type="submit" class="btn btn-primary">Sign Up</button>
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
