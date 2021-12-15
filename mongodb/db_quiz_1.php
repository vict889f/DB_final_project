<!-- To run this program, your machine needs to have:

    1. Lastest PHP version
    2. PhP Driver https://docs.mongodb.com/drivers/php/
    3. PhP Library https://docs.mongodb.com/php-library/current/ 

    To run just type - php db_quiz_1.php

    This script is DB Quiz that consists from 10 questions
    that are store at MongoDB Atlas. Quiz Response is 
    also send and stored there

    v.1

    15.12.2021

-->

<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new MongoDB\Client("mongodb+srv://admin:Qwe123@kea-dev.iifk9.mongodb.net/myFirstDatabase?retryWrites=true&w=majority");

// pointing to db and collection
$db_name = 'db_quiz_1';
$collection_name = 'questions';
$collection = $client->$db_name->$collection_name;

echo "\n";
$user_email = readline('Please enter your email: ');
$user_answers = [];
array_push($user_answers, $user_email);

for ($x = 1; $x <= 10; $x+=1) {    
    $find_question = $collection->findOne(['number' => $x]);

    $question = $find_question['question'];
    echo "\n";
    echo "\n";
    echo "\n";
    echo $question . "\n";

    sleep(1);

    echo "\n";

    $answers = $find_question['answers'];
    foreach ($answers as $answer => $q) {
        print "$answer => $q\n";
    }
    echo "\n";
    $a = readline('Your answer: ');
    array_push($user_answers, $a);
};

echo "\n";
echo "Thank you for participating!";
echo "\n";

$participants = 'participants';
$collection_insert = $client->$db_name->$participants;

$result = $collection_insert->insertOne([
        $user_answers
    ]);
echo "We saved results in out database!";
echo "\n";

