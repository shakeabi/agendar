<footer>
    <div class="row">
        <div class="col-lg-12">
            Made with &#10084; by <a href="https://github.com/shakeabi">Abishake</a>
        </div>

    </div>
</footer>

</div>

<script type="text/javascript">//Make sure this works!!

  window.onload = function(){
    setInterval("load();",500);
  }
  function load(url, element)
  {   url = 'refresher.php';
      element = document.getElementById('torefresh');
      req = new XMLHttpRequest();
      req.open("GET", url, false);
      req.send(null);

      element.innerHTML = req.responseText;
      console.log("refreshing");
  }

</script>
</body>

</html>
