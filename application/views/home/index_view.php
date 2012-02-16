<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php     	$this->load->view('header/blueprint_css.php');  ?>
</head>

<html>

<body>


<div >
	
	<div  class='container '  >
	
		<div   class=' span-12'   >
			
				SPORTCARDLOGO HERE
	
		</div>
	
	<div    class=' span-12 last'  >

	  <ul id="header-menu">
<!--	
	    <li><a href="/" title="Online invoicing and time tracking">Home</a></li>
	    <li><a href="/tour" title="Learn more about our invoicing product">Tour</a></li>
	    <li><a href="<?php  echo base_url()   ?>index.php/home/register">Pricing &amp; Signup</a></li>
	    
	    -->
	    
	    <li><a href="<?php  echo base_url()   ?>index.php/home/login">Log In</a></li>
	  </ul>	
	  
	  
	</div>
	
	
	</div>	
</div>

<div  class='container'      style='border:1px solid gray;height:400px'    >
Main Body
</div>

			
</body>
</html>

<script type="text/javascript" language="Javascript" src = "<?php echo  base_url();   ?>js/jquery.js"></script>
<script type="text/javascript" language="Javascript">
	
	$(document).ready(function() {
	
		  Cufon.replace('.cufon', {
				color: '-linear-gradient(#999, 0.45=#666, 0.45=#555, #999)'
			});
  });
    

</script>

<?php  
$this->load->view('fonts/cufon.php');
?>

<script type="text/javascript" language="Javascript">
<?php  echo $font[0]->code;   ?>	
</script>