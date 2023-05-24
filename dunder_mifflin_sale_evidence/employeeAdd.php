<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="employeeStyle.css">
    <link rel="icon" type="images/png" sizes="32x32" href="images/favicon-32x32.png">
    <title>DunderMifflin | Add new employee</title>
</head>
<body>
<header>
    <nav class="nav-header-flex">
        <ul>
            <li>
                <a href="index.php" class="nav-header-flex"><i class="fa-solid fa-house"></i>
                </a>
            </li>
            <li>
                <a href="employee.php" class="nav-header-flex"><i class="fa-solid fa-user-group"></i>
                </a>
            </li>
            <li>
                <a href="products.php" class="nav-header-flex"><i class="fa-solid fa-box"></i>
                </a>
            </li>
            <li>
                <a href="salesEvidence.php" class="nav-header-flex"><i class="fa-solid fa-basket-shopping"></i>
                </a>
            </li>
        </ul>
    </nav>
</header>
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">DunderMifflin</div>
        <i class="fa-solid fa-bars" id="btn" ></i>
        <img class="logo-image" src="images/mifflin.png">
    </div>
    <ul class="nav-list">
        <li>
            <a href="index.php">
                <i class="fa-solid fa-house"></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="employee.php">
                <i class="fa-solid fa-user-group"></i>
                <span class="links_name">Employees</span>
            </a>
            <span class="tooltip">Employees</span>
        </li>
        <li>
            <a href="products.php">
                <i class="fa-solid fa-box"></i>
                <span class="links_name">Products</span>
            </a>
            <span class="tooltip">Products</span>
        </li>
        <li>
            <a href="salesEvidence.php">
                <i class="fa-solid fa-basket-shopping"></i>
                <span class="links_name">Sales</span>
            </a>
            <span class="tooltip">Sales Evidence</span>
        </li>
        <li class="profile">
            <div class="profile-details">
                <img src="images/profile.png" alt="profileImage">
                <div class="name_job">
                    <div class="name">Admin</div>
                    <div class="position">Admin</div>
                </div>
            </div>
            <i class="fa-solid fa-arrow-right-from-bracket" id="log_out" ></i>
        </li>
    </ul>
</div>
<section class="home-section">
    <div class="add-employee-top">
        <?php
            if (isset($_GET['id']))
            {
                echo "<h2>Edit employee <i class='fa-solid fa-user-plus'></i></h2>";
            }
           else
           {
               echo "<h2>Add a new employee <i class='fa-solid fa-user-plus'></i></h2>";
           }
        ?>
    </div>

    <?php
    require 'db.php';
    ob_start();

    if (isset($_GET['id']))
    {
        $stmt = $pdo->prepare("SELECT * FROM tbEmployees WHERE id = :id");
        $stmt->execute(['id' => $_GET['id']]);

        $row = $stmt-> fetch();
    }
    ?>

    <div class="add-new-employee-form">
        <form action="" method="POST">
            <input type="text" name="name" value="<?php echo isset($_GET['id']) ? $row['name'] : ''?>" placeholder="Name" required="required">
            <input type="text" name="surname" value="<?php echo isset($_GET['id']) ? $row['surname'] : ''?>" placeholder="Surname" required="required">
            <input type="email" name="email" value="<?php echo isset($_GET['id']) ? $row['email'] : ''?>" placeholder="Email@" required="required">
            <input type="date" name="birth_date" value="<?php echo isset($_GET['id']) ? $row['birth_date'] : ''?>" required="required">
            <input type="text" name="position" value="<?php echo isset($_GET['id']) ? $row['position'] : ''?>" placeholder="Position" required="required">

            <?php
                if (isset($_GET['id']))
                {
                    echo "<button onclick='SuccessPopUp()' class='edit-create-button' type='submit' name='submit'>EDIT</button>";
                }
                else
                {
                    echo "<button onclick='SuccessPopUp()' class='edit-create-button' type='submit' name='submit'>CREATE</button>";
                }
            ?>
        </form>

    <?php
        if  (isset($_POST) && !empty($_POST))
        {
            if(empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email'] || empty($_POST['birth_date']) || empty($_POST['position'])))
            {
                echo "Fill all the values";
                die();
            }

            if (!isset($_GET['id']))
            {
                $stmt = $pdo->prepare("INSERT INTO tbEmployees (name, surname, email, birth_date, position) 
                                            VALUES (:name, :surname, :email, :birth_date, :position)");

                $stmt->execute([
                        'name' => $_POST['name'],
                        'surname' => $_POST['surname'],
                        'email' => $_POST['email'],
                        'birth_date' => $_POST['birth_date'],
                        'position' => $_POST['position']
                ]);
                header('location: employeeAdd.php');
            }
                else if (isset($_GET['id']))
                {
                    $stmt = $pdo->prepare("UPDATE tbEmployees SET name = :name, surname = :surname, email = :email, birth_date = :birth_date, position = :position WHERE id = :id");

                    $stmt -> execute([
                       'id' => $_GET['id'],
                       'name' => $_POST['name'],
                       'surname' => $_POST['surname'],
                       'email' => $_POST['email'],
                       'birth_date' => $_POST['birth_date'],
                       'position' => $_POST['position']
                    ]);
                    header('location: employee.php?id='. $_GET['id']);
                }

        }
    ?>
</section>
<script src="script.js"></script>
<script src="https://kit.fontawesome.com/a10f07ebc3.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script> /** alert("OPERATION WAS SUCCESSFUL") **/
    function SuccessPopUp(){
        alert('OPERATION WAS SUCCESSFUL');
    }
</script>
</body>
</html>