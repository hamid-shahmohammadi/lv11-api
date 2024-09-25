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

    public function login (Request $request){

        $data =$request->validate([
            'email'=>['required','email'],
            'password'=>['required','min:6'],
        ]);
        $user=user::where('email',$data['email'])->first();
        if(!$user || !Hash::check($data['password'], $user->password)){
            return response([
                'message'=>'email or password incorrect'
            ],401);
        }
        $token=$user->createToken('auth_token')->plainTextToken;
        return[
            'user'=>$user,
            'token'=>$token
        ];
    }
}
```
## cmd
```
pamm Post -m
```
## schema
```
Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
```
## Post
```
class Post extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function author (){
        return $this->belongsTo(User::class,'user_id');
    }
}
```
## cmd
```
pam
php artisan make:controller PostController
```
## PostController
```
class PostController extends Controller
{
    public function index (){
        return Post::get();
    }
    public function createPost (Request $request){
        $data = $request->validate([
            'title'=>['required','string','min:3'],
            'content'=>['required','string','max:5000'],
            'user_id'=>['required','exists:users,id'],
        ]);
        return Post::create($data);
    }

}
```
## api
```
Route::middleware("auth:sanctum")->group(function(){
    Route::get('/posts',[PostController::class,"index"]);
    Route::post('/posts',[PostController::class,"createPost"]);
});
```
## DB::listen
```
DB::listen(fn($query)=>info($query->toRawSql()));
```
