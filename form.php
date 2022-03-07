<?php
include 'top.php';

//step one: intialize 
$dataIsGood = false;
$firstName = "";
$lastName = "";
$zipCode = "";
$email = "";
$opinion = "";
$totalChecked = 0; 
$greatWhiteShark = false;
$hammerheadShark = false;
$porbeagleShark = false;
$spinyDogfish = false;
$none = false;
$threats = "Overfishing";
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
        <main class="form flexbox-layout">
            <article>
                 <?php
        print '<p>Post Array:</p><pre>';
        print_r($_POST);
        print '</pre>';

        // process form when it is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $dataIsGood = true;

            // Server side Sanitization
            $email = getData("txtEmail");
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $firstName = getData("txtFirstName");
            $lastName = getData("txtLastName");
            $zipCode = getData("txtZipCode");
            $opinion = getData("radSharks");
            $greatWhiteShark = (int) getData("chkGreatWhiteShark");
            $hammerheadShark = (int) getData("chkHammerheadShirt");
            $porbeagleShark = (int) getData("chkPorbeagleShark");
            $spinyDogfish = (int) getData("chkSpinyDogfish");
            $none = (int) getData("chkNone");
            $threats = getData("lstThreats");
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
            if ($zipCode == "") {
                print '<p class="mistake">Please enter your zip code.</p>';
                $dataIsGood = false;
            }  elseif (!is_numeric($zipCode)) {
                print '<p class="mistake">Your zip code appears to have a non-number character</p>';
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
            //check boxes
            if ($opinion != "radSharksFear" AND $opinion !="radSharksNeutral" AND $opinion !="radSharksLike") {
                print '<p class="mistake">Please indicate your opinion on sharks.</p>';
                $dataIsGood = false;
            }
            //radio buttons
            $totalChecked = $greatWhiteShark + $hammerheadShark + $porbeagleShark + $spinyDogfish + $none;
            if ($totalChecked < 1) {
                print '<p class="mistake">Please indicate which (if any) sharks you are familiar with.</p>';
                $dataIsGood = false;
            }
            //list box
            if ($threats == "") {
                print '<p class="mistake">Please indicate your opinion on what the greatest threat to sharks is.</p>';
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
                    $sql = 'INSERT INTO tblSharkSurvey (fldFirstName, fldLastName, fldZipCode, fldEmail, fldOpinion, fldGreatWhiteShark, fldHammerheadShark, fldPorbeagleShark, fldSpinyDogfish, fldNone, fldThreats, fldComments) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
                    $statement = $pdo->prepare($sql);
                    $params = array($firstName, $lastName, $zipCode, $email, $opinion, $greatWhiteShark, $hammerheadShark, $porbeagleShark, $spinyDogfish, $none, $threats, $comments); 

                    if ($statement->execute($params)) {
                        print '<p>Record was successfully saved.</p>';
                    } else {
                        print '<p>Record was NOT successfully saved.</p>';
                    }    
            
                } catch (PDOException $e) {
                    print '<p>Couldn\'t insert the record, please contact someone :).</p>';
                } //end try
            } // ends data is good
        } // ends form was submitted

        if ($dataIsGood) {
            print '<h2>Thank you, your information has been received.</h2>';
        }
        ?>
                <figure>
                    <img alt="Whale Shark-July 2018" src="images/formimage.png" style="max-width: 100%;">
                    <figcaption><i>Bull Shark in the Bahamas.</i> Photo by: <cite><a href="https://www.floridamuseum.ufl.edu/discover-fish/species-profiles/carcharhinus-leucas/" target="_blank">David Sydner</a></cite></figcaption>
                </figure>
                
                <h2 class="text-shadow">Shark Survey</h2>
                
                <section>
                        <form action="#" method="post" enctype="multipart/form-data">
                            
                        <fieldset class="contact">
                            <legend>Biographical Information</legend>
                            <p>
                                <label for="txtFirstName">First Name:</label>
                                <input type="text" name="txtFirstName" id="txtFirstName" value = "<?php print $firstName; ?>">
                            </p>
                            <p>
                                <label for="txtLastName">Last Name:</label>
                                <input type="text" name="txtLastName" id="txtLastName" value = "<?php print $lastName; ?>">
                            </p>
                            <p>
                                <label for="txtZipCode">Zip Code:</label>
                                <input type="text" name="txtZipCode" id="txtZipCode" value = "<?php print $zipCode; ?>">
                            </p>
                            <p>
                                <label for="txtEmail">Email Address:</label>
                                <input type="text" name="txtEmail" id="txtEmail" value = "<?php print $email; ?>">
                            </p>
                        </fieldset>
                    
                        <fieldset class="radio">
                            <legend>Opinion on Sharks</legend>
                            <p>
                                <input type="radio" name="radSharks" id="radSharksFear"  value="radSharksFear" <?php if ($opinion == 'radSharksFear') print 'checked'; ?>>
                                <label for="radSharksFear" class="formselection">I am afraid of sharks</label>
                            </p>
                            <p>
                                <input type="radio" name="radSharks" id="radSharksNeutral"  value="radSharksNeutral" <?php if ($opinion == 'radSharksNeutral') print 'checked'; ?>>
                                <label for="radSharksNeutral" class="formselection">I am neutral on sharks</label>
                            </p>
                            <p>
                                <input type="radio" name="radSharks" id="radSharksLike"  value="radSharksLike" <?php if ($opinion == 'radSharksLike') print 'checked'; ?>>
                                <label for="radSharksLike" class="formselection">I am like sharks and am not afraid of them</label>
                            </p>
                        </fieldset>
                    
                        <fieldset class="checkbox">
                            <legend>Which sharks have you heard of (check all that apply)?</legend>
                            <p>
                                <input <?php if ($greatWhiteShark) print " checked "; ?> type="checkbox" name="chkGreatWhiteShark" id="chkGreatWhiteShark"  value="1">
                                <label for="chkGreatWhiteShark" class="formselection">Great White Shark</label>
                            </p>
                            <p>
                                <input <?php if ($hammerheadShark) print " checked "; ?> type="checkbox" name="chkHammerheadShark" id="chkHammerheadShirt"  value="1">
                                <label for="chkHammerheadShirt" class="formselection">Hammerhead Shark</label>
                            </p>
                            <p>
                                <input <?php if ($porbeagleShark) print " checked "; ?> type="checkbox" name="chkPorbeagleShark" id="chkPorbeagleShark"  value="1">
                                <label for="chkPorbeagleShark" class="formselection">Porbeagle Shark</label>
                            </p>
                            <p>
                                <input <?php if ($spinyDogfish) print " checked "; ?> type="checkbox" name="chkSpinyDogfish" id="chkSpinyDogfish" value="1">
                                <label for="chkSpinyDogfish" class="formselection">Spiny Dogfish</label>
                            </p>
                            <p>
                                <input <?php if ($none) print " checked "; ?> type="checkbox" name="chkNone" id="chkNone" value="1">
                                <label for="chkNone" class="formselection">None of the above</label>
                            </p>
                        </fieldset>
                    
                        <fieldset class="listbox">
                            <legend>What do you think is the greatest threat to sharks?</legend>
                            <p>
                                <select id="lstThreats" name="lstThreats" class="formselection" size="1">
                                    <option <?php if ($threats == "lstOverfishing") print " selected "; ?> value="lstOverfishing">Overfishing</option>
                                    <option <?php if ($threats == "lstRisingtemps") print " selected "; ?> value="lstRisingtemps">Rising ocean temperatures</option>
                                    <option <?php if ($threats == "lstPollution") print " selected "; ?> value="lstPollution">Pollution</option>
                                    <option <?php if ($threats == "lstOther") print " selected "; ?> value="lstOther">Other</option>
                                </select>
                            <p>
                        </fieldset>
                        
                        <fieldset class="textarea">
                            <legend>Questions:</legend>
                            <p>
                                <label for="txtQuestions">Questions about sharks?</label>
                                <textarea id="txtQuestions" name="txtQuestions" rows="2" cols="20"><?php print $comments; ?></textarea>
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
            
