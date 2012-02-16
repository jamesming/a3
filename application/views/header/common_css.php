<style>

body {
background:#F8F6F6;
}
input{
border: 0
}
a{
	text-decoration:none;
	cursor:pointer;
	color: inherit;
}
a:hover{
	color: inherit;
}
.container_inside{
padding:0px 5px;
}
.float_left{
float:left;	
}
.float_right{
float:right;	
}
.clearfix{
clear:both;	
}
	.rounded_bg .top {
		background:url(<?php  echo base_url()   ?>images/rounded_bg_transparent_left.gif) no-repeat 0 0;
		padding-left:5px;
	}

		.rounded_bg .top .sub_top {
			background:url(<?php  echo base_url()   ?>images/rounded_bg_transparent.gif) no-repeat right 0;
			height:8px;
		}

	.rounded_bg .bottom {
		background:url(<?php  echo base_url()   ?>images/rounded_bg_transparent_left.gif) no-repeat 0 -12px;
		padding-left:5px;
	}

		.rounded_bg .bottom .sub_bottom {
			background:url(<?php  echo base_url()   ?>images/rounded_bg_transparent.gif) no-repeat right -12px;
			height:8px;
		}

	.rounded_bg .middle {
		border-right:1px solid #cbcaca;
		border-left:1px solid #cbcaca;
		background:#ffffff;
		padding:0 1px;
	}
.margin_left{
	margin-left: 9px;
}
.margin_right{
	margin-right: 9px;
}
.margin_top{
	margin-top: 12px;
}
.one_quarter_column {
    width: 193px;
}
.one_third_column {
    width: 307px;
}
.two_third_column {
    width: 623px;
}
.three_quarters_column {
    width: 751px;
}
.centered_width{
		width: 850px;	
}
.full_width{
		width: 940px;	
}
.margin_for_centered_width{
    margin-left: 40px;
    margin-top: 33px;	
}

.header_style{
    color: darkgray;
    font-size: 19px;
    font-weight: bold;
    height: 28px;
    padding-left: 70px;
    padding-top: 12px
}


.input_label_header{
	color:darkgray;
	font-weight:bold;
}
.input_background{
	height:25px;	
	background-image:url(<?php  echo base_url()   ?>images/input_backgrounds2.png);	
	background-repeat:no-repeat;	
	padding:6px 5px 0px 5px;
}
		.input_background input{
			border:0px;
			background:transparent;
			font-size:13px;
			margin:0px 0px 0px 0px;
			outline: none;
			<?php if( $this->tools->browserIsExplorer()){?>
				margin:-1px 0px 0px 0px;	
			<?php } ?>
			<?php if( $this->tools->browserIsSafari()){?>
				font-size:12px;	
			<?php } ?>		
			
		}

.input_wrapper{
margin:10px 0px;
 /*background:red;	*/
}

.input_300 {
    background-position: left 0;
    width:300px;
}
		.input_300 input{
			width:287px;
		}
.input_250 {
    background-position: left -33px;
    width:250px;
}
		.input_250 input{
			width:237px;
		}

.input_200 {
    background-position: left -66px;
    width:200px;
}
		.input_200 input{
			width:187px;
		}

.input_150 {
    background-position: left -100px;
    width:150px;
}
		.input_150 input{
			width:137px;
		}
		
.input_150_select {
    background-position: left -203px;
    width:150px;
}		

.input_100 {
    background-position: left -133px;
    width:100px;
}
		.input_100 input{
			width:87px;
		}

		
		
.input_50 {
    background-position: left -166px;
    width: 42px
}
		.input_50 input{
			width:39px;
		}

.input_50_select {
    background-position: left -238px;
    width: 42px
}
		

.loading{
  background-image: url(<?php echo base_url()    ?>images/ajax-loader.gif);
  background-position: 24px 4px;
  background-repeat: no-repeat;
  height: 22px;
  width: 52px;	
  text-align:center;
}


.submit_button{
	background-image: url(<?php echo base_url()    ?>images/sm_button.png);
  background-position: 0 0;
  background-repeat: no-repeat;
  height: 23px;
  width: 60px;
  color: white;
  padding: 5px 0 0 15px;
  cursor:pointer;
  font-weight:bold;
}

.error_message{
font-size:10px;
color:red;
}


.or_redirect{
font-size:12px;	
font-weight:normal;
}


				

#working_area_wrapper, .working_area_wrapper{
	margin:0px 0px 0px 20px;
	padding:10px 0px 10px 0px;
	clear:both;
}

.label_header{
	background-image:url(<?php echo base_url()    ?>images/dotted_line.png);
  background-repeat:repeat-x;
	background-position: 0 38px;
	font-size:20px;
	padding:10px 0px 3px 0px;
	color:gray;
	width:auto;
	display:inline;
    padding: 10px 0 14px;
}
.label_description{
	font-size:14px;
	padding:20px 20px 15px 0px;
	color:gray;
}


.table_middle_left_section{
	border-left:1px solid gray;
	border-top:1px solid gray;	
	width:706px;
}
		.table_middle_left_section tr.first_row td{
			font-weight:bold;
			background:#D8D8D8;
		}
		.table_middle_left_section td{
			width:25%;
			border-right:1px solid gray;
			border-bottom:1px solid gray;
			padding:0px 5px;
		}	
</style>






