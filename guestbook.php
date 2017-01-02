
<!DOCTYPE html>
<html>
<head>
    
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="mainbrackets.css">

<link rel="stylesheet" type="text/css" href="menu.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--<script type="text/javascript" src="soloscriptbrackets.js"></script>-->
<link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link rel="shortcut icon" href="testdummyblack.png" />
<link href="https://fonts.googleapis.com/css?family=Faster+One" rel="stylesheet">


<link href="https://fonts.googleapis.com/css?family=Six+Caps" rel="stylesheet">
<style>
        .entry{
            border: 1px solid;
            margin: 10px;
            padding: 10px;
        }
    </style>

</head>

<body>
   <?php require_once ('menu.php')?>
    <br><br><br><br>
    <h1>Guest Book</h1>
 
    <form method='post' action=''>
    <textarea name='message'></textarea><br>
    <input type='text' name='sender' /><br>
    <input type='submit' value='Send your message' />
    </form>
 
    <?php
   // $db = mysqli_connect('localhost', 'root', '', 'guestbook'); // Här kopplar vi upp till databasen
    $db = mysqli_connect('guestbook-219315.mysql.binero.se', '219315_xx63052', 'dualtone23', '219315-guestbook');
    
    
    if( isset($_POST['message']) && isset($_POST['sender']) ){ // om vi fått ett formulär med fälten 'message' och 'sender skickat'
         
        $sender = $_POST['sender'];
        $message = $_POST['message'];
 
        $query = "
            INSERT INTO entries
            (date, sender, message)
            VALUES
            (NOW(), '$sender', '$message')
        "; // En SQL-fråga som lägger till ett nytt meddelande i databasen
 
        mysqli_query($db, $query); // Ställ frågan som vi skapade ovan i $query till dabatsen
 
        echo "Skickat!";
    }
     
 
    $query = "
        SELECT *
        FROM entries
        ORDER BY date DESC
    "; // En SQL-fråga som hämtar alla inläggen i gästboken från databasen med det senaste inlägget först
 
    $result = mysqli_query($db, $query); // Här skickar vi frågan ovan till databasen
 
    while( $row = mysqli_fetch_assoc($result) ){ // Eftersom vi inte vet antal rader vi får som svar kör vi en while-loop som tar en rad i taget och lägger i $row som då blir en array med alla värden i den raden där nycklarna har samma namn som kolumnerna i tabellen i databasen
        echo "
            <div class='entry'>
                <p>{$row['date']}</p>
                <p>{$row['message']}</p>
                <p>/{$row['sender']}</p>
            </div>
        ";
    }
     
    ?>
 
   

 

               
    

    
<!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58262de95b1721ad"></script> 
    
</body>
    
</html>


