{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name -->
            <div>
                <x-label for="first_name" :value="__('FirstName')" />

                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')"
                    required autofocus />
            </div>
            <!-- Last Name -->
            <div>
                <x-label for="last_name" :value="__('LastName')" />

                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required
                    autofocus />
            </div>

            <!-- Phone -->
            <div>
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
                    autofocus />
            </div>

            <!-- role -->
            <div>
                <x-label for="role" :value="__('role')" />

                <x-input id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}





<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('icons/iconic/css/material-design-iconic-font.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('icons/bootstrap-icons/bootstrap-icons.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/login.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/utils.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }} ">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/scrollBar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    {{-- @include('dashboard.components.header')
    @yield('header') --}}
</head>

<body>

    <div class="limiter">


        <div class="container-login100" style="background-color: rgb(229, 237, 237)">
            @if ($errors->any())
                @include('dashboard.components.alerts')
                @yield('validation')
            @endif
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <span class="login100-form-title p-b-49">
                        Register
                    </span>
                    <div class="row ">
                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate="First Name is reauired">
                                <span class="label-input100">First Name</span>
                                <input class="input100" type="text" name="first_name"
                                    placeholder="Type first name">
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate="Last Name is reauired">
                                <span class="label-input100">Last Name</span>
                                <input class="input100" type="text" name="last_name" placeholder="Type last name">
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-23" data-validate="Phone is reauired">
                                <span class="label-input100">Phone</span>
                                <input class="input100" type="text" name="phone" placeholder="Type your phone">
                                <span class="focus-input100" data-symbol="&#xf206;"></span>
                            </div>
                            {{-- @error('phone')
                                <div class="error">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror --}}
                        </div>
                        <div class="col-6">
                            <div class="wrap-input100 validate-input m-b-20 m-t-7" data-validate="Role is reauired">
                                <span class="label-input100">Role</span>
                                <select class="form-select" style="border: none" name="role" required>
                                    <option value="super">Super</option>
                                    <option value="notifications">Notifications</option>
                                    <option value="captains">Captains</option>
                                    <option value="invitations">Invitations</option>
                                    <option value="trips">Trips</option>
                                    <option value="bills">Bills</option>
                                    <option value="users">Users</option>

                                </select>

                            </div>
                        </div>
                    </div>
                    {{-- @error('email')
                        <div class="error">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror --}}
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Email is reauired">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email" placeholder="Type your email">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Type your password">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    <div class="  wrap-input100 validate-input " data-validate="Password Confirmation is required">
                        <span class="label-input100">Password Confirmation</span>
                        <input class="input100" type="password" name="password_confirmation"
                            placeholder="Type your password confirmation">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    <div class="text-right p-t-8 p-b-31">
                        <a href="{{ route('login') }}">
                            Already registered?
                        </a>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>

                            <button class="login100-form-btn">
                                Register
                            </button>


                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>

    <script src="js/login/jquery-3.2.1.min.js"></script>
    <script src="js/login/main.js"></script>


</body>

</html>
