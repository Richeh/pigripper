<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="json.php" method="GET">
            <fieldset>
                <select name="table">
                    <option value="articles" selected="selected">Articles</option>
                    <option value="news">News</option>
                </select>
            </fieldset>
            <fieldset>
                <label>Start date</label>
                <input name="startDate" value="2015-01-30"/>
            </fieldset>
            <fieldset>
                <label>End date</label>
                <input name="endDate" value="2016-01-30"/>
            </fieldset>
            <input type="submit"></input>
        </form>
    </body>
</html>
