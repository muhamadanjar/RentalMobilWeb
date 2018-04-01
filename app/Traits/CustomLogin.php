<?php
namespace App\Traits;
use App\User;
use Illuminate\Http\Request;
use Validator;
use DB;
use Mail;
use Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Laracasts\Flash\Flash;
trait CustomLogin{
    
    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        $rules = [
            'username' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
        $input = $request->only(
            'username',
            'name',
            'email',
            'password',
            'password_confirmation'
        );
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        $checkuser = User::where('username',$request->username)->count();
        if(($checkuser) > 0){
            Flash::error(trans('flash/register.already'));
            return response()->json([
                'success'=> true,
                'message'=> 'Account already used..'
            ]);
        }
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $user = User::create(['username'=>$request->username,'name' => $name, 'email' => $email, 'password' => Hash::make($password),'isactived'=> 1]);
        $user->assignRole('customer');
        $verification_code = str_random(30); //Generate verification code
        DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);
        $subject = "Please verify your email address.";
        /*Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('FROM_EMAIL_ADDRESS'), "From User/Company Name Goes Here");
                $mail->to($email, $name);
                $mail->subject($subject);
        });*/
        Flash::success(trans('flash/register.success'));
        return response()->json([
            'success'=> true, 
            'message'=> 'Thanks for signing up! Please check your email to complete your registration.'
        ]);
    }

    /**
     * API Verify User
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyUser($verification_code){
        $check = DB::table('user_verifications')->where('token',$verification_code)->first();
        if(!is_null($check)){
            $user = User::find($check->user_id);
            if($user->isverified == 1){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Account already verified..'
                ]);
            }
            $user->update(['isverified' => 1]);
            DB::table('user_verifications')->where('token',$verification_code)->delete();
            return response()->json([
                'success'=> true,
                'message'=> 'You have successfully verified your email address.'
            ]);
        }
        return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);
    }

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginjwt(Request $request){
        $rules = [
            //'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
        ];
        $input = $request->only('username', 'password');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'isverified' => 1,
            'isactived' => 1
        ];

        $token = JWTAuth::attempt($credentials);
        
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token) {
                return response()->json(['success' => false, 'error' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 500);
        }
        // all good so return the token
        $_user = DB::table('users')->where('username',$request->username)->first();
        return response()->json(['success' => true, 'data'=> [ 'token' => $token, 'user'=>$_user ]])->header('Authorization','Bearer '.$token);
        //return response()->json(compact('token'));
    }
    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logoutjwt(Request $request) {
        $this->validate($request, ['token' => 'required']);
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }

    /**
     * API Recover Password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recover(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $error_message = "Your email address was not found.";
            return response()->json(['success' => false, 'error' => ['email'=> $error_message]], 401);
        }
        try {
            Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject('Your Password Reset Link');
            });
        } catch (\Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
        return response()->json([
            'success' => true, 'data'=> ['msg'=> 'A reset email has been sent! Please check your email.']
        ]);
    }
}