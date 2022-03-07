<?php
include 'top.php';

//step one: intialize 
$dataIsGood = false;
$firstName = "";
$lastName = "";
$pronouns = "";
$email = "";
$grade = ""; 
$comments = "";

//function to check for text and numbers
function verifyAlphaNum($testString) {
    // Check for letters, numbers and dash, period, space and single quote only.
    // added & ; and # as a single quote sanitized with html entities will have 
    // this in it bob's will be come bob's
    return (preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}

//sanitize function from the textbook
function getData($field) 
{
    if (!isset($_POST[$field])) 
    {
        $data = "";
    }
    else 
    {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);    
    }
    return $data;
}
?>
        <main>
            <article>
                 <?php
                 
        /*
        print '<p>Post Array:</p><pre>';
        print_r($_POST);
        print '</pre>';
         * 
         */

        // process form when it is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $dataIsGood = true;

            // Server side Sanitization
            $email = getData("txtEmail");
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $firstName = getData("txtFirstName");
            $lastName = getData("txtLastName");
            $pronouns = getData("txtPronouns");
            $grade = getData("radGrade");
            $comments = getData("txtQuestions");
     

            //step two: validation
            //first text box
            if ($firstName == "") {
                print '<p class="mistake">Please enter your first name.</p>';
                $dataIsGood = false;
            } elseif (!verifyAlphaNum($firstName)) {
                print '<p class="mistake">Your first name appears to have an extra character</p>';
                $dataIsGood = false;
            }
            //second text box
            if ($lastName == "") {
                print '<p class="mistake">Please enter your last name.</p>';
                $dataIsGood = false;
            } elseif (!verifyAlphaNum($lastName)) {
                print '<p class="mistake">Your last name appears to have an extra character</p>';
                $dataIsGood = false;
            }
            //third textbox
            if ($pronouns == "") {
                print '<p class="mistake">Please enter your pronouns</p>';
                $dataIsGood = false;  
            } 
            //email address
            if ($email == "") {
                print '<p class="mistake">Please enter your email address.</p>';
                $dataIsGood = false;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                print '<p class="mistake">Your email address appears to be incorrect.</p>';
                $dataIsGood = false;
            }
            //radio boxes
            if ($grade != "radFirst" AND $grade !="radSecond" AND $grade !="radThird" AND $grade !="radFourth" AND $grade != "radOther") {
                print '<p class="mistake">Please chose your grade.</p>';
                $dataIsGood = false;
            }
            //text area
            if ($comments != "") {
                if (!verifyAlphaNum($comments)) {
                    print '<p class="mistake">Your question appears to have an extra character</p>';
                    $dataIsGood = false;
                }
            } 

            //step three: saving
            if ($dataIsGood) {
                try {
                    $sql = 'INSERT INTO tblMockTrialSurvey (fldFirstName, fldLastName, fldPronouns, fldEmail, fldGrade, fldComments) VALUES (?,?,?,?,?,?)';
                    $statement = $pdo->prepare($sql);
                    $params = array($firstName, $lastName, $pronouns, $email, $grade, $comments); 

                    if ($statement->execute($params)) {
                        print '<p>Your form was successfully recieved by the Mock Trial Team!</p>';
                        
                        //email information
                        $to = $email;
                        $from = 'UVM Mock Trial Team <zsilverm@uvm.edu>';
                        $subject = 'Thank you for reaching out to Mock Trial!';
                        
                        $mailMessage = 'Thank you for taking ';
                        $mailMessage .= 'the time to fill out our survey. A member of the Mock Trial exec team will contact you back shortly! Have a great day!</p><p>-UVM Mock Trial</p>';
                        
                        $headers = "MIME-Version: 1.0\r\n";
                        $headers .= "Content-type: text/html; charset=utf-8\r\n";
                        $headers .= "From: " . $form . "\r\n";
                        
                        $mailSent = mail($to, $subject, $mailMessage, $headers);

                        //email sent
                        if ($mailSent) {
                            print "<p>A copy has been emailed to you for your records.</p>";
                        }
                        //end of email message
                        
                    } else {
                        print '<p>Record was NOT successfully saved.</p>';
                    }
                } catch (PDOException $e) {
                    print '<p>Couldn\'t insert the record, please contact Zoe :).</p>';
                } //end try
            } // ends data is good
        } // ends form was submitted

        if ($dataIsGood) {
            print 'Thank you so much for taking the time to contact us. Have a great day!';
        }
        ?>
                <figure>
                    <img class = "image" alt="Mock Trial on Zoom" src="images/zoom.png" style="max-width: 100%;">
                    <figcaption><i>Mock Trial virtually.</i></figcaption>
                </figure>
                
                
                <h2>Get in Touch with Us!</h2>
                
                <section>
                        <form action="#" method="post" enctype="multipart/form-data">
                            
                        <fieldset class="contact">
                            <legend>Contact Information</legend>
                            <p>
                                <label for="txtFirstName">First Name:</label>
                            </p>
                            <p>
                                <input type="text" name="txtFirstName" id="txtFirstName" value = "<?php print $firstName; ?>">
                            </p>
                            <p>
                                <label for="txtLastName">Last Name:</label>
                            </p>
                            <p>
                                <input type="text" name="txtLastName" id="txtLastName" value = "<?php print $lastName; ?>">
                            </p>
                            <p>
                                <label for="txtPronouns">Pronouns:</label>
                            </p>
                            <p>
                                <input type="text" name="txtPronouns" id="txtPronouns" value = "<?php print $pronouns; ?>">
                            </p>
                            <p>
                                <label for="txtEmail"> UVM Email Address:</label>
                            </p>
                            <p>
                                <input type="text" name="txtEmail" id="txtEmail" value = "<?php print $email; ?>">
                            </p>
                        </fieldset>
                    
                        <fieldset class="radio">
                            <legend>Your Grade</legend>
                            <p>
                                <input type="radio" name="radGrade" id="radFirst"  value="radFirst" <?php if ($grade == 'radFirst') print 'checked'; ?>>
                                <label for="radFirst" class="formselection">First Year</label>
                            </p>
                            <p>
                                <input type="radio" name="radGrade" id="radSecond"  value="radSecond" <?php if ($grade == 'radSecond') print 'checked'; ?>>
                                <label for="radSecond" class="formselection">Sophomore</label>
                            </p>
                            <p>
                                <input type="radio" name="radGrade" id="radThird"  value="radThird" <?php if ($grade == 'radThird') print 'checked'; ?>>
                                <label for="radThird" class="formselection">Junior</label>
                            </p>
                            <p>
                                <input type="radio" name="radGrade" id="radFourth"  value="radFourth" <?php if ($grade == 'radFourth') print 'checked'; ?>>
                                <label for="radFourth" class="formselection">Senior</label>
                            </p>
                            <p>
                                <input type="radio" name="radGrade" id="radOther"  value="radOther" <?php if ($grade == 'radOther') print 'checked'; ?>>
                                <label for="radOther" class="formselection">Graduate/Other</label>
                            </p>
                        </fieldset>
                        <fieldset class="textarea">
                            <legend>Questions or Comments:</legend>
                            <p>
                                <label for="txtQuestions">Anything you want to know?</label>
                            </p>
                            <p>
                                <textarea id="txtQuestions" name="txtQuestions" rows="4" cols="35"><?php print $comments; ?></textarea>
                            </p>
                        </fieldset>
                        
                        <fieldset class="buttons">
                                <input id="btnSubmit" name="btnSubmit" type="submit" value="Submit">
                        </fieldset>
                    </form>
                </section>
                
            </article>
        </main>
<?php
include 'footer.php';
?>
            
