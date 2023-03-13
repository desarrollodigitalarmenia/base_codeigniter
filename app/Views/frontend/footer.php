


    <!-- Go to Top Link -->
    <a href="#" class="back-to-top">
      <i class="lni-chevron-up"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader">
      <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/jquery-min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/popper.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/bootstrap.min.js"></script>

    <script src="<?= site_url() ?>app/FrontEnd/assets/js/jquery.counterup.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/waypoints.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/wow.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/owl.carousel.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/jquery.slicknav.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/main.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/form-validator.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/contact-form-script.min.js"></script>
    <script src="<?= site_url() ?>app/FrontEnd/assets/js/summernote.js"></script>

    
    <script>
      function getCities(){
        const $select = $("#city");
        
        $.ajax({
          url: "findcity",
          method: "post",
          dataType: 'json',
          data: $("form").serialize(),
          error: function (f){
            alert("Fail");
          },
          success: function (data){
            //alert(data);
            if(data!='[]'){
              $select.empty();
              $.each(data, function(i, item) {
                //alert(data[i].name_short);
                $select.append($("<option>", {
                  value: data[i].id,
                  text: data[i].name
                }));
              });
              
            }
          }
        });
      }
    </script>
      
  </body>
</html>