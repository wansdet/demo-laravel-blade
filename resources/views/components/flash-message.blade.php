<!-- Controller response -->
@if(session()->has('message'))
    <div class="fixed bottom-0 left-0 m-4 py-2 px-4 bg-green-700 text-white rounded shadow"
         x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 3000)"
         x-show="show">
        {{ session('message') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="fixed bottom-0 left-0 m-4 py-2 px-4 bg-red-700 text-white rounded shadow"
         x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 3000)"
         x-show="show">
        {{ session('error') }}
    </div>
@endif

<!-- API response -->
<div id="flash-messages"></div>
<script>
    function showFlashMessage(message, type) {
        // Create a new message element
        const messageElement = document.createElement('div');
        messageElement.classList.add('fixed', 'bottom-0', 'left-0', 'm-4', 'py-2', 'px-4', 'rounded', 'shadow');

        // Set the background color based on the message type (success or error)
        if (type === 'success') {
            messageElement.classList.add('bg-green-700', 'text-white');
        } else if (type === 'error') {
            messageElement.classList.add('bg-red-700', 'text-white');
        }

        // Add the message text
        messageElement.innerText = message;

        // Append the message element to the container
        const flashMessagesContainer = document.getElementById('flash-messages');
        flashMessagesContainer.appendChild(messageElement);

        // Automatically remove the message after 3 seconds (adjust the timeout as needed)
        setTimeout(() => {
            flashMessagesContainer.removeChild(messageElement);
        }, 3000);
    }
</script>
