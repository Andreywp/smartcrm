document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('widget-form');
    const messageBox = document.getElementById('form-message');

    if (!form) {
        return;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        messageBox.textContent = '';
        messageBox.className = 'text-sm mt-2';

        const formData = new FormData(form);

        try {
            const response = await fetch('/api/tickets', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const data = await response.json();

            if (!response.ok) {
                messageBox.textContent = data.message || 'Validation error';
                messageBox.classList.add('text-red-600');
                return;
            }

            messageBox.textContent = 'Your message has been sent';
            messageBox.classList.add('text-green-600');

            form.reset();
        } catch (error) {
            messageBox.textContent = 'Server error. Please try later.';
            messageBox.classList.add('text-red-600');
        }
    });
});
