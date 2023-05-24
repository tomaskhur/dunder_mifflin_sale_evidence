<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="salesEvidenceStyle.css">
    <link rel="icon" type="images/png" sizes="32x32" href="images/favicon-32x32.png">
    <title>DunderMifflin | Add new sale</title>
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
        <i class="fa-solid fa-bars" id="btn"></i>
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
                <span class="links_name">employees</span>
            </a>
            <span class="tooltip">Employees</span>
        </li>
        <li>
            <a href="products.php">
                <i class="fa-solid fa-box"></i>
                <span class="links_name">products</span>
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
            <i class="fa-solid fa-arrow-right-from-bracket" id="log_out"></i>
        </li>
    </ul>
</div>
<section class="home-section">
    <div class="add-sale-top">
        <?php
        if (isset($_GET['id'])) {
            echo "<h2>Edit Sales <i class='fa-solid fa-user-plus'></i></h2>";
        } else {
            echo "<h2>Add a new sale <i class='fa-solid fa-user-plus'></i></h2>";
        }
        ?>
    </div>

    <?php
    require 'db.php';
    ob_start();

    if (isset($_GET['id'])) {
        $stmt = $pdo->prepare('SELECT * FROM tbSalesEvidence WHERE id = :id');
        $stmt->execute(['id' => $_GET['id']]);
        $row = $stmt->fetch();
    }


    $stmt = $pdo->prepare('SELECT * FROM tbEmployees');
    $stmt->execute();
    $employeesList = $stmt->fetchAll();

    $stmt = $pdo->prepare('SELECT * FROM tbProducts');
    $stmt->execute();
    $productsList = $stmt->fetchAll();

    ?>

    <div class="add-new-sale-form">
        <form method="POST" id="addnewsale" name="addnewsale">
            <label for="employeeSelect">Employee</label>
            <select name="idEmployees" id="employeeSelect">
                <?php foreach ($employeesList as $key => $value): ?>
                    <option <?php echo isset($_GET['id']) && $row['idEmployees'] == $value['id'] ? 'selected' : ''; ?>
                            value="<?= $value['id'] ?>"> <?= $value['name'] ?> <?= $value['surname'] ?> </option>
                <?php endforeach; ?>
            </select>
            <label for="productSelect">Product</label>
            <select name="idProducts" id="idProducts">
                <?php foreach ($productsList as $key => $value): ?>
                    <option <?php echo isset($_GET['id']) && $row['idProducts'] == $value['id'] ? 'selected' : ''; ?>
                            value="<?= $value['id'] ?>"> <?= $value['name'] ?> </option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="number_of_sales"
                   value="<?php echo isset($_GET['id']) ? $row['number_of_sales'] : '' ?>" placeholder="Number of sales"
                   required="required">
            <input type="date" name="date_of_sale" value="<?php echo isset($_GET['id']) ? $row['date_of_sale'] : '' ?>"
                   required="required">
            <div class="discount_label_align">
                <label>10% discount<input type="checkbox" id="10prcdiscount" name="10prcdiscount" <?php echo isset($_GET['id']) && $row['discount'] == true ? 'checked' : '' ?>></label>
                <?php
                    if (isset($_POST['idProducts'])) {
                        $stmt = $pdo->prepare('SELECT price AS TotalPrice from tbProducts WHERE id = :id');
                        $stmt->execute(['id' => $_POST['idProducts']]);
                        $price = $stmt->fetch();

                        $finalPrice = (isset($_POST['10prcdiscount']) ? $price['TotalPrice'] * 0.9 : $price['TotalPrice']) * $_POST['number_of_sales'];
                    }
                ?>
            </div>
            <?php
                if (isset($_GET['id'])) {
                    echo "<button class='edit-create-button' onclick='SuccessPopUp()' type='submit' name='submit'>EDIT</button>";
                } else {
                    echo "<button class='edit-create-button' onclick='SuccessPopUp()' type='submit' name='submit'>CREATE</button>";
                }
            ?>
        </form>

        <?php
        if (isset($_POST) && !empty($_POST)) {
            if (empty($_POST['idEmployees']) || empty($_POST['idProducts']) || empty($_POST['number_of_sales'] || empty($_POST['date_of_sale']))) {
                echo "Fill all the values";
            }


            if (!isset($_GET['id'])) {
                $stmt = $pdo->prepare("INSERT INTO tbSalesEvidence (idEmployees, idProducts, number_of_sales, date_of_sale, sum_price, discount) 
                                            VALUES (:idEmployees, :idProducts, :number_of_sales,:date_of_sale, :sum_price, :discount)");

                $stmt->execute([
                    'idEmployees' => $_POST['idEmployees'],
                    'idProducts' => $_POST['idProducts'],
                    'number_of_sales' => $_POST['number_of_sales'],
                    'date_of_sale' => $_POST['date_of_sale'],
                    'sum_price' => $finalPrice,
                    'discount' => (int)isset($_POST['10prcdiscount'])
                ]);
                header('location: salesEvidenceAdd.php');
            } else if (isset($_GET['id'])) {
                $stmt = $pdo->prepare("UPDATE tbSalesEvidence SET idEmployees = :idEmployees, idProducts = :idProducts, number_of_sales = :number_of_sales, date_of_sale = :date_of_sale, sum_price = :sum_price, discount = :discount WHERE id = :id");

                $stmt->execute([
                    'id' => $_GET['id'],
                    'idEmployees' => $_POST['idEmployees'],
                    'idProducts' => $_POST['idProducts'],
                    'number_of_sales' => $_POST['number_of_sales'],
                    'date_of_sale' => $_POST['date_of_sale'],
                    'sum_price' => $finalPrice,
                    'discount' => (int)isset($_POST['10prcdiscount'])
                ]);
                header('location: salesEvidence.php?id=' . $_GET['id']);
            }

        }
        ?>
</section>
<script src="script.js"></script>
<script src="https://kit.fontawesome.com/a10f07ebc3.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function SuccessPopUp(){
        alert('OPERATION WAS SUCCESSFUL');
    }
</script>
</body>
</html>