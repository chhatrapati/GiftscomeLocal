<?php session_start();?>
<!DOCTYPE html>
<head>
	<title>About Us</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once('templates/common_css.php');?>

<style>

	@media
	  only screen 
    and (max-width: 760px), (min-device-width: 768px) 
    and (max-device-width: 1024px)  {

		table, thead, tbody, th, td, tr {
			display: block;
		}

		thead tr {
			position: absolute;
			top: -9999px;
			left: -9999px;
		}

    tr {
      margin: 0 0 1rem 0;
    }
      
    tr:nth-child(odd) {
      background: #ccc;
    }
    
		td {
		
			border: none;
			border-bottom: 1px solid #eee;
			position: relative;
			padding-left: 50%;
		}

		td:before {
			
			position: absolute;
			top: 0;
			left: 6px;
			width: 45%;
			padding-right: 10px;
			white-space: nowrap;
		}

	
		td:nth-of-type(1):before { content: "First Name"; }
		td:nth-of-type(2):before { content: "Last Name"; }
		td:nth-of-type(3):before { content: "Job Title"; }
		td:nth-of-type(4):before { content: "Favorite Color"; }
		td:nth-of-type(5):before { content: "Wars of Trek?"; }
		td:nth-of-type(6):before { content: "Secret Alias"; }
		td:nth-of-type(7):before { content: "Date of Birth"; }
		td:nth-of-type(8):before { content: "Dream Vacation City"; }
		td:nth-of-type(9):before { content: "GPA"; }
		td:nth-of-type(10):before { content: "Arbitrary Data"; }
	}
</style>
</head>
<body class="animsition" onLoad="start()">
<?php require_once('templates/header.php');?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/about_banner.png);">
	</section>
	<!-- content page -->
	<section class="bgwhite p-t-30 p-b-38" style="min-height:500px;">
		<div class="container">
			<div class="row">
		   <table role="table">
  <thead role="rowgroup">
    <tr role="row">
      <th role="columnheader">First Name</th>
      <th role="columnheader">Last Name</th>
      <th role="columnheader">Job Title</th>
      <th role="columnheader">Favorite Color</th>
      <th role="columnheader">Wars or Trek?</th>
      <th role="columnheader">Secret Alias</th>
      <th role="columnheader">Date of Birth</th>
      <th role="columnheader">Dream Vacation City</th>
      <th role="columnheader">GPA</th>
      <th role="columnheader">Arbitrary Data</th>
    </tr>
  </thead>
  <tbody role="rowgroup">
    <tr role="row">
      <td role="cell">James</td>
      <td role="cell">Matman</td>
      <td role="cell">Chief Sandwich Eater</td>
      <td role="cell">Lettuce Green</td>
      <td role="cell">Trek</td>
      <td role="cell">Digby Green</td>
      <td role="cell">January 13, 1979</td>
      <td role="cell">Gotham City</td>
      <td role="cell">3.1</td>
      <td role="cell">RBX-12</td>
    </tr>
    <tr role="row">
      <td role="cell">The</td>
      <td role="cell">Tick</td>
      <td role="cell">Crimefighter Sorta</td>
      <td role="cell">Blue</td>
      <td role="cell">Wars</td>
      <td role="cell">John Smith</td>
      <td role="cell">July 19, 1968</td>
      <td role="cell">Athens</td>
      <td role="cell">N/A</td>
      <td role="cell">Edlund, Ben (July 1996).</td>
    </tr>
    <tr role="row">
      <td role="cell">Jokey</td>
      <td role="cell">Smurf</td>
      <td role="cell">Giving Exploding Presents</td>
      <td role="cell">Smurflow</td>
      <td role="cell">Smurf</td>
      <td role="cell">Smurflane Smurfmutt</td>
      <td role="cell">Smurfuary Smurfteenth, 1945</td>
      <td role="cell">New Smurf City</td>
      <td role="cell">4.Smurf</td>
      <td role="cell">One</td>
    </tr>
    <tr role="row">
      <td role="cell">Cindy</td>
      <td role="cell">Beyler</td>
      <td role="cell">Sales Representative</td>
      <td role="cell">Red</td>
      <td role="cell">Wars</td>
      <td role="cell">Lori Quivey</td>
      <td role="cell">July 5, 1956</td>
      <td role="cell">Paris</td>
      <td role="cell">3.4</td>
      <td role="cell">3451</td>
    </tr>
    <tr role="row">
      <td role="cell">Captain</td>
      <td role="cell">Cool</td>
      <td role="cell">Tree Crusher</td>
      <td role="cell">Blue</td>
      <td role="cell">Wars</td>
      <td role="cell">Steve 42nd</td>
      <td role="cell">December 13, 1982</td>
      <td role="cell">Las Vegas</td>
      <td role="cell">1.9</td>
      <td role="cell">Under the couch</td>
    </tr>
  </tbody>
</table>

			</div>
		</div>
	</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<?php require_once('templates/chat_script.php');?>
</body>
</html>