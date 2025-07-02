<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column mt-lg-4 ps-2 pe-2 ps-lg-7 pe-lg-4" data-kt-drawer="true"
    data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle"
    class="bg-primary">
    <div class="app-sidebar-logo flex-shrink-0 d-none d-md-flex flex-center align-items-center"
        id="kt_app_sidebar_logo">
        <!--begin::Logo-->
        <a href="{{ route('dashboard.index') }}">
            @if (isArabic())
                <img alt="Logo" src="{{ asset('placeholder_images/webstdy-logo.svg') }}"
                    class="h-50px d-none d-sm-inline app-sidebar-logo-default theme-light-show" />
            @else
                <img alt="Logo" src="{{ asset('placeholder_images/webstdy-logo.svg') }}"
                    class="h-50px d-none d-sm-inline app-sidebar-logo-default theme-light-show" />
            @endif
            @if (isArabic())
                <img alt="Logo" src="{{ asset('placeholder_images/logo_webstdy.svg') }}"
                    class="h-50px theme-dark-show" />
            @else
                <img alt="Logo" src="{{ asset('placeholder_images/logo_webstdy.svg') }}"
                    class="h-50px theme-dark-show" />
            @endif
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-1"></i>
            </div>
        </div>
        <!--end::Aside toggle-->
    </div>
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="hover-scroll-overlay-y my-5" data-kt-scroll="true"
            data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-bold px-6 bg-transparent"
                id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <x-dashboard.aside-item :slug="'/'" :route="route('dashboard.index')" :title="__('Dashboard')">
                    <i class="ki-outline ki-category fs-2"></i>
                </x-dashboard.aside-item>
                <!--end:Menu item-->
                @can('view_admins')
                    <x-dashboard.aside-item :slug="'admins'" :route="route('dashboard.admins.index')" :title="__('Admins')">
                        <i class="fas fa-user-shield fs-2"></i>
                    </x-dashboard.aside-item>
                @endcan


                <!--begin:Menu item-->
                @can('view_countries')
                    <x-dashboard.aside-item :slug="'countries'" :route="route('dashboard.countries.index')" :title="__('countries')">
                        <i class="ki-outline ki-map fs-2"></i>
                    </x-dashboard.aside-item>
                @endcan
                <!--end:Menu item-->
                @can('view_tools')
                    <x-dashboard.aside-item :slug="'tools'" :route="route('dashboard.tools.index')" :title="__('tools')">
                        <i class="fas fa-dumbbell fs-2"></i>

                    </x-dashboard.aside-item>
                @endcan

                
                @can('view_contact_us')
                    <x-dashboard.aside-item :slug="'contact_us'" :route="route('dashboard.contact-requests.index')" :title="__('Contact us')">
                        <i class="ki-outline ki-phone fs-1"></i>
                    </x-dashboard.aside-item>
                @endcan


                @can('view_services')
                    <x-dashboard.aside-item :slug="'services'" :route="route('dashboard.services.index')" :title="__('Services')">
                        <i class="ki-outline ki-plus fs-2"></i>
                    </x-dashboard.aside-item>
                @endcan
                <!--begin:Menu item-->

                <!--begin:Menu item-->
                @can('view_rates')
                    <x-dashboard.aside-item :slug="'rates'" :route="route('dashboard.rates.index')" :title="__('Rates')">
                        <i class="ki-outline ki-chart-line fs-2"></i>
                    </x-dashboard.aside-item>
                @endcan
                <!--end:Menu item-->

                <!--begin:Menu item-->
                @can('view_newsletter')
                    <x-dashboard.aside-item :slug="'newsletter'" :route="route('dashboard.newsletter.index')" :title="__('Newsletter')">
                        <i class="ki-outline ki-book-square fs-1"></i>
                    </x-dashboard.aside-item>
                @endcan


                <!--begin:Menu item-->
                @can('view_customers')
                    <x-dashboard.aside-item :slug="'customers'" :route="route('dashboard.customers.index')" :title="__('Customers')">
                        <i class="ki-outline ki-people fs-2"></i>
                    </x-dashboard.aside-item>
                @endcan
                <!--end:Menu item-->


                @can('view_roles')
                    <x-dashboard.aside-item :slug="'settings'" :route="route('dashboard.settings.roles.index')" :title="__('Settings')">
                        <i class="ki-outline ki-rescue fs-2"></i>
                    </x-dashboard.aside-item>
                @endcan
                <!--end:Menu item-->
                <!--begin:Menu item-->
                @can('view_recycle_bin')
                    <x-dashboard.aside-item :slug="'trash'" :route="route('dashboard.trash')" :title="__('Recycle Bin')">
                        <i class="ki-outline ki-trash fs-2"></i>
                    </x-dashboard.aside-item>
                @endcan
                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer d-flex align-items-center px-8 pb-10" id="kt_app_sidebar_footer">
        <!--begin::User-->
        <div class="">
            <!--begin::User info-->
            <div class="d-flex align-items-center" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                data-kt-menu-overflow="true" data-kt-menu-placement="{{ isArabic() ? 'top-end' : 'top-start' }}">

                <div class="d-flex flex-center cursor-pointer symbol symbol-circle symbol-40px">
                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label fs-2 fw-semibold text-primary">
                            {{ substr(auth()->user()->name, 0, 2) }}
                        </div>
                    </div>
                </div>
                <!--begin::Name-->
                <div class="d-flex flex-column align-items-start justify-content-center ms-3">
                    <span class="text-gray-500 fs-8 fw-semibold">{{ __('Hello') }}</span>
                    <a href="#"
                        class="text-gray-800 fs-7 fw-bold text-hover-primary">{{ auth()->user()->name }}</a>
                </div>
                <!--end::Name-->
            </div>
            <!--end::User info-->
            <!--begin::User account menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                data-kt-menu="true">
                <div class="menu-item px-5 my-1">
                    <a href="{{ route('dashboard.profile-info') }}" class="menu-link px-5">{{ __('Profile') }}</a>
                </div>
                <!--begin::Menu item-->
                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                    data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                    <a href="#" class="menu-link px-5">
                        <span class="menu-title position-relative">{{ __('Mode') }}
                            <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                                <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                            </span></span>
                    </a>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                        data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-outline ki-night-day fs-2"></i>
                                </span>
                                <span class="menu-title">{{ __('Light') }}</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-outline ki-moon fs-2"></i>
                                </span>
                                <span class="menu-title">{{ __('Dark') }}</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-outline ki-screen fs-2"></i>
                                </span>
                                <span class="menu-title">{{ __('System') }}</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                    data-kt-menu-placement="right-end" data-kt-menu-offset="-15px, 0">
                    <a href="{{ route('dashboard.change-language', 'en') }}" class="menu-link px-5">
                        <span class="menu-title position-relative">
                            {{ __('Language') }}
                            @if (isArabic())
                                <span
                                    class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                                    {{ __('Arabic') }}
                                    <img class="w-15px h-15px rounded-1 ms-2"
                                        src="{{ asset('assets/dashboard/media/flags/saudi-arabia.svg') }}"
                                        alt="" />
                                </span>
                            @else
                                <span
                                    class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                                    {{ __('English') }}
                                    <img class="w-15px h-15px rounded-1 ms-2"
                                        src="{{ asset('assets/dashboard/media/flags/united-states.svg') }}"
                                        alt="" />
                                </span>
                            @endif
                        </span>
                    </a>
                    <!--begin::Menu sub-->
                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ route('dashboard.change-language', 'en') }}"
                                class="menu-link d-flex px-5 @if (!isArabic()) active @endif">
                                <span class="symbol symbol-20px me-4">
                                    <img class="rounded-1"
                                        src="{{ asset('assets/dashboard/media/flags/united-states.svg') }}"
                                        alt="" />
                                </span>
                                {{ __('English') }}
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ route('dashboard.change-language', 'ar') }}"
                                class="menu-link d-flex px-5 @if (isArabic()) active @endif">
                                <span class="symbol symbol-20px me-4">
                                    <img class="rounded-1"
                                        src="{{ asset('assets/dashboard/media/flags/saudi-arabia.svg') }}"
                                        alt="" />
                                </span>
                                {{ __('Arabic') }}
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu sub-->
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <form id="logout-form" method="post" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="javascript:" onclick="$('#logout-form').submit()"
                            class="menu-link px-5">{{ __('Sign Out') }}</a>
                    </form>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::User account menu-->
        </div>
        <!--end::User-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Sidebar-->
