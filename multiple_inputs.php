<html>
<head>
    <title></title>
</head>
<body>
    <?php
    session_start();

    if(!isset($_POST['submit']))
    {

        $_SESSION['count']=0;

    }
    ?>
    <form action="" method="POST">
  <i> color </i><input type="text" name="text">
  <i> color amount </i> <input type="number" name="num">
  <input type="submit" value="Go" name="submit">
</form>

<?php
    if(isset($_POST['submit']))
    {
        echo $_POST['text'];
        echo "<br>";
        echo $_POST['num'];
        echo "<br>";
        $count=$_SESSION['count']++;
        if($count==9)
        {
            echo "you have received 10 values";
            echo "<br>";
            echo "press ok to get again";
            ?>
            <form method="post">
                <input type="submit" name="ok" value="ok">
            </form>
            <?php
            if(isset($_POST['ok']))
            {    
            header("Refresh:0");
            }
        }
    }
    ?>
</body>
</html>