# route
```
Route::middleware("auth:sanctum")->group(function(){
    Route::get('/posts',[PostController::class,"index"]);
    Route::post('/posts',[PostController::class,"createPost"])->name('api.create.post');
});
```
# Post
```
class Post extends Model
{
    use HasFactory,LogsActivity;
    protected $guarded=[];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['title', 'content']);
        // Chain fluent methods for configuration options
    }
```
# PostController
```
public function createPost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'metadata' => 'required',
            'user_id' => 'required',
        ]);

        $post=Post::create($validated);

        activity()
            ->performedOn($post)
            ->causedBy(Auth::user())
            ->withProperties([
                'url' => route('api.create.post'),
                'type' => 'create',
                'attr'=>$post->toArray()
            ])
            ->log('api create post');

        return $post;
    }
```
