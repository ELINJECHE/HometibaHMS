<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">HomeTiba &copy; Affordable Treatment</div>
                            <div>
                                <a href="#">Services</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
  $(document).ready(function () {
    var dateToday = new Date();
    $("#datepicker").datepicker({
      minDate: dateToday,
      dateFormat: 'yy-mm-dd'
    });
    //intialize///
    $('#timepicker').timepicker({
      timeFormat: 'HH:mm',
      interval: 60,
      maxTime: '6:00pm',
      dynamic: false,
      dropdown: true,
      scrollbar: true
    });
    $(document).on('change', '#datepicker', function () {
      var date_now = new Date();
      var d = new Date(date_now + 'UTC');
      var n = d.getTime(); //miliseconds
      var thisyear = d.getFullYear();
      var thismonth = (d.getMonth() + 1);
      var thisday = d.getDate();
      //convert month
      if (thismonth >= 1 && thismonth < 10) {
        var mm = '0' + thismonth;
      } else {
        var mm = thismonth;
      }
      //convert day
      if (thisday >= 1 && thisday < 10) {
        var dd = '0' + thisday;
      } else {
        var dd = thisday;
      }
      var nowdate = thisyear + '-' + mm + '-' + dd;
      var pickdate = $('#datepicker').val();
      if (nowdate === pickdate) {
        var minBook = n + 720000;
        var minTime = msToTime(parseInt(minBook));
      } else {
        var minTime = '7:00am';
      }
      $('#timepicker').timepicker('option', 'minTime', minTime); //update options...
    });
    $("#datepicker").trigger("change") //on load of page call this

    function msToTime(duration) {
      var milliseconds = parseInt((duration % 1000) / 100),
        seconds = Math.floor((duration / 1000) % 60),
        minutes = Math.floor((duration / (1000 * 60)) % 60),
        hours = Math.floor((duration / (1000 * 60 * 60)) % 24);

      hours = (hours < 10) ? "0" + hours : hours;
      minutes = (minutes < 10) ? "0" + minutes : minutes;
      seconds = (seconds < 10) ? "0" + seconds : seconds;

      return hours + ":" + minutes;
    }
  })
</script>
    </body>
</html>
