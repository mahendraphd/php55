<?php
    session_start();
    echo 'How R U';
    if(!isset($_SESSION["FileCreatorFlag"]))
    {
         header('Location: ./index.php');
    } 
    else if(isset($_SESSION["FileCreatorFlag"])&& $_SESSION["FileCreatorFlag"]===TRUE)
    {
        echo ' Hello';
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mysql";
        $maxsize = 2* 1024 * 1024;
        $difference = new mysqli($servername, $username, $password, $dbname); // connection name is difference
        if($difference->connect_error) 
        {
            die("Connection Problem" . $conn->connect_error);
        }
        $TopicName1=$_SESSION["TopicName1"];
        $TopicName2=$_SESSION["TopicName2"];
        $ArticleName=$_SESSION["ArticleName"];
        $fileString="Difference-".$TopicName1."-".$TopicName2."-".$_SESSION["AuthorId"];
        echo $fileString;
        $myPage=$fileString.".php";
        echo file_exists($myPage);
        $OpenReference=  fopen($myPage, "w");
        fwrite($OpenReference,"<?php");
        fwrite($OpenReference,"session_start();");
        fwrite($OpenReference,"?>");
        fwrite($OpenReference,"<!DOCTYPE html>");
        fwrite($OpenReference,'<html lang="en">');
        fwrite($OpenReference,"<head>");
        fwrite($OpenReference,"<title>Differencing.org</title>");
        fwrite($OpenReference,'<meta charset="utf-8">');
        fwrite($OpenReference,'<meta name="description" content="">
                                    <meta name="viewport" content="width=device-width, initial-scale=1">
                                    <link rel="apple-touch-icon" href="apple-touch-icon.png">
                                    <link rel="stylesheet" href="css/bootstrap.min.css">
                                    <link rel="stylesheet" href="css/mystyle.css">
                                    <link rel="stylesheet" href="css/TableStyle.css">
                                    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
                                    <link rel="stylesheet" href="css/main.css">
                                    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
                             <style>
                            </style>');
        fwrite($OpenReference,"</head>");
        fwrite($OpenReference,"<body>");
        fwrite($OpenReference,'<div class="navbar navbar-inverse">
                                    <header>
                                    <img src="images/dd.png" height="100" width="200" align="left">
                                    <h1 color="green">Differencing.org</h1>
                                    </header>
                               </div>');
        fwrite($OpenReference,'<nav class="navbar navbar-inverse">
                                    <div class="container-fluid">
                                        <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>                        
                                        </button>
                                        <a class="navbar-brand" href="#">Logo</a>
                                    </div>
                                    <div class="collapse navbar-collapse" id="myNavbar">
                                        <ul class="nav navbar-nav">
                                            <li class="active"><a href="#">Home</a></li>
                                            <li><a href="#">Programming</a></li>
                                            <li><a href="#">Data Mining</a></li>
                                            <li><a href="#">Basic Sciences</a></li>
                                        </ul>
                                        <ul class="nav navbar-nav navbar-right">
                                            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                </nav>
                                ');
        fwrite($OpenReference,'<div class="container-fluid text-center">    
                                    <div class="row content">
                                        <div class="col-sm-2 sidenav">
                                            <p><a href="#">Link</a></p>
                                            <p><a href="#">Link</a></p>
                                            <p><a href="#">Link</a></p>
                                            <p><a href="#">
                                        </a></p>
                                        </div> ');
              fwrite($OpenReference,'<div class="col-sm-8 text-left">');//Table Content Start.
              $ExtractQuerry="select *from ".$ArticleName."";
              $result = $difference->query($ExtractQuerry);
              fwrite($OpenReference, ' <div class=" row container-fluid text-center" ><h2>Difference between '.$TopicName1.' and '.$TopicName2.'.</h2></div>');
              fwrite($OpenReference,'<div class=" row container-fluid">');
              fwrite($OpenReference,'<table>');
              $rowcount=mysqli_num_rows($result);
                   //fwrite($OpenReference,'<tr><td>00000001'.$rowcount.'</td></tr>');
                   
              if ($rowcount> 0) 
              {
                  //fwrite($OpenReference,'<tr><td>1111111111</td></tr>');
                  fwrite($OpenReference,'<tr>');
                        fwrite($OpenReference,'<th>S.N.</th>');
                        fwrite($OpenReference,'<th>'.$TopicName1.'</th>');
                        fwrite($OpenReference,'<th>'.$TopicName2.'</th>');
                    fwrite($OpenReference,'</tr>');
                    
                    //fwrite($OpenReference,'<tr><td>22222222</td></tr>');
                    while($row = mysqli_fetch_assoc($result))
                    {
                        //fwrite($OpenReference,'<tr>');
                           // fwrite($OpenReference,'<td>333333333</td>');
                        //fwrite($OpenReference,'</tr>');
                        if(($row['topic1']!=='' && $row['topic2']!=='')&& ($row['imgname1']!=='' && $row['imgname2']!==''))
                        {
                            fwrite($OpenReference,'<tr>');
                                fwrite($OpenReference,'<td>'.$row['sn'].'</td>');
                                fwrite($OpenReference,'<td><p>'.$row['topic1'].'</p><img src="upload/'.$row['imgname1'].'" alt="Differencing.org" class="img-responsive img-rounded"></td>');
                                fwrite($OpenReference,'<td><p>'.$row['topic2'].'</p><img src="upload/'.$row['imgname2'].'" alt="Differencing.org" class="img-responsive img-rounded"></td>');
                            fwrite($OpenReference,'</tr>');     
                        }
                        else if(($row[topic1]!=='' && $row['topic2']!==''))  
                        {
                            fwrite($OpenReference,'<tr>');
                                fwrite($OpenReference,'<td>'.$row['sn'].'</td>');
                                fwrite($OpenReference,'<td><p>'.$row['topic1'].'</p></td>');
                                fwrite($OpenReference,'<td><p>'.$row['topic2'].'</p></td>');
                            fwrite($OpenReference,'</tr>');
                        }
                        else if(($row[topic1]==='' && $row['topic2']==='')&&($row['imgname1']!=='' && $row['imgname2']!==''))  
                        {
                            fwrite($OpenReference,'<tr>');
                                fwrite($OpenReference,'<td>'.$row['sn'].'</td>');
                                fwrite($OpenReference,'<td><img src="upload/'.$row['imgname1'].'" alt="Differencing.org" class="img-responsive img-rounded"></td>');
                                fwrite($OpenReference,'<td><img src="upload/'.$row['imgname2'].'" alt="Differencing.org" class="img-responsive img-rounded"></td>');
                            fwrite($OpenReference,'</tr>');     
                        }
                    }    
              } 
              else 
              {
                    echo "0 results";
              }
              
              fwrite($OpenReference,'</table>');
              fwrite($OpenReference,'</div>');
              fwrite($OpenReference,'<div class=" row container-fluid text-right color1" ><h5><a href=""><i>By:</i> Mahendra Gupta (M.Tech,JNU New Delhi) </a></h5></div>');
            fwrite($OpenReference,'<div class=" row container-fluid text-left"><h4><i>References:</i></h4></div>');
            fwrite($OpenReference,'<div class=" row container-fluid">');
            $ExtractQuerry="select *from ".$ArticleName."";
            $result = $difference->query($ExtractQuerry);
            $rowcount=mysqli_num_rows($result);
            if ($rowcount> 0) 
              {
                
                    fwrite($OpenReference,'<ol>');
                    while($row = mysqli_fetch_assoc($result))
                    {
                        //fwrite($OpenReference,'<tr>');
                           // fwrite($OpenReference,'<td>333333333</td>');
                        //fwrite($OpenReference,'</tr>');
                        if(($row['referencename']!=='' && $row['referenceurl']!==''))
                        {
                            fwrite($OpenReference,'<li><a href="'.$row['referenceurl'].'" target="_blank">'.$row['referencename'] .'.</li>');            
                        }
                        else if(($row['referencename']!=='' && $row['referenceurl']===''))  
                        {
                             fwrite($OpenReference,'<li><a href="#">'.$row['referencename'] .'.</li>');
                        }
                        else if(($row['referencename']==='' && $row['referenceurl']!==''))  
                        {
                            fwrite($OpenReference,'<li><a href="'.$row['referenceurl'].'" target="_blank">'.$row['referenceurl'].'.</li>');     
                        }
                    }    
              } 
             
              $difference->close();
            
            fwrite($OpenReference,'</div>');
                             
              fwrite($OpenReference,'</div>');//Table Content Ends.
              fwrite($OpenReference,'<div class="col-sm-2 sidenav">
                                    <div class="well">
                                            <p>ADS</p>
                                    </div>
                                    <div class="well">
                                        <p>ADS</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <footer class="container-fluid text-center">
                            <p>Footer Text</p>
                        </footer>

                        </body>
                        </html>
                    ');
         header('Location: ./'.$myPage.'');
        
    }