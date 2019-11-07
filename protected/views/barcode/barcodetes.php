<html>
      <head>
      <title>PHP Barcode Generator Script</title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <script src='jquery.js'></script>
      </head>
      <body>
      <div class='resp_code'>
      <center><b>Barcode Generator Script </b></center><br><br>
     
      <script type='text/javascript'>
      function chk(){
      var sds = document.getElementById("dum");
      if(sds == null){
       alert("You are using a free package.\n You are not allowed to remove the tag.\n");
      }
      var sdss = document.getElementById("dumdiv");
      if(sdss == null){
       alert("You are using a free package.\n You are not allowed to remove the tag.\n");
       document.getElementById("content").style.visibility="hidden";
      }
      }
      window.onload=chk;
      function get_barcode()
      {
       var str = document.getElementById('txtstr').value;
      var siz = document.getElementById('txtsize').value;
      var orientation = $("#orientation option:selected" ).text();
      var codetype = $("#codetype option:selected" ).text();
      if (str=='' || siz=='') {
      alert("Enter values properly!");
      }
      else if (codetype=='Codabar') {                 
       var regex = /^[0-9?=.$\/+-:]+$/;
       if (!regex.test($("#txtstr").val())){
       alert("Codabar Accepts Only 0-9 and .$/+-:");
       document.getElementById('txtstr').value='';
       }
       else{
       $.ajax({
          type: "POST",
          url: "barcode.php",
          data:{str:str,size:siz,orientation:orientation,codetype:codetype},
          success: function(data){
         // alert(data);
         if (data) {
         $('#maindiv').html(data);
         //window.localtion.reload();
         document.getElementById('txtstr').value='';
         document.getElementById('txtsize').value='';
         
         }            
          }
         })
       }
      }  
      else
      {
           $('.load').show();
           $("#btn").hide();
        $.ajax({
          type: "POST",
          url: "barcode.php",
          data:{str:str,size:siz,orientation:orientation,codetype:codetype},
          success: function(data){
         // alert(data);
         if (data) {
         $('#maindiv').html(data);
         //window.localtion.reload();
         document.getElementById('txtstr').value='';
         document.getElementById('txtsize').value='';
         
         }            
          },
          complete: function(){
           $('.load').hide();
           $("#btn").show();                  
           }
         })
      }   
      }
      function checnum(as)
      {
      var dd = as.value;
      if(dd.lastIndexOf(" ")>=0){dd = dd.replace(" ","");as.value = dd;
      }
      if(isNaN(dd))
      {
      dd = dd.substring(0,(dd.length-1));
      as.value = dd;
      }
      }
       function validateForm()
       {
      var str = document.getElementById('txtstr').value;
      var siz = document.getElementById('txtsize').value;
      if (str=='' || siz=='') {
      alert("Enter values properly!");
      return false;
      }
      else
      {
      return true;
      window.reload;
      }
      }
      </script>
     
      <div align='left' class='frms noborders' id='content'>
     
       <b>Enter String : </b><input type='text' name='string' maxlength='25' id='txtstr' autocomplete='off'><br>
       <b>Select Orientation : </b>
       <select name='orientation' id='orientation'>
      <option>Horizontal</option>
      <option>Vertical</option>
       </select>
       <b>Select CodeType: </b>
       <select name='codetype' id='codetype'>
      <option>Code128</option>
      <option>Code39</option>
      <option>Code25</option>
      <option>Codabar</option>
       </select><br>
       <b>Enter Size : </b><input type='text' name='size' maxlength='2' onkeyup=checnum(this) id='txtsize' autocomplete='off'>
       <div align='center'>
           <div class='load' style='display:none;'><img src='barcode-generator/loading.gif'></div>
           <input type='submit' value='Get Barcode' onclick='get_barcode()' id='btn'>
       </div><br>
     
      <div align='center' id='maindiv'></div>
       </div>
      <div  align='center' style="font-size: 10px;color: #dadada;" id="dumdiv">
      <a href="http://pemrogramanwebdinamis.blogspot.com/" id="dum" style="font-size: 10px;color: #dadada;text-decoration:none;color: #dadada;">&copy;PWD</a>
      </div>
      </div>    
      </body>
</html>