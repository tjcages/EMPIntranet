<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
  <?php endif; ?>

    <h1>Login</h1>
 
  <form action="login.php" method="POST">
    
    <input type="text" placeholder="Enter your email" name="email">
    <input type="password" placeholder="and password" name="password">

    <input type="submit">

  </form>
      <input type="checkbox" checked="checked"> Remember me

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>

</div>


<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>