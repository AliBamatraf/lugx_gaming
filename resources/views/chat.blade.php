<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .chat-container {
            max-width: 600px;
            margin: 20px auto;
        }
        .chat-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .message {
            margin-bottom: 15px;
        }
        .message.user {
            text-align: right;
        }
        .message.assistant {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container chat-container">
        <div class="chat-box" id="chat-box">
            <h4>Chat with AI</h4>
            <div id="messages">
                <!-- Chat messages will appear here -->
            </div>
            <form id="chat-form">
                <div class="input-group mt-3">
                    <input type="text" id="question" class="form-control" placeholder="Type your message..." required>
                    <button class="btn btn-primary" type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        const messagesDiv = document.getElementById('messages');
        const chatForm = document.getElementById('chat-form');
        const questionInput = document.getElementById('question');

        let conversation = [];

        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const userMessage = questionInput.value.trim();
            if (!userMessage) return;

            // Add user's message to the chat
            addMessage('user', userMessage);

            // Send the user's question to the server
            try {
                const response = await fetch('/api/ask-ai', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        question: userMessage,
                        conversation: conversation,
                    }),
                });

                const data = await response.json();

                // Add assistant's response to the chat
                addMessage('assistant', data.response);

                // Update the conversation
                conversation.push({ role: 'user', content: userMessage });
                conversation.push({ role: 'assistant', content: data.response });
            } catch (error) {
                console.error('Error:', error);
                addMessage('assistant', 'An error occurred. Please try again later.');
            }

            questionInput.value = '';
        });

        function addMessage(role, content) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${role}`;
            messageDiv.textContent = content;
            messagesDiv.appendChild(messageDiv);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }
    </script>
</body>
</html>
