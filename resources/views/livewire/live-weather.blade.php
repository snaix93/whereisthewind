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
        <div class='mt-12 w-full lg:mt-0'>
            <div class='py-12 px-4 mx-auto w-full rounded-3xl shadow-xl lg:mr-0 lg:ml-auto bg-dark-700 sm:p-16 lg:p-14 xl:p-16' wire:loading.remove>
                @if(empty($errors->count()))
                    <h3 class='mt-4 text-5xl font-extrabold text-white md:mt-5'>
                        Enter the city
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
    </section>
    <section class='px-4 mx-auto w-full max-w-screen-xl sm:px-6 lg:px-8'>

        <!-- Section text -->
        <div class='mx-auto w-full max-w-xl text-center lg:max-w-3xl md:max-w-2xl'>
            <p class="inline-flex justify-center items-center py-2 px-6 text-sm font-medium tracking-wide text-white bg-gradient-to-r rounded-r-full rounded-tl-full from-dark-600 to-dark-700">
                Get in
            </p>
            <h2 class='mt-6 text-3xl font-extrabold text-white sm:text-4xl md:text-5xl'>
                Our simple design process
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
                      <span class='flex justify-center items-center mx-auto bg-gradient-to-r rounded-3xl shadow-xl w-18 h-18 from-dark-600 to-dark-700'>
                        <!-- TablerIcon name: clipboard-list -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-dark-300" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                          <rect x="9" y="3" width="6" height="4" rx="2" />
                          <line x1="9" y1="12" x2="9.01" y2="12" />
                          <line x1="13" y1="12" x2="15" y2="12" />
                          <line x1="9" y1="16" x2="9.01" y2="16" />
                          <line x1="13" y1="16" x2="15" y2="16" />
                        </svg>
                      </span>
                    <h3 class='mt-5 text-2xl font-semibold text-center text-white'>
                        {{ $cityData->city }}
                    </h3>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                        {{ $cityData->comment }}
                    </p>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                       Min: {{ $cityData->temp_min }}
                    </p>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                       Max: {{ $cityData->temp_max }}
                    </p>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                        Feels Like: {{ $cityData->temp_feels_like }}
                    </p>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                      Humidity:  {{ $cityData->humidity }}
                    </p>
                    <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                      Last Updated:  {{ $cityData->weather_updated_at }}
                    </p>
                </div>
            @endforeach
            <!-- Step -->
            <div class='w-full'>
                  <span class='flex justify-center items-center mx-auto bg-gradient-to-r rounded-3xl shadow-xl w-18 h-18 from-dark-600 to-dark-700'>
                    <!-- TablerIcon name: artboard -->
                    <svg class='w-10 h-10 text-dark-300' xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <rect x="8" y="8" width="8" height="8" rx="1" />
                      <line x1="3" y1="8" x2="4" y2="8" />
                      <line x1="3" y1="16" x2="4" y2="16" />
                      <line x1="8" y1="3" x2="8" y2="4" />
                      <line x1="16" y1="3" x2="16" y2="4" />
                      <line x1="20" y1="8" x2="21" y2="8" />
                      <line x1="20" y1="16" x2="21" y2="16" />
                      <line x1="8" y1="20" x2="8" y2="21" />
                      <line x1="16" y1="20" x2="16" y2="21" />
                    </svg>
                  </span>

                <h3 class='mt-5 text-2xl font-semibold text-center text-white'>
                    2. Design Concept
                </h3>
                <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                    We will get back with a few options including approximate budget and time estimates.
                </p>
            </div>

            <!-- Step -->
            <div class='w-full'>
                  <span class='flex justify-center items-center mx-auto bg-gradient-to-r rounded-3xl shadow-xl w-18 h-18 from-dark-600 to-dark-700'>
                    <!-- TablerIcon name: rocket -->
                    <svg xmlns="http://www.w3.org/2000/svg" class='w-10 h-10 text-dark-300' width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" />
                      <path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" />
                      <circle cx="15" cy="9" r="1" />
                    </svg>
                  </span>
                <h3 class='mt-5 text-2xl font-semibold text-center text-white'>
                    3. Product Creation
                </h3>
                <p class='mt-2 text-lg leading-relaxed text-center text-dark-300'>
                    Once the option is selected, the development process will commence. We will provide reports on the processes. Pay as we go.
                </p>
            </div>
        </div>
    </section>
</div>
