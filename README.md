# whatsappApiClone
Task Assigment Whatsapp API 
PHP Laravel Assignment (Make WhatsApp API server (whatsapp api clone):
		
	To develop a WhatsApp-like chat API server using Laravel 8, PHP 8.0, and WebSockets, follow these steps to build and document essential chat functionalities. Here’s a structured approach:
1. Setting up the Environment
•	Install Laravel: Install a Laravel 8 project.
•	Install WebSocket Server: Use a WebSocket library like beyondcode/laravel-websockets to manage real-time messaging.
•	Database: Configure your RDBMS (MySQL, PostgreSQL, etc.) to set up tables for storing chatrooms, messages, and users.
2. Database Schema
Tables:
•	Users: id, name, email, created_at, updated_at
•	Chatrooms: id, name, max_members, created_at, updated_at
•	UserChatroom (pivot table for many-to-many relationship): user_id, chatroom_id
•	Messages: id, user_id, chatroom_id, message, attachment_path, created_at
3. API Development
1.	Create Chatroom
o	Endpoint: POST /api/chatrooms
o	Action: Create a new chatroom with a maximum member limit.
o	Body: { "name": "string", "max_members": integer }
o	Constraints: Ensure chatroom names are unique.
2.	List Chatrooms
o	Endpoint: GET /api/chatrooms
o	Action: Retrieve a list of available chatrooms.
o	Response: Return all chatrooms with current and max member counts.
3.	Enter Chatroom
o	Endpoint: POST /api/chatrooms/{id}/enter
o	Action: Add the user to a chatroom if it has not reached the max member limit.
o	Logic: Verify that the user isn't already a member and that the max member limit hasn’t been reached.
4.	Leave Chatroom
o	Endpoint: POST /api/chatrooms/{id}/leave
o	Action: Remove the user from the chatroom.
o	Logic: Check if the user is a member before removing them.
5.	Send Message
o	Endpoint: POST /api/chatrooms/{id}/messages
o	Action: Send a text or attachment message.
o	Body: { "message": "string", "attachment": "file" }
o	Storage: Store attachments in a root/picture or root/video directory based on the file type.
6.	List Messages
o	Endpoint: GET /api/chatrooms/{id}/messages
o	Action: Retrieve all messages for a chatroom, paginated.
4. WebSocket Integration
•	WebSocket Channels: Each chatroom will have its WebSocket channel (e.g., chatroom.{id}).
•	Event Broadcasting: Use Laravel’s broadcasting capabilities for real-time updates when a new message is sent.
•	Presence Channels: Track users entering and leaving chatrooms to update members in real-time.
5. API Documentation
•	Use Swagger or Postman collections to document endpoints, parameters, responses, and possible error codes. Provide a guide on how to use each API.
6. Deployment
•	Deploy the Laravel API server on a hosting service like DigitalOcean, AWS, or Laravel Vapor.
•	Set up a WebSocket server to ensure real-time messaging functionality is live.
This setup ensures a modular, scalable, and maintainable structure by separating user, chatroom, and message management responsibilities. Implementing WebSockets for real-time communication enhances the chat experience, similar to WhatsApp. Let me know if you need help with code snippets for specific parts!
7.Testing:
	To test the "Create Chatroom" API endpoint in Postman for your Laravel application, follow these steps:
7.1. Start the Local Server
If you haven't already, start your Laravel server by running:
bash
Copy code
php artisan serve
This will usually start the server at http://127.0.0.1:8000.
7.2. Open Postman and Set Up the Request
1.	Open Postman and create a new POST request.
2.	Set the Request URL to:
arduino
Copy code
http://127.0.0.1:8000/api/chatrooms
Make sure this URL matches your local server address, including the api prefix if you defined your routes in routes/api.php.
3.	Set the Request Method to POST.
4.	Add the Headers:
o	If your API requires authentication, add the necessary token in the Headers tab. For example:
	Authorization: Bearer YOUR_TOKEN_HERE (replace YOUR_TOKEN_HERE with an actual token).
o	Set the Content-Type to application/json:
plaintext
Copy code
Content-Type: application/json
5.	Add the Body:
o	Go to the Body tab.
o	Select raw and set the format to JSON.
o	Add the following JSON data, replacing the values as needed:
json
Copy code
{
  "name": "General Chat",
  "max_members": 10
}
6.	Send the Request:
o	Click the Send button in Postman.
o	You should receive a response indicating whether the chatroom was created successfully.
7.3. Example Response
If the request is successful, you should receive a 201 Created status with a response similar to this:
json
Copy code
{
  "chatroom": {
    "id": 1,
    "name": "General Chat",
    "max_members": 10,
    "created_at": "2024-11-05T10:00:00.000000Z",
    "updated_at": "2024-11-05T10:00:00.000000Z"
  },
  "message": "Chatroom created successfully."
}
If there’s an error (such as validation errors or missing fields), Laravel will return an appropriate response with a 400 or 422 status, and a message indicating what went wrong.
Let me know if you encounter any issues with this setup!


