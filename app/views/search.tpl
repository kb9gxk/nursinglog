            <div class="h1 cover-heading" id="Stitle">Search Log</div>
            <div class="table-responsive">
            	Please select the classification of the event:<br/>
      <select name="category" class="form-control center" style="width:255px;" onchange="loadlogsearch(this)">
      [::type::]
       </select><br/>
            	<div id="myDiv"></div>
            </div>


          <script>$(document).ready(function(){loadlogsearch(0);});</script>