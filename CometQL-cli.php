<?php

header("Content-Type: text/html; charset=utf-8"); 

ini_set('display_errors','on');
error_reporting(E_ALL);  
 
$link = mysqli_connect("app.comet-server.ru", "15", "lPXBFPqNg3f661JcegBY0N0dPXqUBdHXqj2cHf04PZgLHxT6z55e20ozojvMRvB8", "CometQL_v1");
if ( !$link ) die ("Unable to connect to CometQL");
  
if( !isset($_GET["query"]) || empty($_GET["query"]))
{
    echo "The query parameter is not set.";
    exit();
}

$result = mysqli_query (  $link, $_GET["query"] ); 

echo "CometQL>".htmlspecialchars($_GET["query"])."<br>\n";
    if(mysqli_errno($link) != 0)
    {
        echo "<b>Error code:<a href='https://comet-server.ru/wiki/doku.php/en:comet:cometql:error'  target='_blank' >".mysqli_errno($link)."</a>&nbsp;&nbsp;Error text:<a href='https://comet-server.com/wiki/doku.php/en:comet:cometql:error' target='_blank' >".mysqli_error($link)."</a></b>";
    }
    else if(@mysqli_num_rows($result))
    {
        $row = mysqli_fetch_assoc($result);
        echo "<table>\n";
                echo "\t<tr>\n";
            foreach ($row as $key => $value) 
            { 
                echo "\t\t<td>".$key."</td>\n"; 
            }
                echo "\t</tr>\n";
            do
            {
                echo "\t<tr>\n";
                foreach ($row as $key => $value) 
                { 
                    echo "\t\t<td>".htmlspecialchars($value)."</td>\n"; 
                } 
                echo "\t</tr>\n";
            }while($row = mysqli_fetch_assoc($result));
        echo "</table>\n";
        echo "<b>".mysqli_num_rows($result)." rows in set</b>\n";
    }
    else
    {
        echo "<b>Empty set</b>\n";
    }
    
    echo "<hr>";

mysqli_close ( $link );