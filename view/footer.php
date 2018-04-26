      <hr>
      <footer>
          <?php
              if (isset($_SESSION)){
                  echo "<div class='alert-danger'>".$_SESSION['error']."</div>";
              }
          ?>
        <p>&copy; Copyright !gibb</p>
      </footer>
    </div>
    <script src="<?=$GLOBALS['appurl']?>/js/jquery.min.js"></script>
  </body>
</html>
