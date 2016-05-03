<?php

    // configuration
    require("../includes/config.php");

    $users = CS50::query("SELECT * FROM users where availability = ?", 0);
    $time = actual_time();
    if (count($users) != 0)
    {
        foreach($users as $user)
        {
            if ($user["rest_start"] > $time)
            {
                $temp = (int)(24 - $user["rest_start"]);
                $temp = (int)($temp + actual_time());
            }
            else
            {
                $temp = (int)(actual_time() - $user["rest_start"]);
            }

            if($temp >= 9)
            {
                CS50::query("UPDATE users SET availability = ? where username = ?", 1, $user["username"]);
            }
        }
    }

if ($_SESSION["permissions"] == "Admin")
{

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
        else
        {
            $flights[] = [
                "flight-number" => $data["flight_number"],
                "flight-date" => $data["flight_date"],
                "flight-depart" => $data["flight_origin"],
                "flight-start" => $data["formatted_start_time"],
                "flight-arrive" => $data["flight_destination"],
                "flight-end" => $data["formatted_end_time"],
                "assigned" => $data["assigned"],
                "completed" => $data["completed"]
            ];
        }
    }
}
elseif ($_SESSION["permissions"] == "Pilot")
{
    $dataSet = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

    $dataSet1 = CS50::query("SELECT * FROM assignedflights WHERE captain = ? OR first_officer = ? ORDER BY flight_date ASC", $dataSet[0]["username"], $dataSet[0]["username"]);

    $flights = [];

    if (count($dataSet1) != 0)
    {

        foreach ($dataSet1 as $data)
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

            $dataSet2 = CS50::query("SELECT *, TIME_FORMAT(flight_start, '%l:%i %p') AS 'formatted_start_time', TIME_FORMAT(flight_end, '%l:%i %p') AS 'formatted_end_time' FROM flights WHERE flight_number = ? AND flight_date = ?", $data["flight_number"], $data["flight_date"]);

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
                "flight-depart" => $dataSet2[0]["flight_origin"],
                "flight-start" => $dataSet2[0]["formatted_start_time"],
                "flight-arrive" => $dataSet2[0]["flight_destination"],
                "flight-end" => $dataSet2[0]["formatted_end_time"],
                "assigned" => $dataSet2[0]["assigned"],
                "completed" => $dataSet2[0]["completed"]
            ];
        }
    }
}
elseif ($_SESSION["permissions"] == "FA")
{
    $dataSet = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

    $dataSet1 = CS50::query("SELECT * FROM assignedflights WHERE fal = ? OR fa1 = ? OR fa2 = ? OR fa3 = ? OR fa4 = ? OR fa5 = ? ORDER BY flight_date ASC", $dataSet[0]["username"], $dataSet[0]["username"], $dataSet[0]["username"], $dataSet[0]["username"], $dataSet[0]["username"], $dataSet[0]["username"]);

    $flights = [];

    if (count($dataSet1) != 0)
    {

        foreach ($dataSet1 as $data)
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

            $dataSet2 = CS50::query("SELECT *, TIME_FORMAT(flight_start, '%l:%i %p') AS 'formatted_start_time', TIME_FORMAT(flight_end, '%l:%i %p') AS 'formatted_end_time' FROM flights WHERE flight_number = ? AND flight_date = ?", $data["flight_number"], $data["flight_date"]);

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
                "flight-depart" => $dataSet2[0]["flight_origin"],
                "flight-start" => $dataSet2[0]["formatted_start_time"],
                "flight-arrive" => $dataSet2[0]["flight_destination"],
                "flight-end" => $dataSet2[0]["formatted_end_time"],
                "assigned" => $dataSet2[0]["assigned"],
                "completed" => $dataSet2[0]["completed"]
            ];
        }
    }
}


    // render dashboard
    render("dashboard.php", ["flights" => $flights, "title" => "Dashboard"]);

?>