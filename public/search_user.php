<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        
        $dataSet = CS50::query("SELECT * FROM users");
        $searchQuery = 0;
        $searchSelect = [];

        foreach ($dataSet as $data)
        {
            $searchSelect[] = [
                "first-name" => $data["first_name"],
                "last-name" => $data["last_name"],
                "username" => $data["username"],
                "permissions" => $data["permissions"],
                "availability" => $data["availability"],
                "search" => $searchQuery
            ];
        }
        
        // else render form
        render("maint_users_form.php", ["searchSelect" => $searchSelect, "title" => "Employees"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $dataSet = CS50::query("SELECT * FROM users WHERE username = ?", $_POST["search-box"]);
        $dataSet1 = CS50::query("SELECT * FROM users");
        $searchQuery = 1;
        $users = [];
        $searchSelect = [];

        foreach ($dataSet as $data)
        {
            $users[] = [
                "user-id" => $data["id"],
                "first-name" => $data["first_name"],
                "last-name" => $data["last_name"],
                "username" => $data["username"],
                "password" => $data["hash"],
                "permissions" => $data["permissions"],
                "email" => $data["email"],
                "availability" => $data["availability"],
                "total-hours" => $data["total_hours"],
                "current-hours" => $data["current_hours"],
                "search" => $searchQuery
            ];
        }

        foreach ($dataSet1 as $data1)
        {
            $searchSelect[] = [
                "first-name" => $data1["first_name"],
                "last-name" => $data1["last_name"],
                "username" => $data1["username"],
                "permissions" => $data1["permissions"],
                "availability" => $data1["availability"],
                "search" => $searchQuery
            ];
        }
        
        // render dashboard
        render("maint_users_form.php", ["searchSelect" => $searchSelect, "users" => $users, "title" => "Employees"]);

    }
?>