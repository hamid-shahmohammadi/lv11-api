# lv11-api
lv11 api
```
php artisan install:api
config
migrate
```
## app/Models/User.php
```
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
```
## cmd
```
php artisan make:controller AuthController
```

## AuthController
```
class AuthController extends Controller
{
    public function register(Request $request){
        $data =$request->validate([
            'name'=>['required','string'],
            'email'=>['required','email','unique:users'],
            'password'=>['required','min:6'],
        ]);

        $user=User::create($data);
        $token=$user->createToken('auth_token')->plainTextToken;
        return [
            'user'=>$user,
            'token'=>$token
        ];
    }
}
```
