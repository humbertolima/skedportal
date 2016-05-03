<?php

    // configuration
//    require("../includes/config.php");
//            
//    CS50::query("UPDATE flights SET completed = 1 WHERE flight_number = ? AND flight_date = ?", $_GET["fNum"], $_GET["fDate"]);
//
//    redirect("/");
//    







    // configuration
    require("../includes/config.php");
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $actual_time = actual_time();
        $dataSet = CS50::query("UPDATE flights SET flight_end = ?, completed = ? where flight_date = ? and flight_number = ?", $actual_time, 1, $_GET["fDate"], $_GET["fNum"]);
        $dataSet1 = CS50::query("select * from assignedflights where flight_date = ? and flight_number = ?", $_GET["fDate"], $_GET["fNum"]);
        $flight = CS50::query("select * from flights where flight_date = ? and flight_number = ?", $_GET["fDate"], $_GET["fNum"]);

        if ($flight[0]["flight_start"] > $flight[0]["flight_end"])
        {
            $total_hours = 24 - $flight[0]["flight_start"];
            $total_hours = $total_hours + $flight[0]["flight_end"];
        }
        else {
            $total_hours = $flight[0]["flight_end"] - $flight[0]["flight_start"];
        }
        $crew = [
            "captain"=>$dataSet1[0]["captain"],
            "first_officer"=>$dataSet1[0]["first_officer"],
            "fal"=>$dataSet1[0]["fal"],
            "fa1"=>$dataSet1[0]["fa1"],
            "fa2"=>$dataSet1[0]["fa2"],
            "fa3"=>$dataSet1[0]["fa3"],
            "fa4"=>$dataSet1[0]["fa4"],
            "fa5"=>$dataSet1[0]["fa5"]
            ];
            foreach($crew as $c)
            {
                if(!empty($c))
                {
                    CS50::query("UPDATE users SET total_hours = total_hours + ?, current_hours = current_hours + ? where username = ?", $total_hours, $total_hours, $c);

                    $w = CS50::query("select * from users where username = ?", $c);
                    if($w[0]["current_hours"] >= 14)
                    {
                        CS50::query("UPDATE users SET availability = ?, current_hours = ?, rest_start = ? where username = ?", 0, 0, $actual_time, $c);

                        mail("hlg870415@hotmail.com", "Infromation", $w["last_name"] . $w["first_name"] . " is now Illegal");
                    }

                }
            }




    }
    redirect("/");


?>