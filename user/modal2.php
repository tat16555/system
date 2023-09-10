<nav>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
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
                    <th scope="col"><?= $reserve_row['price'] ?? '' ?></th>
                    <th scope="col"><?= $reserve_row['payment'] ?? '' ?></th>	
                    <th scope="col"><?= $reserve_row['reference_number'] ?? '' ?></th>
                    <th scope="col"><?= $reserve_row['status'] ?? '' ?></th>
                    <th scope="col"><?= $reserve_row['start_time'] ?? '' ?></th>
                    <th scope="col"><?= $reserve_row['created_at'] ?? '' ?></th>
                </tr>
            </thead>
            <?php } } ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>    
</nav>