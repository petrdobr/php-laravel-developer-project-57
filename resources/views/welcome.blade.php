<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('messages.appName') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div class=" mx-auto max-w-10xl p-6 mt-16 text-start">
                    <!-- Your main content goes here -->
                    <h1 class="mt-4 mb-4"><b>Учебный проект "Менеджер Задач"</b></h1>
                    <p>Выполнен в рамках обучения на курсе "Веб-разработка на Laravel" на платформе Хекслет.</p>
                    <p>Выполнил Доброхотов Петр</p>
                    <p>github: 
                        <a href="https://github.com/petrdobr/php-laravel-developer-project-57" class="text-gray-600 hover:text-gray-900">
                            php-laravel-developer-project-57
                        </a>
                    </p>
                    <h2 class="mt-4 mb-2"> Описание функционала</h2>
                    <p>Для совершения действий требуется авторизация. Можно воспользоваться тестовым пользователем email: test@t.t, pass: testtest</p>
                    <p>Модуль регистрации и авторизации пользователей реализован с помощью laravel/breeze, основной функционал оставлен без изменений, но удалена возможность редактирования профиля.</p>
                    <p>Так что нового пользователя можно создать, за него можно авторизоваться, но его нельзя редактировать и удалять.</p>
                    <br>
                    <p>Задачи, статусы и метки можно создавать, изменять, удалять.</p>
                    <p>Каждой задаче можно присвоить один статус и больше одной метки. При создании указывается исполнитель из списка пользователей.</p>
                    <p>Если существуют задачи, которым присвоен статус или метка, то этот статус или метку удалить нельзя. Действие вернет предупреждение (flash-сообщение).</p>
                    <p>Удалить задачу может только пользователь, который её создал.</p>
                    <p>На странице задач реализована фильтрация по статусу, автору задачи и ее исполнителю.</p>
                        <br><br>
                    <p>Следующий текст нужен для прохождения автоматических тестов:</p>
                    <p>    Привет от Хекслета! </p>
                    <p>    Это простой менеджер задач на Laravel</p>
                </div>
            </main>
        </div>
    </body>
</html>