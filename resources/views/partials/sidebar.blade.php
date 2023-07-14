<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-text mx-3">{{ __('Homepage') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item {{ request()->is('admin/results') || request()->is('admin/results') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.results.index') }}">
            <i class="fas fa-poll"></i>
            <span>{{ __('Результаты') }}</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
           aria-controls="collapseTwo">
            <span>{{ __('Пользователи') }}</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}"
                   href="{{ route('admin.permissions.index') }}"> <i class="fa fa-briefcase mr-2"></i> {{ __('Права') }}
                </a>
                <a class="collapse-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}"
                   href="{{ route('admin.roles.index') }}"><i class="fas fa-users-cog mr-2"></i> {{ __('Роли') }}</a>
                <a class="collapse-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}"
                   href="{{ route('admin.users.index') }}"> <i class="fas fa-users mr-2"></i> {{ __('Список') }}</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->is('admin/categories') || request()->is('admin/categories') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-list"></i>
            <span>{{ __('Категории') }}</span></a>
    </li>

    <li class="nav-item {{ request()->is('admin/questions') || request()->is('admin/questions') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.questions.index') }}">
            <i class="fas fa-question-circle"></i>
            <span>{{ __('Вопросы') }}</span></a>
    </li>

    <li class="nav-item {{ request()->is('admin/options') || request()->is('admin/options') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.options.index') }}">
            <i class="fas fa-list-ol"></i>
            <span>{{ __('Варианты ответов') }}</span></a>
    </li>
</ul>
