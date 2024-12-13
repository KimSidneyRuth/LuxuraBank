<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Management</title>
    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background-color: #9575cd;
            color: white;
            padding: 15px 20px;
            font-size: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-label {
            font-weight: 500;
            color: #333;
            margin-right: 10px;
        }

        .search-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 300px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            text-align: left;
            padding: 12px;
            border-bottom: 2px solid #ddd;
            color: #333;
            font-weight: 500;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .action-button {
            background-color: #00a86b;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .action-button:hover {
            background-color: #008f5d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Select on any action options to manage your clients.
        </div>

        <div class="search-container">
            <label class="search-label">Search:</label>
            <input type="text" class="search-input">
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Client Number</th>
                    <th>ID No.</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Kim Pascual</td>
                    <td>LXB-CLIENT-10629</td>
                    <td>ID0002</td>
                    <td>09355356944</td>
                    <td>kimpascual@gmail.com</td>
                    <td>Baliwag, Bulacan</td>
                    <td><a href="#" class="action-button">Open Account</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Juan Dela Cruz</td>
                    <td>LXB-CLIENT-50413</td>
                    <td>2019200697</td>
                    <td>09322674699</td>
                    <td>juandelacruz@gmail.com</td>
                    <td>San Rafael, Bulacan</td>
                    <td><a href="#" class="action-button">Open Account</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Perlie Santos</td>
                    <td>LXB-CLIENT-35892</td>
                    <td>2018-200600</td>
                    <td>09952742931</td>
                    <td>perliesantos@gmail.com</td>
                    <td>San Rafael, Bulacan</td>
                    <td><a href="#" class="action-button">Open Account</a></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Alysha Marie Del Mundo</td>
                    <td>LXB-CLIENT-06854</td>
                    <td>564653458</td>
                    <td>09558876693</td>
                    <td>delmundoalysha@gmail.com</td>
                    <td>POBLACION</td>
                    <td><a href="#" class="action-button">Open Account</a></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Adrielle Bayot Gallagher</td>
                    <td>LXB-CLIENT-04763</td>
                    <td>8856454554656</td>
                    <td>09558876693</td>
                    <td>kimsidneyruth11@gmail.com</td>
                    <td>POBLACION</td>
                    <td><a href="#" class="action-button">Open Account</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>