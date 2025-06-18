<?php
session_start();
require_once 'calculator.php';
require_once 'view/top.php';

$result = null;
$message = '';
$showResult = false;

if (
    isset($_GET['submitted'], $_GET['firstNumber'], $_GET['secondNumber'], $_GET['operator']) &&
    $_GET['submitted'] === '1'
) {
    $firstNumber = $_GET['firstNumber'];
    $secondNumber = $_GET['secondNumber'];
    $operator = $_GET['operator'];

    if (is_numeric($firstNumber) && is_numeric($secondNumber) && is_string($operator)) {
        $result = calc($operator, floatval($firstNumber), floatval($secondNumber));
        $message = $result !== null ? htmlspecialchars($result) : "Invalid operator or division by zero.";
    } else {
        $message = "Invalid input. Use numbers and a valid operator.";
    }

    $_SESSION['message'] = $message;
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
    $showResult = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <main class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <h1 class="text-center bebas-neue-regular rubik-doodle-shadow-regular"><i class="fas fa-calculator"></i> CALCOLATOR 2000 <i class="fas fa-calculator"></i></h1>

        <form class="formCalc" action="index.php" method="get" autocomplete="off" novalidate id="calcForm">
            <div class="mb-3">
                <label for="firstNumber" class="form-label">NUMBER ↓</label>
                <input type="text" class="form-control" name="firstNumber" id="firstNumber" required />
            </div>

            <div class="mb-3">
                <label class="form-label d-block">OPERATOR ↓</label>
                <div class="btn-group" role="group" aria-label="Operator selection"">
                    <input type="radio" class="btn-check" name="operator" id="add" value="+" required autocomplete="off">
                    <label class="btn btn-outline-primary" for="add">+</label>

                    <input type="radio" class="btn-check" name="operator" id="subtract" value="-" required autocomplete="off">
                    <label class="btn btn-outline-primary" for="subtract">−</label>

                    <input type="radio" class="btn-check" name="operator" id="multiply" value="*" required autocomplete="off">
                    <label class="btn btn-outline-primary" for="multiply">×</label>

                    <input type="radio" class="btn-check" name="operator" id="divide" value="/" required autocomplete="off">
                    <label class="btn btn-outline-primary" for="divide">÷</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="secondNumber" class="form-label">NUMBER ↓</label>
                <input type="text" class="form-control" name="secondNumber" id="secondNumber" required />
            </div>

            <input type="hidden" name="submitted" value="1" />

            <div class="d-grid">
                <button type="submit" class="btn btn-success" id="submit">CALCULATE</button>
            </div>
        </form>

        <?php if ($showResult): ?>
            <div class="mt-4 text-center">
                <label for="result" class="form-label" style="font-weight: bold;">RESULT = </label>
                <span class="result d-inline-block" id="result" tabindex="0">
                    <?= $message ?>
                </span>
            </div>
        <?php endif; ?>
    </main>
    <?php require_once 'view/down.php'; ?>
</body>

</html>