<?php

$user_full_name = $USER->firstname . " " . $USER->lastname;
$contact_ilt_form = '<form class="hedataform" id="hedataform" method="post" enctype="multipart/form-data" action="">
                        <fieldset>
                            <ol style="list-style-type:none; padding-left: 0;">
                                <li><label><b>Your message:</b><br><textarea rows="4" cols="50" name="studentcomment"> Enter text here...</textarea></label></li>
                                <li><input class="submitheform" type="submit" value="Submit" name="submit" id="submitform"></li>
                                </ol>
                        </fieldset>
                    </form>';

                    
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["studentcomment"])) {
        $form_student_comment_err = 'Please enter your comment';
    } else {
        $form_student_comment = test_input($_POST["studentcomment"]);
    }
}





if(isset($_POST['submit'])){
    if ($user_id_number != '' && $user_full_name != '' && $form_student_comment != '' ) {

        $email_subject = "Moodle Student Support Request";
        
        $email_body = "You have received a new message from the user $user_full_name \r\n
        Message: $form_student_comment \r\n
        Please reply to: $USER->email";

        $noreplyUser = new stdClass();
        $noreplyUser->firstname = 'ILT';
        $noreplyUser->lastname = '';
        $noreplyUser->username = 'iltteam';
        $noreplyUser->id = '-99';
        $noreplyUser->email = 'ilt@';
        $noreplyUser->maildisplay = 2;
        $noreplyUser->alternatename = "";
        $noreplyUser->firstnamephonetic = "";
        $noreplyUser->lastnamephonetic = "";
        $noreplyUser->middlename = "";
        
        //email_to_user($to,$email_subject,$email_body,$headers);
        email_to_user($noreplyUser, core_user::get_support_user(), $email_subject, $email_body);
        $_POST = array();
        echo 'Successfully Submitted';
        
    }
    else {
        echo 'Invalid form submitted';

    }
}
