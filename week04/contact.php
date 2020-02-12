<?php
$pageTitle = "Contact Us";

// run the header.php code as if it were here in this index.php file
include "includes/header.php";

?>

<section>
    <h2 class="noDisplay">About Us</h2>
    <article class="left_article">
      <h3>How can we help?</h3>
        <?php   // use alternative IF syntax (with colons instead of braces)
                // when working with large blocks of HTML
        if(!isset($_POST['send'])): ?>
        <form method="post">
            <p>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email">
            </p>
            <p>
                <label for="subject">Subject:</label><br>
                <input type="text" name="subject" id="email">
            </p>
            <p>
                <label for="message">Message:</label><br>
                <textarea type="message" id="message"></textarea>
            </p>
            <p>
                <input type="submit" ame="send" value="Send">
            </p>
        </form>
        <?php else: ?>
        <p>Thank you for your message.</p>
        <?php endif; ?>

     </article>
    <aside class="right_article"><img src="images/placeholder.jpg" alt="" width="400" height="200" class="placeholder"/> </aside>
  </section>

<?php
include "includes/footer.php";
?>
