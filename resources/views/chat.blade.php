@extends('layouts.app')

@section('content')
<style>
    .chat-box {
        height: 400px;
        overflow-y: auto;
    }

    .message {
        display: block;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 20px;
        max-width: 80%;
        word-wrap: break-word; /* Add this line to wrap long words */
    }

    .message.sent {
        float: right;
        clear: both; /* Add this line to ensure proper wrapping */
        background-color: #007bff;
        color: #fff;
    }

    .message.received {
        float: left;
        clear: both; /* Add this line to ensure proper wrapping */
        background-color: #e6e6e6;
        color: #333;
    }

    .message-content {
        margin-bottom: 5px;
    }
</style>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>Doctors</h3>
                <ul class="list-group">
                    @foreach ($users as $user)
                        <li class="list-group-item">
                            <a href="#" class="user-link" data-user-id="{{ $user->id }}">{{ $user->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span id="chat-heading"></span>
                    </div>
                    <div class="card-body chat-box" id="chat-box">
                        <p>Select a user to start the chat.</p>
                    </div>
                    <div class="card-footer">
                        <form id="message-form" action="{{ route('chat.send') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="message" id="message-input" placeholder="Type your message">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to load messages for a specific user
            function loadMessages(userId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('chat.getMessages') }}',
                    data: { user_id: userId },
                    success: function(response) {
                        if (response.success) {
                            var messages = response.messages;
                            var chatBox = $('#chat-box');
                            chatBox.empty();
                            if (messages.length > 0) {
                                messages.forEach(function(message) {
                                    var messageClass = message.user_id === {{ auth()->id() }} ? 'sent' : 'received';
                                    chatBox.append('<div class="message ' + messageClass + '">' + message.content + '</div>');
                                });
                            } else {
                                chatBox.append('<p>No messages yet</p>');
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Function to send a message
            function sendMessage(message) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('chat.send') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'message': message,
                        'receiver_id': selectedUserId,
                    },
                    success: function(response) {
                        if (response.success) {
                            var chatBox = $('#chat-box');
                            chatBox.append('<div class="message sent">' + message + '</div>');
                            chatBox.scrollTop(chatBox[0].scrollHeight);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Event listener for message form submission
            $('#message-form').on('submit', function(event) {
                event.preventDefault();

                var messageInput = $('#message-input');
                var message = messageInput.val();

                if (message.trim() !== '') {
                    sendMessage(message);
                    messageInput.val('');
                }
            });

            // Check if there is a selected user from previous session
            var selectedUserId = localStorage.getItem('selectedUserId');
            if (selectedUserId) {
                // Load the messages for the selected user
                loadMessages(selectedUserId);
            }

            // Event handler for user links
            $('.user-link').on('click', function(event) {
                event.preventDefault();

                var userId = $(this).data('user-id');

                // Update the chat heading
                var chatHeading = $('#chat-heading');
                chatHeading.text('Chat with ' + $(this).text());

                // Load the messages for the selected user
                loadMessages(userId);

                // Store the selected user ID in local storage
                localStorage.setItem('selectedUserId', userId);
            });
        });
    </script>
@endsection
