<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css'); }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('/js/main.js'); }}"></script>

    <title>Admin - prihlásenie</title>
</head>
<body class="relative min-h-screen">

    <main class="flex flex-col justify-center justify-items-center  h-full min-h-screen ">
        <div class="max-w-sm mx-auto flex flex-col items-center justify-center px-2 mt-4">
            <div class="bg-white px-6 pt-6 pb-4 rounded-md shadow-md text-black ">
                <a href="/" class=""><i class="fa fa-arrow-left" aria-hidden="true"></i> Späť</a>

                <h1 class="mb-8 text-3xl text-center mt-5">Prihlásenie do admin panelu</h1>
                <form action="/admin/login" method="POST">
                @csrf
                <input type="email" name="email" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="r_email" placeholder="Email" />
                @if($errors->has('email'))
                    <span>{{$errors->first('email')}}</span>
                @endif
                <input type="password" name="password" class="block border border-grey-light w-full p-2 rounded-md mb-4 focus:outline-none" id="r_password" placeholder="Heslo" />
                @if($errors->has('password'))
                    <span>{{$errors->first('password')}}</span>
                @endif
                <input type="submit" class="block w-full colored-button bg-[var(--color-button)] p-2 mt-10 font-bold text-white rounded-md hover:cursor-pointer" id="r_submit" value="Pokračovať">
                </form>
            </div>
        </div>
    </main>
</body>
</html>