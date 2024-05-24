<div>
    <section class='px-4 pt-12 pb-10 md:pb-12 md:pt-16 sm:px-6 lg:px-8'>
        <div class='mx-auto max-w-screen-xl'>
            <div class='mx-auto w-full text-center max-w-screen-4xl xl:max-w-5xl'>
                <div wire:loading.remove>
                    <p class="inline-flex justify-center items-center py-2 px-6 text-sm font-medium tracking-wide text-white bg-gradient-to-r rounded-r-full rounded-tl-full from-dark-600 to-dark-700">
                        Weather Forecast
                    </p>
                    <h1 class='mt-4 text-4xl font-extrabold text-white md:mt-5 sm:text-5xl md:text-6xl' >
                        Where is the Wind?
                    </h1>

                </div>
                <div wire:loading>
                    <div class='mx-auto w-full text-center max-w-screen-4xl xl:max-w-5xl mt-12'>
                        <img class="inline-flex justify-center items-center" src="https://i.giphy.com/3ohs7TrCSp7c8ZrxBe.webp">
                    </div>
                    <h1 class='mt-4 text-4xl font-extrabold text-white md:mt-5 sm:text-5xl md:text-6xl'>
                        Loading...
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <section class='py-12 px-4 md:py-16 sm:px-6 lg:px-8'>
        @if(empty($currentWeather))
        <div class='mt-12 w-full lg:mt-0'>
            <div class='py-12 px-4 mx-auto w-full rounded-3xl shadow-xl lg:mr-0 lg:ml-auto bg-dark-700 sm:p-16 lg:p-14 xl:p-16' wire:loading.remove>
                @if(empty($errors->count()))
                    <h3 class='mt-4 text-5xl font-extrabold text-white md:mt-5'>
                        Enter a city or a country
                    </h3>
                @else
                    <x-validation-errors class="text-white text-3xl"></x-validation-errors>
                @endif

                <div class="mt-4">
                    <textarea id="input" type='text' name='input' wire:model="city"
                              wire:keydown.enter="getWeather"
                              cols="12"
                              placeholder='Ex: Madagascar'
                              class='p-4 mt-2 w-full text-2xl font-medium text-white rounded-2xl border-2 border-solid transition duration-200 ease-in-out outline-none bg-dark-800 border-dark-800 focus:border-dark-600 focus:outline-none'
                              required></textarea>
                    @auth
                        <div class='flex justify-start mt-6' wire:click="getWeather">
                            <button type='submit' class="flex justify-center items-center py-4 px-8 w-auto h-14 text-base font-semibold leading-snug bg-white rounded-full transition ease-in-out duration-250 text-dark-900 hover:text-white focus:outline-none hover:bg-dark-900">
                                Get
                            </button>
                        </div>
                    @elseguest
                        <div class='flex justify-start mt-6' >
                            <a href="/register" type='button' class="flex justify-center items-center py-4 px-8 w-auto h-14 text-base font-semibold leading-snug bg-white rounded-full transition ease-in-out duration-250 text-dark-900 hover:text-white focus:outline-none hover:bg-dark-900">
                                Sign Up/In
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
        @else
            <div class='mt-12 w-full lg:mt-0'>
                <div class='py-12 px-4 mx-auto w-full rounded-3xl shadow-xl lg:mr-0 lg:ml-auto bg-dark-700 sm:p-16 lg:p-14 xl:p-16' wire:loading.remove>
                    <h3 class='mt-4 text-2xl font-extrabold text-white md:mt-5'>
                        {{ $currentWeather }}
                    </h3>
                    @if($showHowToDressButton)
                        <div class='flex justify-start mt-6' wire:click="howToDressAPI">
                            <button type='submit' class="flex justify-center items-center py-4 px-8 w-auto h-14 text-base font-semibold leading-snug bg-white rounded-full transition ease-in-out duration-250 text-dark-900 hover:text-white focus:outline-none hover:bg-dark-900">
                                How To Dress?
                            </button>
                        </div>
                    @endif
                    @if(!empty($howToDress))
                        <h3 class='mt-4 text-2xl font-extrabold text-white md:mt-5'>
                            {{ $howToDress }}
                        </h3>
                    @endif
                    <div class='flex justify-start mt-6' wire:click="resetApiResponse">
                        <button type='submit' class="flex justify-center items-center py-4 px-8 w-auto h-14 text-base font-semibold leading-snug bg-white rounded-full transition ease-in-out duration-250 text-dark-900 hover:text-white focus:outline-none hover:bg-dark-900">
                            Try again?
                        </button>
                    </div>

                </div>
            </div>
        @endif
    </section>
    <section class='px-4 mx-auto w-full max-w-screen-xl sm:px-6 lg:px-8'>
        @if(!empty($userCities))
        <!-- Section text -->
        <div class='mx-auto w-full max-w-xl text-center lg:max-w-3xl md:max-w-2xl'>
            <p class="inline-flex justify-center items-center py-2 px-6 text-sm font-medium tracking-wide text-white bg-gradient-to-r rounded-r-full rounded-tl-full from-dark-600 to-dark-700">

            </p>
            <h2 class='mt-6 text-3xl font-extrabold text-white sm:text-4xl md:text-5xl'>
                Previous Requests
            </h2>
            <p class='mt-6 text-xl text-dark-300'>
                <!--      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sapien massa, convallis a pellentesque nec.-->
            </p>
        </div>

        <!-- Process steps -->
        <div class='grid gap-10 mx-auto mt-12 max-w-xl lg:mt-16 lg:grid-cols-3 lg:grid-x-16 lg:max-w-none'>

            @foreach($userCities as $cityData)
            <!-- Step-->
                <div class='w-full'>
                    <h3 class='mt-5 text-2xl font-semibold text-center text-white'>
                        {{ ucfirst($cityData->city) }}  {{ $cityData->current_temp }}°C
                    </h3>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                        {{ ucfirst($cityData->comment) }}
                    </p>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                       Min: {{ $cityData->temp_min }}°C
                    </p>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                       Max: {{ $cityData->temp_max }}°C
                    </p>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                        Feels Like: {{ $cityData->temp_feels_like }}°C
                    </p>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                      Humidity:  {{ $cityData->humidity }}%
                    </p>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                      Last Updated:  {{ $cityData->updated_at->diffForHumans() }}
                    </p>
                </div>
            @endforeach
        </div>
        @endif
    </section>
</div>
