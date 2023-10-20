<?php
require_once "vendor/autoload.php";
// (new \Dotenv\Dotenv(__DIR__))->load();
// $dotenv = Dotenv\Dotenv::create(dirname(__DIR__), 'custom env');
//  $dotenv->load();
    $host        = "localhost";
    $dbname      = "ruxocons_mafama";
    $user        = "ruxocons_mafama";
    $pass        = "Mafama@123";
   
   $conn = mysqli_connect($host, $user, $pass, $dbname);
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $date = date('Y-m-d');
    $sql = "SELECT * FROM email_campaigns";
    $result = mysqli_query($conn, $sql);
    // print_r($result); die();
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {

        // echo $row["email"];die();
        $sql1 = "SELECT * FROM contacts WHERE email = ".$row["email"];
        $result1 = mysqli_query($conn, $sql1);
        // echo $row["email"];die();
        if (mysqli_num_rows($result1) > 0) {
          while($row1 = mysqli_fetch_assoc($result1)) {

            $startdate = $row["date"];
            $ndate = date('Y-m-d');
                        if(($ndate == $startdate) && ($row["status"] == "pending")) {
                            // echo $row1["first_name"];die();
                            $to = $row["email"];
                            $subject = $row["subject"];
                            
                            echo $row["email"];
                            ob_start();
                        ?>
                            <html>
                            <head>
                            </head>
                            <body>
                                <div <?php if ($row["backhground"] != "") { ?> style="padding:20px 10px; background-color: <?php echo $row["backhground"] ?>" <?php } ?>>
                                    <?php 
                                        if($row["greeting"] != ""){
                                    ?>
                                    <p style="margin-bottom: 0px; color: <?php echo $row["forecolorr"] ?>">
                                        <?php echo $row["greeting"] ?> <?php echo $row1["first_name"] ?> <?php echo $row1["last_name"] ?>
                                    </p>
                                    <?php 
                                        }
                                    ?>
                                    <?php $row["message"] ?><br>

                                </div>
                            </body>
                            </html>

                    <?php
                            $message=ob_get_clean();
                            
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            
                            // More headers
                            $headers .= 'From: <dsvmailer@gmail.com>' . "\r\n";
                            
                            mail($to,$subject,$message,$headers);
                            
                            $sql = "UPDATE email_campaigns SET status='sent' WHERE id=".$row['id']; 
                            mysqli_query($conn, $sql);
                        }
                }
            }
            else{
                $startdate = $row["date"];
            $ndate = date('Y-m-d');
                        if(($ndate == $startdate) && ($row["status"] == "pending")) {
                            $to = $row["email"];
                            $subject = $row["subject"];
                            
                            ob_start();
                        ?>
                            <html>
                            <head>
                            </head>
                            <body>
                                <div <?php if ($row["backhground"] != "") { ?> style="padding:20px 10px; background-color: <?php echo $row["backhground"] ?>" <?php } ?>>
                                    <?php 
                                        if($row["greeting"] != ""){
                                    ?>
                                    <p style="margin-bottom: 0px; color: <?php echo $row["forecolorr"] ?>">
                                        <?php echo $row["greeting"] ?> 
                                    </p>
                                    <?php 
                                        }
                                    ?>
                                    <?php echo $row["message"] ?><br>

                                </div>
                            </body>
                            </html>

                    <?php
                            $message=ob_get_clean();
                            
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            
                            // More headers
                            $headers .= 'From: <dsvmailer@gmail.com>' . "\r\n";
                            
                            mail($to,$subject,$message,$headers);
                            
                            $sql = "UPDATE email_campaigns SET status='sent' WHERE id=".$row['id']; 
                            mysqli_query($conn, $sql);
                        }
            }
          }
        }
        else {
    //   echo "0 results";
    }
    
    mysqli_close($conn);


?>