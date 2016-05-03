<?php

    // configuration
    require("../includes/config.php");
    
    $dataSet = CS50::query("SELECT *, TIME_FORMAT(flight_start, '%l:%i %p') AS 'formatted_start_time', TIME_FORMAT(flight_end, '%l:%i %p') AS 'formatted_end_time' FROM flights ORDER BY flight_date ASC");

    $flights = [];

    foreach ($dataSet as $data)
    {
        
        $dataSet1 = CS50::query("SELECT * FROM assignedflights WHERE flight_number = ? AND flight_date = ?", $data["flight_number"], $data["flight_date"]);
        
        if (count($dataSet1) != 0)
        {
        
            
            $captain = CS50::query("SELECT first_name, last_name FROM users WHERE username = ?", $dataSet1[0]["captain"]);
            if (count($captain) == 0)
            {
                $captain[0]['last_name'] = "";
                $captain[0]['first_name'] = "";
            }
            $fOfficer = CS50::query("SELECT first_name, last_name FROM users WHERE username = ?", $dataSet1[0]["first_officer"]);
            if (count($fOfficer) == 0)
            {
                $fOfficer[0]['last_name'] = "";
                $fOfficer[0]['first_name'] = "";
            }
            $fal = CS50::query("SELECT first_name, last_name FROM users WHERE username = ?", $dataSet1[0]["fal"]);
            if (count($fal) == 0)
            {
                $fal[0]['last_name'] = "";
                $fal[0]['first_name'] = "";
            }
            $fa1 = CS50::query("SELECT first_name, last_name FROM users WHERE username = ?", $dataSet1[0]["fa1"]);
            if (count($fa1) == 0)
            {
                $fa1[0]['last_name'] = "";
                $fa1[0]['first_name'] = "";
            }
            $fa2 = CS50::query("SELECT first_name, last_name FROM users WHERE username = ?", $dataSet1[0]["fa2"]);
            if (count($fa2) == 0)
            {
                $fa2[0]['last_name'] = "";
                $fa2[0]['first_name'] = "";
            }
            $fa3 = CS50::query("SELECT first_name, last_name FROM users WHERE username = ?", $dataSet1[0]["fa3"]);
            if (count($fa3) == 0)
            {
                $fa3[0]['last_name'] = "";
                $fa3[0]['first_name'] = "";
            }
            $fa4 = CS50::query("SELECT first_name, last_name FROM users WHERE username = ?", $dataSet1[0]["fa4"]);
            if (count($fa4) == 0)
            {
                $fa4[0]['last_name'] = "";
                $fa4[0]['first_name'] = "";
            }
            $fa5 = CS50::query("SELECT first_name, last_name FROM users WHERE username = ?", $dataSet1[0]["fa5"]);
            if (count($fa5) == 0)
            {
                $fa5[0]['last_name'] = "";
                $fa5[0]['first_name'] = "";
            }

            $flights[] = [
                "flight-number" => $data["flight_number"],
                "flight-date" => $data["flight_date"],
                "captain" => $captain[0]['last_name'] . ", " . $captain[0]['first_name'],
                "first-officer" => $fOfficer[0]['last_name'] . ", " . $fOfficer[0]['first_name'],
                "fa-lead" => $fal[0]['last_name'] . ", " . $fal[0]['first_name'],
                "fa-1" => $fa1[0]['last_name'] . ", " . $fa1[0]['first_name'],
                "fa-2" => $fa2[0]['last_name'] . ", " . $fa2[0]['first_name'],
                "fa-3" => $fa3[0]['last_name'] . ", " . $fa3[0]['first_name'],
                "fa-4" => $fa4[0]['last_name'] . ", " . $fa4[0]['first_name'],
                "fa-5" => $fa5[0]['last_name'] . ", " . $fa5[0]['first_name'],
                "flight-depart" => $data["flight_origin"],
                "flight-start" => $data["formatted_start_time"],
                "flight-arrive" => $data["flight_destination"],
                "flight-end" => $data["formatted_end_time"],
                "assigned" => $data["assigned"],
                "completed" => $data["completed"]
            ];
        }
    }

    // render dashboard
    render("active_flights.php", ["flights" => $flights, "title" => "Active Flights"]);

?>