<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900">
	<style>
		@media only screen and (max-width: 1024px){			
			.paddedBox{padding-left:10px !important;padding-right:10px !important;}
			.paddedBox .box {padding:0 5px !important;font-size:10px;}
			.paddedBox .box table td table{padding:5px !important;}
		}
		@media only screen and (max-width: 769px){			
			body .block {width:90% !important;}						
		}
		@media only screen and (max-width: 580px){
			.logo {display: inline-block;padding: 10px 0 !important;text-align: center !important;width: 100% !important;}
			.summary {padding: 10px 0 !important;text-align: center !important;width: 100% !important;float: left;margin: 0 !important;}
			.button {display: inline-block;padding: 0 !important;width: 100% !important;}
			.text {display: inline-block;padding: 20px 0 !important;text-align: center !important;width: 100% !important;}
			.links {line-height: 34px;margin: 20px !important;padding:15px!important;text-align: center;}
			.links td {display: inline-block;text-align: center;}
			.links .heading {display: block;padding:10px 0 0 !important;text-align: center;width: 100% !important;}
			.button > table {margin: 0 auto;width: 140px;}
			.mid-table {padding: 0 !important;}
			.box {clear: both;display: block;float: none;margin: 0 auto 15px;overflow: hidden;padding: 0 !important;width:90% !important;}
			.box > table {height: auto;}
			.mid-content {padding: 10px 15px 0 !important;}
		}				
		.im{color:#000 !important;}
		body{font-family: "Lato",sans-serif;}
	</style>

<body style="padding:0;margin:0;color:#000;">
@php($strUrl =  Request::root())
	<div class="block" style="border:12px solid #ccc;background-color:#fff;width:760px;margin:10px auto;font-family:'Lato',sans-serif;font-weight: 700;font-size: 12px;">
		<table cellpadding="0" cellspacing="0" style="width:100%;">
			<tbody>
				<tr>
					<td style="text-align: left;padding: 85px 30px; line-height: 1.5em;">
						<h3>Hello {{ $name }},</h3>
						<p style="margin:30px 0;">Thank you for the registration. For your account activation please <a href="{{url('/verify-user/'.$email_confirmation_code)}}">Click here</a> to activate your account.</p>
						<p>Regards, <br>Team Tester!</p>
					</td>					
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>