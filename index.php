<?php
    $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
    $mysqli = new mysqli("localhost", "root", "","test");


    // FUNCTION TO LOAD LATEST EVENTS TO HOMEPAGE
    $events = array();

    function getHomepageEvents(){
        global $mysqli, $events, $months;
        $sql = "SELECT * FROM events ORDER BY date DESC";
        $eventresults = $mysqli->query($sql);
        if($eventresults->num_rows>0){
            $rownumber=0;
            while($row=$eventresults->fetch_assoc()){
                $events[$rownumber] = array();
                $events[$rownumber]['date'] = explode('-', $row['date'])[2];
                $events[$rownumber]['month'] = $months[intval(explode('-', $row['date'])[1])];
                $events[$rownumber]['beginat'] = $row['beginat'];
                $events[$rownumber]['endat'] = $row['endat'];
                $events[$rownumber]['venue'] = $row['venue'];
                $events[$rownumber]['brief'] = $row['brief'];
                $events[$rownumber]['description'] = $row['description'];
                $events[$rownumber]['image'] = $row['image'];
                ++$rownumber;
            }
        }
    }

    // FUNCTION TO LOAD LATEST GALLERY IMAGES TO HOMEPAGE
    $albumimages = array();
    $maximagecount=8;

    function getHomepageGallery(){
        global $mysqli, $albumimages, $maximagecount;
        $sql = "SELECT * FROM albums ORDER BY date DESC";
        $galleryresults = $mysqli->query($sql);
        $availableimagescount = 0;
        if($galleryresults->num_rows>0){
            while($row=$galleryresults->fetch_assoc()){
                $files = scandir("uploads/albums/".$row['location']."/");
                foreach($files as $filename){
                    if($filename=="." || $filename==".."){
                        // DO NOTHING
                    }else{
                        ++$availableimagescount;
                        $albumimages[] = "uploads/albums/".$row['location']."/".$filename;
                        if($availableimagescount===$maximagecount){
                            return;
                        }
                    }
                }
            }
        }
    }



    // LOAD LATEST EVENTS
    getHomepageEvents();

    // LOAD LATEST GALLERY IMAGES
    getHomepageGallery();
    for($i=count($albumimages);$i<$maximagecount;$i++){
        array_push($albumimages, "images/664394-rajpath.jpg");
    }

?>