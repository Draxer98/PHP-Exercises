<?php

class CustomException extends Exception {}

function testAllErrors() {
    try {
        echo "1. Division by zero:\n";
        $x = 10 / 0;

    } catch (DivisionByZeroError $e) {
        echo "Division by zero error: " . $e->getMessage() . "\n";

    } finally {
        echo "Block finally after division by zero.\n\n";
    }

    try {
        echo "2. Access to a nonexistent file:\n";
        if (!file_exists("nonexistent_file.php")) {
            throw new Exception("File not found.");
        }

    } catch (Exception $e) {
        echo "Generic exception: " . $e->getMessage() . "\n";

    } finally {
        echo "Block finally after file.\n\n";
    }

    try {
        echo "3. Custom exception:\n";
        throw new CustomException("This is a custom error.");

    } catch (CustomException $e) {
        echo "CustomException caught: " . $e->getMessage() . "\n";

    } finally {
        echo "Block finally after CustomException.\n\n";
    }

    try {
        echo "4. Undeclared variable:\n";
        //echo $undefinedVariable;

    } catch (Error $e) {
        echo "Error generated by undefined variable: " . $e->getMessage() . "\n";

    } finally {
        echo "Block finally after undefined variable.\n\n";
    }

    try {
        echo "5. Throw an Error directly:\n";
        throw new Error("Serious system error.");

    } catch (Error $e) {
        echo "Caught Error: " . $e->getMessage() . "\n";

    } finally {
        echo "Block finally after Error.\n\n";
    }

    try {
        echo "6. Generic catch with Throwable:\n";
        throw new Exception("General exception");

    } catch (Throwable $e) {
        echo "Caught with Throwable: " . $e->getMessage() . "\n";

    } finally {
        echo "Block finally after Throwable.\n\n";
    }
}

testAllErrors();

?>
