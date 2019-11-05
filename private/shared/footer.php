
<!-- ---- ------ ----- ----Sticky Footer-------- ---- ----- -->

  <footer class="sticky-footer">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        &copy; <?php echo date('Y'); ?> Watermill Garden Emporium
      </div>
    </div>
  </footer>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo url_for('/logout.php'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <SCRIPT SRC="GULPFILE/JQUERY/JQUERY.MIN.JS"></SCRIPT>
  <SCRIPT SRC="GULPFILE/BOOTSTRAP/JS/BOOTSTRAP.BUNDLE.MIN.JS"></SCRIPT>

  <!--  Core plugin JavaScript--> 
  <script src="gulpfile/jquery-easing/jquery.easing.min.js"></script>

  <!-- <script src="../public/gulpfile/bootstrap/js/bootstrap.min.js"></script> -->
  <!-- custom scripts for all pages -->
  <script src="js/admin.min.js"></script>
  
</body>
</html>

<?php
    db_disconnect($db);
    ?>
