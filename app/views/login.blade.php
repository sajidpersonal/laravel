
<br /><br />Login<br />

@if($errors->any())
  <ul>
    {{ implode('', $errors->all('<li>:message</li>'))}}
  </ul>
@endif
 
{{ Form::open(array('route' => 'login.auth')) }}
 
  <p>{{ Form::label('username', 'Username') }}
  {{ Form::text('username') }}</p>
 
  <p>{{ Form::label('password', 'Password') }}
  {{ Form::password('password') }}</p>
 
  <p>{{ Form::submit('Submit') }}</p>
 
{{ Form::close() }}
<a href="<?php echo action('register', array());?>">Register</a>
&nbsp;&nbsp;&nbsp;
<a href="<?php echo action('forgot_password', array());?>">Forgot Password</a>