<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

    // function convertTime($time){
    //     $time = explode(":", $time);
    //     if(intval($time[0])>=12){
    //         if(intval($time[0])==12){
    //             $convertedTime = "12:".$time[1]." PM";
    //         }else{
    //             $convertedTime = "". intval($time[0])%12 .":". $time[1] ." PM";
    //         }
    //     }else{
    //         $convertedTime = "". intval($time[0]) .":". $time[1] ." AM";
    //     }
    //     return $convertedTime;
    // }

    function storeImage($albumdir, $afiles, $afilescount){

        $allowed = array('jpg', 'jpeg', 'png');
        $allowedsize = 1000000;

        for($aindex=0;$aindex<$afilescount;$aindex++){
            $fileName = $afiles['name'][$aindex];
            $fileTempName = $afiles['tmp_name'][$aindex];
            $fileSize = $afiles['size'][$aindex];
            $fileError = $afiles['error'][$aindex];
            $fileType = $afiles['type'][$aindex];

            $fileExt = explode(".", $fileName);
            $fileActualExt = strtolower(end($fileExt));

            if(in_array($fileActualExt, $allowed)){
                if($fileError===0){
                    if($fileSize<=$allowedsize){
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = "uploads/albums/$albumdir/".$fileNameNew;
                        move_uploaded_file($fileTempName, $fileDestination);
                    }else{
                        $error = "$fileName File size too big.";
                        echo $error;
                        return 1;
                    }
                }else{
                    $error = "$fileName Error uploading your file.";
                    echo $error;
                    return 1;
                }
            }else{
                $error = "$fileName Not a proper image file.";
                echo $error;
                return 1;
            }
        }
        return 0;        
    }

    if(isset($_POST['submit'])){

        $adate = $_POST['date'];
        $aname = $_POST['albumname'];
        $aname = strtolower($aname);
        $aname = str_replace(' ', '-', $aname);
        $albumdir = $adate."-".$aname;
        $afiles = $_FILES['albumfile'];
        if(mkdir("uploads/albums/$albumdir")){
            $afilescount = count($_FILES['albumfile']['name']);
            if(storeImage($albumdir, $afiles, $afilescount)===1){
                rmdir("uploads/albums/$albumdir");
                echo "Could not upload all files.";
                return;
            }
        }else{
            echo "<h1>Problem creating album, try changing the name of the album.</h1>";
            return;
        }
        
        $aname = $_POST['albumname'];
        $mysqli = new mysqli("localhost", "root", "","test");
        $sql = "INSERT INTO albums (name, date, location, imagecount) VALUES ('$aname', '$adate', '$albumdir', $afilescount)";
        $results = $mysqli->query($sql);
        
        if($results==true){
            echo "Record created";
        }else{
            echo "Record not created";
        }
    }
?>
</body>
</html>