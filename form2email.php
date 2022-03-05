<?php
//Message vars
$msg = '';
$msgClass = '';
// Check for submit
if (filter_has_var(INPUT_POST, 'submit')) {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    // Check Required fields
    if (!empty($name) && !empty($email) && !empty($message)) {
        
      
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    
            $msg = 'Please check Email';
            $msgClass = 'alert-danger';
        } else {
        
            // Recepient email
            $toEmail = 'hassanbulega@hasgotech.com';
            $subject = 'Contact Request From ' . $name;
            $body = '<h2>Contact Request</h2>
                     <h4>Name</h4> <p>'. $name .'</p>
                     <h4>Email</h4> <p>'. $email .'</p>
                     <h4>Message</h4> <p>'. $message .'</p>
            ';
            // Email Headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-Type:text/html; charset = UTF-8" . "\r\n";

            // Additional Headers
            $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";

            // Using the mail function
            if(mail($toEmail, $subject, $body, $headers)) {
                // Email Sent
                $msg = 'Your Email has been sent';
                $msgClass = 'alert-success';
            } else {
                // Failed
                $msg = 'Your Email was not sent';
                $msgClass = 'alert-danger';
            }


        }
    } else {
        
        $msg = 'Please fill in all fields';
        $msgClass = 'alert-danger';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form(Submit to Email)</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cosmo/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- <script defer  src="../fontawesome-all.min.js"></script> -->
</head>

<body>
    <nav class="navbar navbar-default bg-dark mb-2">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand text-white" href="index.php">My Contact Form</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php if ($msg != '') : ?>
            <div class="alert <?php echo $msgClass; ?>">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <h2>Send Us a Message</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>" />
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="text" id="email" class="form-control" name="email" placeholder="name@gmail.com" value="<?php echo isset($_POST['email']) ? $email : ''; ?>" />
                </div>
            </div>

           

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                    <textarea id="message" class="form-control" name="message" rows="5" placeholder="Write your message here...">
                    <?php echo isset($_POST['message']) ? $message : ''; ?>
                    </textarea>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-secondary">Submit</button>
            <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
        </form>
    </div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script> -->
</body>

</html>