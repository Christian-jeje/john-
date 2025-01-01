document.getElementById('user-input').addEventListener('keypress', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Prevent the default action (form submission)
        sendMessage(); // Call the sendMessage function
    }
});

function sendMessage() {
    const userInput = document.getElementById('user-input').value.trim();
    const chatArea = document.getElementById('chat-area');

    if (userInput !== '') {
        // Display user message
        const userMessage = document.createElement('div');
        userMessage.className = 'message user';
        userMessage.innerText = userInput;
        chatArea.appendChild(userMessage);

        // Simulate bot response after 1 second
        setTimeout(() => {
            const botMessage = document.createElement('div');
            botMessage.className = 'message bot';
            botMessage.innerText = getBotResponse(userInput);
            chatArea.appendChild(botMessage);

            // Scroll to the latest message
            chatArea.scrollTop = chatArea.scrollHeight;
        }, 1000);

        // Clear the input field
        document.getElementById('user-input').value = '';
    }
}

function getBotResponse(input) {
    input = input.toLowerCase();
    const currentTime = new Date();
    const hours = currentTime.getHours();
    const minutes = currentTime.getMinutes();
    const day = currentTime.toLocaleDateString('en-US', { weekday: 'long' });

    
    if (input.includes("good morning")) {
        return "Good morning! I hope you have a great start to your day!";
    } else if (input.includes("good afternoon")) {
        return "Good afternoon! How's your day going?";
    } else if (input.includes("good evening")) {
        return "Good evening! Relax and enjoy your time.";
    } else if (input.includes("day today")) {
        return `Today is ${day}.`;
    } else if (input.includes("current hour") || input.includes("what time is it")) {
        return `The current time is ${hours}:${minutes < 10 ? "0" : ""}${minutes}.`;
    } else if (input.includes("how are you")) {
        return "I'm just a bot, but I'm here to help you!";
    } else if (input.includes("bye")) {
        return "Goodbye! Have a great day!";
    } else {
        switch (true) {
            case input.includes("hello") || input.includes("hi"):
                return "Hi! I'm here to chat.";
            case input.includes("thank you"):
                return "You're welcome!";
            case input.includes("your name"):
                return "I'm your friendly chatbot!";
            case input.includes("birthday"):
                return "Happy Birthday!";
            case input.includes("bad day"):
                return "Don't be sad. Everything will be alright.";
            case input.includes("bad at coding"):
                return "The developer is also bad at coding.";
            case input.includes("so sad"):
                return "Don't be sad, I am always here for you.";
            case input.includes("cheer"):
                return "Every storm runs out of rain-keep going, because brighter days are ahead.";
            case input.includes("want a partner"):
                return "Thy will be done.";
            case input.includes("my partner"):
                return "You can talk to me.";
            case input.includes("it"):
                return "IT students are cheater.";
            case input.includes("Lorem ipsum"):
                return "Lorem ipsum.";
            case input.includes("attack me"):
                return "Wala kang jowa!";
            case input.includes("may jowa ako"):
                return "Mahal ka ba?";
            case input.includes("mahal ako"):
                return "Di ka suree~~";
            case input.includes("i love you"):
                return "Manigas ka. Hmmpt";
            case input.includes("gwapo"):
                return "pustura nim HAHAHA";
            case input.includes("report ka"):
                return "report gad la, updan ko pa ikaw HAHA";
            default:
                return "Utruha po.";
        }
    }
}