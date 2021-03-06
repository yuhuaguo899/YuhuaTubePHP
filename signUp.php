<?php 
require_once("includes/config.php");
require_once("includes/classes/Account.php");  
require_once("includes/classes/Constants.php");  
require_once("includes/classes/FormSanitizer.php"); 

$account=new Account($con);



if(isset($_POST["submitButton"]))
{
    $firstName =FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName =FormSanitizer::sanitizeFormString($_POST["lastName"]);
    
    $username=FormSanitizer::sanitizeFormUsername($_POST["username"]);

    $email=FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $email2=FormSanitizer::sanitizeFormEmail($_POST["email2"]);

    $password=FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2=FormSanitizer::sanitizeFormPassword($_POST["password2"]);

    $wasSuccessful=$account->register($firstName,$lastName,$username,$email,$email2,$password,$password2);

    if($wasSuccessful)
    {
        $_SESSION["userLoggedIn"]=$username;
        // redirect page
        header("Location:index.php");
    }

}


function getInputValue($name)
{
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SignInYuhuaTube</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link  rel="stylesheet" type="text/css" href="assets/css/style.css"></link>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/commonAction.js"></script>
</head>
<body>
        <div class="signInContainer">
            <div class="column">
                <div class="header">
                    <img src="assets/images/icons/VideoTubeLogo.png" title="tubelogo" alt="Site logo">
                    <h3>Sign Up</h3>
                    <span>to continue to YuhuaTube</span>
                </div>

                <div class="loginForm">

                <form action="signUp.php" method="POST" >

                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <input type="text" name="firstName" placeholder="First name..." autocomplete="off" required  value ="<?php getInputValue('firstName');?>">

                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <input type="text" name="lastName" placeholder="Last name..." autocomplete="off" required value ="<?php getInputValue('lastName');?>">

                    <?php echo $account->getError(Constants::$usernameCharacters); ?>
                    <?php echo $account->getError(Constants::$usernameTaken); ?>
                    <input type="text" name="username" placeholder="Username..." autocomplete="off" required value ="<?php getInputValue('username');?>">
                   
                    <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>                   
                    <input type="email" name="email" placeholder="email..." autocomplete="off" required  value ="<?php getInputValue('email');?>">
                    <input type="email" name="email2" placeholder="Confirm email..." autocomplete="off" required  value ="<?php getInputValue('email2');?>">

                    <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                    <?php echo $account->getError(Constants::$passwordLength); ?>                 
                    <input type="password" name="password" placeholder="password..." autocomplete="off" required>
                    <input type="password" name="password2" placeholder="Confirm password..." autocomplete="off" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                </form>
                
                </div>

                <a href="signIn.php" class="signInMessage">Already have an account? Sign in here!</a>    
            
            </div>
        
        
        
        </div>




</body>
</html>