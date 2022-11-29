<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
          
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
<div style="display: flex;
justify-content: center;
align-items: center;
text-align: center;
min-height: 100vh;">
           
<div style="background-color: #fff;border-radius: 10px;  box-shadow: 0 14px 28px rgba(0,0,0,0.25),  0 10px 10px rgba(0,0,0,0.22);
position: relative;overflow: hidden;width: 520px;max-width: 100%;min-height: 430px;" id="container">

	<div style=" justify-content: center display: block; heigth:10px; ">
        <center>            
            <!--<div style=" justify-content: center display: block;"><img src="{{asset('images/biormed_logo.jpg')}}" width="200"></div>		
            -->
            DOCUMENTARI
            </center>
	</div>
	<div >
        <div >
             <div style="float: left; margin-left: 15px;" >
            <x-jet-label for="email" value="{{ __('Email') }}" style="color: rgb(66, 5, 146);"/>
            </div>
            <x-jet-input id="email" 
            class="block mt-1 w-full" 
            type="email" 
            name="email" :value="old('email')" required  
            style=" 
            padding: 15px 10px;
            margin: 10px;
            width: 90%;
            border: 0.2px solid rgb(180, 178, 178);
            transition: border-width 0.2s ease;
            border-radius: 2px;
            color: rgb(85, 81, 81);
            " />
        </div>

        <div class="mt-4" >
            <div style="float: left; margin-left: 15px;" >
            <x-jet-label for="password" value="{{ __('Password') }}" style="color: rgb(66, 5, 146);"/>
            </div>
            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" style=" 
            padding: 15px 10px;
            margin: 10px;
            width: 90%;
            border: 0.2px solid rgb(180, 178, 178);
            transition: border-width 0.2s ease;
            border-radius: 2px;
            color: rgb(85, 81, 81);
            "  />
        </div>

        <div class="block mt-4 ml-5" style="margin-left: 15px;">
            <label for="remember_me" class="flex items-center">
                <x-jet-checkbox id="remember_me" name="remember" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-jet-button  style="position: relative;                    
            padding: 15px 10px;
            margin: 10px;
            width: 90%;
            border: 0.2px solid rgb(180, 178, 178);
            transition: border-width 0.2s ease;
            border-radius: 2px;
            color: rgb(235, 228, 228);
            background-color: rgb(101, 51, 192)">
                {{ __('Entrar') }}
            </x-jet-button>
        </div>
		
	</div>

</div>
</div>
          
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
