<!DOCTYPE html>
<html>
<head>
  <title>Library Database</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
  
    th, td {
      text-align: left;
      padding: 8px;
    }
  
    th {
      background-color: #4CAF50;
      color: white;
    }
  </style>
</head>
<body>
  <?php
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'library';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $create_table_sql = "CREATE TABLE IF NOT EXISTS library (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      book_title VARCHAR(30) NOT NULL,
      author VARCHAR(30) NOT NULL,
      customer_name VARCHAR(30) NOT NULL
    )";
    mysqli_query($conn, $create_table_sql);

    if (isset($_POST['submit'])) {
      $book_title = $_POST['book_title'];
      $author = $_POST['author'];
      $customer_name = $_POST['customer_name'];

      $sql = "INSERT INTO library (book_title, author, customer_name) VALUES ('$book_title', '$author', '$customer_name')";

      if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }

    $sql = "SELECT * FROM library";
    $result = mysqli_query($conn, $sql);

    echo "<table>";
    echo "<tr><th>ID</th><th>Book Title</th><th>Author</th><th>Customer Name</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td>" . $row['id'] . "</td><td>" . $row['book_title'] . "</td><td>" . $row['author'] . "</td><td>" . $row['customer_name'] . "</td></tr>";
    }
    echo "</table>";

    mysqli_close($conn);
  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="book_title">Book Title:</label>
    <input type="text" name="book_title" required>
    <br>
    <label for="author">Author:</label>
    <input type="text" name="author" required>
    <br>
    <label for="customer_name">Customer Name:</label>
    <input type="text" name="customer_name" required>
    <br>
    <input type="submit" name="submit" value="Submit">
  </form>
</body>
</html>
