<!DOCTYPE html>
<html>
   <head>
      <title>FileUpload</title>
      <script>
         //function to disable button, not used
         function dis() {
         document.getElementById("upload").disabled = true;
         }
         //function to enable button after pressing the fileupload button, it enables the submit button
         function en(){
         document.getElementById("upload").disabled = false;
         }
      </script>
      <style type="text/css">
         div { color: #444;
         text-shadow: 2px 2px 2px #1C6EA4;
         font-family: Verdana, Geneva, sans-serif;
         font-size: 12px;
         letter-spacing: 2px;
         word-spacing: 2px;
         color: #000000;
         font-weight: normal;
         }
      </style>
   </head>
   <body>
      <div align="center">
         <form enctype="multipart/form-data" action="uploadFile.php" method="POST">
            <table>
               <tr>
                  <td width="600px">1.<input type="file" name="uploaded_file" onclick="en();"><br /></td>
               </tr>
               <tr>
                  <td> 2.<input type="submit" value="Upload" name="upload" id="upload" disabled></td>
               </tr>
            </table>
         </form>
      </div>
  
<?PHP
//check if there is a file chosen
  if(!empty($_FILES['uploaded_file']))
  {

//check if the submit button was pushed
	if (isset($_POST['upload']))
	 {

//create path variable
     $path = "";

//get full path
     $path = $path . basename( $_FILES['uploaded_file']['name']);

//get filepath 
     $path1 = getcwd();

//if we have succesfully moved the uploaded file from temp to current dir
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {

//write name and path in green  
      echo "<br><div align='center'><table>
               <tr><td align='left' width='600px'>The file <font color='green'>".  basename( $_FILES['uploaded_file']['name'])."</font> has been uploaded to <font color='green'>". $path1."</font></td></tr></table></div>";
    } 
	 
//No file was chosen, ofcourse you can easily click the first button to enable the second and cancel the file chosing and click upload but what good is that
	else
		{
         echo "<br><div align='center'>Nothing to upload, choose a file</div>";  
		 }
	}
  }
?>
<br><div align='center'>
<table>
      <tr><td align="left"><hr><br><font color="red">Filelisting </font><a href="<?php echo $_SERVER["REQUEST_URI"];?>">Refresh</a><br><br><hr>
 </td></tr>         
<?php
//show simple filelisting
$files = glob("./*");
foreach ($files as $file) {
	$file = basename($file);

//it means we have a file or dir
    if ($file and $file[0] == "_") {
        continue;
    }
	printf("<tr><td align='left' width='600px'><a href='%s'>%s</a><br></td></tr>", $file, $file);
}
?>
</table>
</div>
 </body>
</html>