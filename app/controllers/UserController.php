<?php

//use Cribbb\Storage\User\UserRepository as User;

class UserController extends BaseController {

    /**
     * User Repository
     */
    protected $user;

    /**
     * Inject the User Repository
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

    public function index() {
        return View::make('user');
    }

    public function dashboard() {
        if(Auth::check()){
            return View::make('dashboard');
        }else{
            echo "You are not authorized to view this section.";
        }
    }
    public function register(){
        if(!Auth::check()){
            return View::make('register');
        }else{
            return Redirect::intended('dashboard');
        }
    }
    public function register_save(){
        $data = (Input::all());
        
        $validator = Validator::make(
            array(
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password'],
                'password_confirmation' => $data['password_confirmation'],
            ),
            array(
                'username' => 'required|required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required'
            )
        );
        if ($validator->fails()){
            return Redirect::route('register')
                        ->withInput()
                        ->withErrors($validator->messages());
        }else{
            $user = new User;
            $user->username = $data['username'];
            $user->password = Hash::make(Input::get('password'));
            $user->email = $data['email'];
            $user->_token = md5($data['email'].$data['username']);
            $s=$user->save();
            
            $token = $user->_token;
            Mail::send('emails.verify', array('email'=>$user->email, 'username'=>$user->username, 'token' => $token), function($message) use ($data)
            {
                $message->to($data['email'], $data['username'])->from($data['email'], $data['username'])->subject('Verify!');
            });
            //return View::make('emails.verify', array('token'=>$user->_token));
            return Redirect::route('login')->with('flash', 'The new user has been created');
        }
    }
    public function verify(){
        
    }
    public function login()
    {
        if(!Auth::check()){
            return View::make('login');
        }else{
            return Redirect::intended('dashboard');
        }
    }
    public function login_auth(){
    $data = Input::all();
    if (Auth::attempt(array('username' => $data['username'], 'password' => $data['password'])))
    {
        return Redirect::intended('dashboard');
    }
    return Redirect::route('login.index')
                        ->withInput()
                        ->withErrors('Credentials Mismatch');
  }
    public function logout(){
      Auth::logout();
      return Redirect::intended('login');
  }
  public function forgotPassword(){
      if(!Auth::check()){
            return View::make('forgot_password');
        }else{
            return Redirect::intended('dashboard');
        }
  }
  public function forgotPasswordSend(){
      
  }
}
