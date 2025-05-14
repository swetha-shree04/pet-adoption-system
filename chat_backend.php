<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = trim(strtolower($_POST['message'])); // Normalize input

    // Define chatbot responses
    $responses = [
        // Greetings & Basic Conversation
        "hi" => "Hello! How can I assist you today?",
        "hello" => "Hi there! Need any help?",
        "hey" => "Hey! How can I help you?",
        "how are you" => "I'm just a chatbot, but I'm doing great! How about you?",
        "what is your name" => "I'm your friendly support assistant!",
        "bye" => "Goodbye! Have a great day!",
        "goodbye" => "Take care! Hope to chat with you again!",
        "thank you" => "You're welcome! 😊 Let me know if you need anything else.",
        "thanks" => "Happy to help! Have a great day!",
        "who created you" => "I was created by the Pet Haven team to assist awesome people like you!",
        "what can you do" => "I can answer your pet-related queries, help with adoptions, and provide service details!",
        "tell me a joke" => "Sure! Why did the cat sit on the computer? Because it wanted to keep an eye on the mouse! 😹",
        
        // Adoption Queries
        "what are some dogs available" => "We have Buddy, Luffy, Charlie, and Max available for adoption.",
        "what are some cats available" => "Currently, we have Whiskers, Luna, Oliver, and Bella available for adoption.",
        "do you have rabbits" => "Yes! We have adorable rabbits like Snowball and Daisy available.",
        "how can i adopt a pet" => "You can visit our adoption center or apply online on our website!",
        "is there an adoption fee" => "Yes, adoption fees vary based on the pet. Dogs: $50-$150, Cats: $30-$100.",
        "what are the adoption requirements" => "You need a valid ID, proof of residence, and a short interview to ensure the best match.",
        "how long does the adoption process take" => "It usually takes 2-5 days depending on verification and approvals.",
        "can i return a pet after adoption" => "If you face difficulties, please contact us. We encourage responsible adoption.",
        "do you have puppies for adoption" => "Yes! We have puppies like Coco, Bruno, and Daisy ready for adoption.",
        "do you have kittens for adoption" => "Yes! Kittens like Mochi, Tiger, and Bella are waiting for a loving home.",
        "can i visit the shelter before adopting" => "Yes! We encourage visits to meet the pets before adoption.",
        
        // Pet Care Services
        "what services do you offer" => "We offer pet adoption, grooming, training, and veterinary consultations.",
        "do you provide pet grooming" => "Yes! We offer pet grooming services including baths, haircuts, and nail trimming.",
        "how much is a vet consultation" => "Vet consultations start from $30 and may vary based on the treatment required.",
        "do you sell pet accessories" => "Yes! We have leashes, collars, toys, and pet beds available for purchase.",
        "do you offer pet training" => "Yes! We provide basic and advanced pet training services.",
        "do you provide pet boarding" => "Yes, we offer pet boarding for short and long-term stays.",
        "can you recommend a vet" => "Of course! Our in-house vet, Dr. Smith, is available for consultations.",
        "do you provide vaccinations" => "Yes! We offer vaccinations for dogs, cats, and rabbits.",
        "how often should i take my pet for a check-up" => "It is recommended to visit a vet at least once a year.",
        
        // Pricing & Discounts
        "what is the price of dog food" => "Dog food prices range from $20 to $50 depending on the brand.",
        "what is the price of cat food" => "Cat food prices start from $15 and go up to $40 for premium brands.",
        "do you have discounts on pet food" => "Yes! We offer discounts on bulk purchases and special offers during festive seasons.",
        "how much is pet insurance" => "Our pet insurance plans start from $10 per month.",
        "do you have membership plans" => "Yes! Our premium members get discounts on grooming, training, and pet food.",
        
        // Store & Delivery
        "where is your store located" => "We are located at 123 Pet Haven Street, Citytown. Visit us anytime!",
        "what are your working hours" => "We are open from 9 AM to 7 PM, Monday to Saturday.",
        "do you offer home delivery" => "Yes! We provide home delivery for pet food, accessories, and grooming products.",
        "how can i contact customer support" => "You can reach us at support@pethaven.com or call us at (123) 456-7890.",
        "do you accept returns" => "We accept returns for unopened pet products within 7 days of purchase.",
        "do you have an app" => "Yes! You can download our 'Pet Haven' app from the Play Store and App Store.",
        "can i track my order" => "Yes! Use the tracking number sent to your email after purchase.",
        "do you ship internationally" => "Currently, we only deliver within the country.",
        
        // Fun & Interactive
        "what is the best dog breed for families" => "Labradors, Golden Retrievers, and Beagles are great family dogs!",
        "what is the best cat breed for first-time owners" => "Ragdolls, Maine Coons, and British Shorthairs are great choices!",
        "what pet should i get" => "That depends on your lifestyle! Need help deciding? Let me know what you're looking for!",
        "do dogs dream" => "Yes! Dogs dream just like humans. You might see them twitching in their sleep.",
        "can cats recognize their owners" => "Yes! Cats recognize their owners by voice and scent, even if they act aloof.",
        "how old is my pet in human years" => "A 1-year-old dog is about 15 in human years. Let me know your pet's age!",
        "what is the most popular pet name" => "Bella and Max are the most popular pet names!",
        "do pets understand emotions" => "Yes! Pets can sense emotions and often respond to your mood.",
        "how can i make my pet happy" => "Give them love, attention, playtime, and good food! 😊",
        
        // Emergency Help
        "my pet is sick what should i do" => "Please take your pet to the nearest vet or call our emergency helpline at (123) 456-7890.",
        "what to do if my pet is lost" => "Stay calm, search nearby areas, and contact local shelters for help.",
        "do you have emergency vet services" => "Yes, we have 24/7 emergency vet services available for urgent cases.",
        "my dog is not eating what should i do" => "Try offering their favorite food. If they refuse for more than a day, visit a vet.",
        "can my pet eat human food" => "Some human foods are safe, but avoid chocolate, onions, and grapes.",
        
        // Default Response
        "default" => "Sorry, I didn't understand that. Can you rephrase?"
    ];

    // Find response or default
    $reply = $responses[$message] ?? $responses["default"];

    echo json_encode(["ai_response" => $reply]);
}
?>
