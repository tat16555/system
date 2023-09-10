<nav>
<style>
    .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4); /* Black with opacity */
            }
            .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Set the width of the modal */
            height: 80%; /* Set the height of the modal */
            }

            .close-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            }
            .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            }

            .close:hover,
            .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
            }
            
</style>
<div class="modal">
  <div class="modal-content">
  <table class="table">
            <thead class="table-primary">
                <tr>    
                    <th scope="col">#</th>
                    <th scope="col">id_users</th>
                    <th scope="col">ชื่อ-นามสกุล</th>
                    <th scope="col">คอร์สเรียน</th>
                    <th scope="col">ราคา</th>
                    <th scope="col">payment</th>
                    <th scope="col">reference_number</th>	
                    <th scope="col">status</th>
                    <th scope="col">วันที่เริ่มเข้าเรียน</th>
                    <th scope="col">วันที่ทำธุรกรรม</th>
                </tr>
            </thead>
              <?php
              // Retrieve reserve information from the reserve table
              require_once '../config/course_information.php';
              $stmt = $conn->prepare("SELECT * FROM reserve WHERE id_users = :id_users");
              $stmt->bindParam(':id_users', $id_users, PDO::PARAM_INT);
              $stmt->execute();
              if ($stmt->rowCount()) {
                  // Loop through the results and output the data
                  while ($reserve_row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
            <thead class="table-info">
                <tr id="myMenu">    
                    <th scope="col"><?= $reserve_row['ID_Re'] ?? '' ?></th>
                    <th scope="col"><?= $reserve_row['id_users'] ?? '' ?></th>
                    <th scope="col"><?= $reserve_row['first_name_surname'] ?? '' ?></th>
                    <th scope="col"><?= $reserve_row['Cou_Name'] ?? '' ?></th>
                    <th scope="col"><p style="color:rgb(159, 159, 9);"><?= $reserve_row['price'] ?? '' ?></p></th>
                    <th scope="col"><?= $reserve_row['payment'] ?? '' ?></th>	
                    <th scope="col"><?= $reserve_row['reference_number'] ?? '' ?></th>
                    <?php
                            $status = $reserve_row['status'];
                            if ($status == 'complished') {
                                // show green text for accomplished status
                                echo '<td style="color:green;">'.$status.'</td>';
                            } else if ($status == 'failed') {
                                // show red text for failed status
                                echo '<td style="color:red;">'.$status.'</td>';
                            } else if ($status == 'not verified') {
                              // show yellow text for failed status
                              echo '<td style="color:yellow;">'.$status.'</td>';
                          }else {
                                // show black text for all other statuses
                                echo '<td>'.$status.'</td>';
                            }
                          ?>
                    <th scope="col"><?= $reserve_row['start_time'] ?? '' ?></th>
                    <th scope="col"><?= $reserve_row['created_at'] ?? '' ?></th>
                </tr>
            </thead>
            <?php } } ?>
    <button class="btn btn-danger close-btn" id="close">Close</button>
  </div>
</div>
</nav>