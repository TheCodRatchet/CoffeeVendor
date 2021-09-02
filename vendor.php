<?php

$product = new stdClass();
$product->name = "Coffee";
$product->price = 350;

$person = new stdClass();
$person->tenCents = (int)readline("Enter amount of 10 cents: ");
$person->twentyCents = (int)readline("Enter amount of 20 cents: ");
$person->fiftyCents = (int)readline("Enter amount of 50 cents: ");
$person->oneEuro = (int)readline("Enter amount of 1 euros: ");
$person->twoEuro = (int)readline("Enter amount of 2 euros: ");

$total = (10 * $person->tenCents) + (20 * $person->twentyCents) + (50 * $person->fiftyCents) + (100 * $person->oneEuro) + (200 * $person->twoEuro);

if ($total < $product->price) {
    echo "You don't have enough money for {$product->name}" . PHP_EOL;
}

echo "Please put in coins to receive {$product->name}" . PHP_EOL;

while ($product->price > 0) {
    echo "Total left: {$product->price}" . PHP_EOL;
    $inputCoin = (float) readline("Input coins in vendor: ") * 100;
    if ($inputCoin != 10 && $inputCoin != 20 && $inputCoin != 50 && $inputCoin != 100 && $inputCoin != 200) {
        echo "Vendor accepts only (10,20,50) cents and (1,2) euro coins";
        continue;
    }

    if ($inputCoin == 10 && $person->tenCents == 0) {
        echo "You don't have 10 cent coins" . PHP_EOL;
        continue;
    }
    if ($inputCoin == 20 && $person->twentyCents == 0) {
        echo "You don't have 20 cent coins" . PHP_EOL;
        continue;
    }
    if ($inputCoin == 50 && $person->fiftyCents == 0) {
        echo "You don't have 50 cent coins" . PHP_EOL;
        continue;
    }
    if ($inputCoin == 100 && $person->oneEuro == 0) {
        echo "You don't have 1 euro coins" . PHP_EOL;
        continue;
    }
    if ($inputCoin == 200 && $person->twoEuro == 0) {
        echo "You don't have 2 euro coins" . PHP_EOL;
        continue;
    }

    if ($inputCoin == 10) {
        $person->tenCents -= 1;
    }
    if ($inputCoin == 20) {
        $person->twentyCents -= 1;
    }
    if ($inputCoin == 50) {
        $person->fiftyCents -= 1;
    }
    if ($inputCoin == 100) {
        $person->oneEuro -= 1;
    }
    if ($inputCoin == 200) {
        $person->twoEuro -= 1;
    }

    $product->price -= $inputCoin;

}

$change = 0 - $product->price;
var_dump($change);
$receivedCoins = [];

while ($change != 0){
    if ($change >= 200){
        $person->twoEuro += 1;
        $change -= 200;
        $receivedCoins[] = 200;
    } else if ($change >= 100){
        $person->oneEuro += 1;
        $change -= 100;
        $receivedCoins[] = 100;
    } else if ($change >= 50) {
        $person->fiftyCents += 1;
        $change -= 50;
        $receivedCoins[] = 50;
    } else if ($change >= 20){
        $person->twentyCents += 1;
        $change -= 20;
        $receivedCoins[] = 20;
    } else {
        $person->tenCents += 1;
        $change -= 10;
        $receivedCoins[] = 10;
    }
}

$outputCoins = array_count_values($receivedCoins);

echo "Your change is: " . PHP_EOL;

foreach ($outputCoins as $coin => $count){
    echo "$count - " . $coin / 100 . " euro coins" . PHP_EOL;
}