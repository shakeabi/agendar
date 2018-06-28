<footer>
    <div class="row">
        <div class="col-lg-12">
            Made with &#10084; by <a href="https://github.com/shakeabi">Abishake</a>
        </div>

    </div>
</footer>

</div>

<script type="text/javascript">//Make sure this works!!
  var currDate = "<?php echo $temparr[2]; ?>";
  currDate = parseInt(currDate, 10);
  var currMonth = "<?php echo $temparr[1]; ?>";
  currMonth = parseInt(currMonth, 10)-1;//coz were adding a month
  var currYear = "<?php echo $temparr[0]; ?>";
  currYear = parseInt(currYear, 10);
</script>
<script src="js/appointments.js"></script>

</body>

</html>
