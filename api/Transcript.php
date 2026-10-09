<?php

declare(strict_types=1);

session_start();

$receipt = $_SESSION['email_receipt'] ?? null;
unset($_SESSION['email_receipt']);

$hasReceipt = is_array($receipt);
$name = htmlspecialchars((string) ($receipt['name'] ?? ''), ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars((string) ($receipt['email'] ?? ''), ENT_QUOTES, 'UTF-8');
$recipient = htmlspecialchars((string) ($receipt['recipient'] ?? ''), ENT_QUOTES, 'UTF-8');
$subject = htmlspecialchars((string) ($receipt['subject'] ?? ''), ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $hasReceipt ? 'Email Sent' : 'Email Receipt' ?> | Olen's Portfolio</title>
    <link rel="stylesheet" href="Details/portemon.css?v=20261006-2">
</head>
<body class="portfoliopage receipt-page">
    <main class="screen receipt-screen">
        <section class="receipt-card" aria-labelledby="receipt-title">
            <div class="receipt-mascot">
                <img src="Details/EmpoleonMove.gif" alt="Empoleon, your message-sending mascot">
            </div>

            <div class="receipt-copy">
                <?php if ($hasReceipt): ?>
                    <div class="receipt-status" role="status">
                        <span class="receipt-check" aria-hidden="true">&#10003;</span>
                        Email sent successfully
                    </div>
                    <h1 id="receipt-title">Empoleo is Happy</h1>
                    <p class="receipt-intro">Your email has been healed!</p>

                    <dl class="receipt-details">
                        <div class="receipt-row">
                            <dt>From</dt>
                            <dd><?= $name ?> &lt;<?= $email ?>&gt;</dd>
                        </div>
                        <div class="receipt-row">
                            <dt>To</dt>
                            <dd><?= $recipient ?></dd>
                        </div>
                        <div class="receipt-row">
                            <dt>Subject</dt>
                            <dd><?= $subject ?></dd>
                        </div>
                    </dl>
                <?php else: ?>
                    <div class="receipt-status receipt-status-pending">No email receipt found</div>
                    <h1 id="receipt-title">Nothing has been sent yet</h1>
                    <p class="receipt-intro">Send a message using the contact form to get your receipt here.</p>
                <?php endif; ?>

                <a class="receipt-back-link" href="Portfolen.php">Back to the portfolio</a>
            </div>
        </section>
    </main>
</body>
</html>