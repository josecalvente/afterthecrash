
<?php session_start(); // Det är viktigt att vi sätter igång användandet av SESSIONS absolut först i filen ?>
<!doctype html>
<html>
<head>
    <style>
        .entry{
            border: 1px solid;
            margin: 10px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Gästboksadmin</h1>
 
    <?php
        if( isset($_POST['password']) ){ // Om ett formulär med ett fält som heter 'password' skickats
            if($_POST['password'] == "hemlis"){ // Om lösenordet som man skrev in i formuläret är 'hemlis'
                $_SESSION['admin'] = TRUE; // sätter vi en SESSION-variabel till TRUE
            }
        }
 
        if( isset($_POST['logout']) ){ // Om ett formulär med ett fält (eller i detta fall en knapp) som heter 'logout' skickats
            $_SESSION['admin'] = FALSE; // sätter vi en SESSION-variabel till FALSE
        }
 
    // ========== INLOGGAD ADMIN ==========  //
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == TRUE){ // Om vi har en SESSION-variabel som heter admin och den är TRUE, dvs om man är inloggad
            echo "
                <form method='post' action=''>
                    <input type='submit' value='Logga ut' name='logout'>
                </form>
            ";
 
            echo "
                <form method='get' action=''>
                <input type='text' name='search'>
                <input type='submit' value='Sök'>
                </form>
            ";
 
            $db = mysqli_connect('guestbook-219315.mysql.binero.se', '219315_xx63052', 'dualtone23', '219315-guestbook');  // Koppla upp till databasen
 
            if( isset($_POST['id']) ){
 
                $id = $_POST['id'];
 
                $query = "
                    DELETE FROM entries
                    WHERE id = $id
                "; // Här skapar vi en SQL-fråga som tar bort ett inlägg med ett visst 'id'
 
                mysqli_query($db, $query); // Här skickar vi SQL-frågan vi skapade till databasen så att inlägget försvinner
            }
 
            if( isset($_GET['search']) ){ // Om vi får en GET-variabel via URL:en som heter 'search'
 
                $search = $_GET['search'];
                 
                $search_query = "
                    WHERE message LIKE '%$search%'
                    OR sender LIKE '%$search%'
                "; // Här skapar vi en del av en SQL-fråga som gör ett urval av bara de inlägg som matchar sökningen i antingen meddelandet eller i avsändarens namn
             
            }else{
                $search_query = ""; // om vi inte fått en sökning sätter vi "sök delen" av SQL-frågan till tomt
            }
 
            $query = "
                SELECT *
                FROM entries
                $search_query
                ORDER BY date DESC
            "; // här skapas en SQL-fråga som hämtar alla inlägg med det senaste först. det finns även en variabel $search_query som vi skapade ovan och som är beroende av sökningen vi skrev
 
            $result = mysqli_query($db, $query); // här skickar vi frågan för att hämta inläggen till databasen
 
            while( $row = mysqli_fetch_assoc($result) ){ // Eftersom vi inte vet antal rader vi får som svar kör vi en while-loop som tar en rad i taget och lägger i $row som då blir en array med alla värden i den raden där nycklarna har samma namn som kolumnerna i tabellen i databasen
                echo "
                    <div class='entry'>
                        <p>{$row['date']}</p>
                        <p>{$row['message']}</p>
                        <p>/{$row['sender']}</p>
                        <form method='post' action=''>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='submit' value='Ta bort'>
                        </form>
                    </div>
                ";
            }
 
    // ========== SLUT PÅ INLOGGAD ADMIN ========== //
        }else{ // Detta skrivs ut om man inte är inloggad
            echo "
                <form method='post' action=''>
                    <input type='password' name='password'>
                    <input type='submit' value='Logga in'>
                </form>
            ";
        }
    ?>
 
</body>
</html>

