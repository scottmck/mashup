#!/usr/bin/env php
<?php

    require("../includes/config.php");

    $us_txt_location = $argv[1];
    
    
    if(file_exists($us_txt_location) !== FALSE)
    {
        if(is_readable($us_txt_location) !== FALSE)
        {
            $row = 1;
            if(($us_txt_open = fopen($us_txt_location, 'r')) !== FALSE)
            {
                while(($data = fgetcsv($us_txt_open, 1000, "\t")) !== FALSE)
                {
                    $num = count($data);
                    //put mySQL insert here
                    $row++;
                    CS50::query("INSERT IGNORE INTO places (country_code, postal_code, place_name, admin_name1, admin_code1, admin_name2,
                    admin_code2, admin_name3, admin_code3, latitude, longitude, accuracy) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
                    $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11]);
                }
                fclose ($us_txt_open);
                return;
            }
            return -1;
        }
        return -1;
    }
    return -1;
?>
