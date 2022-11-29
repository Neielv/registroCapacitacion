<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Instituto de la Democracia</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">  
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
   
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        input[type='number']::-webkit-inner-spin-button,
        input[type='number']::-webkit-outer-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }
      
        .custom-number-input input:focus {
          outline: none !important;
        }
      
        .custom-number-input button:focus {
          outline: none !important;
        }
      </style>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

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
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    @stack('js')


    <script>
        livewire.on('alert', function(title,message) {
            Swal.fire(
                title,
                message,
                'success'
            )
        });
    </script>

<script>
  livewire.on('error', function(title,message) {
    Swal.fire({
  icon: 'error',
  title: title,
  text: message
  
})
  });
</script>




    <script>
        function decrement(e) {
          const btn = e.target.parentNode.parentElement.querySelector(
            'button[data-action="decrement"]'
          );
          const target = btn.nextElementSibling;
          let value = Number(target.value);
         if (value>0)
          value--;
          target.value = value;
        }
      
        function increment(e) {
          const btn = e.target.parentNode.parentElement.querySelector(
            'button[data-action="decrement"]'
          );
          const target = btn.nextElementSibling;
          let value = Number(target.value);
          value++;
          target.value = value;
        }
      
        const decrementButtons = document.querySelectorAll(
          `button[data-action="decrement"]`
        );
      
        const incrementButtons = document.querySelectorAll(
          `button[data-action="increment"]`
        );
      
        decrementButtons.forEach(btn => {
          btn.addEventListener("click", decrement);
        });
      
        incrementButtons.forEach(btn => {
          btn.addEventListener("click", increment);
        });
      </script>
</body>

</html>
