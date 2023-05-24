
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
    <title>DunderMifflin | Add a new sale</title>
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
                <span class="links_name">employees</span>
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

        $stmt = $pdo->prepare('SELECT S.id as ID, E.name AS Name, E.surname AS Surname, P.name AS Product, S.number_of_sales AS Sales, S.date_of_sale AS DoS, sum_price AS TotalPrice FROM tbSalesEvidence S
                                     inner join tbEmployees E on E.id = S.idEmployees
                                     inner join tbProducts P on P.id = S.idProducts
                                     WHERE E.name LIKE "%" :Name "%" OR E.surname LIKE "%" :Surname "%" OR P.name LIKE "%" :Product "%"
                                     order by DoS desc');
        $stmt->execute(['Name' => $search, 'Surname' => $search, 'Product' => $search]);

        $data = $stmt->fetchAll();

        if (empty($data)) {
            echo "<h3 class='result_not_found'>Nebyl nalezen žádný výsledek</h3>";
        }
    ?>
    <div class="add-sale-top">
        <h2>List of sales</h2>
    </div>

    <div class="sale-table">
       <div class="flex-sale">
        <div class="sale-search-bar">
            <form action="" method="GET">
                <div class="search-icon">
                    <input type="search" name="search" placeholder="Search...">
                </div>
            </form>
        </div>
           <div class="add-new-sale">
               <a href="salesEvidenceAdd.php"><h3>Add a new sale <i class="fa-solid fa-basket-shopping"></i></h3></a>
           </div>
       </div>
        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>P.Name</th>
                    <th>Q</th>
                    <th>T.Price</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($data as $key => $value) : ?>
                    <tr>
                        <td><?= $value['Name']?></td>
                        <td><?= $value['Surname']?></td>
                        <td><?= $value['Sales']?></td>
                        <td><?= $value['TotalPrice']?></td>
                        <td><a href="salesEvidenceAdd.php?id=<?= $value['ID'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="deleteSale.php?id=<?= $value['ID'] ?>"><i class="fa-solid fa-trash-can"></i></a></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    </div>
</section>
<script src="script.js"></script>
<script src="https://kit.fontawesome.com/a10f07ebc3.js" crossorigin="anonymous"></script>
</body>
</html>
