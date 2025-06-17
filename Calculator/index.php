<?php
require_once 'calculator.php';
require_once 'view/top.php';
require_once 'view/down.php';
?>
<!DOCTYPE
<html>


<body>
    <h1>CALCOLATOR 2000</h1>
    <form action="" method="get" class="inputCalc">
        <div class="inputCalc">
            <label for="name"> NUMBER > </label>
            <input type="text" name="firstNumber" id="a" require />
        </div>
        <div class="inputCalc">
            <label for="name"> OPERATOR > </label>
            <input class="textBlock" type="text" name="operator" id="operator" require />
        </div>
        <div class="inputCalc">
            <label for="name"> NUMBER > </label>
            <input type="text" name="secondNumber" id="b" require />
        </div>
        <div class="inputCalcButton">
            <input class="button" type="submit" value="Result" />
        </div>
    </form>

    <label>RESULT ></label>
    <span class="result">
    <?php
    if (isset($_GET['firstNumber']) && isset($_GET['operator']) && isset($_GET['secondNumber'])) {

        if (is_numeric($_GET['firstNumber']) && is_string($_GET['operator']) && is_numeric($_GET['secondNumber'])) {
            $result = calc($_GET['operator'], $_GET['firstNumber'], $_GET['secondNumber']);
            if($result != null){
                echo "$result";
            } else {
                echo 'error in the argoment';
            }
        } else {
            echo 'error';
        }
    }
    ?>
    </span>
</body>

</html>