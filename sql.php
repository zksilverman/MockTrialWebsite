<?php
include 'top.php';
?> 
<main>
    <p>Create Table SQL</p>

    <pre>
        CREATE TABLE tblMockTrialSurvey(
            pmktblMockTrialSurveyId INT AUTO_INCREMENT PRIMARY KEY,
            fldFirstName VARCHAR(30),
            fldLastName VARCHAR(30),
            fldPronouns VARCHAR(30),
            fldEmail VARCHAR(50),
            fldGrade VARCHAR(50),
            fldComments TEXT
            );

        INSERT INTO tblMockTrialSurvey (fldFirstName, fldLastName, fldPronouns, fldEmail, fldGrade, fldComments) VALUES ('Zoe', 'Silverman', 'she/her', 'zsilverm@uvm.edu', 'Junior', 'None');

        CREATE TABLE tblMockTrialContactInformation(
            pmktblMockTrialContactInformationId INT AUTO_INCREMENT PRIMARY KEY,
            fldName VARCHAR(80),
            fldPronouns VARCHAR(30),
            fldEmail VARCHAR(50),
            fldRole VARCHAR(100)
            );


        INSERT INTO tblMockTrialContactInformation (fldName, fldPronouns, fldEmail, fldRole) VALUES 
        
        ('Brynn Connell', 'she/her', 'Brynn.Connell@uvm.edu', 'President'),
        ('Erin Bucchin', 'she/her', 'Erin.Bucchin@uvm.edu', 'Vice President'),
        ('Jahna Belz', 'she/her', 'Jahna.Belz@uvm.edu', 'Co-Treasurer'),
        ('Zoe Silverman', 'she/her', 'Zoe.Silverman@uvm.edu', 'Co-Treasurer'),
        ('Grace Bickham', 'she/her', 'Grace.Bickham@uvm.edu', 'Secretary'),
        ('Emma Cripps', 'she/her', 'Emma.Cripps@uvm.edu', 'Social Media Manager'),
        ('Kate Castle', 'she/her', 'kdcastle@uvm.edu', 'Co-Director of Snacks and Activities'),
        ('Trea Hsieh-Lewis', 'she/her', 'Trea.Hsieh-Lewis@uvm.edu', 'Co-Director of Snacks and Activities');


    </pre>
</main>
 
<?php
include 'footer.php';
?>   