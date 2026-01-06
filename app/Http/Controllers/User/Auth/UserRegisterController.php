<?php



    namespace App\Http\Controllers\User\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Validation\ValidationException;


    use App\Mail\VerifyEmail;
    
    class UserRegisterController extends Controller
    {

        public function index(){
            return view('user.auth.register');
        }

        public function register(Request $request)
        {
            try {
                Log::info('[REGISTER] Incoming request', [
                    'email' => $request->email,
                    'time'  => now()->toDateTimeString(),
                ]);
    
                // VALIDATION
                Log::info('[REGISTER] Running validation...');
                $request->validate([
                    'name'     => 'required|string|max:255',
                    'email'    => 'required|email|unique:users,email',
                    'password' => 'required|string|min:6|confirmed',
                ]);
                Log::info('[REGISTER] Validation passed.');
    
                // CREATE USER
                Log::info('[REGISTER] Creating user...');
                $user = User::create([
                    'name'        => $request->name,
                    'email'       => $request->email,
                    'password'    => Hash::make($request->password),
                    'is_approved' => false,
                    'role'        => 'user',
                ]);
                Log::info('[REGISTER] User created successfully', [
                    'user_id' => $user->id,
                    'email'   => $user->email,
                ]);
    
                // LOGIN
                Auth::login($user);
                Log::info('[REGISTER] User logged in', ['user_id' => $user->id]);
    
                // SEND VERIFICATION EMAIL
                Log::info('[REGISTER] Sending email verification...', [
                    'user_id' => $user->id
                ]);
                $user->sendEmailVerificationNotification();
                $user->update(['last_verification_sent' => now()]);
                Log::info('[REGISTER] Verification email sent successfully', [
                    'user_id' => $user->id
                ]);
    
                return redirect()->route('verification.notice')
                                 ->with('info', 'Please check your email to verify your account.');
    
            } catch (ValidationException $e) {
                // FRONTEND WILL SHOW SPECIFIC VALIDATION ERRORS
                return back()->withErrors($e->errors())->withInput();
            } catch (\Exception $e) {
                // LOG OTHER ERRORS
                Log::error('[REGISTER] Error occurred', [
                    'message' => $e->getMessage(),
                    'line'    => $e->getLine(),
                    'file'    => $e->getFile(),
                    'trace'   => $e->getTraceAsString(),
                ]);
    
                return back()->withInput()->with('error', 'Something went wrong. Please try again.');
            }
        }
        
        
        
    }
        

    
    


