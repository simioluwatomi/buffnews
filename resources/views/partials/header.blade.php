<header class="navbar-wrap navbar-expand-lg flex-column">

    <div class="navbar navbar-border navbar-light bg-white">

        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <ul class="nav navbar-menu align-items-center ml-auto">

                <li class="nav-item d-none d-lg-flex mr-3">

                    <a href="https://github.com/simioluwatomi/buffnews" class="btn btn-secondary" target="_blank"
                       rel="noreferrer">

                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon" fill="currentColor">
                            <path
                                d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                        </svg>

                        Source code
                    </a>

                </li>

                @auth

                    <li class="nav-item dropdown">

                        <a href="#" data-toggle="dropdown"
                           class="nav-link d-flex align-items-center py-0 px-lg-0 px-2 text-reset ml-2"
                           aria-label="Show personal menu">

                            <span class="avatar avatar-sm">{{ auth()->user()->initials }}</span>

                            <span class="ml-2 d-none d-lg-block lh-1">

                                {{ auth()->user()->full_name }}

                                <span class="text-muted d-block mt-1 text-h6">{{ auth()->user()->role->name }}</span>

                            </span>

                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                            @can('create', \App\Models\News::class)

                                <a class="dropdown-item" href="{{ route('news.create') }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="icon dropdown-icon">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>

                                    Publish News

                                </a>

                            @endcan

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon dropdown-icon">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>

                                {{ __('Logout') }}

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </a>

                        </div>

                    </li>

                @endauth

            </ul>

        </div>

    </div>

</header>
