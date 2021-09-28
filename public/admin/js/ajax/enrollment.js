<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


	$(document).ready(function(){

    $(document).on('change', '.course', function(){
      // console.log("Changed");

      var cid = $(this).val();
      // console.log(id);
      var parentt = $(this).parent();
      var opt = " ";
      var optCost;
      $.ajax({
        type: 'GET',
        url: '{!!route("loadPackagesByCourse")!!}',
        data:{'id': cid},
        success: function(data){
          console.log('success');
          console.log(data.length);
          console.log(parentt);
          opt += '<option selected disabled>Select your Package</option>'
          for(var i=0; i<data.length; i++)
          {
            opt += '<option value="'+data[i].id+'">'+data[i].p_name+'</option>'
          }

          $(".coursepackage").html(" ");
          $(".coursepackage").append(opt);
        },
        error: function(){
          console.log('error');
        }
      });
    });

	});
