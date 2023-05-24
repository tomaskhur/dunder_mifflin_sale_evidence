<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="images/png" sizes="32x32" href="images/favicon-32x32.png">
    <title>DunderMiffilin | Home - Dashboard</title>
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
    <div class="greetings"></div>
    <div class="daytime"></div>
    <?php
        require 'db.php';

        /* ALL SALES */
        $stmt = $pdo->query('SELECT SUM(sum_price) AS TotalPrice from tbSalesEvidence');
        $row = $stmt->fetchAll();

        /* PERSON WITH MOST SALES */
        $stmt2 = $pdo->query('SELECT E.name AS Name, E.surname as Surname, COUNT(S.id) AS EmployeeSales FROM tbSalesEvidence S
                                      INNER JOIN tbEmployees E ON S.idEmployees = E.id
                                      GROUP BY E.name, E.surname ORDER BY COUNT(S.id)
                                      DESC LIMIT 1
                                      ');
        $row2 = $stmt2->fetchAll();

        /* SALES IN INTERVAL OF 14 DAYS */
        $stmt3 = $pdo->query('SELECT COUNT(id) AS Sales from tbSalesEvidence WHERE date_of_sale > now() - INTERVAL 14 DAY');
        $row3 = $stmt3->fetchAll();

        $stmt4 = $pdo->query('SELECT WEEKDAY(date_of_sale) AS `day`, COUNT(id) AS sales FROM tbSalesEvidence WHERE WEEKDAY(date_of_sale) < 5 AND CURRENT_DATE - date_of_sale <= 7 GROUP BY WEEKDAY(date_of_sale) ORDER BY WEEKDAY(date_of_sale) asc');
        $row4 = $stmt4->fetchAll();
        // var_dump($row4);
        $mapper = function ($value) {
            return $value["sales"];
        };
        $salesInDays = array_map($mapper, $row4);
    ?>
    <div class="sales-graph-7-days">
        <div class="charts-graph">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <div class="sales-flex">
        <div class="sales-count-14-days">
            <div class="card-sales">
                <h2 class="title-card-sales">
                    Sales
                </h2>
                <h5 class="subtitle-card-sales">
                    14 days
                </h5>
                <div class="icon-card-sales-flex">
                <i class="fa-solid fa-basket-shopping"></i>
                </div>
                <?php foreach ($row3 as $key => $value): ?>
                    <h2 class="overall"><?= $value['Sales'] ?> Sales</h2>
                <?php endforeach;?>
            </div>
        </div>

        <div class="sales-overall">
            <div class="card-sales">
                <h2 class="title-card-sales">
                    Earnings
                </h2>
                <h5 class="subtitle-card-sales">
                    Overall
                </h5>
                <div class="icon-card-sales-flex">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
                <?php foreach ($row as $key => $value): ?>
                    <h2 class="overall"><?= number_format($value['TotalPrice'], 2)?> $</h2>
                <?php endforeach;?>
            </div>
        </div>

        <div class="info-panel">
            <div id="daily-info">
                <h1>DAILY INFO</h1>
            </div>
            <div class="best-seller">
                <h2 class="title-card-sales">
                    Best Seller
                </h2>
                <h5 class="subtitle-card-sales">
                    Of this month
                </h5>
                <div class="icon-card-sales-flex">
                    <i class="fa-solid fa-user"></i>
                </div>
                <?php foreach ($row2 as $key => $value): ?>
                        <h1 class="overall"><?= $value['Name'].' '.$value['Surname'] ?></h1>
                    <h2 class="best-seller-count-sales">With amout of <span id="underline"><?= $value['EmployeeSales'] ?></span> sales</h2>
                <?php endforeach;?>
            </div>
        </div>
    </div>

</section>
<script src="script.js"></script>
<script src="https://kit.fontawesome.com/a10f07ebc3.js" crossorigin="anonymous"></script>
<script type="text/javascript">
    let daytimediv = document.querySelector(".daytime")
    var currentdate = new Date();
    var datetime = "Last Sync: " + currentdate.getDate() + "/"
        + (currentdate.getMonth()+1)  + "/"
        + currentdate.getFullYear() + " @ "
        + currentdate.getHours() + ":"
        + currentdate.getMinutes() + ":"
        + currentdate.getSeconds();
    daytimediv.innerHTML += `<h5>${datetime}</h5>`
</script>
<script>
    let greetingsdiv = document.querySelector(".greetings")
    var day = new Date();
    var hr = day.getHours();
    if (hr >= 0 && hr < 12) {
        greetingsdiv.innerHTML += "<h1>Good Morning! &#128075;</h1>";
    } else if (hr == 12) {
        greetingsdiv.innerHTML += "<h1>Good Noon! &#128075;</h1>";
    } else if (hr >= 12 && hr <= 17) {
        greetingsdiv.innerHTML += "<h1>Good Afternoon! &#128075;</h1>";
    } else {
        greetingsdiv.innerHTML += "<h1>Good Evening! &#128075;</h1>";
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri']
    const data = {
        labels: labels,
        datasets: [{
            label: 'Sales for last week',
            display: 'false',
            color: "rgba(255, 255, 255)",
            data: [<?= implode(",", $salesInDays ?? "") ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(255, 159, 64, 0.8)',
                'rgba(255, 205, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(153, 102, 255, 0.8)',
                'rgba(201, 203, 207, 0.8)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    ticks: {color: 'white', beginAtZero: false}
                },
                x: {
                    ticks: {color: 'white', beginAtZero: true}
                },
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'rgba(255,255,255)'
                    }
                }
            }
        },
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
</body>
</html>
