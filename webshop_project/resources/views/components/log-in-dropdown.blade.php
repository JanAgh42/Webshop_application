<div>
    @auth
    <div>
        <div class="relative text-gray-500 text-center font-semibold block p-2 text-sm rounded-md" id="menu-item-0">
            {{ Auth::user()->username }}
            <div class="flex justify-center gap-4 sm:block mt-4">
                <a href="/profile" class="block text-center w-full rounded-md p-0.5 text-white mt-2 colored-button bg-[var(--color-button)]">
                    Môj účet
                </a>
                <a href="/logout" class="block text-center w-full rounded-md p-0.5 bg-gray-500 text-white mt-2 hover:bg-gray-600">
                    Odhlásiť sa
                </a>
            </div>
        </div>
    </div>
    @endauth

    @guest
    <div>
        <span class="text-sm text-gray-500">Prihlásiť sa</span>
        <form class="flex flex-col px-4" action="/login" method="POST">
            @csrf
            <input type="email" placeholder="Email" name="email" class="w-full my-2 rounded-sm p-0.5 focus:outline-none focus:bg-gray-50 border-b border-grey-light" id="input-email">
            @if($errors->has('email'))
            <span>{{$errors->first('email')}}<span />
                @endif
                <input type="password" placeholder="Heslo" name="password" class="w-full rounded-sm p-0.5 focus:outline-none focus:bg-gray-50 border-b border-grey-light" id="input-password">
                @if($errors->has('password'))
                <span>{{$errors->first('password')}}<span />
                    @endif
                    <input type="submit" value="Prihlásiť sa" class="block m-auto rounded-md cursor-pointer p-0.5 px-10 text-white mt-2 colored-button bg-[var(--color-button)]" id="input-submit">
                    <span class="text-xs text-gray-500 mt-2">Nemáte účet? <a href="/register" class="text-blue-400 hover:text-blue-500">Zaregistrujte sa</a></span>
                    <a href="/admin/login" class="text-blue-400 text-xs mt-1 hover:text-blue-500">Admin panel</a>
        </form>
    </div>
    @endguest
</div>