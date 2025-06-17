<?php
function calc(string $operator,float ...$arrays)
{
    $result = $arrays[0];

    switch ($operator) {
        case '+':
            $result += $arrays[1];
            break;
        case '-':
            $result -= $arrays[1];
            break;
        case '*':
            $result *= $arrays[1];
            break;
        case '/':
            if ($arrays[1] != 0) {
                $result /= $arrays[1];
            } else {
                $result = null;
            }
            break;
        default:
            $result = null;
            break;
    }

    return $result;
}
