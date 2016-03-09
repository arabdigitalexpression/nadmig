# Changes happen

### Language   
set langue to arabic hard coded 
edit this file `/app/Http/Middleware/Custom/Locale.php`
where 
```
$language = Session::get('language', Config::get('app.locale'));
```
to 
```
$language = Session::get('language', 'ar');
```
also add the arabic language to the language table 