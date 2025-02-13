<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userMessage = strtolower(trim($_POST["message"]));

    // Predefined chatbot responses
    $responses = [
        "hello" => "Hi! How can I assist you?",
        "jobs" => "We have various job openings. Please tell us your field of interest.",
        "software jobs" => "We have openings in IT and Software Development.",
        "thank you" => "You're welcome! Let me know if you need more help.",
        "rahul kaisa hai" => "voh toh chutiya hai uski baat mat karo",
        "or shubhanshu" => "voh toh chutiya hai uski baat mat karo",
        "kyu" => "kyu kya chutiya hai matlab chutiya hai",
        "bye" => "Goodbye! Have a great day!"
    ];

    // Match user input with predefined responses
    $reply = "I'm sorry, I didn't understand that. Could you please rephrase?";
    foreach ($responses as $key => $value) {
        if (strpos($userMessage, $key) !== false) {
            $reply = $value;
            break;
        }
    }

    echo $reply;
}
?>
