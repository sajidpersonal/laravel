<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Email Verification</h2>

		<div>
			To verify your email address, click here: {{ URL::to('verify', array($token)) }}.
		</div>
	</body>
</html>