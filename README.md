composer create-project laravel/laravel jetstream-livewire-app
cd jetstream-livewire-app

composer require laravel/jetstream
php artisan jetstream:install livewire --teams

npm install && npm run dev
php artisan migrate
php artisan serve

<!-- 
Error
@vite(['resources/css/app.css', 'resources/js/app.js']) 

Replace with below code
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}" defer></script>
-->


php artisan vendor:publish --tag=jetstream-views

php artisan make:model Category --migration
php artisan migrate

composer require te7a-houdini/laravel-trix
php artisan vendor:publish --provider="Te7aHoudini\LaravelTrix\LaravelTrixServiceProvider"
php artisan migrate
