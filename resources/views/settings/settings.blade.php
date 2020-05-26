@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">
                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        {{ __('Settings') }}
                    </div>

                    <form class="w-full p-6" method="POST" action="{{ route('settings.update') }}">
                        @csrf

                        <div class=" flex-wrap mb-6">
                            <label class="block text-gray-700 text-sm font-bold">
                                Security Type :
                            </label><br>

                            <input value="password" name="security_type"
                               {{ is_null($settings) ? 'checked': ($settings->security_type == 'password' ? 'checked' : '') }}
                               type="radio" id="password">
                            <label class="text-sm mr-2" for="password">Password</label>

                            <input value="pattern" name="security_type"
                               {{ $settings->security_type == 'pattern' ? 'checked' : '' }}
                               type="radio" id="pattern">
                            <label class="text-sm" for="pattern">Pattern</label>

                            @error('security_type')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class=" flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 text-sm font-bold">
                                Line On Move :
                            </label><br>

                            <input value="0"
                               {{ $settings->line_on_move == 0 ? 'checked' : '' }}
                               name="line_on_move" type="checkbox" id="line_on_move">
                            <label class="text-sm" for="line_on_move">True</label>

                            @error('line_on_move')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap items-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Update') }}
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
