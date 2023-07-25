
            <!DOCTYPE html>
            <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
            
                    <title>@yield('title')</title>
            
                    <!-- Fonts -->
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
            
                    <!-- Styles -->
                    @livewireStyles
            
                    <!-- Scripts -->
                    @vite(['resources/css/app.css', 'resources/js/app.js'])
                    {{-- @include('admin.header') --}}
                    @livewire('admin.header')
                </head>
                <body class="hold-transition sidebar-mini layout-fixed">
                    
            {{-- @livewire('navigation-menu') --}}
                
       
                    @include('sweetalert::alert')
             
                    <div class="wrapper">
                    @livewire('admin.topbar')
               
                         
                        
                                @livewire('admin.sidebar') 
                              
                                
                               
                             
                        
                                
                        
                                <main>
                                    {{ $slot }}
                                 
                                </main>
                                
                                @livewire('admin.footer');
                            </div>
                         
                     
                   
            
                    @stack('modals')
                    
                    @livewireScripts
                </body>
            </html>
            