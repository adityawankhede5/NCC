<?php


    function convertTime($time){
        $time = explode(":", $time);
        if(intval($time[0])>=12){
            if(intval($time[0])==12){
                $convertedTime = "12:".$time[1]." PM";
            }else{
                $convertedTime = "". intval($time[0])%12 .":". $time[1] ." PM";
            }
        }else{
            $convertedTime = "". intval($time[0]) .":". $time[1] ." AM";
        }
        return $convertedTime;
    }

    function storeImage($efile){

        $fileName = $efile['name'];
        $fileTempName = $efile['tmp_name'];
        $fileSize = $efile['size'];
        $fileError = $efile['error'];
        $fileType = $efile['type'];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');
        $allowedsize = 1000000;

        if(in_array($fileActualExt, $allowed)){
            if($fileError===0){
                if($fileSize<=$allowedsize){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = "uploads/events/".$fileNameNew;
                    move_uploaded_file($fileTempName, $fileDestination);
                    return $fileNameNew;
                }else{
                    $error = "File size too big.";
                    echo $error;
                    return 1;
                }
            }else{
                $error = "Error uploading your file.";
                echo $error;
                return 1;
            }
        }else{
            $error = "Not a proper image file.";
            echo $error;
            return 1;
        }
    }

    if(isset($_POST['submit'])){
        // echo $_POST['date'];
        // echo $_POST['month'];
        // echo $_POST['timefrom'];
        // echo $_POST['timeto'];
        // echo $_POST['venue'];
        // echo $_POST['brief'];
        // echo $_POST['description'];
        // echo $_POST['filename'];

        $edate = intval($_POST['date']);
        $emonth = $_POST['month'];
        $ebeginat = convertTime($_POST['timefrom']); 
        $eendat = convertTime($_POST['timeto']);
        $evenue = $_POST['venue'];
        $ebrief = $_POST['brief'];
        $edescription = $_POST['description']; 
        $efile = $_FILES['filename'];
        // PROCESSING FILE
        $efileName = storeImage($efile);
        if($efileName===1){
            echo "Error in uploading.";
        }else{
            echo "Uploaded successfully";
        }
        
        // echo $edate;
        // echo $emonth;
        // echo $ebeginat;
        // echo $eendat;
        // echo $evenue;
        // echo $ebrief;
        // echo $edescription;


        $mysqli = new mysqli("localhost", "root", "","test");
        $sql = "INSERT INTO events (date, month, beginat, endat, venue, brief, description, image) VALUES ($edate, '$emonth', '$ebeginat', '$eendat', '$evenue', '$ebrief', '$edescription', '$efileName')";
        $results = $mysqli->query($sql);

        // $results = $mysqli->query("INSERT INTO events (`date`, `month`, `beginat`, `endat`, `venue`, `brief`, `description`, `image`) VALUES ($edate, '$emonth', '$ebeginat', '$eendat', '$evenue', '$ebrief', '$edescription', '$efileName')");
        if($results==true){
            echo "REcord created";
        }else{
            echo "Record not created";
        }
    }


?>