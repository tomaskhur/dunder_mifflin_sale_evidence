<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="productStyle.css">
    <link rel="icon" type="images/png" sizes="32x32" href="images/favicon-32x32.png">
    <title>DunderMifflin | Add a new product</title>
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
        <img class="logo-image" src="images/mifflin.png" alt="logoImage">
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
    <?php
        require 'db.php';

        if(!empty($_GET["search"])) {
            $search = $_GET["search"];
        }
        else {
            $search = "";
        }

        $stmt = $pdo->prepare('SELECT * FROM tbProducts WHERE name LIKE "%" :name "%" OR category LIKE "%" :category "%"');
        $stmt->execute(['name' => $search, 'category' => $search]);

        $data = $stmt->fetchAll();

        if (empty($data)) {
            echo "<h3 class='result_not_found'>Nebyl nalezen žádný výsledek</h3>";
        }
    ?>
    <div class="add-product-top">
        <h2>List of products</h2>
    </div>

    <div class="product-table">
        <div class="flex-product">
            <div class="product-search-bar">
                <form action="" method="GET">
                    <div class="search-icon">
                        <input type="search" name="search" placeholder="Search...">
                    </div>
            </form>
            </div>
            <div class="add-new-product">
                <a href="productAdd.php"><h3>Add a new product <i class="fa-solid fa-basket-shopping"></i></h3></a>
            </div>

        </div>
        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product name</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($data as $key => $value) : ?>

                <tr>
                    <td><?= $value['id']?></td>
                    <td><?= $value['name']?></td>
                    <td><?= $value['category']?></td>
                    <td><a href="productAdd.php?id=<?= $value['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a> </td>
                    <td> <a class="delete" href="deleteProduct.php?id=<?= $value['id'] ?>"><i class="fa-solid fa-trash-can"></i></a></td>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>
        </div>
    </div>
</section>
<script src="script.js"></script>
<script src="https://kit.fontawesome.com/a10f07ebc3.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
