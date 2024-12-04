// Get the URL query string
const queryString = window.location.search;

// Create a URLSearchParams object from the query string
const params = new URLSearchParams(queryString);

// Get the value of the 'user_id' parameter
const employee_id = $('#employee_id').val();
const user = $('#user_name').val();
//
// socket = new WebSocket("ws://194.110.54.202:1995?user_id=" + employee_id);
// socket.onopen = (event) => {
// };
//
// socket.onclose = (e) => {
//     console.log('socket closed try again')
// }
//
// socket.onmessage = (event) => {
//     data = JSON.parse(event.data)
//     console.log(data);
//     if(data['type'] === 'message') {
//         date = Date.parse(data['created_at']);
//         date = moment(date).add(-6, 'hours').format('YYYY-MM-DD HH:mm:ss')
//         if(data['user_id'] === employee_id) {
//
//         }
//         message_html = data['user_id'] ? `
//         <!-- Message. Default to the left -->
//         <div class="direct-chat-msg">
//             <div class="direct-chat-infos clearfix">
//                 <span class="direct-chat-name float-left">${data['name']}</span>
//                 <span class="direct-chat-timestamp float-right">${date}</span>
//             </div>
//
//             <!-- /.direct-chat-img -->
//             <div class="direct-chat-text">
//                 ${data['text']}
//             </div>
//             <!-- /.direct-chat-text -->
//         </div>
//         `
//             :
//             `
//         <div class="direct-chat-msg right">
//             <div class="right">
//                 <div class="direct-chat-infos clearfix">
//                     <span class="direct-chat-name float-right">${data['name']}</span>
//                     <span class="direct-chat-timestamp float-left">${date}</span>
//                 </div>
//
//                 <!-- /.direct-chat-img -->
//                 <div class="direct-chat-text">
//                     ${data['text']}
//                 </div>
//             </div>
//             <!-- /.direct-chat-text -->
//         </div>
// `
//         $('#direct-chat-messages').append(message_html);
//
//     }
// };





socket = new WebSocket("ws://185.100.67.120:1995?user_id=" + employee_id);

// setInterval(function(){
//     var object = {"message":"ARandonMessage"};
//     object = JSON.stringify(object);
//     socket.send(object);
// }


socket.onopen = (event) => {
    // Connection opened successfully
};
//
// socket.onclose = (e) => {
//     console.log('Socket closed. Trying to reconnect...');
//     // Attempt to reconnect after a short delay
//     setTimeout(() => {
//         connectWebSocket(employee_id);
//     }, 3000); // 3 seconds delay before attempting to reconnect
// };

socket.onmessage = (event) => {
    data = JSON.parse(event.data);
    console.log(data);
    if(data['action'] === 'message') {
        date = Date.parse(data['created_at']);
        date = moment(date).add(6, 'hours').format('YYYY-MM-DD HH:mm:ss')
        if(data['user_id'] === employee_id) {
        }
        message_html = data['user_id'] ? `
        <!-- Message. Default to the left -->
               <div class="direct-chat-msg right">
            <div class="right">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-right">${user}</span>
                    <span class="direct-chat-timestamp float-left">${date}</span>
                </div>

                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    ${data['text']}
                </div>
            </div>
            <!-- /.direct-chat-text -->
        </div>

        `
            :
            `
 <div class="direct-chat-msg">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">${data['name']}</span>
                <span class="direct-chat-timestamp float-right">${date}</span>
            </div>

            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                ${data['text']}
            </div>
            <!-- /.direct-chat-text -->
        </div>
`
        $('#direct-chat-messages').append(message_html);

    }
};


// // Call the function to connect initially
// connectWebSocket(employee_id);








function send_message(user_id) {
// console.log(user_id)
    input = document.getElementById('chat_input')
    input_message = input.value
    if(input_message !== "" && input_message !== null) {
        input.value = '';
        message = {
            "action":"message",
            "to":user_id,
            "text":input_message
        }
        socket.send(JSON.stringify(message));

    }
}
