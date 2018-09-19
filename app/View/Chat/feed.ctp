  <div class="tittle">
    <h1>Simple Chat System</h1>
  </div>
  <div class = "container">
    <form  id="form_cont" method="post" enctype="multipart/form-data">
      <div class="form-group" style="margin-bottom: 0px;">
        <div class="row">
          <div class="col-xs-11">
        <label class="sr-only">Name:</label>
        <input type="text" class="form-control" placeholder="Your Name Here" name="name" required value="<?php if(isset($edit_item['Chat']['name'])) {echo $edit_item['Chat']['name'];} else {echo $name;}?>">
      </div>
      <div class="btn-logout">
        <a type="button" class="btn btn-danger" href="logout" >Log out</a></div>
</div>
        </div><br>
      <div class="form-group" style="margin-bottom: 0px; ">
        <label class="sr-only">Message:</label>
        <textarea  class="form-control" rows="3" placeholder="Type your message here ....." name="message"><?php echo $edit_item['Chat']['message'] ?></textarea>
      </div>
      <br>
      <div class="form-group" id="button_submit">
        <input type="submit" id="submit" class="hide">
        <label for="submit" id="submit1"><?php if($_GET==NULL) {echo "SEND";}else{echo "EDIT";} ?></label>
        <input type="file" id="upload-button" name="fileupload"  id="file" class="hide">
        <label for="file" id="browser1">Browser</label>
        <span id="filename"><?php echo $edit_item['Chat']['file_name'];?></span>
      </div>

    </form>
    <h3 style="font-family:cursive">Chat Messages</h3>
    <div class = "chatbox">

      <?php 
        foreach($text_list as $value){        
          echo "<div class=\"message\">";
          echo "<h1><p class=\"name\">";
          foreach ($user_list as $user) {
            if( $value['Chat']['user_id'] === $user['users']['id']) echo $user['users']['name'];
          }
          echo "</p></h1>";
            echo "<div class=\"row\">";
              echo "<div class=\"col-xs-11\">";
                echo "<p class=\"content\">";
                  if($value['Chat']['type']==1){
                    echo $value['Chat']['message'];
                  }
                  else if ($value['Chat']['type']==2){
                   ?>
                    <img id="myImg" class="images" alt="<?php echo getcwd();?>" src="../img/upload/<?php echo $value['Chat']['file_name'] ?>" onclick="bigger_image(this)">
                    <div id="myModal" class="modal-image">
                      <span class="close-modal">&times;</span>
                      <img class="modal-image-content" id="img01">
                    </div>
                   <?php
                  }
                echo "</p></div>";
                if($user_id === $value['Chat']['user_id']) {
                echo "<div class=\"col-xs-1\">";
                  echo "<img id=\"edit-icon\" src=\"../img/quanedit.png\" onclick=\"location.href='feed?id=".$value['Chat']['id']."';\">";
                  echo "<img id=\"delete-icon\" class=\"delete1\" src=\"../img/quandelete.png\" onclick=\"location.href='delete/".$value['Chat']['id']."';\">";
                echo "</div>"; }
            echo "</div>";
          echo "<span class=\"time\">";
          if($value['Chat']['update_at']==NULL){
            echo $value['Chat']['create_at'];
          }else {
            echo $value['Chat']['update_at'];
          }
          echo "</span></div>";
        }
      ?>
    </div>
  </div>
  <script type="text/javascript">
      var modal = document.getElementById('myModal');
      var img = document.getElementById('myImg');
      var modalImg = document.getElementById("img01");
      function bigger_image(img){
          modal.style.display = "block";
          modalImg.src = img.src;
      }
      var span = document.getElementsByClassName("close-modal")[0];
      span.onclick = function() { 
        modal.style.display = "none";
      }
  </script>
  <script type="text/javascript">
    $("#browser1").click(function(){
        $("#upload-button").click();
    });
    $("#upload-button").on('change',function(){
      $("#filename").text($("#upload-button").val().replace(/C:\\fakepath\\/i,''));
    });
  </script>


