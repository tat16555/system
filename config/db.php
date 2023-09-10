<?php

$servername = "localhost";
$username = "root";
$password = "";

try {
  // สร้าง PDO เชื่อมต่อกับฐานข้อมูล
  $conn = new PDO("mysql:host=$servername;dbname=registration-system", $username, $password);

  // ตั้งค่าโหมดข้อผิดพลาด PDO เป็นข้อยกเว้น
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // ใช้คำสั่งที่เตรียมไว้เพื่อป้องกันการโจมตีจากการฉีด SQL
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
  $stmt = $conn->prepare("SELECT * FROM worker WHERE username = ? AND password = ?");
  $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
  $stmt->bindParam(1, $username);
  $stmt->bindParam(2, $password);
  $stmt->execute();
} catch(PDOException $e) {
  // แสดงผลข้อความแสดงข้อผิดพลาดหากการเชื่อมต่อล้มเหลว
  echo "Connection failed: " . $e->getMessage();
}

/* นี่เป็นวิธีหนึ่งในการปรับปรุงโค้ด PHP ที่คุณระบุเพื่อลดช่องโหว่ */
/*
    การปรับปรุงหลักบางประการในโค้ดข้างต้น ได้แก่:
การใช้ข้อความสั่งที่เตรียมไว้พร้อมกับเคียวรีที่กำหนดพารามิเตอร์เพื่อป้องกันการโจมตีจากการฉีด SQL สิ่งนี้ทำให้คุณสามารถดำเนินการสืบค้น SQL ได้อย่างปลอดภัยด้วยอินพุตที่ผู้ใช้ให้มา 
โดยไม่ต้องกังวลว่าผู้ใช้ที่เป็นอันตรายจะพยายามแทรกโค้ด SQL ตามอำเภอใจลงในแบบสอบถามของคุณ
แสดงความคิดเห็นที่ละเอียดและให้ข้อมูลมากขึ้นเพื่ออธิบายว่าโค้ดกำลังทำอะไร ซึ่งจะทำให้ผู้อื่น (รวมถึงตัวคุณเอง) เข้าใจและดูแลรักษาโค้ดได้ง่ายขึ้นในอนาคต
การใช้try...catchโครงสร้างเพื่อจัดการกับข้อยกเว้นใดๆ ที่อาจเกิดจากPDOอินสแตนซ์ ซึ่งช่วยให้คุณจัดการข้อผิดพลาดใดๆ ที่อาจเกิดขึ้นระหว่างการดำเนินการโค้ดของคุณได้อย่างสง่างาม
 */