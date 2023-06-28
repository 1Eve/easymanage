<?php

/*
 *  Template Name:chat template
 *
 */

?>
<?php get_header(); ?>
<div id="chat-bubble" onclick="toggleChatBox()">
  <span>Chat</span>
</div>

<div id="chat-box" style=display:none;">
  <div class="chat-header">
    <span>Chat Box</span>
    <button onclick="toggleChatBox()">Close</button>
  </div>
  <div class="chat-messages">
    <!-- Chat messages go here -->
  </div>
  <div class="chat-input">
    <input type="text" placeholder="Type your message..." />
    <button>Send</button>
  </div>
</div>

<script>
    function toggleChatBox() {
  var chatBox = document.getElementById("chat-box");
  if (chatBox.style.right === "-400px") {
    chatBox.style.right = "20px";
    chatBox.style.display = "block";
  } else {
    chatBox.style.right = "-400px";
  }
}
</script>