<?php 

    require_once('inc/functions.php');

    $task = $_GET['task'] ?? 'report';
    $info = '';
    
    if('seed' == $task){
        seed();
        $info = "Seeding is compleete";
    }

    /**
     * 
     * Declare a variable like $fname $lname $roll 
     * when user update a form, it's save our db, but if any error it's also stay
     */

    $fname = "";
    $lname = "";
    $roll = "";


    if(isset($_POST['submit'])){
        $fname = htmlspecialchars(filter_input(INPUT_POST, 'fname'));
        $lname= htmlspecialchars(filter_input(INPUT_POST, 'lname'));
        $roll = htmlspecialchars(filter_input(INPUT_POST, 'roll'));
        $id = htmlspecialchars(filter_input(INPUT_POST, 'id'));
        
        if($id){
            if($fname != "" && $lname != "" && $roll != ""){
                $result = updateStudent($id, $fname, $lname, $roll);

                if(!$result){
                    $info = "Student Update successfully";
                } else{
                    $info = "Same Roll already exists!!!";
                }
               
                
            }
        } else{
            if($fname != "" && $lname != "" && $roll != ""){
                $result = addStudent($fname, $lname, $roll); 
                if(!$result){
                    $info = "Same ID already exists!!!";
                } else{
                    $info = "Student added successfully";
                }
                
            } else { 
                $info = "Please fill all the fields";
            }
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LWHH CRUD Project</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <style>
        body {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column column-60 column-offset-20">
            <h2>LWHH CRUD Project</h2>
            <p>A sample project to perform CRUD operations using plain files and PHP</p>

            <?php include_once('inc/templates/nav.php'); ?>

            <hr/>

            <?php 
            
            if($info != ''){
                echo "<blockquote>{$info}</blockquote>";
            }
            
            ?>
        </div>
    </div>

        <?php if('report' == $task){ ?>
        <div class="container">
            <div class="row">
                <div class="column">
                    <?php generateReport(); ?>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if('add' == $task){ ?>
        <div class="container">
            <div class="row">
            <div class="column column-60 column-offset-20">
                <form method="POST">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>">
                    <label for="roll">Roll</label>
                    <input type="number" name="roll" id="roll" value="<?php echo $roll; ?>">
                    <button type="submit" class="button-primary" name="submit">Save</button>
                </form>
            </div>
            </div>
        </div>
        <?php } ?>

        <?php if('edit' == $task){ 

            $id = $_GET['id'];
            $student = getStudent($id);

            if($student){
            ?>
        <div class="container">
            <div class="row">
            <div class="column column-60 column-offset-20">
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" value="<?php echo $student['fname']; ?>">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" value="<?php echo $student['lname']; ?>">
                    <label for="roll">Roll</label>
                    <input type="number" name="roll" id="roll" value="<?php echo $student['roll']; ?>">
                    <button type="submit" class="button-primary" name="submit">Update</button>
                </form>
            </div>
            </div>
        </div>
        <?php }} ?>

</body>

</html>