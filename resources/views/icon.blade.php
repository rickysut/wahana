<div class="mb-6">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('add')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg class="fill-current w-8 h-8  " xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">add</small>
        </div>
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('app')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="fill-current w-8 h-8  ">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">app</small>
        </div>
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('bookmark')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg class="fill-current w-8 h-8  " xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">bookmark</small>
        </div>
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('cart')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg class="fill-current w-8 h-8  " xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">cart</small>
        </div>
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('clip')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg class="fill-current w-8 h-8  " viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">clip</small>
        </div>
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('delete')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg class="fill-current w-8 h-8  " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">delete</small>
        </div>
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('edit')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg class="fill-current w-8 h-8  " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                            </path>
                            <path fill-rule="evenodd"
                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">edit</small>
        </div>
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('export')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg class="fill-current w-8 h-8  " xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">export</small>
        </div>
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('filter')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg class="fill-current w-8 h-8  " viewBox="0 0 24 24">
                            <path
                                d="M14 12v7.88c.04.3-.06.62-.29.83a.996.996 0
                            01-1.41 0l-2.01-2.01a.989.989 0
                            01-.29-.83V12h-.03L4.21 4.62a1 1 0
                            01.17-1.4c.19-.14.4-.22.62-.22h14c.22 0
                            .43.08.62.22a1 1 0 01.17 1.4L14.03 12H14z">
                            </path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">filter</small>
        </div>
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('search')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg viewBox="0 0 512 512" class="fill-current w-8 h-8  ">
                            <path
                                d="M505 442.7L405.3
            343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7
            44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1
            208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4
            2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9
            0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7
            0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0
            128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">search</small>
        </div>
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('show')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            aria-hidden="true" class="fill-current w-8 h-8  ">
                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z"></path>
                            <path fill-rule="evenodd"
                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">show</small>
        </div>
        <div class="col-span-4 sm:col-span-3 lg:col-span-2 2xl:col-span-1 text-center">
            <div @click.prevent="navigator.clipboard.writeText('users')">
                <!-- Card -->
                <div class="card card-category flex flex-col items-center card-copy">

                    <div class="card-body">


                        <svg class="fill-current w-8 h-8  " xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>

                </div>
                <!-- END: Card -->
            </div>
            <small class=" text-xs leading-normal">users</small>
        </div>
    </div>
</div>
