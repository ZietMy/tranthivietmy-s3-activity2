<?php

function validate_message($message)
{
    // function to check if message is correct (must have at least 10 caracters (after trimming))
    // $message2=trim($message);
    if (empty($message)){
        return "Please enter a message";
    }
    elseif (strlen($message)<10){
        return "Message must be at least 10 characters long";
    }
    return ;

}

function validate_username($username)
{
    // function to check if username is correct (must be alphanumeric => Use the function 'ctype_alnum()')
    // $username =(trim($username));
    if(empty($username)) {
        return "Please enter a username";
    }
    elseif (!ctype_alnum($username)){
        return "Username should contains only letters and numbers";
    }
    return ;
}

function validate_email($email)
{
    
    // $email2 =(trim($email));
    if(empty($email)) {
        return "Please enter an email";
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        return  "email must contain '@'";
    }
    return ;
}



$user_error = "";
$email_error = "";
$terms_error = "";
$message_error = "";
$username = "";
$email = "";
$message = "";

$form_valid = false;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['username'])){
        $username=htmlspecialchars(trim($_POST['username']));
        // $username=(trim($_POST['username']));
        $user_error=validate_username($username);
    }
    

    if(isset($_POST['email'])){
        $email=htmlspecialchars(trim($_POST['email']));
        $email_error=validate_email($email);
    }

    if(isset($_POST['message'])){
        $message=htmlspecialchars(trim($_POST['message']));
        $message_error= validate_message($message);
    }
    
    if(!isset($_POST['terms'])){
        $terms_error = "You must accept the Terms of Service";

    }
    // Here is the list of error messages that can be displayed:
    //
    // ""
    // "You must accept the Terms of Service"
    // "Please enter a username"
    // "Username should contains only letters and numbers"
    // "Please enter an email"
    // "email must contain '@'"
    if (empty($user_error) && empty($email_error)&& empty($message_error)&& !empty($_POST['terms'])){
        $form_valid= true;
    }
    
}


?>

<form action="#" method="post">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username" value="<?php echo $username ?>">
            <small class="form-text text-danger"> <?php echo $user_error; ?></small>
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter email" name="email" value="<?php echo $email ?>">
            <small class="form-text text-danger"> <?php echo $email_error; ?></small>
        </div>
    </div>
    <div class="mb-3">
        <textarea name="message" placeholder="Enter message"  class="form-control"  ></textarea>
        <small class="form-text text-danger"> <?php echo $message_error; ?></small>
    </div>
    <div class="mb-3">
        <input type="checkbox" class="form-control-check" name="terms" id="terms" > <label for="terms">I accept the Terms of Service</label>
        <small class="form-text text-danger"> <?php echo $terms_error; ?></small>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<hr>

<?php
if ($form_valid) :
?>
    <div class="card">
        <div class="card-header">
            <p><?php echo $username; ?></p>
            <p><?php echo $email; ?></p>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo $message; ?></p>
        </div>
    </div>
<?php
endif;
?>