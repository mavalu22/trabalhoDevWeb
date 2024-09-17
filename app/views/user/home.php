<?php $title = 'Home'; ?>
<?php include __DIR__ . '/../header.php'; ?>

<div class="container2">
    <h1>Inbox</h1>

    <div class="inbox-grid">
        <div class="inbox-header">
            <div class="inbox-header-item">From</div>
            <div class="inbox-header-item">Subject</div>
            <div class="inbox-header-item">Date</div>
            <div class="inbox-header-item">Status</div>
            <div class="inbox-header-item">Action</div>
        </div>
        <?php foreach ($messages as $message): ?>
            <div class="inbox-row" 
                onclick="window.location.href='index.php?action=viewMessage&id=<?php echo $message['id']; ?>';">
                <div class="inbox-column from">
                    <?php echo htmlspecialchars($message['sender']); ?>
                </div>
                <div class="inbox-column subject">
                    <?php echo htmlspecialchars($message['subject']); ?>
                </div>
                <div class="inbox-column date">
                    <?php echo htmlspecialchars($message['send_datetime']); ?>
                </div>
                <div class="inbox-column status" style="color: <?php echo $message['read_status'] == 0 ? 'yellow' : 'green'; ?>">
                    <?php echo $message['read_status'] == 0 ? 'Unread' : 'Read'; ?>
                </div>
            </div>
                <div class="inbox-column action">
                    <form action="index.php?action=deleteMessage" method="post" onsubmit="return confirm('Are you sure you want to delete this message?');">
                        <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                        <button class="delete-button">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
        <?php endforeach; ?>
    </div>

</div>
<?php include __DIR__ . '/../footer.php'; ?>
