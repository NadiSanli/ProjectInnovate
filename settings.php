<?php
    //Starts session and includes database connection.
    session_start();
    //Check if you're logged in.
    if ($_SESSION['loggedin'] === FALSE){
        header("location: login.php");
    }else {

        include("includes/config.php");

        //Checks whether submit button has been pressed.
        if (isset($_POST["submit"])) {
            if ((empty($_POST['breed']) || empty($_POST['sex']) || empty($_POST['age']) || empty($_POST['distance']))) {
                echo '<script>alert("You must fill all fields to set your preferences!")</script>';
            } else {
                $userid = $_SESSION['userid'];
                $prefBreed = $_POST["breed"];
                $prefSex = $_POST["sex"];
                $prefAge = $_POST["age"];
                $prefDistance = $_POST["distance"];

                //Finds breedID matching to the breed you picked.
                $sql = $pdo->prepare("SELECT breedID FROM breed WHERE name = ?");
                $sql->execute(array($prefBreed));
                var_dump($sql);
                $breedID = $sql->fetchColumn(0);
                var_dump($breedID);

                //Executes SQL to save preferences into preferences table to be used during swiping.
                $sql = $pdo->prepare('INSERT INTO preferences (userid, prefBreed, prefAge, prefSex, prefDistance) VALUES (?, ?, ?, ?, ?)');
                $sql->execute(array($userid, $breedID, $prefAge, $prefSex, $prefDistance));
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Breedr</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
    <div class="navbar">
        <ul>
            <li><a href="index.php">Swipe</a></li>
            <li><a href="chat.php">Chat</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="settings.php">Preferences</a></li>
        </ul>
    </div>
    <div class="content_wrapper">
        <div class="logo">
            <img src="images/logo.png">
        </div>
        <div class="addmessage">
            <form class="form_signup" method="POST" action="<?php echo htmlentities($_SERVER["PHP_SELF"]) ?>">
                <p>Distance:</p>
                <p><input type="number" name="distance" min="1" max="100" class ="main-button" value="1"></p>

                <p>Age:</p>
                <p><input type="number" name="age" min="1" max="100" class ="main-button" value="1"></p>

                <p>Breed:</p>
                <p><select name ="breed" class="main-button">
                    <option value="Affenpinscher">Affenpinscher</option>
                    <option value="Afghan hound">Afghan hound</option>
                    <option value="Airedale terrier">Airedale terrier</option>
                    <option value="Akita">Akita</option>
                    <option value="Alaskan malamute">Alaskan malamute</option>
                        <option value="American eskimo dog">American eskimo dog</option>
                        <option value="American foxhound">American foxhound</option>
                        <option value="American staffordshire terrier">American staffordshire terrier</option>
                        <option value="American water spaniel">American water spaniel</option>
                        <option value="Anatolian shepherd dog">Anatolian shepherd dog</option>
                        <option value="Australian shepherd">Australian shepherd</option>
                        <option value="Australian terrier">Australian terrier</option>
                        <option value="Basenji">Basenji</option>
                        <option value="Basset hound">Basset hound</option>
                        <option value="Beagle"Beagle</option>
                        <option value="Bearded collie">Bearded collie</option>
                        <option value="Beauceron">Beauceron</option>
                        <option value="Bedlington terrier">Bedlington terrier</option>
                        <option value="Belgian malinois">Belgian malinois</option>
                        <option value="Belgian sheepdog">Belgian sheepdog</option>
                        <option value="Belgian tervuren">Belgian tervuren</option>
                        <option value="Bernese mountain dog">Bernese mountain dog</option>
                        <option value="Bichon frise">Bichon frise</option>
                        <option value="Black and tan coonhound">Black and tan coonhound</option>
                        <option value="Black russian terrier">Black russian terrier</option>
                        <option value="Bloodhound">Bloodhound</option>
                        <option value="Bluetick coonhound">Bluetick coonhound</option>
                        <option value="Border collie">Border collie</option>
                        <option value="Borzoi">Borzoi</option>
                        <option value="Boston terrier">Boston terrier</option>
                        <option value="Bouvier des flandres">Bouvier des flandres</option>
                        <option value="Boxer">Boxer</option>
                        <option value="Boykin spaniel">Boykin spaniel</option>
                        <option value="Briard">Briard</option>
                        <option value="Brittany">Brittany</option>
                        <option value="Brussels griffon">Brussels griffon</option>
                        <option value="Bull terrier">Bull terrier</option>
                        <option value="Bulldog">Bulldog</option>
                        <option value="Bullmastiff">Bullmastiff</option>
                        <option value="Cairn terrier">Cairn terrier</option>
                        <option value="Canaan dog">Canaan dog</option>
                        <option value="Cane corso">Cane corso</option>
                        <option value="Cardigan welsh corgi">Cardigan welsh corgi</option>
                        <option value="Cavalier king charles spaniel">Cavalier king charles spaniel</option>
                        <option value="Chesapeake bay retriever">Chesapeake bay retriever</option>
                        <option value="Chihuahua">Chihuahua</option>
                        <option value="Chinese crested">Chinese crested</option>
                        <option value="Chinese shar-pei">Chinese shar-pei</option>
                        <option value="Chow chow">Chow chow</option>
                        <option value="Clumber spaniel">Clumber spaniel</option>
                        <option value="Cocker spaniel">Cocker spaniel</option>
                        <option value="Collie">Collie</option>
                        <option value="Curly-coated retriever">Curly-coated retriever</option>
                        <option value="Dachshund">Dachshund</option>
                        <option value="Dalmatian">Dalmatian</option>
                        <option value="Dandie dinmont terrier">Dandie dinmont terrier</option>
                        <option value="Doberman pinscher">Doberman pinscher</option>
                        <option value="Dogue de bordeaux">Dogue de bordeaux</option>
                        <option value="English cocker spaniel">English cocker spaniel</option>
                        <option value="English setter">English setter</option>
                        <option value="English springer spaniel">English springer spaniel</option>
                        <option value="English toy spaniel">English toy spaniel</option>
                        <option value="Entlebucher mountain dog">Entlebucher mountain dog</option>
                        <option value="Field spaniel">Field spaniel</option>
                        <option value="Finnish spitz">Finnish spitz</option>
                        <option value="Flat-coated retriever">Flat-coated retriever</option>
                        <option value="French bulldog">French bulldog</option>
                        <option value="German pinscher">German pinscher</option>
                        <option value="German shepherd dog">German shepherd dog</option>
                        <option value="German shothaired pointer">German shothaired pointer</option>
                        <option value="German wirehaired pointer">German wirehaired pointer</option>
                        <option value="Giant schnauzer">Giant schnauzer</option>
                        <option value="Glen of imaal terrier">Glen of imaal terrier</option>
                        <option value="Golden retriever">Golden retriever</option>
                        <option value="Gordon setter">Gordon setter</option>
                        <option value="Great dane">Great dane</option>
                        <option value="Great pyrenees">Great pyrenees</option>
                        <option value="Greater swiss mountain dog">Greater swiss mountain dog</option>
                        <option value="Greyhound">Greyhound</option>
                        <option value="Havanese">Havanese</option>
                        <option value="Ibizan hound">Ibizan hound</option>
                        <option value="Icelandic sheepdog">Icelandic sheepdog</option>
                        <option value="Irish red and white setter">Irish red and white setter</option>
                        <option value="Irish setter">Irish setter</option>
                        <option value="Irish terrier">Irish terrier</option>
                        <option value="Irish water spaniel">Irish water spaniel</option>
                        <option value="Irish wolfhound">Irish wolfhound</option>
                        <option value="Italian greyhound">Italian greyhound</option>
                        <option value="Japanese chin">Japanese chin</option>
                        <option value="Keeshound">Keeshound</option>
                        <option value="Kerry blue terrier">Kerry blue terrier</option>
                        <option value="Komondor">Komondor</option>
                        <option value="Kuvasz">Kuvasz</option>
                        <option value="Labrador retriever">Labrador retriever</option>
                        <option value="Lakeland terrier">Lakeland terrier</option>
                        <option value="Leonberger">Leonberger</option>
                        <option value="Lhasa apso">Lhasa apso</option>
                        <option value="Lowchen">Lowchen</option>
                        <option value="Maltese">Maltese</option>
                        <option value="Manchester terrier">Manchester terrier</option>
                        <option value="Mastiff">Mastiff</option>
                        <option value="Miniature schnauzer">Miniature schnauzer</option>
                        <option value="Neapolitan mastiff">Neapolitan mastiff</option>
                        <option value="Newfoundland">Newfoundland</option>
                        <option value="Norfolk terrier">Norfolk terrier</option>
                        <option value="Norwegian buhund">Norwegian buhund</option>
                        <option value="Norwegian elkhound">Norwegian elkhound</option>
                        <option value="Norwegian lundehund">Norwegian lundehund</option>
                        <option value="Norwich terrier">Norwich terrier</option>
                        <option value="Nova scotia duck tolling retriever">Nova scotia duck tolling retriever</option>
                        <option value="Old english sheepdog">Old english sheepdog</option>
                        <option value="Otterhound">Otterhound</option>
                        <option value="Papillon">Papillon</option>
                        <option value="Parson russel terrier">Parson russel terrier</option>
                        <option value="Pekingese">Pekingese</option>
                        <option value="Pembroke welsh corgi">Pembroke welsh corgi</option>
                        <option value="Petit basset griffon vendeen">Petit basset griffon vendeen</option>
                        <option value="Pharaoh hound">Pharaoh hound</option>
                        <option value="Plott">Plott</option>
                        <option value="Pointer">Pointer</option>
                        <option value="Pomeranian">Pomeranian</option>
                        <option value="Poodle">Poodle</option>
                        <option value="Portuguese water dog">Portuguese water dog</option>
                        <option value="Saint bernard">Saint bernard</option>
                        <option value="Silky terrier">Silky terrier</option>
                        <option value="Smooth fox terrier">Smooth fox terrier</option>
                        <option value="Tibetan mastiff">Tibetan mastiff</option>
                        <option value="Welsh springer spaniel">Welsh springer spaniel</option>
                        <option value="Wirehaired pointing griffon">Wirehaired pointing griffon</option>
                        <option value="Xoloitzcuintli">Xoloitzcuintli</option>
                        <option value="Yorkshire terrier">Yorkshire terrier</option>
                </select></p>

                <p>Sex:</p>
                <p><select name="sex" class="main-button">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                </select></p>


                <p><input type="submit" value="Submit" name="submit" class="main-button"/></p>
            </form>
        </div>
    </div>
    </body>
</html>