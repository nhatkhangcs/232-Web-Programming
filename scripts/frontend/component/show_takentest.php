<table class="list-table">
    <thead>
        <tr>
            <th class="text-start">Name</th>
            <th>Date Taken</th>
            <th>Time Taken</th>
            <th>Duaration</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!-- List item -->
        <!-- <tr class="list-item">
            <td>
                <div class="d-flex .align-item-center">
                    <i class="material-icons me-2" style="color: #4D5FFF;">description</i>
                    Midterm exam 2021
                </div>
            </td>
            <td>15 Apr 2024</td>
            <td>40</td>
            <td>45 minutes</td>
            <td>
                <div class="text-end">
                    <i class="material-icons fs-3 me-3" style="color: #4D5FFF;">play_circle</i>
                </div>
            </td>
        </tr> -->


        <?php
        include '../db-create/db-config.php';

        $conn = mysqli_connect($host, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $studentId = $_SESSION['studentid'];

        $itemsPerPage = 6;
        $page = isset($_GET['pagenum']) ? intval($_GET['pagenum']) : 1;
        $offset = max(0, ($page - 1) * $itemsPerPage);
        $pagination = false;

        $sql = "SELECT * FROM TakenTest WHERE studentId = '$studentId' LIMIT $offset, $itemsPerPage";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sql_test = "SELECT * FROM test WHERE testId = " . $row['testId'];
                $result_test = mysqli_query($conn, $sql_test);
                $row_test = mysqli_fetch_assoc($result_test);


                echo '<tr class="list-item">
                <td>
                    <div class="d-flex .align-item-center">
                        <i class="material-icons me-2" style="color: #4D5FFF;">description</i>'
                    . htmlspecialchars($row_test['name']) .
                    '</div>
                </td>
                <td>' . htmlspecialchars($row['dateTaken']) . '</td>
                <td>' . htmlspecialchars($row['timeTaken']) . ' minutes</td>
                <td>' . htmlspecialchars($row_test['timeLimit']) . ' minutes</td>
                <td>
                <div class="text-end">
                    <a href="review_page.php?takentestid=' . $row['takenTestId'] . '" style="text-decoration: none">
                        <i class="material-icons fs-3 pe-3" style="color: #4D5FFF;">visibility</i>
                    </a>
                </div>
                </td>';
                echo '</tr>';
            }
            $pagination = true;
        } else {
            echo 'Do your first test to see it here!';
        }

        ?>
    </tbody>
</table>
<?php
    if ($pagination) {
        // pagination
        $sql = "SELECT COUNT(*) AS total FROM TakenTest WHERE studentId = '$studentId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $totalItems = $row['total'];
        $totalPages = ceil($totalItems / $itemsPerPage);

        echo '<ul class="pagination justify-content-center mt-3">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li class="page-item"><a class="page-link" href="student_dashboard.php?pagenum=' . $i . '">' . $i . '</a></li>';
        }
        echo '</ul>';
    }
    mysqli_close($conn);
?>