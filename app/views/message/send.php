<?php $title = 'Send Message'; ?>
<?php include __DIR__ . '/../header.php'; ?>
<div class="container">
    <h1>Send a Message</h1>
    <form action="index.php?action=sendMessage" method="post" id="messageForm">
        <label for="recipient">Recipient:</label>
        <input type="text" id="recipient" name="recipient" autocomplete="off">
        <div id="recipientList"></div>


        <label for="recipients">Recipients:</label>
        <div id="selectedRecipients"></div> 

        <input type="hidden" name="recipients" id="recipientsInput" required>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

<?php include __DIR__ . '/../footer.php'; ?>

<script src="/public/js/autocomplete.js"></script>
