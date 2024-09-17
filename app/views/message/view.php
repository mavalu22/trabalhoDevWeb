<?php $title = 'View Message'; ?>
<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <h1>Message Details</h1>

    <p><strong>From:</strong> <?php echo htmlspecialchars($message['sender']); ?></p>
    <p><strong>Subject:</strong> <?php echo htmlspecialchars($message['subject']); ?></p>
    <p><strong>Date:</strong> <?php echo htmlspecialchars($message['send_datetime']); ?></p>
    <p><strong>Message:</strong></p>
    <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>

    <a href="index.php?action=home">Back to Inbox</a>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
