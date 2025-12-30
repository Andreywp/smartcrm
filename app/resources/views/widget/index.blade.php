<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Feedback Widget</title>
    @vite(['resources/css/app.css', 'resources/js/widget.js'])
</head>
<body class="bg-gray-50 p-4">

<div class="max-w-md mx-auto bg-white p-4 border rounded">
    <h1 class="text-lg font-semibold mb-4">Contact us</h1>

    <form id="widget-form" class="space-y-3">
        <div>
            <label class="block text-sm">Name</label>
            <input type="text" name="name" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block text-sm">Phone</label>
            <input type="text" name="phone" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block text-sm">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block text-sm">Subject</label>
            <input type="text" name="subject" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block text-sm">Message</label>
            <textarea name="message" rows="4" class="w-full border p-2 rounded"></textarea>
        </div>

        <input
            type="file"
            name="files[]"
            multiple
            class="w-full text-sm"
        >

        <button
            type="submit"
            class="w-full bg-gray-800 text-white py-2 rounded"
        >
            Send
        </button>

        <div id="form-message" class="text-sm mt-2"></div>
    </form>
</div>

</body>
</html>

