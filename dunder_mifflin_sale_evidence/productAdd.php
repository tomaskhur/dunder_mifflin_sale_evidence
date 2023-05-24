<?php
    ob_start();
?>
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
    <title>DunderMifflin | Add new product</title>
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
        <img class="logo-image" src="images/mifflin.png" alt="imageLogo">
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
    <div class="add-product-top">
        <?php
        if (isset($_GET['id']))
        {
            echo "<h2>Edit product <i class='fa-solid fa-user-plus'></i></h2>";
        }
        else
        {
            echo "<h2>Add a new product <i class='fa-solid fa-user-plus'></i></h2>";
        }
        ?>
    </div>
    
    <?php
        require 'db.php';
        if (isset($_GET['id']))
        {
            $stmt = $pdo->prepare('SELECT * from tbProducts WHERE id = :id');
            $stmt->execute(['id' => $_GET['id']]);

            $row = $stmt -> fetch();
        }

    ?>
    
    <div class="add-new-product-form">
        <form method="POST">
            <input type="text" name="name" placeholder="Product Name" value="<?php echo isset($_GET['id']) ? $row['name'] : ''?>" required>
            <textarea name="description" placeholder="Description" required>
                <?php echo isset($_GET['id']) ? $row['description'] : ''?>
            </textarea>
            <h3>Category</h3>
            <label for="electronics">Electronics
            <input type="radio" id="electronics" name="category" placeholder="" value="Electronics" <?php if (isset($_GET['id']) && $row['category'] == "Electronics") echo 'checked' ?> required>
            </label>
            <label for="paper">Paper
            <input type="radio" id="paper" name="category" placeholder="" value="Paper" <?php if (isset($_GET['id']) && $row['category'] == "Paper") echo 'checked' ?> required>
            </label>
            <label for="stationery">Stationery
            <input type="radio" id="stationery" name="category" placeholder="" value="Stationery" <?php if (isset($_GET['id']) && $row['category'] == "Stationery") echo 'checked' ?> required>
            </label>
            <input type="text" name="price" placeholder="$Price" value="<?php echo isset($_GET['id']) ? $row['price'] : ''?>">
            <?php
                if (isset($_GET['id']))
                {
                    echo "<button class='edit-create-button' onclick='SuccessPopUp()' type='submit' name='submit'>EDIT</button>";
                }
                else
                {
                    echo "<button class='edit-create-button' onclick='SuccessPopUp()' type='submit' name='submit'>CREATE</button>";
                }
            ?>
        </form>

        <?php
            if (isset($_POST) && !empty($_POST))
            {
                if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['category']) || empty($_POST['price']))
                {
                    echo "Fill all the values";
                    die();
                }
                if (!isset($_GET['id']))
                {
                    $stmt = $pdo->prepare("INSERT INTO tbProducts (name, description, category, price)
                                                   VALUES (:name,:description, :category, :price)");

                    $stmt->execute([
                            'name' => $_POST['name'],
                            'description' => $_POST['description'],
                            'category' => $_POST['category'],
                            'price' => $_POST['price']
                    ]);
                    header('location: productAdd.php');
                }
                else if (isset($_GET['id']))
                {
                    $stmt = $pdo->prepare("UPDATE tbProducts SET name = :name, description = :description, price = :price, category = :category WHERE id = :id");

                    $stmt -> execute([
                        'id' => $_GET['id'],
                        'name' => $_POST['name'],
                        'description' => $_POST['description'],
                        'price' => $_POST['price'],
                        'category' => $_POST['category'],
                    ]);
                    header('location: products.php?id='. $_GET['id']);
                }
            }

        ?>
    </div>
</section>
<script src="script.js"></script>
<script src="https://kit.fontawesome.com/a10f07ebc3.js" crossorigin="anonymous"></script>
<script>
    function SuccessPopUp(){
        alert('OPERATION WAS SUCCESSFUL');
    }
</script>
</body>
</html>