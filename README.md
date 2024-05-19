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
